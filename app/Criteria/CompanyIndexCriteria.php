<?php

namespace App\Criteria;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class CompanyIndexCriteria implements CriteriaInterface
{
    /**
     * @param User $user
     *
     * @return void
     */
    public function __construct(private User $user)
    {
    }

    /**
     * Apply criteria in query repository.
     *
     * @param mixed $model
     * @param RepositoryInterface $repository
     *
     * @return Builder<\Illuminate\Database\Eloquent\Model>
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->with(['user', 'createdBy'])
            ->when(! $this->user->isAdmin(), function (Builder $builder) {
                $builder->where('user_id', $this->user->id);
            })
            ->orderByDesc('created_at');
    }
}
