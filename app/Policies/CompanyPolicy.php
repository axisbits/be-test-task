<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     *
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo(PermissionEnum::companiesManage) || $user->hasPermissionTo(PermissionEnum::companiesManageOwn);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Company $model
     *
     * @return mixed
     */
    public function view(User $user, Company $model)
    {
        if ($user->hasPermissionTo(PermissionEnum::companiesManage)) {
            return true;
        }

        if ($user->hasPermissionTo(PermissionEnum::companiesManageOwn)) {
            return $this->hasOwnPermission($user, $model);
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     *
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo(PermissionEnum::companiesManage) || $user->hasPermissionTo(PermissionEnum::companiesManageOwn);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Company $model
     *
     * @return mixed
     */
    public function update(User $user, Company $model)
    {
        if ($user->hasPermissionTo(PermissionEnum::companiesManage)) {
            return true;
        }

        if ($user->hasPermissionTo(PermissionEnum::companiesManageOwn)) {
            return $this->hasOwnPermission($user, $model);
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Company $model
     *
     * @return mixed
     */
    public function delete(User $user, Company $model)
    {
        if ($user->hasPermissionTo(PermissionEnum::companiesDelete)) {
            return true;
        }

        if ($user->hasPermissionTo(PermissionEnum::companiesDeleteOwn)) {
            return $this->hasOwnPermission($user, $model);
        }

        return false;
    }

    /**
     * @param User $user
     * @param Company $model
     *
     * @return bool
     */
    protected function hasOwnPermission(User $user, Company $model): bool
    {
        return \data_get($model, 'created_by') === $user->id;
    }
}
