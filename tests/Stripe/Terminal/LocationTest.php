<?php

declare(strict_types=1);

namespace Stripe\Terminal;

/**
 * @internal
 * @covers \Stripe\Terminal\Location
 */
final class LocationTest extends \PHPUnit\Framework\TestCase
{
    use \Stripe\TestHelper;

    const TEST_RESOURCE_ID = 'loc_123';

    public function testIsListable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/terminal/locations'
        );
        $resources = Location::all();
        static::assertIsArray($resources->data);
        static::assertInstanceOf(\Stripe\Terminal\Location::class, $resources->data[0]);
    }

    public function testIsRetrievable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/terminal/locations/' . self::TEST_RESOURCE_ID
        );
        $resource = Location::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\Terminal\Location::class, $resource);
    }

    public function testIsSaveable(): void
    {
        $resource = Location::retrieve(self::TEST_RESOURCE_ID);
        $resource->display_name = 'new-name';

        $this->expectsRequest(
            'post',
            '/v1/terminal/locations/' . self::TEST_RESOURCE_ID
        );
        $resource->save();
        static::assertInstanceOf(\Stripe\Terminal\Location::class, $resource);
    }

    public function testIsUpdatable(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/terminal/locations/' . self::TEST_RESOURCE_ID,
            ['display_name' => 'new-name']
        );
        $resource = Location::update(self::TEST_RESOURCE_ID, [
            'display_name' => 'new-name',
        ]);
        static::assertInstanceOf(\Stripe\Terminal\Location::class, $resource);
    }

    public function testIsCreatable(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/terminal/locations',
            [
                'display_name' => 'name',
                'address' => [
                    'line1' => 'line1',
                    'country' => 'US',
                    'state' => 'CA',
                    'postal_code' => '12345',
                    'city' => 'San Francisco',
                ],
            ]
        );
        $resource = Location::create([
            'display_name' => 'name',
            'address' => [
                'line1' => 'line1',
                'country' => 'US',
                'state' => 'CA',
                'postal_code' => '12345',
                'city' => 'San Francisco',
            ],
        ]);
        static::assertInstanceOf(\Stripe\Terminal\Location::class, $resource);
    }

    public function testIsDeletable(): void
    {
        $resource = Location::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'delete',
            '/v1/terminal/locations/' . self::TEST_RESOURCE_ID
        );
        $resource->delete();
        static::assertInstanceOf(\Stripe\Terminal\Location::class, $resource);
    }
}
