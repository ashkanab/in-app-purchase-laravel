<?php

namespace AppStore\InAppPurchase\Enum;

enum Status: int
{
    case Active = 1;

    case Expired = 2;

    case RetryPeriod = 3;

    case GracePeriod = 4;

    case Revoked = 5;

    case Consumed = 6;


    public static function getNameByValue($value): ?string
    {
        foreach (self::cases() as $case) {
            if ($case->value === $value) {
                return $case->name;
            }
        }
        return null;
    }
}
