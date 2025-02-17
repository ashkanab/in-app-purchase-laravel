<?php

namespace AppStore\InAppPurchase\Objects;

use AppStore\InAppPurchase\Enum\Status;
use AppStore\InAppPurchase\Models\Purchase;

class PurchaseStatus
{
    public function __construct(
        private readonly ?string $purchaseId = null,
        private readonly ?string $userId = null,
        private readonly ?string $productId = null,
        private readonly ?string $originalTransactionId = null,
        private readonly bool    $isConsumable = false,
        private ?string          $status = null,
        private readonly int     $quantity = 0,
    )
    {
    }

    public function consume(): bool
    {
        if(!$this->isConsumable() || !$this->isActive()) {
            return false;
        }

        Purchase::where('id', $this->purchaseId)
            ->update(['status' => Status::Consumed->value]);

        $this->status = Status::Consumed->name;

        return true;
    }

    public function isActive(): bool
    {
        return $this->status === Status::Active->name;
    }

    /**
     * @return string
     */
    public function getProductId(): string
    {
        return $this->productId;
    }

    /**
     * @return string
     */
    public function getOriginalTransactionId(): string
    {
        return $this->originalTransactionId;
    }

    /**
     * @return string
     */
    public function getPurchaseId(): string
    {
        return $this->purchaseId;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     */
    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string|null
     */
    public function getUserId(): ?string
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return bool
     */
    public function isConsumable(): bool
    {
        return $this->isConsumable;
    }
}