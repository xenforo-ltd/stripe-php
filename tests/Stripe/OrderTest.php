<?php

declare(strict_types=1);

namespace Stripe;

/**
 * @internal
 * @covers \Stripe\Order
 */
final class OrderTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'or_123';

    public function testIsListable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/orders'
        );
        $resources = Order::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Stripe\Order::class, $resources->data[0]);
    }

    public function testIsRetrievable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/orders/' . self::TEST_RESOURCE_ID
        );
        $resource = Order::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\Order::class, $resource);
    }

    public function testIsCreatable(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/orders'
        );
        $resource = Order::create([
            'currency' => 'usd',
        ]);
        static::assertInstanceOf(\Stripe\Order::class, $resource);
    }

    public function testIsSaveable(): void
    {
        $resource = Order::retrieve(self::TEST_RESOURCE_ID);
        $resource->metadata['key'] = 'value';
        $this->expectsRequest(
            'post',
            '/v1/orders/' . $resource->id
        );
        $resource->save();
        static::assertInstanceOf(\Stripe\Order::class, $resource);
    }

    public function testIsUpdatable(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/orders/' . self::TEST_RESOURCE_ID
        );
        $resource = Order::update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Stripe\Order::class, $resource);
    }

    public function testIsPayable(): void
    {
        $resource = Order::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'post',
            '/v1/orders/' . $resource->id . '/pay'
        );
        $resource->pay();
        static::assertInstanceOf(\Stripe\Order::class, $resource);
    }

    public function testIsReturnable(): void
    {
        $order = Order::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'post',
            '/v1/orders/' . $order->id . '/returns'
        );
        $resource = $order->returnOrder();
        static::assertInstanceOf(\Stripe\OrderReturn::class, $resource);
    }
}
