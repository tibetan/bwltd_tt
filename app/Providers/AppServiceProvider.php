<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\BrandRepository;
use App\Repositories\BrandRepositoryInterface;
use App\Repositories\CountryRepository;
use App\Repositories\CountryRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BrandRepositoryInterface::class, BrandRepository::class);
        $this->app->bind(CountryRepositoryInterface::class, CountryRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
