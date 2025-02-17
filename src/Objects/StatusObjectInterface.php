<?php

namespace AppStore\InAppPurchase\Objects;

use AppStore\InAppPurchase\Enum\Type;

interface StatusObjectInterface
{
    public function isActive(): bool;

    public function getProductId(): string;

    public function getOriginalTransactionId(): ?string;

    public function getStatus(): ?string;

    public function getType(): Type;
}