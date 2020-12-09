<?php

declare(strict_types=1);

namespace Stripe\Service;

/**
 * @internal
 * @covers \Stripe\Service\SetupIntentService
 */
final class SetupIntentServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Stripe\TestHelper;

    const TEST_RESOURCE_ID = 'seti_123';

    /** @var \Stripe\StripeClient */
    private $client;

    /** @var SetupIntentService */
    private $service;

    /**
     * @before
     */
    protected function setUpService(): void
    {
        $this->client = new \Stripe\StripeClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new SetupIntentService($this->client);
    }

    public function testAll(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/setup_intents'
        );
        $resources = $this->service->all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Stripe\SetupIntent::class, $resources->data[0]);
    }

    public function testCancel(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/setup_intents/' . self::TEST_RESOURCE_ID . '/cancel'
        );
        $resource = $this->service->cancel(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\SetupIntent::class, $resource);
    }

    public function testConfirm(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/setup_intents/' . self::TEST_RESOURCE_ID . '/confirm'
        );
        $resource = $this->service->confirm(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\SetupIntent::class, $resource);
    }

    public function testCreate(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/setup_intents'
        );
        $resource = $this->service->create([
            'payment_method_types' => ['card'],
        ]);
        static::assertInstanceOf(\Stripe\SetupIntent::class, $resource);
    }

    public function testRetrieve(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/setup_intents/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\SetupIntent::class, $resource);
    }

    public function testUpdate(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/setup_intents/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->update(
            self::TEST_RESOURCE_ID,
            [
                'metadata' => ['key' => 'value'],
            ]
        );
        static::assertInstanceOf(\Stripe\SetupIntent::class, $resource);
    }
}
