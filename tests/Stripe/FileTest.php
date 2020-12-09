<?php

declare(strict_types=1);

namespace Stripe;

/**
 * @internal
 * @covers \Stripe\File
 */
final class FileTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'file_123';

    public function testIsListable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/files'
        );
        $resources = File::all();
        static::assertIsArray($resources->data);
        static::assertInstanceOf(\Stripe\File::class, $resources->data[0]);
    }

    public function testIsRetrievable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/files/' . self::TEST_RESOURCE_ID
        );
        $resource = File::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\File::class, $resource);
    }

    public function testDeserializesFromFile(): void
    {
        $obj = Util\Util::convertToStripeObject([
            'object' => 'file',
        ], null);
        static::assertInstanceOf(\Stripe\File::class, $obj);
    }

    public function testDeserializesFromFileUpload(): void
    {
        $obj = Util\Util::convertToStripeObject([
            'object' => 'file_upload',
        ], null);
        static::assertInstanceOf(\Stripe\File::class, $obj);
    }
}
