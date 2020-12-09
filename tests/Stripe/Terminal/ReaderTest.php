<?php

declare(strict_types=1);

namespace Stripe\Terminal;

/**
 * @internal
 * @covers \Stripe\Terminal\Reader
 */
final class ReaderTest extends \PHPUnit\Framework\TestCase
{
    use \Stripe\TestHelper;

    const TEST_RESOURCE_ID = 'rdr_123';

    public function testIsListable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/terminal/readers'
        );
        $resources = Reader::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Stripe\Terminal\Reader::class, $resources->data[0]);
    }

    public function testIsRetrievable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/terminal/readers/' . self::TEST_RESOURCE_ID
        );
        $resource = Reader::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\Terminal\Reader::class, $resource);
    }

    public function testIsSaveable(): void
    {
        $resource = Reader::retrieve(self::TEST_RESOURCE_ID);
        $resource->label = 'new-name';

        $this->expectsRequest(
            'post',
            '/v1/terminal/readers/' . self::TEST_RESOURCE_ID
        );
        $resource->save();
        static::assertInstanceOf(\Stripe\Terminal\Reader::class, $resource);
    }

    public function testIsUpdatable(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/terminal/readers/' . self::TEST_RESOURCE_ID,
            ['label' => 'new-name']
        );
        $resource = Reader::update(self::TEST_RESOURCE_ID, [
            'label' => 'new-name',
        ]);
        static::assertInstanceOf(\Stripe\Terminal\Reader::class, $resource);
    }

    public function testIsCreatable(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/terminal/readers',
            ['registration_code' => 'a-b-c']
        );
        $resource = Reader::create(['registration_code' => 'a-b-c']);
        static::assertInstanceOf(\Stripe\Terminal\Reader::class, $resource);
    }

    public function testIsDeletable(): void
    {
        $resource = Reader::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'delete',
            '/v1/terminal/readers/' . self::TEST_RESOURCE_ID
        );
        $resource->delete();
        static::assertInstanceOf(\Stripe\Terminal\Reader::class, $resource);
    }
}
