<?php

namespace AppStore\InAppPurchase;

use AppStore\InAppPurchase\Enum\Status;
use AppStore\InAppPurchase\Models\Subscription;
use AppStore\InAppPurchase\Objects\SubscriptionStatus;
use AshkanAb\AppStore\Client;
use AshkanAb\AppStore\Factory;
use Carbon\Carbon;

class AppStorePurchase
{
    private Client $client;

    public function __construct(array $config = [])
    {
        $this->client = (new Factory(
            $config['bundle'],
            now()->addMinutes(5),
            $config['issuer_id'],
            $config['key_id'],
            config_path($config['private_key_path'])
        ))
            ->isSandbox($config['env'] === 'sandbox')
            ->client();
    }

    public function client(): Client
    {
        return $this->client;
    }


    public function verifySubscription(string $purchaseTransactionId): SubscriptionStatus
    {
        $transaction = $this->client->getTransactionInfo($purchaseTransactionId)->getDecodedTransactionInfo();


        if (!$transaction->isSubscription()) {
            return new SubscriptionStatus();
        }

        if ($transaction->isExpired()) {
            return new SubscriptionStatus();
        }


        $subscription = Subscription::updateOrCreate(
            [
                'product_id' => $transaction->getProductId(),
                'group_id' => $transaction->getSubscriptionGroupIdentifier()
            ],
            [
                'org_transaction_id' => $transaction->getOriginalTransactionId(),
                'expire_at' => $transaction->getExpiresDate(),
                'auto_renewable' => $transaction->getType() === 'Auto-Renewable Subscription',
                'status' => Status::Active->value,
            ]
        );

        return new SubscriptionStatus(
            subscriptionId: $subscription->id,
            productId: $subscription->product_id,
            originalTransactionId: $subscription->org_transaction_id,
            groupId: $subscription->group_id,
            autoRenewable: $subscription->auto_renewable,
            expireAt: $subscription->expire_at,
            status: Status::Active->name
        );
    }


    public function getSubscriptionStatus(string $subscriptionId): SubscriptionStatus
    {
        $subscription = Subscription::where('id', $subscriptionId)->first();

        if (!$subscription) {
            return new SubscriptionStatus();
        }

        $subscriptionStatus = new SubscriptionStatus(
            subscriptionId: $subscription->id,
            productId: $subscription->product_id,
            originalTransactionId: $subscription->org_transaction_id,
            groupId: $subscription->group_id,
            autoRenewable: $subscription->auto_renewable,
            expireAt: $subscription->expire_at,
            status: Status::getNameByValue($subscription->status)
        );


        if($subscriptionStatus->isActive() && !$subscriptionStatus->isExpired()) {
            return $subscriptionStatus;
        }


        $lastTransactionItem = $this->client->getSubscriptions($subscription->org_transaction_id)
            ->getData()->getLastTransactions($subscription->group_id)[0];


        $renewalInfo = $lastTransactionItem->getDecodedRenewalInfo();

        $subscriptionStatus->setStatus(Status::getNameByValue($lastTransactionItem->getStatus()));
        $subscriptionStatus->setAutoRenewable((bool)$renewalInfo->getAutoRenewStatus());
        $subscriptionStatus->setExpireAt(
            Carbon::createFromTimestamp($renewalInfo->getRenewalDate()->getTimestamp())
        );

        $subscription->update([
            'expire_at' => $subscriptionStatus->getExpireAt(),
            'auto_renewable' => $subscriptionStatus->getAutoRenewable(),
            'status' => $lastTransactionItem->getStatus()
        ]);

        return $subscriptionStatus;
    }



}