<?php

namespace App\Policies;

use App\Models\ExchangeRate;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ExchangeRatePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function viewAny(User $user): Response|bool
    {
        return in_array('exchangeRate_view:any', $user->userAbility->abilities());
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function create(User $user): Response|bool
    {
        return in_array('exchangeRate_create:any', $user->userAbility->abilities());

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param  \App\Models\ExchangeRate  $exchangeRate
     * @return Response|bool
     */
    public function update(User $user)
    {
        return in_array('exchangeRate_edit:any', $user->userAbility->abilities());

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param  \App\Models\ExchangeRate  $exchangeRate
     * @return Response|bool
     */
    public function delete(User $user, ExchangeRate $exchangeRate)
    {
        return in_array('exchangeRate_delete:any', $user->userAbility->abilities());
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param  \App\Models\ExchangeRate  $exchangeRate
     * @return Response|bool
     */
    public function restore(User $user, ExchangeRate $exchangeRate)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param  \App\Models\ExchangeRate  $exchangeRate
     * @return Response|bool
     */
    public function forceDelete(User $user, ExchangeRate $exchangeRate)
    {
        return in_array('exchangeRate_delete:any', $user->userAbility->abilities());

    }
}
