<?php

use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'verified'])
    ->prefix('companies')
    ->controller(CompanyController::class)
    ->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{company}', 'show');
        Route::put('/{company}', 'update');
        Route::delete('/{company}', 'destroy');
    });
