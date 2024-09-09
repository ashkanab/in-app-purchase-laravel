<?php

namespace AppStore\InAppPurchase;

use Illuminate\Support\Facades\Facade;

/**
 *
 * @method static Objects\SubscriptionStatus verifySubscription(string $purchaseTransactionId)
 * @method static Objects\SubscriptionStatus getSubscriptionStatus(string $subscriptionId)
 *
 */

class Purchase extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'purchase';
    }
}