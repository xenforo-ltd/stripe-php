<?php

declare(strict_types=1);

namespace Stripe;

/**
 * @internal
 * @covers \Stripe\Payout
 */
final class PayoutTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'po_123';

    public function testIsListable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/payouts'
        );
        $resources = Payout::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Stripe\Payout::class, $resources->data[0]);
    }

    public function testIsRetrievable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/payouts/' . self::TEST_RESOURCE_ID
        );
        $resource = Payout::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\Payout::class, $resource);
    }

    public function testIsCreatable(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/payouts'
        );
        $resource = Payout::create([
            'amount' => 100,
            'currency' => 'usd',
        ]);
        static::assertInstanceOf(\Stripe\Payout::class, $resource);
    }

    public function testIsSaveable(): void
    {
        $resource = Payout::retrieve(self::TEST_RESOURCE_ID);
        $resource->metadata['key'] = 'value';
        $this->expectsRequest(
            'post',
            '/v1/payouts/' . $resource->id
        );
        $resource->save();
        static::assertInstanceOf(\Stripe\Payout::class, $resource);
    }

    public function testIsUpdatable(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/payouts/' . self::TEST_RESOURCE_ID
        );
        $resource = Payout::update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Stripe\Payout::class, $resource);
    }

    public function testIsCancelable(): void
    {
        $resource = Payout::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'post',
            '/v1/payouts/' . $resource->id . '/cancel'
        );
        $resource->cancel();
        static::assertInstanceOf(\Stripe\Payout::class, $resource);
    }

    public function testIsReverseable(): void
    {
        $resource = Payout::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'post',
            '/v1/payouts/' . $resource->id . '/reverse'
        );
        $resource->reverse();
        static::assertInstanceOf(\Stripe\Payout::class, $resource);
    }
}
