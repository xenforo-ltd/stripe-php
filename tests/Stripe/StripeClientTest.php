<?php

declare(strict_types=1);

namespace Stripe;

/**
 * @internal
 * @covers \Stripe\StripeClient
 */
final class StripeClientTest extends \PHPUnit\Framework\TestCase
{
    public function testExposesPropertiesForServices(): void
    {
        $client = new StripeClient('sk_test_123');
        static::assertInstanceOf(\Stripe\Service\CouponService::class, $client->coupons);
        static::assertInstanceOf(\Stripe\Service\Issuing\IssuingServiceFactory::class, $client->issuing);
        static::assertInstanceOf(\Stripe\Service\Issuing\CardService::class, $client->issuing->cards);
    }
}
