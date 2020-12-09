<?php

declare(strict_types=1);

namespace Stripe;

/**
 * @internal
 * @covers \Stripe\WebhookEndpoint
 */
final class WebhookEndpointTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'we_123';

    public function testIsListable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/webhook_endpoints'
        );
        $resources = WebhookEndpoint::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Stripe\WebhookEndpoint::class, $resources->data[0]);
    }

    public function testIsRetrievable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/webhook_endpoints/' . self::TEST_RESOURCE_ID
        );
        $resource = WebhookEndpoint::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\WebhookEndpoint::class, $resource);
    }

    public function testIsCreatable(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/webhook_endpoints'
        );
        $resource = WebhookEndpoint::create([
            'enabled_events' => ['charge.succeeded'],
            'url' => 'https://stripe.com',
        ]);
        static::assertInstanceOf(\Stripe\WebhookEndpoint::class, $resource);
    }

    public function testIsSaveable(): void
    {
        $resource = WebhookEndpoint::retrieve(self::TEST_RESOURCE_ID);
        $resource->enabled_events = ['charge.succeeded'];
        $this->expectsRequest(
            'post',
            '/v1/webhook_endpoints/' . self::TEST_RESOURCE_ID
        );
        $resource->save();
        static::assertInstanceOf(\Stripe\WebhookEndpoint::class, $resource);
    }

    public function testIsUpdatable(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/webhook_endpoints/' . self::TEST_RESOURCE_ID
        );
        $resource = WebhookEndpoint::update(self::TEST_RESOURCE_ID, [
            'enabled_events' => ['charge.succeeded'],
        ]);
        static::assertInstanceOf(\Stripe\WebhookEndpoint::class, $resource);
    }

    public function testIsDeletable(): void
    {
        $resource = WebhookEndpoint::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'delete',
            '/v1/webhook_endpoints/' . self::TEST_RESOURCE_ID
        );
        $resource->delete();
        static::assertInstanceOf(\Stripe\WebhookEndpoint::class, $resource);
    }
}
