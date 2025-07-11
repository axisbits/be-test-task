<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
        return $user->hasPermissionTo(PermissionEnum::usersManage);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param User $model
     *
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        if ($user->hasPermissionTo(PermissionEnum::usersManage)) {
            return true;
        }

        if ($user->hasPermissionTo(PermissionEnum::usersManageOwn)) {
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
        return $user->hasPermissionTo(PermissionEnum::usersManage);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param User $model
     *
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        if ($user->hasPermissionTo(PermissionEnum::usersManage)) {
            return true;
        }

        if ($user->hasPermissionTo(PermissionEnum::usersManageOwn)) {
            return $this->hasOwnPermission($user, $model);
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param User $model
     *
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        if ($user->hasPermissionTo(PermissionEnum::usersDelete)) {
            return true;
        }

        if ($user->hasPermissionTo(PermissionEnum::usersDeleteOwn)) {
            return $this->hasOwnPermission($user, $model);
        }

        return false;
    }

    /**
     * @param User $user
     * @param User $user
     *
     * @return bool
     */
    protected function hasOwnPermission(User $user, User $model): bool
    {
        return \data_get($model, 'created_by') === $user->id;
    }
}
