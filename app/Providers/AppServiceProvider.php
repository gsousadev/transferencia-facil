<?php

namespace App\Providers;

use App\Domain\Repositories\TransactionORMRepository;
use App\Domain\Repositories\UserORMRepository;
use App\Domain\Services\TransactionService;
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
        $this->publishes([
            __DIR__ . '/pt-br' => resource_path('lang/pt-br'),
        ], 'laravel-pt-br-localization');
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
