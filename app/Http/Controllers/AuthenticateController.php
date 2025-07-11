<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticateStoreRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Transformers\AuthLoginTransformer;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use InvalidArgumentException;
use Prettus\Repository\Exceptions\RepositoryException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthenticateController extends Controller
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
     * Handle an incoming authentication request.
     *
     * @param AuthenticateStoreRequest $request
     *
     * @return JsonResponse
     *
     * @throws ValidationException
     * @throws InvalidArgumentException
     * @throws BindingResolutionException
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     * @throws HttpException
     * @throws NotFoundHttpException
     * @throws RepositoryException
     */
    public function login(AuthenticateStoreRequest $request): JsonResponse
    {
        $request->authenticate();

        /** @var User $user */
        $user = $request->user();

        $user->createAccessToken('User Token');
        \event(new Authenticated('api', $user));

        return $this->responseData($this->repository
            ->setTransformer(AuthLoginTransformer::class)
            ->parserResult($user));
    }
}
