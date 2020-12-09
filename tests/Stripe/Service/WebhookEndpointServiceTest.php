<?php

declare(strict_types=1);

namespace Stripe\Service;

/**
 * @internal
 * @covers \Stripe\Service\WebhookEndpointService
 */
final class WebhookEndpointServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Stripe\TestHelper;

    const TEST_RESOURCE_ID = 'we_123';

    /** @var \Stripe\StripeClient */
    private $client;

    /** @var WebhookEndpointService */
    private $service;

    /**
     * @before
     */
    protected function setUpService(): void
    {
        $this->client = new \Stripe\StripeClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new WebhookEndpointService($this->client);
    }

    public function testAll(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/webhook_endpoints'
        );
        $resources = $this->service->all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Stripe\WebhookEndpoint::class, $resources->data[0]);
    }

    public function testCreate(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/webhook_endpoints'
        );
        $resource = $this->service->create([
            'enabled_events' => ['charge.succeeded'],
            'url' => 'https://stripe.com',
        ]);
        static::assertInstanceOf(\Stripe\WebhookEndpoint::class, $resource);
    }

    public function testDelete(): void
    {
        $this->expectsRequest(
            'delete',
            '/v1/webhook_endpoints/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->delete(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\WebhookEndpoint::class, $resource);
    }

    public function testRetrieve(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/webhook_endpoints/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\WebhookEndpoint::class, $resource);
    }

    public function testUpdate(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/webhook_endpoints/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->update(self::TEST_RESOURCE_ID, [
            'enabled_events' => ['charge.succeeded'],
        ]);
        static::assertInstanceOf(\Stripe\WebhookEndpoint::class, $resource);
    }
}
