<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class UserPolicy
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
        return  in_array('user_view:all', $user->userAbility->abilities());
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return Response|bool
     */
    public function view(User $user, User $model): bool
    {
        return ($user->id === $model->id && Auth::user()->id === $user->id) ||
            in_array('user_view:single', $user->userAbility->abilities());
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return Response|bool
     */
    public function changeStatus(User $user)
    {
        return  in_array('user_edit:status', $user->userAbility->abilities());

    }


    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return Response|bool
     */
    public function delete(User $user, User $model)
    {
        return in_array('user_delete:single', $user->userAbility->abilities());
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return Response|bool
     */
    public function restore(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return Response|bool
     */
    public function forceDelete(User $user, User $model)
    {
        //
    }
}
