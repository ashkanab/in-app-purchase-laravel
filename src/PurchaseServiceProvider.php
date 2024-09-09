<?php

namespace AppStore\InAppPurchase;

use Illuminate\Support\ServiceProvider;

class PurchaseServiceProvider extends ServiceProvider
{

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            // Export the migration

            if (! class_exists('CreateSubscriptionsTable')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_subscriptions_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_subscriptions_table.php'),
                    // you can add any number of migrations here
                ], 'migrations');
            }

            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('purchase.php'),
            ], 'config');
        }
    }


    public function register()
    {
        $this->app->bind('purchase', function($app) {
            return new AppStorePurchase(config('purchase'));
        });
    }
}