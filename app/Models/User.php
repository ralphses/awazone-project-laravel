<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'referer_user',
        'address',
        'username',
        'date_of_birth',
        'image_path',
        'referral_code',
        'user_ability_id',
        'main_currency',
        'is_locked'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userContact(): HasOne
    {
        return $this->hasOne(UserContact::class);
    }

    public function userAbility(): BelongsTo {
        return $this->belongsTo(UserAbility::class);
    }

    public function userKycDoc(): HasOne
    {
        return $this->hasOne(UserKycDoc::class);
    }

    public function aibopayAccounts(): HasMany
    {
        return $this->hasMany(AibopayAccount::class);
    }

    public function card(): HasMany
    {
        return $this->hasMany(Card::class);
    }

    public function monnifyAccount(): HasOne
    {
        return $this->hasOne(MonnifyAccount::class);
    }

}
