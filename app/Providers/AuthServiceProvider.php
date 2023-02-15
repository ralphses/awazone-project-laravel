<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\AibopayAccount;
use App\Models\Currency;
use App\Models\ExchangeRate;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserAbility;
use App\Models\UserKycDoc;
use App\Policies\AibopayAccountPolicy;
use App\Policies\CurrencyPolicy;
use App\Policies\ExchangeRatePolicy;
use App\Policies\TransactionPolicy;
use App\Policies\UserAbilityPolicy;
use App\Policies\UserKycDocPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        UserAbility::class => UserAbilityPolicy::class,
        User::class => UserPolicy::class,
        UserKycDoc::class => UserKycDocPolicy::class,
        AibopayAccount::class => AibopayAccountPolicy::class,
        Transaction::class => TransactionPolicy::class,
        ExchangeRate::class => ExchangeRatePolicy::class,
        Currency::class => CurrencyPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();


        //
    }
}
