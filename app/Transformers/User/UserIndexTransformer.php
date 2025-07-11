<?php

namespace App\Transformers\User;

use App\Enums\RoleEnum;
use App\Models\Company;
use App\Models\User;
use App\Transformers\Transformer;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class UserIndexTransformer extends Transformer
{
    /**
     * @var array<int,string>
     */
    protected array $defaultIncludes = [
        'role',
        'companies',
    ];

    /**
     * Transform entity.
     *
     * @param User $user
     *
     * @return array<mixed,mixed>
     */
    public function transform($user): array
    {
        return $user->only([
            'id',
            'first_name',
            'last_name',
            'email',
        ]);
    }

    /**
     * @param User $user
     *
     * @return Item
     */
    public function includeRole(User $user): Item
    {
        return $this->item($user->role, fn (RoleEnum $role) => [
            'id' => $role->value,
            'name' => $role->description,
        ]);
    }

    /**
     * @param User $user
     *
     * @return Collection
     */
    public function includeCompanies(User $user): Collection
    {
        return $this->collection($user->companies, fn (Company $company) => $company->only([
            'id',
            'name',
            'email',
            'phone',
            'address',
        ]));
    }
}
