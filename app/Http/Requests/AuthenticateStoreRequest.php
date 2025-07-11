<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthenticateStoreRequest extends Request
{
    /**
     * @return array<string,array<mixed,mixed>>
     */
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
            ],
            'password' => [
                'required',
                'string',
                'min:4',
            ],
            'remember' => [
                'nullable',
                'boolean',
            ],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @return void
     *
     * @throws ValidationException
     * @throws \InvalidArgumentException
     * @throws BindingResolutionException
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws HttpException
     * @throws NotFoundHttpException
     */
    public function authenticate(): void
    {
        $user = User::whereEmail($this->email)->first();

        if (! $user || ! Hash::check($this->password, $user->password)) {
            \abort(\response()->json(['message' => \__('Invalid email or password.')], Response::HTTP_UNAUTHORIZED));
        }

        $this->setUserResolver(fn () => $user);
    }
}
