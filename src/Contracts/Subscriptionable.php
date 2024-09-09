<?php

namespace AppStore\InAppPurchase\Contracts;

interface Subscriptionable
{
    public function getSubscriptionIdName(): string;
}