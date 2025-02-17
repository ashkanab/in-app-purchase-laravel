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
            // Export the migration

            if (! class_exists('CreatePurchasesTable')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_purchases_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_purchases_table.php'),
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
        $this->app->bind('purchase', function() {
            return new AppStorePurchase(config('purchase'));
        });
    }
}