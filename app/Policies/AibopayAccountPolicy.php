<?php

namespace App\Policies;

use App\Models\AibopayAccount;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class AibopayAccountPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AibopayAccount  $aibopayAccount
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, AibopayAccount $aibopayAccount)
    {
        return $user->id === $aibopayAccount->user()->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->id === Auth::user()->id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AibopayAccount  $aibopayAccount
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function updateBvn(User $user, AibopayAccount $aibopayAccount)
    {
        return $user->id === $aibopayAccount->user()->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AibopayAccount  $aibopayAccount
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteOne(User $user, AibopayAccount $aibopayAccount)
    {
        return $user->id === $aibopayAccount->user()->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AibopayAccount  $aibopayAccount
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, AibopayAccount $aibopayAccount)
    {
        return $user->id === $aibopayAccount->user()->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AibopayAccount  $aibopayAccount
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user)
    {
        return in_array('aibopayAccount_delete:any', $user->userAbility->abilities());
    }

    public function viewAll() {
        return in_array('aibopayAccount_view:all', Auth::user()->userAbility->abilities());
    }

    public function viewAny() {
        return in_array('aibopayAccount_view:any', Auth::user()->userAbility->abilities());
    }

    public function suspendAny() {
        return in_array('aibopayAccount_suspend:any', Auth::user()->userAbility->abilities());
    }

}
