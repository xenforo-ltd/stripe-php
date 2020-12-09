<?php

declare(strict_types=1);

namespace Stripe;

/**
 * @internal
 * @covers \Stripe\PaymentMethod
 */
final class PaymentMethodTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'pm_123';

    public function testIsListable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/payment_methods'
        );
        $resources = PaymentMethod::all([
            'customer' => 'cus_123',
            'type' => 'card',
        ]);
        static::assertIsArray($resources->data);
        static::assertInstanceOf(\Stripe\PaymentMethod::class, $resources->data[0]);
    }

    public function testIsRetrievable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/payment_methods/' . self::TEST_RESOURCE_ID
        );
        $resource = PaymentMethod::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\PaymentMethod::class, $resource);
    }

    public function testIsCreatable(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/payment_methods'
        );
        $resource = PaymentMethod::create([
            'type' => 'card',
        ]);
        static::assertInstanceOf(\Stripe\PaymentMethod::class, $resource);
    }

    public function testIsSaveable(): void
    {
        $resource = PaymentMethod::retrieve(self::TEST_RESOURCE_ID);
        $resource->metadata['key'] = 'value';
        $this->expectsRequest(
            'post',
            '/v1/payment_methods/' . $resource->id
        );
        $resource->save();
        static::assertInstanceOf(\Stripe\PaymentMethod::class, $resource);
    }

    public function testIsUpdatable(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/payment_methods/' . self::TEST_RESOURCE_ID
        );
        $resource = PaymentMethod::update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Stripe\PaymentMethod::class, $resource);
    }

    public function testCanAttach(): void
    {
        $resource = PaymentMethod::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'post',
            '/v1/payment_methods/' . $resource->id . '/attach'
        );
        $resource = $resource->attach([
            'customer' => 'cus_123',
        ]);
        static::assertInstanceOf(\Stripe\PaymentMethod::class, $resource);
        static::assertSame($resource, $resource);
    }

    public function testCanDetach(): void
    {
        $resource = PaymentMethod::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'post',
            '/v1/payment_methods/' . $resource->id . '/detach'
        );
        $resource = $resource->detach();
        static::assertInstanceOf(\Stripe\PaymentMethod::class, $resource);
        static::assertSame($resource, $resource);
    }
}
