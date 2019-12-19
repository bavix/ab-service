<?php

namespace App\Providers;

use App\Models\Project;
use App\Observers\ProjectObserver;
use App\Services\CollateService;
use App\Services\CompareService;
use App\Services\SegmentDataProvider;
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
        $this->app->singleton(SegmentDataProvider::class);
        $this->app->singleton(CompareService::class);
        $this->app->singleton(CollateService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Project::observe(ProjectObserver::class);
    }

}
