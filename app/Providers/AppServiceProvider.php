<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Relation::morphMap([
            'resident_house' => \App\Models\Citizen::class,
            'public_facility' => \App\Models\Infrastructure::class,
            'msme_location' => \App\Models\Msme::class,
        ]);
    }
}
