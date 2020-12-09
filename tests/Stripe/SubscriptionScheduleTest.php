<?php

declare(strict_types=1);

namespace Stripe;

/**
 * @internal
 * @covers \Stripe\SubscriptionSchedule
 */
final class SubscriptionScheduleTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'sub_sched_123';
    const TEST_REVISION_ID = 'sub_sched_rev_123';

    public function testIsListable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/subscription_schedules'
        );
        $resources = SubscriptionSchedule::all();
        static::assertIsArray($resources->data);
        static::assertInstanceOf(\Stripe\SubscriptionSchedule::class, $resources->data[0]);
    }

    public function testIsRetrievable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/subscription_schedules/' . self::TEST_RESOURCE_ID
        );
        $resource = SubscriptionSchedule::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\SubscriptionSchedule::class, $resource);
    }

    public function testIsCreatable(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/subscription_schedules'
        );
        $resource = SubscriptionSchedule::create([
            'phases' => [
                [
                    'items' => [
                        ['price' => 'price_123', 'quantity' => 2],
                    ],
                ],
            ],
        ]);
        static::assertInstanceOf(\Stripe\SubscriptionSchedule::class, $resource);
    }

    public function testIsSaveable(): void
    {
        $resource = SubscriptionSchedule::retrieve(self::TEST_RESOURCE_ID);
        $resource->metadata['key'] = 'value';
        $this->expectsRequest(
            'post',
            '/v1/subscription_schedules/' . $resource->id
        );
        $resource->save();
        static::assertInstanceOf(\Stripe\SubscriptionSchedule::class, $resource);
    }

    public function testIsUpdatable(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/subscription_schedules/' . self::TEST_RESOURCE_ID
        );
        $resource = SubscriptionSchedule::update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Stripe\SubscriptionSchedule::class, $resource);
    }

    public function testIsCancelable(): void
    {
        $resource = SubscriptionSchedule::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'post',
            '/v1/subscription_schedules/' . $resource->id . '/cancel',
            []
        );
        $resource->cancel([]);
        static::assertInstanceOf(\Stripe\SubscriptionSchedule::class, $resource);
    }

    public function testIsReleaseable(): void
    {
        $resource = SubscriptionSchedule::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'post',
            '/v1/subscription_schedules/' . $resource->id . '/release',
            []
        );
        $resource->release([]);
        static::assertInstanceOf(\Stripe\SubscriptionSchedule::class, $resource);
    }
}
