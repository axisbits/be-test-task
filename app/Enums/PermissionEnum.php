<?php

namespace App\Enums;

/**
 * @method static static usersManage()
 * @method static static usersManageOwn()
 * @method static static usersDelete()
 * @method static static usersDeleteOwn()
 * @method static static companiesManage()
 * @method static static companiesManageOwn()
 * @method static static companiesDelete()
 * @method static static companiesDeleteOwn()
 *
 * @extends Enum<string>
 */
final class PermissionEnum extends Enum
{
    public const usersManage = 'users:manage';

    public const usersManageOwn = 'users:manage-own';

    public const usersDelete = 'users:delete';

    public const usersDeleteOwn = 'users:delete-own';

    public const companiesManage = 'companies:manage';

    public const companiesManageOwn = 'companies:manage-own';

    public const companiesDelete = 'companies:delete';

    public const companiesDeleteOwn = 'companies:delete-own';
}
