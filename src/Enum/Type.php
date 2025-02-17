<?php

namespace AppStore\InAppPurchase\Enum;

enum Type: string
{

    case AutoRenewableSubscription = 'Auto-Renewable Subscription';
    case NonConsumable = 'Non-Consumable';
    case Consumable = 'Consumable';
    case NonRenewingSubscription = 'Non-Renewing Subscription';

}
