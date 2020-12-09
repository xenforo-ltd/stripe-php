<?php

declare(strict_types=1);

namespace Stripe;

/**
 * @internal
 * @covers \Stripe\BitcoinReceiver
 */
final class BitcoinReceiverTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'btcrcv_123';

    // Because of the wildcard nature of sources, stripe-mock cannot currently
    // reliably return sources of a given type, so we create a fixture manually
    public function createFixture($params = [])
    {
        $base = [
            'id' => self::TEST_RESOURCE_ID,
            'object' => 'bitcoin_receiver',
            'metadata' => [],
        ];

        return BitcoinReceiver::constructFrom(
            \array_merge($params, $base),
            new Util\RequestOptions()
        );
    }

    public function testHasCorrectStandaloneUrl(): void
    {
        $resource = $this->createFixture();
        static::assertSame(
            '/v1/bitcoin/receivers/' . self::TEST_RESOURCE_ID,
            $resource->instanceUrl()
        );
    }

    public function testHasCorrectUrlForCustomer(): void
    {
        $resource = $this->createFixture(['customer' => 'cus_123']);
        static::assertSame(
            '/v1/customers/cus_123/sources/' . self::TEST_RESOURCE_ID,
            $resource->instanceUrl()
        );
    }

    public function testIsListable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/bitcoin/receivers'
        );
        $resources = BitcoinReceiver::all();
        static::assertInternalType('array', $resources->data);
        static::assertSame(\Stripe\BitcoinReceiver::class, \get_class($resources->data[0]));
    }

    public function testIsRetrievable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/bitcoin/receivers/' . self::TEST_RESOURCE_ID
        );
        $resource = BitcoinReceiver::retrieve(self::TEST_RESOURCE_ID);
        static::assertSame(\Stripe\BitcoinReceiver::class, \get_class($resource));
    }
}
