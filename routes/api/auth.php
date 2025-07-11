<?php

use App\Http\Controllers\AuthenticateController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')
    ->controller(AuthenticateController::class)
    ->group(function () {
        Route::post('login', 'login');
    });
