<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->routes(function () {
            Route::middleware('api')
                ->namespace($this->namespace)
                ->group(function () {
                    $this->routeRequire();
                });
        });
    }

    /**
     * @param string $path
     * @param bool $recursive
     *
     * @return void
     */
    private function routeRequire(string $path = 'api', bool $recursive = false): void
    {
        $pattern = $recursive ? $path : \base_path("routes/$path");

        foreach ((array) \glob("$pattern/*") as $item) {
            if ($item && \is_dir($item)) {
                $this->routeRequire($item, true);
            }

            if ($item && \pathinfo($item, PATHINFO_EXTENSION) === 'php') {
                require $item;
            }
        }
    }
}
