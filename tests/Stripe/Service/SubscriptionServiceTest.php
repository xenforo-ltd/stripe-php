<?php

declare(strict_types=1);

namespace Stripe\Service;

/**
 * @internal
 * @covers \Stripe\Service\SubscriptionService
 */
final class SubscriptionServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Stripe\TestHelper;

    const TEST_RESOURCE_ID = 'sub_123';

    /** @var \Stripe\StripeClient */
    private $client;

    /** @var SubscriptionService */
    private $service;

    /**
     * @before
     */
    protected function setUpService(): void
    {
        $this->client = new \Stripe\StripeClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new SubscriptionService($this->client);
    }

    public function testAll(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/subscriptions'
        );
        $resources = $this->service->all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Stripe\Subscription::class, $resources->data[0]);
    }

    public function testAllPagination(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/subscriptions'
        );
        $resources = $this->service->all([
            'status' => 'all',
            'limit' => 100,
        ]);
        $filters = $resources->getFilters();
        static::assertSame($filters, [
            'status' => 'all',
            'limit' => 100,
        ]);
    }

    public function testCancel(): void
    {
        $this->expectsRequest(
            'delete',
            '/v1/subscriptions/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->cancel(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\Subscription::class, $resource);
    }

    public function testCreate(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/subscriptions'
        );
        $resource = $this->service->create([
            'customer' => 'cus_123',
        ]);
        static::assertInstanceOf(\Stripe\Subscription::class, $resource);
    }

    public function testDeleteDiscount(): void
    {
        $this->expectsRequest(
            'delete',
            '/v1/subscriptions/' . self::TEST_RESOURCE_ID . '/discount'
        );
        $resource = $this->service->deleteDiscount(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\Discount::class, $resource);
        static::assertTrue($resource->isDeleted());
    }

    public function testRetrieve(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/subscriptions/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\Subscription::class, $resource);
    }

    public function testUpdate(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/subscriptions/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Stripe\Subscription::class, $resource);
    }
}
