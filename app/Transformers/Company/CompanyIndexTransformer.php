<?php

namespace App\Transformers\Company;

use App\Models\Company;
use App\Models\User;
use App\Transformers\Transformer;
use League\Fractal\Resource\Item;

class CompanyIndexTransformer extends Transformer
{
    /**
     * @var array<int,string>
     */
    protected array $defaultIncludes = [
        'user',
        'createdBy',
    ];

    /**
     * Transform entity.
     *
     * @param Company $company
     *
     * @return array<mixed,mixed>
     */
    public function transform($company): array
    {
        return $company->only([
            'id',
            'name',
            'email',
            'phone',
            'address',
        ]);
    }

    /**
     * @param Company $company
     *
     * @return Item
     */
    public function includeUser(Company $company): Item
    {
        return $this->item($company->user, fn (User $user) => $user->only([
            'id',
            'first_name',
            'last_name',
            'email',
        ]));
    }

    /**
     * @param Company $company
     *
     * @return Item
     */
    public function includeCreatedBy(Company $company): Item
    {
        return $this->item($company->createdBy, fn (User $user) => $user->only([
            'id',
            'first_name',
            'last_name',
            'email',
        ]));
    }
}
