<?php

use App\Http\Controllers\AibopayAccountController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\ExchangeRateController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserAbilityController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\UserContactController;
use App\Http\Controllers\UserKycDocController;
use App\Models\AibopayAccount;
use App\Models\Currency;
use App\Models\ExchangeRate;
use App\Models\User;
use App\Models\UserAbility;
use App\Models\UserKycDoc;
use App\Models\Utility;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/aibopay', function () {
    return view('aibopay');
});

Route::get('/account', function () {
    return view('account');
})->middleware(['auth', 'verified'])->name('account');


Route::middleware('auth')
    ->prefix('/user/profile')->group(function () {

    Route::get('/', [UserAccountController::class, 'index'])
        ->middleware('verified')
        ->name('profile');

    Route::patch('/{id}', [UserAccountController::class, 'update'])
        ->middleware('verified')
        ->name('profile.update');

    Route::match(['POST', 'GET'], "/update-password",[UserKycDocController::class, 'updatePassword'])
        ->middleware('verified')
        ->name('password.change');


    Route::delete('/{id}', [ProfileController::class, 'destroy'])
        ->middleware('verified')
        ->name('profile.delete');

    Route::get('/kyc', [UserKycDocController::class, 'create'])
        ->middleware('verified')
        ->name('kyc.create')
        ->can('create', UserKycDoc::class);

    Route::post('/kyc', [UserKycDocController::class, 'store'])
        ->middleware('verified')
        ->name('kyc.store')
        ->can('create', UserKycDoc::class);

    Route::prefix('/aibopay-account')
        ->middleware('verified')

        ->group(function () {

            Route::get('/', [AibopayAccountController::class, 'index'])
                ->name('user.aibopay-accounts');

            Route::view('/create', 'dashboard.aibopay.accounts.create-user-account', ['accountTypes' => Utility::AIBOPAY_ACCOUNT_TYPE, 'currencies' => Utility::AIBOPAY_ACCOUNT_CURRENCY])
                ->name('user.aibopay-accounts.create');

            Route::post('/create', [AibopayAccountController::class, 'store'])
                ->name('user.aibopay-accounts.store');

            Route::match(['GET', 'PATCH', 'DELETE'], '/{id}', [AibopayAccountController::class, 'actions'])
                ->name('user.aibopay-accounts.actions');
    } );

    Route::prefix('/card')
        ->middleware('verified')->middleware('auth')
        ->group(function () {

            Route::get('/', [CardController::class, 'index'])
                ->name('card.view');

            Route::get('/add', [CardController::class, 'create'])
                ->name('card.create');

            Route::post('/add', [CardController::class, 'store'])
                ->name('card.create');

            Route::delete('/{id}', [CardController::class, 'destroy'])
                ->name('card.delete');
        });

    Route::prefix('/transaction')
        ->middleware('verified')->middleware('auth')
        ->group(function() {

            Route::get('/deposit', [PaymentController::class, 'viewTopUp'])
            ->name('user.pay');

            Route::post('/deposit', [PaymentController::class, 'startPayment'])
                ->name('user.pay.start');

            Route::view('/otp','dashboard.aibopay.payment.view-otp-page');

            Route::post('/otp', [PaymentController::class, 'verifyOtp'])
                ->name('user.pay.otp');

            Route::get('/transfer', [PaymentController::class, 'transfer'])
                ->name('user.transfer');

            Route::post('/transfer', [PaymentController::class, 'transferFund'])
                ->name('user.transfer.start');

        });
});


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/


Route::prefix('/user/kyc')->group(function () {

    Route::get('/', [UserKycDocController::class, 'index'])
        ->middleware('auth', 'verified')->name('kyc.all')
        ->can('viewAny', UserKycDoc::class);

    Route::match(['PATCH', 'DELETE', 'PUT'], '/{id}', [UserKycDocController::class, 'actions'])
        ->middleware('auth', 'verified')
        ->name('kyc.approve')
        ->can('update', UserKycDoc::class);

    Route::match(['GET'], '/{id}', [UserKycDocController::class, 'actions'])
        ->middleware('auth', 'verified')
        ->name('kyc.approve')
        ->can('viewUser', UserKycDoc::class);
});


Route::prefix('/user')->group(function () {

    Route::get('/all/{roleId?}', [UserAccountController::class, 'viewAll'])
        ->middleware('verified')->name('user.all')
        ->can('viewAny', User::class);

    Route::patch('/status/{id}', [UserAccountController::class, 'activateOrDeactivateUser'])
        ->middleware('verified')
        ->name('user.status')
        ->can('changeStatus', User::class);
});

/**
 * ROLE MANAGEMENT ROUTES
 */

Route::prefix('/user/roles')->group(function () {

    Route::get('/', [UserAbilityController::class, 'index'])
        ->middleware('auth', 'verified')
        ->can('viewAny', UserAbility::class)
        ->name('roles');

    Route::get('/create', [UserAbilityController::class, 'create'])
        ->middleware('auth', 'verified')
        ->can('create', UserAbility::class)
        ->name('role.create');

    Route::post('/create', [UserAbilityController::class, 'store'])
        ->middleware('auth', 'verified')
        ->can('create', UserAbility::class)
        ->name('user-abilities');

    Route::get('/view/{id}', [UserAbilityController::class, 'edit'])
        ->middleware('auth', 'verified')
        ->can('viewAny', UserAbility::class)
        ->name('role.view');

    Route::patch('/update/{id}', [UserAbilityController::class, 'update'])
        ->middleware('auth', 'verified')
        ->can('viewAny', UserAbility::class)
        ->name('role.update');

    Route::delete('/delete/{id}', [UserAbilityController::class, 'destroy'])
        ->middleware('auth', 'verified')
        ->can('viewAny', UserAbility::class)
        ->name('role.delete');

    Route::get('/assign/{id}', [UserAbilityController::class, 'assignRoleToUser'])
        ->middleware('auth', 'verified')
        ->can('viewAny', UserAbility::class)
        ->name('role.assign');

    Route::patch('/assign/{id}', [UserAbilityController::class, 'storeAssignedRoleToUser'])
        ->middleware('auth', 'verified')
        ->can('viewAny', UserAbility::class)
        ->name('role.assign.store');
});


/**
 * AIBOPAY ACCOUNT MANAGEMENT ROUTES
 */

Route::prefix('/aibopay/accounts')->middleware('auth')
    ->group(function () {

        Route::get('/', [AibopayAccountController::class, 'viewAll'])
            ->name('admin.account.view')
            ->can("viewAll", AibopayAccount::class);

        Route::get('/{action}/{id}', [AibopayAccountController::class, 'adminActions'])
            ->whereNumber('id')
            ->whereAlpha('action')
            ->whereIn('action', ['suspend', 'approve-bvn', 'reject-bvn'])
            ->name('admin.{action}.suspend')
            ->can('suspendAny', AibopayAccount::class);
});


/**
 * TRANSACTION MANAGEMENT ROUTES
 */

Route::prefix('/transactions')->middleware('auth',)->group( function () {

    Route::prefix('/exchange-rate')->middleware('verified')->group(function () {

        Route::get('/', [ExchangeRateController::class, 'index'])
            ->name('exchange.rate.view')
            ->can('viewAny', ExchangeRate::class);

        Route::get('/add', [ExchangeRate::class, 'create'])
            ->name('exchange.rate.add')
            ->can('create', ExchangeRate::class);

        Route::post('/add', [ExchangeRate::class, 'store'])
            ->name('exchange.rate.store')
            ->can('create', ExchangeRate::class);
    });

    Route::prefix('/currencies')->middleware('verified')->group(function () {

        Route::get('/', [CurrencyController::class, 'index'])
            ->name('currency.view.all')
            ->can('viewAny', Currency::class);

        Route::get('/add', [CurrencyController::class, 'create'])
            ->name('currency.add')
            ->can('create', Currency::class);

        Route::post('/add', [CurrencyController::class, 'store'])
            ->name('currency.store')
            ->can('create', Currency::class);

        Route::match(['GET','POST', 'PUT', 'PATCH'], '/actions/{id}', [CurrencyController::class, 'actions'])
            ->name('currency.actions')
            ->can('update', Currency::class);

    });

});


/*
|--------------------------------------------------------------------------
| API ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('/api/v1')
    ->middleware('auth')
    ->group(function () {

        Route::prefix('/user')->group(function () {
            Route::get('/account/{currency}', [PaymentController::class, 'getUserAccountWithCard'])
                ->name('account.with.card');
        });

        Route::prefix('/transaction')->group(function () {
            Route::get('/validate-account', [PaymentController::class, 'validateAccountNumber'])
                ->name('account.with.card');
        });
});

Route::get('/transaction/confirm', [PaymentController::class, 'confirm'] );
Route::view('/testing', 'dashboard.aibopay.payment.view-otp-page');


require __DIR__.'/auth.php';
