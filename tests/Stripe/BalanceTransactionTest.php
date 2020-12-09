<?php

declare(strict_types=1);

namespace Stripe;

/**
 * @internal
 * @covers \Stripe\BalanceTransaction
 */
final class BalanceTransactionTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'txn_123';

    public function testIsListable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/balance_transactions'
        );
        $resources = BalanceTransaction::all();
        static::assertIsArray($resources->data);
        static::assertInstanceOf(\Stripe\BalanceTransaction::class, $resources->data[0]);
    }

    public function testIsRetrievable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/balance_transactions/' . self::TEST_RESOURCE_ID
        );
        $resource = BalanceTransaction::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\BalanceTransaction::class, $resource);
    }
}
