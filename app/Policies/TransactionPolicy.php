<?php

namespace App\Policies;

use App\Models\Transactions;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TransactionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return Response|bool
     */
    public function viewAny(User $user)
    {
        return in_array('transaction_view:any', $user->userAbility->abilities());
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Transactions  $transactions
     * @return Response|bool
     */
    public function view(User $user, Transactions $transactions)
    {
        return $user->email === $transactions->customerEmail;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @return Response|bool
     */
    public function update(User $user): Response|bool
    {
        return in_array('transaction_edit:any', $user->userAbility->abilities());
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @return Response|bool
     */
    public function delete(User $user): Response|bool
    {
        return in_array('transaction_delete:any', $user->userAbility->abilities());
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Transactions  $transactions
     * @return Response|bool
     */
    public function restore(User $user, Transactions $transactions)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Transactions  $transactions
     * @return Response|bool
     */
    public function forceDelete(User $user, Transactions $transactions)
    {
        //
    }
}
