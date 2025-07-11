<?php

namespace App\Enums;

/**
 * @method static static create()
 * @method static static delete()
 * @method static static update()
 * @method static static view()
 * @method static static viewAny()
 * @method static static deleteOwn()
 * @method static static updateOwn()
 * @method static static viewOwn()
 * @method static static manage()
 *
 * @extends Enum<string>
 */
final class PolicyAbilityEnum extends Enum
{
    public const create = 'create'; // Action: create | store

    public const delete = 'delete'; // Action: destroy

    public const update = 'update'; // Action: edit | update

    public const view = 'view'; // Action: show

    public const viewAny = 'viewAny'; // Action: index

    public const deleteOwn = 'deleteOwn'; // Action: destroy

    public const updateOwn = 'updateOwn'; // Action: edit | update

    public const viewOwn = 'viewOwn'; // Action: show

    public const manage = 'manage';
}
