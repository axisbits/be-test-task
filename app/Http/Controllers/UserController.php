<?php

namespace App\Http\Controllers;

use App\Enums\PolicyAbilityEnum;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Transformers\User\UserIndexTransformer;
use App\Transformers\User\UserShowTransformer;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use InvalidArgumentException;
use Prettus\Validator\Exceptions\ValidatorException;

class UserController extends Controller
{
    /**
     * @param UserRepository $repository
     *
     * @return void
     */
    public function __construct(protected UserRepository $repository)
    {
    }

    /**
     * @param UserStoreRequest $request
     *
     * @return JsonResponse
     *
     * @throws AuthorizationException
     * @throws ValidationException
     * @throws InvalidArgumentException
     * @throws ValidatorException
     * @throws BindingResolutionException
     */
    public function store(UserStoreRequest $request): JsonResponse
    {
        $this->authorize(PolicyAbilityEnum::create, User::class);
        $this->repository->create($request->validated());

        return $this->responseNoContent();
    }

    /**
     * @param UserUpdateRequest $request
     * @param User $user
     *
     * @return JsonResponse
     *
     * @throws AuthorizationException
     * @throws ValidationException
     * @throws InvalidArgumentException
     * @throws ValidatorException
     * @throws BindingResolutionException
     */
    public function update(UserUpdateRequest $request, User $user): JsonResponse
    {
        $this->authorize(PolicyAbilityEnum::update, $user);
        $this->repository->update($request->validated(), $user->id);

        return $this->responseNoContent();
    }

    /**
     * @param User $user
     *
     * @return JsonResponse
     *
     * @throws AuthorizationException
     */
    public function show(User $user): JsonResponse
    {
        $this->authorize(PolicyAbilityEnum::view, $user);

        $user = $this->repository
            ->with(['companies'])
            ->setTransformer(UserShowTransformer::class)
            ->parserResult($user);

        return $this->responseData($user);
    }

    /**
     * @return JsonResponse
     *
     * @throws AuthorizationException
     * @throws ValidationException
     * @throws InvalidArgumentException
     * @throws ValidatorException
     * @throws BindingResolutionException
     */
    public function index(): JsonResponse
    {
        $this->authorize(PolicyAbilityEnum::viewAny, User::class);

        $users = $this->repository
            ->with(['companies'])
            ->setTransformer(UserIndexTransformer::class)
            ->paginate();

        return $this->responseData($users);
    }

    /**
     * @param User $user
     *
     * @return JsonResponse
     *
     * @throws AuthorizationException
     */
    public function destroy(User $user): JsonResponse
    {
        $this->authorize(PolicyAbilityEnum::delete, $user);
        $this->repository->delete($user->id);

        return $this->responseNoContent();
    }
}
