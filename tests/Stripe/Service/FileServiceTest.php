<?php

declare(strict_types=1);

namespace Stripe\Service;

/**
 * @internal
 * @covers \Stripe\Service\FileService
 */
final class FileServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Stripe\TestHelper;

    const TEST_RESOURCE_ID = 'file_123';

    /** @var \Stripe\StripeClient */
    private $client;

    /** @var FileService */
    private $service;

    /**
     * @before
     */
    protected function setUpService(): void
    {
        $this->client = new \Stripe\StripeClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new FileService($this->client);
    }

    public function testAll(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/files'
        );
        $resources = $this->service->all();
        static::assertIsArray($resources->data);
        static::assertInstanceOf(\Stripe\File::class, $resources->data[0]);
    }

    public function testCreateWithCURLFile(): void
    {
        $client = new \Stripe\StripeClient(['api_key' => 'sk_test_123', 'files_base' => MOCK_URL]);
        $service = new FileService($client);

        $this->expectsRequest(
            'post',
            '/v1/files',
            null,
            ['Content-Type: multipart/form-data'],
            true,
            MOCK_URL
        );
        $curlFile = new \CURLFile(__DIR__ . '/../../data/test.png');
        $resource = $service->create([
            'purpose' => 'dispute_evidence',
            'file' => $curlFile,
            'file_link_data' => ['create' => true],
        ]);
        static::assertInstanceOf(\Stripe\File::class, $resource);
    }

    public function testCreateWithFileHandle(): void
    {
        $client = new \Stripe\StripeClient(['api_key' => 'sk_test_123', 'files_base' => MOCK_URL]);
        $service = new FileService($client);

        $this->expectsRequest(
            'post',
            '/v1/files',
            null,
            ['Content-Type: multipart/form-data'],
            true,
            MOCK_URL
        );
        $fp = \fopen(__DIR__ . '/../../data/test.png', 'rb');
        $resource = $service->create([
            'purpose' => 'dispute_evidence',
            'file' => $fp,
            'file_link_data' => ['create' => true],
        ]);
        static::assertInstanceOf(\Stripe\File::class, $resource);
    }

    public function testRetrieve(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/files/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\File::class, $resource);
    }
}
