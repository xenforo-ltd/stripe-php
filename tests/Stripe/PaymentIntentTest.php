<?php

declare(strict_types=1);

namespace Stripe;

/**
 * @internal
 * @covers \Stripe\PaymentIntent
 */
final class PaymentIntentTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'pi_123';

    public function testIsListable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/payment_intents'
        );
        $resources = PaymentIntent::all();
        static::assertIsArray($resources->data);
        static::assertInstanceOf(\Stripe\PaymentIntent::class, $resources->data[0]);
    }

    public function testIsRetrievable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/payment_intents/' . self::TEST_RESOURCE_ID
        );
        $resource = PaymentIntent::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\PaymentIntent::class, $resource);
    }

    public function testIsCreatable(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/payment_intents'
        );
        $resource = PaymentIntent::create([
            'amount' => 100,
            'currency' => 'usd',
            'payment_method_types' => ['card'],
        ]);
        static::assertInstanceOf(\Stripe\PaymentIntent::class, $resource);
    }

    public function testIsSaveable(): void
    {
        $resource = PaymentIntent::retrieve(self::TEST_RESOURCE_ID);
        $resource->metadata['key'] = 'value';
        $this->expectsRequest(
            'post',
            '/v1/payment_intents/' . self::TEST_RESOURCE_ID
        );
        $resource->save();
        static::assertInstanceOf(\Stripe\PaymentIntent::class, $resource);
    }

    public function testIsUpdatable(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/payment_intents/' . self::TEST_RESOURCE_ID
        );
        $resource = PaymentIntent::update(
            self::TEST_RESOURCE_ID,
            [
                'metadata' => ['key' => 'value'],
            ]
        );
        static::assertInstanceOf(\Stripe\PaymentIntent::class, $resource);
    }

    public function testIsCancelable(): void
    {
        $resource = PaymentIntent::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'post',
            '/v1/payment_intents/' . self::TEST_RESOURCE_ID . '/cancel'
        );
        $resource->cancel();
        static::assertInstanceOf(\Stripe\PaymentIntent::class, $resource);
    }

    public function testIsCapturable(): void
    {
        $resource = PaymentIntent::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'post',
            '/v1/payment_intents/' . self::TEST_RESOURCE_ID . '/capture'
        );
        $resource->capture();
        static::assertInstanceOf(\Stripe\PaymentIntent::class, $resource);
    }

    public function testIsConfirmable(): void
    {
        $resource = PaymentIntent::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'post',
            '/v1/payment_intents/' . self::TEST_RESOURCE_ID . '/confirm'
        );
        $resource->confirm();
        static::assertInstanceOf(\Stripe\PaymentIntent::class, $resource);
    }
}
