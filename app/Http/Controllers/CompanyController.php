<?php

namespace App\Http\Controllers;

use App\Criteria\CompanyIndexCriteria;
use App\Enums\PolicyAbilityEnum;
use App\Http\Requests\Company\CompanyStoreRequest;
use App\Http\Requests\Company\CompanyUpdateRequest;
use App\Models\Company;
use App\Repositories\CompanyRepository;
use App\Transformers\Company\CompanyIndexTransformer;
use App\Transformers\Company\CompanyShowTransformer;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use InvalidArgumentException;
use Prettus\Repository\Exceptions\RepositoryException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class CompanyController extends Controller
{
    /**
     * @param CompanyRepository $repository
     *
     * @return void
     */
    public function __construct(protected CompanyRepository $repository)
    {
    }

    /**
     * @param CompanyStoreRequest $request
     *
     * @return JsonResponse
     *
     * @throws AuthorizationException
     * @throws ValidationException
     * @throws InvalidArgumentException
     * @throws BindingResolutionException
     */
    public function store(CompanyStoreRequest $request): JsonResponse
    {
        $this->authorize(PolicyAbilityEnum::create, Company::class);
        $this->repository->create($request->validated());

        return $this->responseNoContent();
    }

    /**
     * @param CompanyUpdateRequest $request
     * @param Company $company
     *
     * @return JsonResponse
     *
     * @throws AuthorizationException
     * @throws ValidationException
     * @throws InvalidArgumentException
     * @throws BindingResolutionException
     */
    public function update(CompanyUpdateRequest $request, Company $company): JsonResponse
    {
        $this->authorize(PolicyAbilityEnum::update, $company);
        $this->repository->update($request->validated(), $company->id);

        return $this->responseNoContent();
    }

    /**
     * @param Company $company
     *
     * @return JsonResponse
     *
     * @throws AuthorizationException
     */
    public function show(Company $company): JsonResponse
    {
        $this->authorize(PolicyAbilityEnum::view, $company);

        $company = $this->repository
            ->with(['user', 'createdBy'])
            ->setTransformer(CompanyShowTransformer::class)
            ->parserResult($company);

        return $this->responseData($company);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     *
     * @throws AuthorizationException
     * @throws RepositoryException
     * @throws BindingResolutionException
     * @throws BadRequestException
     */
    public function index(Request $request): JsonResponse
    {
        $this->authorize(PolicyAbilityEnum::viewAny, Company::class);
        $user = $request->user() ?? throw new BadRequestException('User not found');

        $companies = $this->repository
            ->pushCriteria(new CompanyIndexCriteria($user))
            ->setTransformer(CompanyIndexTransformer::class)
            ->paginate();

        return $this->responseData($companies);
    }

    /**
     * @param Company $company
     *
     * @return JsonResponse
     *
     * @throws AuthorizationException
     */
    public function destroy(Company $company): JsonResponse
    {
        $this->authorize(PolicyAbilityEnum::delete, $company);
        $this->repository->delete($company->id);

        return $this->responseNoContent();
    }
}
