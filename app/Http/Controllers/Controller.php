<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    /**
     * @param array<mixed,mixed> $data
     * @param int $code
     * @param null|string $message
     *
     * @return JsonResponse
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function responseData(array $data = [], int $code = Response::HTTP_OK, null|string $message = null): JsonResponse
    {
        if ($code === Response::HTTP_OK && ! isset($data['data'])) {
            $data = ['data' => $data];
        }

        if ($message) {
            $data['message'] = $message;
        }

        return \response()->json($data, $code);
    }

    /**
     * @return JsonResponse
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function responseOk(): JsonResponse
    {
        return $this->responseData(code: Response::HTTP_OK);
    }

    /**
     * @return JsonResponse
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function responseNoContent(): JsonResponse
    {
        return $this->responseData(code: Response::HTTP_NO_CONTENT);
    }

    /**
     * @return JsonResponse
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function responseCreated(): JsonResponse
    {
        return $this->responseData(code: Response::HTTP_CREATED);
    }

    /**
     * @return JsonResponse
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function responseNotFound(): JsonResponse
    {
        return $this->responseData(code: Response::HTTP_NOT_FOUND);
    }

    /**
     * @return JsonResponse
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function responseForbidden(): JsonResponse
    {
        return $this->responseData(code: Response::HTTP_FORBIDDEN);
    }
}
