<?php

namespace App\Providers;

use App\Interfaces\KeyValueRepositoryInterface;
use App\Interfaces\KeyValueServiceInterface;
use App\Repositories\DynamoDbKeyValueRepository;
use App\Services\KeyValueService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(KeyValueRepositoryInterface::class, DynamoDbKeyValueRepository::class);
        $this->app->bind(KeyValueServiceInterface::class, KeyValueService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
