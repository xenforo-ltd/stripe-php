<?php

declare(strict_types=1);

namespace Stripe;

/**
 * @internal
 * @covers \Stripe\Charge
 */
final class ChargeTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'ch_123';

    public function testIsListable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/charges'
        );
        $resources = Charge::all();
        static::assertIsArray($resources->data);
        static::assertInstanceOf(\Stripe\Charge::class, $resources->data[0]);
    }

    public function testIsRetrievable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/charges/' . self::TEST_RESOURCE_ID
        );
        $resource = Charge::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\Charge::class, $resource);
    }

    public function testIsCreatable(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/charges'
        );
        $resource = Charge::create([
            'amount' => 100,
            'currency' => 'usd',
            'source' => 'tok_123',
        ]);
        static::assertInstanceOf(\Stripe\Charge::class, $resource);
    }

    public function testIsSaveable(): void
    {
        $resource = Charge::retrieve(self::TEST_RESOURCE_ID);
        $resource->metadata['key'] = 'value';
        $this->expectsRequest(
            'post',
            '/v1/charges/' . $resource->id
        );
        $resource->save();
        static::assertInstanceOf(\Stripe\Charge::class, $resource);
    }

    public function testIsUpdatable(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/charges/' . self::TEST_RESOURCE_ID
        );
        $resource = Charge::update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Stripe\Charge::class, $resource);
    }

    public function testCanCapture(): void
    {
        $charge = Charge::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'post',
            '/v1/charges/' . $charge->id . '/capture'
        );
        $resource = $charge->capture();
        static::assertInstanceOf(\Stripe\Charge::class, $resource);
        static::assertSame($resource, $charge);
    }
}
