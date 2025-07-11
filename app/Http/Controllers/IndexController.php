<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class IndexController extends Controller
{
    /**
     * @return JsonResponse
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index(): JsonResponse
    {
        $appInfo = \config('app.name').' API v1.0.0 '.\app()->getLocale();

        return \response()->json($appInfo);
    }
}
