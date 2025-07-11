<?php

namespace App\Enums;

/**
 * @method static static user()
 * @method static static admin()
 *
 * @extends Enum<string>
 */
final class RoleEnum extends Enum
{
    public const admin = 'admin';

    public const user = 'user';

    /**
     * Get the permissions for the given role.
     *
     * @param string $role
     *
     * @return list<string>
     *
     * @throws \InvalidArgumentException
     */
    public static function permissions(string $role): array
    {
        return match ($role) {
            self::admin => [
                PermissionEnum::usersManage,
                PermissionEnum::usersManageOwn,
                PermissionEnum::usersDelete,
                PermissionEnum::usersDeleteOwn,
                PermissionEnum::companiesManage,
                PermissionEnum::companiesManageOwn,
                PermissionEnum::companiesDelete,
                PermissionEnum::companiesDeleteOwn,
            ],
            self::user => [
                PermissionEnum::companiesManageOwn,
                PermissionEnum::companiesDeleteOwn,
            ],
            default => throw new \InvalidArgumentException('Invalid role'),
        };
    }
}
