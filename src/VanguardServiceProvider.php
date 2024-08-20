<?php

declare(strict_types=1);

namespace VanguardBackup\Vanguard;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class VanguardServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(VanguardManager::class, function ($app) {
            return new VanguardManager($app['config']->get('services.vanguard.token'));
        });
    }
}
