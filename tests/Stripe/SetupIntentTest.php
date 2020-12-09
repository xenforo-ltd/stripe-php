<?php

declare(strict_types=1);

namespace Stripe;

/**
 * @internal
 * @covers \Stripe\SetupIntent
 */
final class SetupIntentTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'seti_123';

    public function testIsListable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/setup_intents'
        );
        $resources = SetupIntent::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Stripe\SetupIntent::class, $resources->data[0]);
    }

    public function testIsRetrievable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/setup_intents/' . self::TEST_RESOURCE_ID
        );
        $resource = SetupIntent::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\SetupIntent::class, $resource);
    }

    public function testIsCreatable(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/setup_intents'
        );
        $resource = SetupIntent::create([
            'payment_method_types' => ['card'],
        ]);
        static::assertInstanceOf(\Stripe\SetupIntent::class, $resource);
    }

    public function testIsSaveable(): void
    {
        $resource = SetupIntent::retrieve(self::TEST_RESOURCE_ID);
        $resource->metadata['key'] = 'value';
        $this->expectsRequest(
            'post',
            '/v1/setup_intents/' . self::TEST_RESOURCE_ID
        );
        $resource->save();
        static::assertInstanceOf(\Stripe\SetupIntent::class, $resource);
    }

    public function testIsUpdatable(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/setup_intents/' . self::TEST_RESOURCE_ID
        );
        $resource = SetupIntent::update(
            self::TEST_RESOURCE_ID,
            [
                'metadata' => ['key' => 'value'],
            ]
        );
        static::assertInstanceOf(\Stripe\SetupIntent::class, $resource);
    }

    public function testIsCancelable(): void
    {
        $resource = SetupIntent::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'post',
            '/v1/setup_intents/' . self::TEST_RESOURCE_ID . '/cancel'
        );
        $resource->cancel();
        static::assertInstanceOf(\Stripe\SetupIntent::class, $resource);
    }

    public function testIsConfirmable(): void
    {
        $resource = SetupIntent::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'post',
            '/v1/setup_intents/' . self::TEST_RESOURCE_ID . '/confirm'
        );
        $resource->confirm();
        static::assertInstanceOf(\Stripe\SetupIntent::class, $resource);
    }
}
