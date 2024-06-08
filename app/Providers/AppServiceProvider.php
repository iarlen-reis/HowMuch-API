<?php

namespace App\Providers;

use App\Repositories\Contracts\AuthRepositoryInterface;
use App\Repositories\Contracts\InvoiceRepositoryInterface;
use App\Repositories\Contracts\PurchaseRepositoryInterface;
use App\Repositories\Implementations\AuthRepository;
use App\Repositories\Implementations\InvoiceRepository;
use App\Repositories\Implementations\PurchaseRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            InvoiceRepositoryInterface::class,
            InvoiceRepository::class,
        );

        $this->app->bind(
            AuthRepositoryInterface::class,
            AuthRepository::class,
        );

        $this->app->bind(
            PurchaseRepositoryInterface::class,
            PurchaseRepository::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
