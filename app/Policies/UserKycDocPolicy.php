<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserKycDoc;
use App\Models\Utility;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserKycDocPolicy
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
        return in_array('kyc_view:all', $user->userAbility->abilities());
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param  \App\Models\UserKycDoc  $userKycDoc
     * @return Response|bool
     */
    public function view(User $user, UserKycDoc $userKycDoc)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function create(User $user): Response|bool
    {
        return $user->userKycDoc === null OR $user->userKycDoc->status > Utility::KYC_STATUS['rejected'];
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param  \App\Models\UserKycDoc  $userKycDoc
     * @return Response|bool
     */
    public function update(User $user): Response|bool
    {
        return in_array('kyc_edit:one', $user->userAbility->abilities());
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param  \App\Models\UserKycDoc  $userKycDoc
     * @return Response|bool
     */
    public function delete(User $user, UserKycDoc $userKycDoc)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param  \App\Models\UserKycDoc  $userKycDoc
     * @return Response|bool
     */
    public function restore(User $user, UserKycDoc $userKycDoc)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param  \App\Models\UserKycDoc  $userKycDoc
     * @return Response|bool
     */
    public function forceDelete(User $user, UserKycDoc $userKycDoc)
    {
        //
    }

    public function viewUser(User $user): bool
    {
        return $user->userKycDoc()->exists();
    }
}
