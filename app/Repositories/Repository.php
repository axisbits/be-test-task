<?php

namespace App\Repositories;

use App\Presenters\Presenter;
use Illuminate\Container\Container as Application;
use League\Fractal\TransformerAbstract;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Exceptions\RepositoryException;
use Prettus\Repository\Traits\CacheableRepository;

abstract class Repository extends BaseRepository
{
    use CacheableRepository {
        CacheableRepository::paginate as traitPaginate;
    }

    /**
     * @var array<int,int>
     */
    protected $allowedPerPage = [10, 25, 50];

    /**
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        parent::__construct($app);
    }

    /**
     * @return array<int, int>
     */
    public function allowedPerPage(): array
    {
        return $this->allowedPerPage;
    }

    /**
     * Specify Presenter class name.
     *
     * @return string
     */
    public function presenter()
    {
        return Presenter::class;
    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    abstract public function model();

    /**
     * Retrieve all data of repository, paginated.
     *
     * @param null|int $limit
     * @param array<mixed,mixed> $columns
     * @param string $method
     *
     * @return mixed
     */
    public function paginate($limit = null, $columns = ['*'], $method = 'paginate')
    {
        $perPage = \request()->get('perPage');
        $limit = \is_null($limit) && \in_array($perPage, $this->allowedPerPage())
            ? $perPage
            : $limit ?? \config('repository.pagination.limit', 10);

        $paginate = $this->traitPaginate($limit, $columns, $method);
        $paginateMeta = $paginate['meta'];
        unset($paginate['meta']);

        return [
            'data' => $paginate,
            'meta' => $paginateMeta,
        ];
    }

    /**
     * Set Transformer.
     *
     * @param TransformerAbstract|string $transformer
     *
     * @return Repository
     *
     * @throws RepositoryException
     */
    public function setTransformer(TransformerAbstract|string $transformer): self
    {
        // @phpstan-ignore-next-line
        $this->makePresenter((new Presenter)->setTransformer($transformer));

        return $this;
    }
}
