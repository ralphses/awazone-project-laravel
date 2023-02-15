<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserAbility extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'abilities',
        'token',
        'description'
    ];

    public function abilities(): array
    {
        return explode('|', $this->attributes['abilities']);
    }

    /**
     * Get users with this ability
     *
     * @return HasMany
     */
    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
