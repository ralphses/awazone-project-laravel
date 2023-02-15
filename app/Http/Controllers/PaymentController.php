<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransferRequest;
use App\Models\AibopayAccount;
use App\Models\Card;
use App\Models\monnify\MonnifyCredentials;
use App\Models\Termii\TermiiService;
use App\Models\Transaction;
use App\Models\Utility;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Client\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Nette\Utils\Random;

class PaymentController extends Controller
{

    public function viewTopUp()
    {

        $userAibopayAccounts = Auth::user()->aibopayAccounts;

        if(count($userAibopayAccounts) < 1) {
            return redirect(route('user.aibopay-accounts.create'));
        }

        return view(
            'dashboard.aibopay.payment.view-top-up-page',
            [
                'methods' => Utility::PAYMENT_METHOD,
                'currencies' => Utility::AIBOPAY_ACCOUNT_CURRENCY,
                'cards' => Auth::user()->card,
                'accounts' => $userAibopayAccounts,
                'monnifyAccount' => Auth::user()->monnifyAccount
            ]
        );
    }

    public function startPayment(Request $request): Factory|View|Redirector|RedirectResponse|Application
    {

        //Validate Request
        $request->validate(
            [
                "pay-method" => ['required', Rule::in(Utility::PAYMENT_METHOD)],
                'amount' => ['required', 'numeric', 'regex:(\d)'],
                'description' => ['required', 'string']
            ]
        );

        if($request->get('pay-method') === "DEBIT/CREDIT CARD") {

            //Validate User request
            $request->validate([
                'currency' => ['required', Rule::in(Utility::AIBOPAY_ACCOUNT_CURRENCY)],
                'dest-account' => ['required', 'string'],
                'card' => ['required', 'integer']
            ]);

            //Check if user is paying with a new Card or already stored card
            if($request->get('card') == 0) {

                //Validate new card
                $request->validate(
                    [
                        'card-number' => ['required', 'string', 'min:12', 'regex:(\d)'],
                        'expiry-month' => ['required'],
                        'card-pin' => ['required', 'string', 'max:4', 'min:4', 'regex:(\d)'],
                        'card-cvv' => ['required', 'string', 'max:3', 'min:3', 'regex:(\d)'],
                    ]
                );
            }

            //Initialize Monnify Transaction
            $transactionInitResponse = $this->transactionInit(
                floatval($request->get('amount')),
                Auth::user()->name,
                Auth::user()->email,
                $request->get('description'),
                $request->get('currency')
            );

            if($transactionInitResponse->successful()) {

                //Save transaction to database
                $newTransaction = Transaction::create(
                    [
                        'transactionReference' => $transactionInitResponse->json('responseBody')['transactionReference'],
                        'paymentReference' => $transactionInitResponse->json('responseBody')['paymentReference'],
                        'customerEmail' => Auth::user()->email,
                        'paymentMethod' => "",
                        'transactionProcessor' => Utility::PAYMENT_PROCESSORS['monnify'],
                        'description' => $request->get('description'),
                        'transactionType' => Utility::TRANSACTION_TYPE['INCOME'],
                        'amount' => $request->get('amount'),
                        'fee' => Utility::TRANSACTION_FEES['transfer-internal'],
                        'transactionStatus' => Utility::TRANSACTION_STATUS['PENDING'],
                    ]
                );
            }
            else {
                return $this->viewTopUp()->with(['error' => 'Internal server error']);
            }

            //Commence payment with Card
            $userCard = Card::where('id', $request->get('card'))->first();

            //Initialize user payment card details
            $paymentCard = [];

            if($request->get('card') != 0 && !is_null($userCard)) {

                //Initialize user payment card details with stored card
                $paymentCard = [
                    "number" => $userCard->number,
                    "expiryMonth" => $userCard->expiryMonth,
                    "expiryYear" => $userCard->expiryYear,
                    "pin" => $userCard->pin,
                    "cvv" => $userCard->cvv
                ];
            }

            else if ($request->get('card') == 0) {

                $expiryPeriod = explode('-', $request->get('expiry-month'));

                //Initialize user payment card details with new card
                $paymentCard = [
                    "number" => $request->get('card-number'),
                    "expiryMonth" => $expiryPeriod[0],
                    "expiryYear" => $expiryPeriod[1],
                    "pin" => $request->get('card-pin'),
                    "cvv" => $request->get('card-cvv')
                ];
            }

            //Monnify payment with card Url
            $requestUrl = env('MONNIFY_BASE_URL') . MonnifyCredentials::PAY_WITH_CARD;

            $thisTransaction = Transaction::where('transactionReference', $transactionInitResponse->json('responseBody')['transactionReference'])->first();

            $payWithCardResponse = Http::withHeaders(['Authorization' => MonnifyCredentials::BEARER_AUTHORIZATION_PREFIX . Storage::disk('local')->get('token.txt')])
                ->post($requestUrl, [
                    "transactionReference" => $thisTransaction->transactionReference,
                    "collectionChannel" => "API_NOTIFICATION",
                    "card" => $paymentCard,

                    "deviceInformation" => [
                        "httpBrowserLanguage" => "en-US",
                        "httpBrowserJavaEnabled" => false,
                        "httpBrowserJavaScriptEnabled" => true,
                        "httpBrowserColorDepth" => 24,
                        "httpBrowserScreenHeight" => 1203,
                        "httpBrowserScreenWidth" => 2138,
                        "httpBrowserTimeDifference" => "",
                        "userAgentBrowserValue" => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko)     Chrome/105.0.0.0 Safari/537.36"
                    ]
                ]);

            if($payWithCardResponse->successful() && $payWithCardResponse->json('responseCode') == 0) {

                $response = $payWithCardResponse->json();

                //Check if this response requires OTP verification
                $otp = $response['responseBody']['otpData'] ?? null;
                $secure3dData = $response['responseBody']['secure3dData'] ?? null;

                if(!is_null($otp)) {

                    $otpMessage = $otp['message'];

                    //Todo: Send message to user phone number
                    $termiiService = new TermiiService();
                    $smsResponse = $termiiService->sendSms(Auth::user()->userContact->phone, env('TERMII_SMS_SENDER_ID'), $otpMessage);

                    //sent sms success
                    session('sentOtpSms', $smsResponse->successful());

                    //Todo: show user interface to insert OTP

                    $otpId = $otp['id'];
                    $transactionReference = $response['responseBody']['transactionReference'];
                    $paymentReference = $response['responseBody']['paymentReference'];

                    //Store data in session
                    $request->session()->put('payment', [
                        'transactionReference' => $transactionReference,
                        'otpId' => $otpId,
                        'paymentReference' => $paymentReference,
                        'account' => $request->get('dest-account')
                    ]);

                    return view('user.pay.otp');
                }

                //Check is Secured 3D data authentication is required
                if(!is_null($secure3dData)) {
                    return redirect($secure3dData['redirectUrl']);
                }

                //update user account
                $destinationAccount = AibopayAccount::find($request->get('dest-account'));
                $authorizedAmount = doubleval($response['responseBody']['authorizedAmount']);

                $this->updateAccount($destinationAccount, $authorizedAmount, $thisTransaction);

                //Todo: Return to dashboard
                return view('account')->with(['status' => 'Transaction Successful!']);

            }
            else {
                return $this->viewTopUp()->with('card-error', $payWithCardResponse->json('responseMessage'));
            }
        }


        if($request->get('pay-method') === "TRANSFER/DEPOSIT") {

            return redirect('/account')->with(['message'=>'Done']);
        }

        if($request->get('pay-method') === "CRYPTOCURRENCY") {

        }

        return redirect($transactionInitResponse->json('responseBody')['checkoutUrl']);
    }

    public function resendOtpMessage(Request $request) {

    }


    /**
     * A function that confirms a successful
     * transaction
     *
     * @param Request $request
     * @return void
     */

    public function confirm(Request $request): void
    {
        $request->validate([
            'paymentReference' => ['required']
        ]);

        $transaction = Transaction::where('paymentReference', $request->get('paymentReference'))->first();

        if($transaction != null) {

            $requestUrl = env('MONNIFY_BASE_URL').MonnifyCredentials::TRANSACTION_STATUS;

            $transactionStatusResponse = Http::withHeaders(['Authorization' => MonnifyCredentials::BEARER_AUTHORIZATION_PREFIX . Storage::disk('local')->get('token.txt')])
                ->get($requestUrl . $transaction->transactionReference);

            if($transaction->transactionStatus != Utility::TRANSACTION_STATUS['PAID'] && $transactionStatusResponse->json('responseBody')['paymentStatus'] == "PAID") {

                $transaction->update([
                    'transactionStatus' => Utility::TRANSACTION_STATUS['PAID'],
                    'paymentMethod' => $transactionStatusResponse->json('responseBody')['paymentMethod']
                ]);
            }
        }
    }

    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function verifyOtp(Request $request) {

        $request->validate(['otp' => ['required', 'string', 'regex:(\d)', 'max:6', 'min:6']]);
        $data = session()->get('payment') ?? false;

        if($data) {

            $authorizeRequestUrl = env('MONNIFY_BASE_URL') . MonnifyCredentials::AUTHORIZE_OTP;

            $authorizeOtpResponse = Http::retry(5, 5000)
                ->withHeaders(['Authorization' => MonnifyCredentials::BEARER_AUTHORIZATION_PREFIX . Storage::disk('local')->get('token.txt')])
                ->post($authorizeRequestUrl,
                    [
                        "transactionReference" => $data['transactionReference'],
                        "collectionChannel" => "API_NOTIFICATION",
                        "tokenId" => $data['otpId'],
                        "token" => $request->get('otp')
                    ]
                );

            $responseBody = $authorizeOtpResponse->json('responseBody');

            if($authorizeOtpResponse->successful() && $responseBody['transactionReference'] === $data['transactionReference']) {

                $this->updateAccount(
                    AibopayAccount::find($data['account']),
                    $responseBody['authorizedAmount'],
                    Transaction::where('transactionReference', $data['transactionReference']));
            }
        }

        else {

        }

        dd($data);
    }


    private function transactionInit(float $amount, string $customerName, string $customerEmail, string $description, string $currencyCode): PromiseInterface|Response
    {

        $requestUrl = env('MONNIFY_BASE_URL').MonnifyCredentials::PAYMENT_INIT;

        return Http::withHeaders(['Authorization' => MonnifyCredentials::BEARER_AUTHORIZATION_PREFIX . Storage::disk('local')->get('token.txt')])
            ->post($requestUrl, [
                "amount" => $amount,
                "customerName" => $customerName,
                "customerEmail" => $customerEmail,
                "paymentReference" => Random::generate(32),
                "paymentDescription" => $description,
                "currencyCode" => $currencyCode,
                "contractCode" => MonnifyCredentials::CONTRACT_CODE,
                "redirectUrl" => env('APP_URL') . ":8000/transaction/confirm",
                "paymentMethods" => ["CARD","ACCOUNT_TRANSFER"]
            ]);

    }

    /**
     * Function to update account balance after transaction
     *
     * @param AibopayAccount $destinationAccount
     * @param float $authorizedAmount
     * @param Transaction $thisTransaction
     * @return void
     */
    public function updateAccount(AibopayAccount $destinationAccount, float $authorizedAmount, Transaction $thisTransaction): void
    {
        $oldBalance = $destinationAccount->balance;

        $destinationAccount->update(['balance' => $authorizedAmount + $oldBalance]);

        //Update transaction to completed status
        $thisTransaction->update(['transactionStatus' => Utility::TRANSACTION_STATUS['COMPLETED']]);
    }

    /**
     * @return Application|Factory|View
     */

    public function transfer(): View|Factory|Application
    {
        $requestUrl = env('MONNIFY_BASE_URL').MonnifyCredentials::GET_BANKS_URL;

        //Todo: Get All Available banks
        $allBanksResponse = Http::retry(5, 1000)
            ->withHeaders(['Authorization' => MonnifyCredentials::BEARER_AUTHORIZATION_PREFIX . Storage::disk('local')->get('token.txt')])
            ->get($requestUrl);

        $banks[] = ['code' => '000', 'name' => 'AiboPay'];
        $banks = array_merge($banks, ($allBanksResponse->successful()) ? $allBanksResponse->json('responseBody') : Utility::BANKS);

        return view('dashboard.aibopay.payment.transfer-fund', ['banks' => $banks, 'accounts' => Auth::user()->aibopayAccounts,]);
    }

    /**
     * @param TransferRequest $request
     *
     * Function to transfer fund from an account
     */
    public function transferFund(TransferRequest $request)
    {
        $request->validated();

        if(is_null($request->get('transfer-account-name'))) {

            $validateAccountNumberResponse = $this->validateAccountNumber($request->get('transfer-account'), $request->get('transfer-bank'));

            if($validateAccountNumberResponse->successful()) {

                $accountName = $validateAccountNumberResponse->json('responseBody')['accountName'];

                return redirect()->back()->withInput()->with('account-name', $accountName);
            }
            else {
                $responseMessage = $validateAccountNumberResponse->json('responseMessage');
                return redirect()->back()->withInput()->with('validate-message', $responseMessage);
            }
        }
        else {
            $request->validate(['origin-account' => ['required', 'integer', Rule::exists('aibopay_accounts', 'id')]]);

            $originAccount = $request->get('origin-account');


            $aiboAccount = AibopayAccount::find($originAccount);
            $amount = $request->get('transfer-amount');

            if(($aiboAccount->balance - floatval(env('AIBOPAY_ACCOUNT_MIN_BALANCE')) - floatval($amount)) < 0) {
                return redirect()->back()->withInput()->with('validate-message', 'Insufficient balance, Available balance: ' . $aiboAccount->balance);
            }
            dd('success');
        }

    }

    private function validateAmount(float $amount, string $accountId) {

    }

    public function validateAccountNumber(string $accountNumber, string $code): PromiseInterface|Response
    {

        $requestUrl = env('MONNIFY_BASE_URL').MonnifyCredentials::VALIDATE_ACCOUNT.
            "accountNumber=" . $accountNumber.
            "&bankCode=" . $code;

        return Http::withHeaders(['Authorization' => MonnifyCredentials::BEARER_AUTHORIZATION_PREFIX . Storage::disk('local')->get('token.txt')])
            ->get($requestUrl);
    }
}
