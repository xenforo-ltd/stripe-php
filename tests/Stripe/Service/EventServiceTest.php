<?php

declare(strict_types=1);

namespace Stripe\Service;

/**
 * @internal
 * @covers \Stripe\Service\EventService
 */
final class EventServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Stripe\TestHelper;

    const TEST_RESOURCE_ID = 'evt_123';

    /** @var \Stripe\StripeClient */
    private $client;

    /** @var EventService */
    private $service;

    /**
     * @before
     */
    protected function setUpService(): void
    {
        $this->client = new \Stripe\StripeClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new EventService($this->client);
    }

    public function testAll(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/events'
        );
        $resources = $this->service->all();
        static::assertIsArray($resources->data);
        static::assertInstanceOf(\Stripe\Event::class, $resources->data[0]);
    }

    public function testRetrieve(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/events/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\Event::class, $resource);
    }
}
