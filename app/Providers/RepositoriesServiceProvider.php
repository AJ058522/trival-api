<?php

namespace App\Providers;

use App\Repositories\Search\SearchRepository;
use App\Repositories\Search\SearchRepositoryInterface;

use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(SearchRepositoryInterface::class, SearchRepository::class);
    }
}
