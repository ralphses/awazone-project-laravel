<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Utility extends Model
{
    use HasFactory;

    public const USER_ABILITIES = [
        'authority' => [
            'authority_view:single',
            'authority_view:all',
            'authority_create',
            'authority_update',
            'authority_delete',
            'user'
        ],
        'user' => [
            'user_view:single',
            'user_view:any',
            'user_view:all',
            'user_delete:single',
            'user_edit:status'
        ],
        'kyc' => [
            'kyc_view:single',
            'kyc_view:any',
            'kyc_view:all',
            'kyc_edit:one',
        ],
        'aibopayAccount' => [
            'aibopayAccount_view:all',
            'aibopayAccount_view:any',
            'aibopayAccount_delete:any',
            'aibopayAccount_bvn:update',
            'aibopayAccount_bvn:approve',
            'aibopayAccount_bvn:reject',
            'aibopayAccount_suspend:any'
        ],
        'transaction' => [
            'transaction_view:all',
            'transaction_delete:any',
            'transaction_edit:any',
        ],
        'card' => [
            'card_view:all',
            'card_delete:any',
            'card_edit:any',
        ],
        'exchangeRate' => [
            'exchangeRate_view:any',
            'exchangeRate_delete:any',
            'exchangeRate_edit:any',
            'exchangeRate_create:any'
        ],
        'currency' => [
            'currency_view:any',
            'currency_delete:any',
            'currency_edit:any',
            'currency_create:any',
        ]
    ];

    public const KYC_STATUS = [
        'active' => 0,
        'in-active' => 1,
        'rejected' => 30
    ];

    public const KYC_DOC_TYPE = [

        'nin' => 'National Identity Card',
        'pvc' => "Permanent Voter's Card",
        'drive' => 'Driver Licence',
        'passport' => 'International Passport',
        'others' => 'Others'

    ];

    public const AIBOPAY_ACCOUNT_TYPE = [
        'Savings',
        'Current',
    ];

    public const AIBOPAY_ACCOUNT_STATUS = [
        'active' => 'ACTIVATED',
        'frozen' => 'FROZEN',
        'inactive' => 'INACTIVE',
        'suspended' => 'SUSPENDED'
    ];

    public const AIBOPAY_ACCOUNT_CURRENCY = [
        'ngn' => "NGN",
        'usd' => "USD",
        'EURO' => "EUR"
    ];

    public const TRANSACTION_STATUS = [
        'COMPLETED' => 0,
        'DECLINED' => -2,
        'PAID' => 1,
        'OVERPAID' => 2,
        'PARTIALLY_PAID' => 3,
        'PENDING' => -1,
        'ABANDONED' => -2,
        'CANCELLED' => -3,
        'FAILED' => -4,
        'REVERSED' => -5,
        'EXPIRED' => -6,
    ];

    public const CARD_TYPE = [
        'VISA',
        'MASTER CARD',
        'OTHERS',
        'VERVE'
    ];

    public const BANKS = [
        'Aibopay',
        'Access Bank Plc',
        'Kuda Microfinance Bank'
    ];

    public const PAYMENT_METHOD = [
        'TRANSFER/DEPOSIT',
        'DEBIT/CREDIT CARD',
        'CRYPTOCURRENCY'
    ];

    public const TRANSACTION_FEES = [
        'transfer-internal' => 0.0,
        'transfer-external' => 10.0,
    ];

    public const TRANSACTION_TYPE = [
        'INCOME' => 1,
        'EXPENDITURE' => -1
    ];

    public const PAYMENT_PROCESSORS = [
        'monnify' => 'MONNIFY',
        'coinremmiter' => 'COINREMITTER'
    ];

    public const COUNTRIES = [
        'Nigeria',
        'United States of America',
        'Germany'
    ];


}
