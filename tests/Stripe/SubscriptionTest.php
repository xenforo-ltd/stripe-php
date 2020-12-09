<?php

declare(strict_types=1);

namespace Stripe;

/**
 * @internal
 * @covers \Stripe\Subscription
 */
final class SubscriptionTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'sub_123';

    public function testIsListable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/subscriptions'
        );
        $resources = Subscription::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Stripe\Subscription::class, $resources->data[0]);
    }

    public function testIsRetrievable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/subscriptions/' . self::TEST_RESOURCE_ID
        );
        $resource = Subscription::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\Subscription::class, $resource);
    }

    public function testIsCreatable(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/subscriptions'
        );
        $resource = Subscription::create([
            'customer' => 'cus_123',
        ]);
        static::assertInstanceOf(\Stripe\Subscription::class, $resource);
    }

    public function testIsSaveable(): void
    {
        $resource = Subscription::retrieve(self::TEST_RESOURCE_ID);
        $resource->metadata['key'] = 'value';
        $this->expectsRequest(
            'post',
            '/v1/subscriptions/' . $resource->id
        );
        $resource->save();
        static::assertInstanceOf(\Stripe\Subscription::class, $resource);
    }

    public function testIsUpdatable(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/subscriptions/' . self::TEST_RESOURCE_ID
        );
        $resource = Subscription::update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Stripe\Subscription::class, $resource);
    }

    public function testIsCancelable(): void
    {
        $resource = Subscription::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'delete',
            '/v1/subscriptions/' . $resource->id,
            []
        );
        $resource->cancel([]);
        static::assertInstanceOf(\Stripe\Subscription::class, $resource);
    }

    public function testCanDeleteDiscount(): void
    {
        $resource = Subscription::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'delete',
            '/v1/subscriptions/' . $resource->id . '/discount'
        );
        $resource->deleteDiscount();
        static::assertInstanceOf(\Stripe\Subscription::class, $resource);
    }

    public function testSerializeParametersItems(): void
    {
        $obj = Util\Util::convertToStripeObject([
            'object' => 'subscription',
            'items' => Util\Util::convertToStripeObject([
                'object' => 'list',
                'data' => [],
            ], null),
        ], null);
        $obj->items = [
            ['id' => 'si_foo', 'deleted' => true],
            ['plan' => 'plan_bar'],
        ];
        $expected = [
            'items' => [
                0 => ['id' => 'si_foo', 'deleted' => true],
                1 => ['plan' => 'plan_bar'],
            ],
        ];
        static::assertSame($expected, $obj->serializeParameters());
    }
}
