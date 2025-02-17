<?php

namespace AppStore\InAppPurchase;

use AshkanAb\AppStore\Client;
use Illuminate\Support\Facades\Facade;

/**
 *
 * @method static Objects\PurchaseStatus verifyPurchase(string $purchaseTransactionId, string|int $userId)
 * @method static Objects\PurchaseStatus getPurchaseStatus(string $purchaseId)
 * @method static Objects\SubscriptionStatus verifySubscription(string $purchaseTransactionId)
 * @method static Objects\SubscriptionStatus getSubscriptionStatus(string $subscriptionId)
 * @method static Client client()
 *
 */

class Purchase extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'purchase';
    }
}