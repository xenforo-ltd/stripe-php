<?php

declare(strict_types=1);

namespace Stripe;

/**
 * @internal
 * @covers \Stripe\SubscriptionItem
 */
final class SubscriptionItemTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'si_123';

    public function testIsListable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/subscription_items',
            [
                'subscription' => 'sub_123',
            ]
        );
        $resources = SubscriptionItem::all([
            'subscription' => 'sub_123',
        ]);
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Stripe\SubscriptionItem::class, $resources->data[0]);
    }

    public function testIsRetrievable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/subscription_items/' . self::TEST_RESOURCE_ID
        );
        $resource = SubscriptionItem::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\SubscriptionItem::class, $resource);
    }

    public function testIsCreatable(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/subscription_items'
        );
        $resource = SubscriptionItem::create([
            'price' => 'price_123',
            'subscription' => 'sub_123',
        ]);
        static::assertInstanceOf(\Stripe\SubscriptionItem::class, $resource);
    }

    public function testIsSaveable(): void
    {
        $resource = SubscriptionItem::retrieve(self::TEST_RESOURCE_ID);
        $resource->metadata['key'] = 'value';
        $this->expectsRequest(
            'post',
            '/v1/subscription_items/' . $resource->id
        );
        $resource->save();
        static::assertInstanceOf(\Stripe\SubscriptionItem::class, $resource);
    }

    public function testIsUpdatable(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/subscription_items/' . self::TEST_RESOURCE_ID
        );
        $resource = SubscriptionItem::update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Stripe\SubscriptionItem::class, $resource);
    }

    public function testIsDeletable(): void
    {
        $resource = SubscriptionItem::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'delete',
            '/v1/subscription_items/' . $resource->id
        );
        $resource->delete();
        static::assertInstanceOf(\Stripe\SubscriptionItem::class, $resource);
    }

    public function testCanCreateUsageRecord(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/subscription_items/' . self::TEST_RESOURCE_ID . '/usage_records'
        );
        $resource = SubscriptionItem::createUsageRecord(self::TEST_RESOURCE_ID, [
            'quantity' => 100,
            'timestamp' => 12341234,
            'action' => 'set',
        ]);
    }

    public function testCanListUsageRecordSummariesDeprecated(): void
    {
        $resource = SubscriptionItem::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'get',
            '/v1/subscription_items/' . $resource->id . '/usage_record_summaries'
        );
        $resources = $resource->usageRecordSummaries();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Stripe\UsageRecordSummary::class, $resources->data[0]);
    }

    public function testCanListUsageRecordSummaries(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/subscription_items/' . self::TEST_RESOURCE_ID . '/usage_record_summaries'
        );
        $resources = SubscriptionItem::allUsageRecordSummaries(self::TEST_RESOURCE_ID);
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Stripe\UsageRecordSummary::class, $resources->data[0]);
    }
}
