<?php

declare(strict_types=1);

namespace Stripe;

/**
 * @internal
 * @covers \Stripe\Coupon
 */
final class CouponTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = '25OFF';

    public function testIsListable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/coupons'
        );
        $resources = Coupon::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Stripe\Coupon::class, $resources->data[0]);
    }

    public function testIsRetrievable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/coupons/' . self::TEST_RESOURCE_ID
        );
        $resource = Coupon::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\Coupon::class, $resource);
    }

    public function testIsCreatable(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/coupons'
        );
        $resource = Coupon::create([
            'percent_off' => 25,
            'duration' => 'repeating',
            'duration_in_months' => 3,
            'id' => self::TEST_RESOURCE_ID,
        ]);
        static::assertInstanceOf(\Stripe\Coupon::class, $resource);
    }

    public function testIsSaveable(): void
    {
        $resource = Coupon::retrieve(self::TEST_RESOURCE_ID);
        $resource->metadata['key'] = 'value';
        $this->expectsRequest(
            'post',
            '/v1/coupons/' . self::TEST_RESOURCE_ID
        );
        $resource->save();
        static::assertInstanceOf(\Stripe\Coupon::class, $resource);
    }

    public function testIsUpdatable(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/coupons/' . self::TEST_RESOURCE_ID
        );
        $resource = Coupon::update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Stripe\Coupon::class, $resource);
    }

    public function testIsDeletable(): void
    {
        $resource = Coupon::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'delete',
            '/v1/coupons/' . self::TEST_RESOURCE_ID
        );
        $resource->delete();
        static::assertInstanceOf(\Stripe\Coupon::class, $resource);
    }
}
