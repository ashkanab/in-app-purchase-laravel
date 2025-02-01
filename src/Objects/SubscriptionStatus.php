<?php

namespace AppStore\InAppPurchase\Objects;

use AppStore\InAppPurchase\Enum\Status;
use Carbon\Carbon;

class SubscriptionStatus
{
    public function __construct(
        private readonly ?string $subscriptionId = null,
        private readonly ?string $productId = null,
        private readonly ?string $originalTransactionId = null,
        private readonly ?string $groupId = null,
        private ?bool   $autoRenewable = null,
        private ?Carbon $expireAt = null,
        private ?string $status = null,
        private bool $wasRecentlyRenewed = false,
    )
    {
    }

    public function isActive(): bool
    {
        if(!$this->status){
            return false;
        }

        if ($this->status === Status::Expired->name || $this->status === Status::Revoked->name) {
            return false;
        }

        return true;
    }

    public function isExpired(): bool
    {
        if(isset($this->expireAt) && $this->expireAt->isFuture()) {
            return false;
        }

        return true;
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
    public function getGroupId(): string
    {
        return $this->groupId;
    }

    /**
     * @return bool|null
     */
    public function getAutoRenewable(): ?bool
    {
        return $this->autoRenewable;
    }

    /**
     * @return Carbon
     */
    public function getExpireAt(): ?Carbon
    {
        return $this->expireAt;
    }

    /**
     * @return string
     */
    public function getSubscriptionId(): string
    {
        return $this->subscriptionId;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param bool|null $autoRenewable
     */
    public function setAutoRenewable(?bool $autoRenewable): void
    {
        $this->autoRenewable = $autoRenewable;
    }

    /**
     * @param Carbon|null $expireAt
     */
    public function setExpireAt(?Carbon $expireAt): void
    {
        $this->expireAt = $expireAt;
    }

    /**
     * @param string|null $status
     */
    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    /**
     * @param bool $wasRecentlyRenewed
     */
    public function setWasRecentlyRenewed(bool $wasRecentlyRenewed): void
    {
        $this->wasRecentlyRenewed = $wasRecentlyRenewed;
    }

    /**
     * @return bool
     */
    public function wasRecentlyRenewed(): bool
    {
        return $this->wasRecentlyRenewed;
    }
}