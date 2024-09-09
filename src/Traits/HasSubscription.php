<?php

namespace AppStore\InAppPurchase\Traits;

use AppStore\InAppPurchase\Purchase;

trait HasSubscription
{
    public function getSubscriptionId()
    {
        return $this->{$this->getSubscriptionIdName()};
    }

    public function hasActiveSubscription(): bool
    {
        if(!$this->getSubscriptionId()){
            return false;
        }

        return Purchase::getSubscriptionStatus($this->getSubscriptionId())->isActive();
    }
}