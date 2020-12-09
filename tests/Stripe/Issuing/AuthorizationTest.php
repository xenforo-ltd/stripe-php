<?php

declare(strict_types=1);

namespace Stripe\Issuing;

/**
 * @internal
 * @covers \Stripe\Issuing\Authorization
 */
final class AuthorizationTest extends \PHPUnit\Framework\TestCase
{
    use \Stripe\TestHelper;

    const TEST_RESOURCE_ID = 'iauth_123';

    public function testIsListable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/issuing/authorizations'
        );
        $resources = Authorization::all();
        static::assertIsArray($resources->data);
        static::assertInstanceOf(\Stripe\Issuing\Authorization::class, $resources->data[0]);
    }

    public function testIsRetrievable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/issuing/authorizations/' . self::TEST_RESOURCE_ID
        );
        $resource = Authorization::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\Issuing\Authorization::class, $resource);
    }

    public function testIsSaveable(): void
    {
        $resource = Authorization::retrieve(self::TEST_RESOURCE_ID);
        $resource->metadata['key'] = 'value';

        $this->expectsRequest(
            'post',
            '/v1/issuing/authorizations/' . self::TEST_RESOURCE_ID
        );
        $resource->save();
        static::assertInstanceOf(\Stripe\Issuing\Authorization::class, $resource);
    }

    public function testIsUpdatable(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/issuing/authorizations/' . self::TEST_RESOURCE_ID,
            ['metadata' => ['key' => 'value']]
        );
        $resource = Authorization::update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Stripe\Issuing\Authorization::class, $resource);
    }

    public function testIsApprovable(): void
    {
        $resource = Authorization::retrieve(self::TEST_RESOURCE_ID);

        $this->expectsRequest(
            'post',
            '/v1/issuing/authorizations/' . self::TEST_RESOURCE_ID . '/approve'
        );
        $resource = $resource->approve();
        static::assertInstanceOf(\Stripe\Issuing\Authorization::class, $resource);
    }

    public function testIsDeclinable(): void
    {
        $resource = Authorization::retrieve(self::TEST_RESOURCE_ID);

        $this->expectsRequest(
            'post',
            '/v1/issuing/authorizations/' . self::TEST_RESOURCE_ID . '/decline'
        );
        $resource = $resource->decline();
        static::assertInstanceOf(\Stripe\Issuing\Authorization::class, $resource);
    }
}
