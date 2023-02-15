<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreteAibopayAccountRequest;
use App\Models\AibopayAccount;
use App\Models\monnify\MonnifyCredentials;
use App\Models\MonnifyAccount;
use App\Models\User;
use App\Models\Utility;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Nette\Utils\Random;

class AibopayAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index() : View
    {
        return view('dashboard.aibopay.accounts.view-user-accounts', ['accounts' => Auth::user()->aibopayAccounts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreteAibopayAccountRequest $request
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function store(CreteAibopayAccountRequest $request): Application|RedirectResponse|Redirector
    {
        //Validate user request
        $request->validated();

        //Check if user has monnify account
        $monnifyAccount = MonnifyAccount::where('user_id', Auth::user()->id);

//        dd($monnifyAccount->first() == null);
        if($monnifyAccount->first() == null) {

            //Create new monnify account on monnify website
            $response = Http::withHeaders(['Authorization' => MonnifyCredentials::BEARER_AUTHORIZATION_PREFIX . Storage::disk('local')->get('token.txt')])

                ->post(env('MONNIFY_BASE_URL') . MonnifyCredentials::CREATE_VIRTUAL_ACCOUNT, [
                    "accountReference" => Auth::user()->username,
                    "accountName" => Auth::user()->name,
                    "currencyCode" => MonnifyCredentials::NGN_CURRENCY_CODE,
                    "contractCode" => MonnifyCredentials::CONTRACT_CODE,
                    "customerEmail" => Auth::user()->email,
                    "bvn" => $request->get('bvn'),
                    "customerName" => Auth::user()->name,
                    "getAllAvailableBanks" => false,
                    "preferredBanks" => [MonnifyCredentials::WEMA_BANK_CODE]
                ]);

            if($response->successful() AND $response->status() === 200) {

                //Create new monnify account resource
                MonnifyAccount::create(
                    [
                    'customerName' => $response->json('responseBody')['customerName'],
                    'accountNumber' => $response->json('responseBody')['accounts'][0]['accountNumber'],
                    'user_id' => Auth::user()->id,
                    'currency' => MonnifyCredentials::NGN_CURRENCY_CODE,
                    'bank' => $response->json('responseBody')['accounts'][0]['bankName'],
                    'reference' => $response->json('responseBody')['accountReference'],
                    'bvn' => $response->json('responseBody')['bvn'],
                    ]
                );

                //Create new Aibopay Account for user
                AibopayAccount::create(
                    [
                        'user_id' => Auth::user()->id,
                        'currency' => $request->get('currency'),
                        'accountName' => $request->get('full-name'),
                        'accountNumber' => $this->generateAccountNumber(),
                        'accountType' => $request->get('type'),
                    ]
                );

            }
            else {
                //Return error message for unsuccessful account creation with monnify
                return redirect(route('user.aibopay-accounts'))->with(['message'=>'Unable to create account']);
            }

        } else {

            //Create new Aibopay Account for user
            AibopayAccount::create(
                [
                    'user_id' => Auth::user()->id,
                    'currency' => $request->get('currency'),
                    'accountName' => $request->get('full-name'),
                    'accountNumber' => $this->generateAccountNumber(),
                    'accountType' => $request->get('type'),
                ]
            );
        }

        return redirect(route('user.aibopay-accounts'));

    }

    public function actions(Request $request, int $id): Factory|\Illuminate\Contracts\View\View|Redirector|RedirectResponse|Application
    {

        $action = $request->get('action') ?? 'inactive';

        if($request->method() === "GET") {

            return view('dashboard.aibopay.accounts.view-single-user-account', ['account' => AibopayAccount::find($id)]);
        }

        if($request->method() === "PATCH") {

            AibopayAccount::where('id', $id)->update([
                'status' => Utility::AIBOPAY_ACCOUNT_STATUS[$action]
            ]);

        }

        if($request->method() === "DELETE") {

            //Todo: remove from monnify
            $response = Http::withHeaders(['Authorization' => MonnifyCredentials::BEARER_AUTHORIZATION_PREFIX . Storage::disk('local')->get('token.txt')])
                ->delete(env('MONNIFY_BASE_URL') . MonnifyCredentials::DELETE_VIRTUAL_ACCOUNT . AibopayAccount::where('id', $id)->first()->reference);


            if($response->successful()) {
                AibopayAccount::destroy($id);
            }

            else {
                return redirect(route('user.aibopay-accounts'))->with(['message' => 'Unable to delete account']);
            }
        }

        return redirect(route('user.aibopay-accounts'));

    }


    /**
     * Remove the specified resource from storage.
     *
     */
    public function adminActions(string $action, int $id)
    {
        $account = AibopayAccount::where('id', $id);

        if($action === 'suspend') {
            $account->update([
                'status' => Utility::AIBOPAY_ACCOUNT_STATUS['suspended']
            ]);
        }

        if($action === 'reject-bvn') {
            $account->update([
                'status' => Utility::AIBOPAY_ACCOUNT_STATUS['inactive']
            ]);
        }

        if($action === 'approve-bvn') {
            $account->update([
                'status' => Utility::AIBOPAY_ACCOUNT_STATUS['active']
            ]);
        }

        return redirect(route('admin.account.view'));
    }

    public function viewAll() : View {

        $accounts = AibopayAccount::paginate(10);

        return view('dashboard.aibopay.accounts.view-all-user-account', ['accounts' => $accounts]);

    }

    /**
     * @throws Exception
     */
    private function generateAccountNumber(): string
    {

        $code = "00102";
        $uniqueAcc = random_int(10000, 99999);

        $accountNumber = $code . $uniqueAcc;

        while (AibopayAccount::where('accountNumber', $accountNumber)->first() != null)
        {
            $uniqueAcc = random_int(10000, 99999);
            $accountNumber = $code . $uniqueAcc;
        }

        return $accountNumber;
    }

}
