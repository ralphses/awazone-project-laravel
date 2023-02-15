<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserAbility;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class UserAbilityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function viewAny(User $user)
    {
        return in_array('authority_view:all', $user->userAbility()->get()->first()->abilities());

    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @return Response|bool
     */
    public function view(User $user): Response|bool
    {
        return $this->viewAny($user);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function create(User $user): Response|bool
    {
        return $this->viewAny($user);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param  \App\Models\UserAbility  $userAbility
     * @return Response|bool
     */
    public function update(User $user, UserAbility $userAbility)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param  \App\Models\UserAbility  $userAbility
     * @return Response|bool
     */
    public function delete(User $user, UserAbility $userAbility)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param  \App\Models\UserAbility  $userAbility
     * @return Response|bool
     */
    public function restore(User $user, UserAbility $userAbility)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param  \App\Models\UserAbility  $userAbility
     * @return Response|bool
     */
    public function forceDelete(User $user, UserAbility $userAbility)
    {
        //
    }
}
