<?php

namespace App\Providers;

use App;
use Illuminate\Support\ServiceProvider;
use App\Motodash\Contracts\Modules\DataTransformer;
use App\Motodash\Contracts\Modules\GraphicTransformer;
use App\Motodash\Contracts\Repositories\UserVehicleRepository;
use App\Motodash\Contracts\Repositories\UserRepository;
use App\Motodash\Contracts\Repositories\ApiRepository;
use App\Motodash\Modules\GraphicTransformer\GlideTransformer;
use App\Motodash\Modules\DataTransformer\FractalDataTransformer;
use App\Motodash\Repositories\EloquentUserVehicleRepository;
use App\Motodash\Repositories\EloquentUserRepository;
use App\Motodash\Repositories\EloquentApiRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(GlideTransformer::class, function($app) {
            return new GlideTransformer($app['laravel-glide-image']);
        });

        $this->app->bind(GraphicTransformer::class,
            GlideTransformer::class,
            true
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserVehicleRepository::class,
            EloquentUserVehicleRepository::class
        );

        $this->app->bind(UserRepository::class,
            EloquentUserRepository::class
        );

        $this->app->bind(DataTransformer::class,
            FractalDataTransformer::class
        );

        $this->app->bind(ApiRepository::class,
            EloquentApiRepository::class
        );

        $this->app->bind('UserPolicy', function($app) {
            return new \App\Policies\UserPolicy();
        });
    }
}
