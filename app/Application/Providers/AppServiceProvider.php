<?php

namespace Application\Providers;

use Domain\Transfer\Repositories\ShopkeeperRepository;
use Domain\Transfer\Repositories\TransactionRepository;
use Domain\Transfer\Repositories\UserRepository;
use Domain\Transfer\Repositories\WalletRepository;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Transfer\Repositories\EloquentORM\ShopkeeperORMRepository;
use Infrastructure\Transfer\Repositories\EloquentORM\TransactionORMRepository;
use Infrastructure\Transfer\Repositories\EloquentORM\UserORMRepository;
use Infrastructure\Transfer\Repositories\EloquentORM\WalletORMRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * @return void
     */
    public function register()
    {
        $this->publishes(
            [
                __DIR__ . '/pt-br' => resource_path('lang/pt-br'),
            ],
            'laravel-pt-br-localization'
        );
    }

    /**
     * Bootstrap any application services.
     * @return void
     */
    public function boot()
    {
        $this->repositoryDependencyInjection();
    }

    private function repositoryDependencyInjection()
    {
        $this->app->singleton(UserRepository::class, function ($app) {
            return new UserRepository($app->make(UserORMRepository::class));
        });

        $this->app->singleton(TransactionRepository::class, function ($app) {
            return new TransactionRepository(
                $app->make(TransactionORMRepository::class),
                $app->make(::class)
            );
        });

        $this->app->singleton(ShopkeeperRepository::class, function ($app) {
            return new ShopkeeperRepository($app->make(ShopkeeperORMRepository::class));
        });

        $this->app->singleton(WalletRepository::class, function ($app) {
            return new WalletRepository($app->make(WalletORMRepository::class));
        });
    }
}
