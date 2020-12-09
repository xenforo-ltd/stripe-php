<?php

declare(strict_types=1);

namespace Stripe;

/**
 * @internal
 * @covers \Stripe\FileLink
 */
final class FileLinkTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'link_123';

    public function testIsListable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/file_links'
        );
        $resources = FileLink::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Stripe\FileLink::class, $resources->data[0]);
    }

    public function testIsRetrievable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/file_links/' . self::TEST_RESOURCE_ID
        );
        $resource = FileLink::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\FileLink::class, $resource);
    }

    public function testIsCreatable(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/file_links'
        );
        $resource = FileLink::create([
            'file' => 'file_123',
        ]);
        static::assertInstanceOf(\Stripe\FileLink::class, $resource);
    }

    public function testIsSaveable(): void
    {
        $resource = FileLink::retrieve(self::TEST_RESOURCE_ID);
        $resource->metadata['key'] = 'value';
        $this->expectsRequest(
            'post',
            '/v1/file_links/' . $resource->id
        );
        $resource->save();
        static::assertInstanceOf(\Stripe\FileLink::class, $resource);
    }

    public function testIsUpdatable(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/file_links/' . self::TEST_RESOURCE_ID
        );
        $resource = FileLink::update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Stripe\FileLink::class, $resource);
    }
}
