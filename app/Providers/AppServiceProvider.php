<?php

namespace App\Providers;

use App\Http\Resources\BaseResource;
use App\Http\Resources\ConsumerResource;
use App\Http\Resources\ProductResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        BaseResource::withoutWrapping();
    }
}
