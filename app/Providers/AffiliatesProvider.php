<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Affiliates\AffiliatesDataInterface;
use App\Services\Affiliates\AffiliatesData;

class AffiliatesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AffiliatesDataInterface::class, AffiliatesData::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
