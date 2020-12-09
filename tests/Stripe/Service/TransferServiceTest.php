<?php

declare(strict_types=1);

namespace Stripe\Service;

/**
 * @internal
 * @covers \Stripe\Service\TransferService
 */
final class TransferServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Stripe\TestHelper;

    const TEST_RESOURCE_ID = 'tr_123';
    const TEST_REVERSAL_ID = 'trr_123';

    /** @var \Stripe\StripeClient */
    private $client;

    /** @var TransferService */
    private $service;

    /**
     * @before
     */
    protected function setUpService(): void
    {
        $this->client = new \Stripe\StripeClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new TransferService($this->client);
    }

    public function testAll(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/transfers'
        );
        $resources = $this->service->all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Stripe\Transfer::class, $resources->data[0]);
    }

    public function testAllReversals(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/transfers/' . self::TEST_RESOURCE_ID . '/reversals'
        );
        $resources = $this->service->allReversals(self::TEST_RESOURCE_ID);
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Stripe\TransferReversal::class, $resources->data[0]);
    }

    public function testCancel(): void
    {
        // stripe-mock does not support this anymore so we stub it
        $this->stubRequest(
            'post',
            '/v1/transfers/' . self::TEST_RESOURCE_ID . '/cancel',
            [],
            null,
            false,
            [
                'object' => 'transfer',
            ]
        );
        $resource = $this->service->cancel(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\Transfer::class, $resource);
    }

    public function testCreate(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/transfers'
        );
        $resource = $this->service->create([
            'amount' => 100,
            'currency' => 'usd',
            'destination' => 'acct_123',
        ]);
        static::assertInstanceOf(\Stripe\Transfer::class, $resource);
    }

    public function testCreateReversal(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/transfers/' . self::TEST_RESOURCE_ID . '/reversals'
        );
        $resource = $this->service->createReversal(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\TransferReversal::class, $resource);
    }

    public function testRetrieve(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/transfers/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\Transfer::class, $resource);
    }

    public function testRetrieveReversal(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/transfers/' . self::TEST_RESOURCE_ID . '/reversals/' . self::TEST_REVERSAL_ID
        );
        $resource = $this->service->retrieveReversal(self::TEST_RESOURCE_ID, self::TEST_REVERSAL_ID);
        static::assertInstanceOf(\Stripe\TransferReversal::class, $resource);
    }

    public function testUpdate(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/transfers/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Stripe\Transfer::class, $resource);
    }

    public function testUpdateReversal(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/transfers/' . self::TEST_RESOURCE_ID . '/reversals/' . self::TEST_REVERSAL_ID
        );
        $resource = $this->service->updateReversal(
            self::TEST_RESOURCE_ID,
            self::TEST_REVERSAL_ID,
            [
                'metadata' => ['key' => 'value'],
            ]
        );
        static::assertInstanceOf(\Stripe\TransferReversal::class, $resource);
    }
}
