<?php

namespace App\Providers;

use App\Repositories\TransactionORMRepository;
use App\Repositories\UserORMRepository;
use App\Services\TransactionService;
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
        $this->app->singleton(TransactionService::class, function ($app) {
            return new TransactionService(
                $app->make(TransactionORMRepository::class),
                $app->make(UserORMRepository::class)
            );
        });
    }
}
