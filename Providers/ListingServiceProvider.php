<?php

namespace Modules\Ledger\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Ledger\Repository\Listing\ListingInterface;
use Modules\Ledger\Repository\Badges\BadgesInterface;
use Modules\Ledger\Repository\Badges\BadgesRepository;
use Modules\Ledger\Repository\Listing\ListingRepository;

class ListingServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
       $this->app->bind(ListingInterface::class, ListingRepository::class);
       $this->app->bind(BadgesInterface::class, BadgesRepository::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
