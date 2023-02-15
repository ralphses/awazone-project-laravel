<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'customerEmail',
        'paymentMethod',
        'description',
        'transactionReference',
        'paymentReference',
        'transactionType',
        'amount',
        'fee',
        'transactionStatus',
        'transactionProcessor'
    ];
}
