<?php

declare(strict_types=1);

namespace Stripe\Service\Issuing;

/**
 * @internal
 * @covers \Stripe\Service\Issuing\AuthorizationService
 */
final class AuthorizationServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Stripe\TestHelper;

    const TEST_RESOURCE_ID = 'iauth_123';

    /** @var \Stripe\StripeClient */
    private $client;

    /** @var AuthorizationService */
    private $service;

    /**
     * @before
     */
    protected function setUpService(): void
    {
        $this->client = new \Stripe\StripeClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new AuthorizationService($this->client);
    }

    public function testAll(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/issuing/authorizations'
        );
        $resources = $this->service->all();
        static::assertIsArray($resources->data);
        static::assertInstanceOf(\Stripe\Issuing\Authorization::class, $resources->data[0]);
    }

    public function testApprove(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/issuing/authorizations/' . self::TEST_RESOURCE_ID . '/approve'
        );
        $resource = $this->service->approve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\Issuing\Authorization::class, $resource);
    }

    public function testDecline(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/issuing/authorizations/' . self::TEST_RESOURCE_ID . '/decline'
        );
        $resource = $this->service->decline(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\Issuing\Authorization::class, $resource);
    }

    public function testRetrieve(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/issuing/authorizations/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\Issuing\Authorization::class, $resource);
    }

    public function testUpdate(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/issuing/authorizations/' . self::TEST_RESOURCE_ID,
            ['metadata' => ['key' => 'value']]
        );
        $resource = $this->service->update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Stripe\Issuing\Authorization::class, $resource);
    }
}
