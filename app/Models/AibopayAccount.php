<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AibopayAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'accountNumber',
        'accountType',
        'balance',
        'currency',
        'status',
        'accountName'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
