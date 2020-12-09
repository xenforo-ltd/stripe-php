<?php

declare(strict_types=1);

namespace Stripe;

/**
 * @internal
 * @covers \Stripe\Event
 */
final class EventTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'evt_123';

    public function testIsListable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/events'
        );
        $resources = Event::all();
        static::assertIsArray($resources->data);
        static::assertInstanceOf(\Stripe\Event::class, $resources->data[0]);
    }

    public function testIsRetrievable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/events/' . self::TEST_RESOURCE_ID
        );
        $resource = Event::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\Event::class, $resource);
    }
}
