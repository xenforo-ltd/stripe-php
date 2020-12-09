<?php

declare(strict_types=1);

namespace Stripe\Issuing;

/**
 * @internal
 * @covers \Stripe\Issuing\Dispute
 */
final class DisputeTest extends \PHPUnit\Framework\TestCase
{
    use \Stripe\TestHelper;

    const TEST_RESOURCE_ID = 'idp_123';

    public function testIsCreatable(): void
    {
        $params = [
            'transaction' => 'ipi_123',
        ];

        $this->expectsRequest(
            'post',
            '/v1/issuing/disputes',
            $params
        );
        $resource = Dispute::create($params);
        static::assertInstanceOf(\Stripe\Issuing\Dispute::class, $resource);
    }

    public function testIsListable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/issuing/disputes'
        );
        $resources = Dispute::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Stripe\Issuing\Dispute::class, $resources->data[0]);
    }

    public function testIsRetrievable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/issuing/disputes/' . self::TEST_RESOURCE_ID
        );
        $resource = Dispute::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\Issuing\Dispute::class, $resource);
    }

    public function testIsUpdatable(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/issuing/disputes/' . self::TEST_RESOURCE_ID,
            []
        );
        $resource = Dispute::update(self::TEST_RESOURCE_ID, []);
        static::assertInstanceOf(\Stripe\Issuing\Dispute::class, $resource);
    }

    public function testIsSubmittable(): void
    {
        $resource = Dispute::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'post',
            '/v1/issuing/disputes/' . self::TEST_RESOURCE_ID . '/submit'
        );
        $resource->submit();
        static::assertInstanceOf(\Stripe\Issuing\Dispute::class, $resource);
    }
}
