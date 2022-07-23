<?php

namespace App\Providers;

use App\Http\Controllers\ProfileController;
use App\Http\Interfaces\CrudInterface;
use App\Repositories\ProfileRepository;
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
        $this->app->when(ProfileController::class)->needs(CrudInterface::class)->give(ProfileRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
