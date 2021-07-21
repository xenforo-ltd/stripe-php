<?php

namespace Stripe;

/**
 * @internal
 * @covers \Stripe\Charge
 */
final class ChargeTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'ch_123';

    public function testIsListable()
    {
        $this->expectsRequest(
            'get',
            '/v1/charges'
        );
        $resources = Charge::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Stripe\Charge::class, $resources->data[0]);
    }

    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/v1/charges/' . self::TEST_RESOURCE_ID
        );
        $resource = Charge::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\Charge::class, $resource);
    }

    public function testIsCreatable()
    {
        $this->expectsRequest(
            'post',
            '/v1/charges'
        );
        $resource = Charge::create([
            'amount' => 100,
            'currency' => 'usd',
            'source' => 'tok_123',
        ]);
        static::assertInstanceOf(\Stripe\Charge::class, $resource);
    }

    public function testIsSaveable()
    {
        $resource = Charge::retrieve(self::TEST_RESOURCE_ID);
        $resource->metadata['key'] = 'value';
        $this->expectsRequest(
            'post',
            '/v1/charges/' . $resource->id
        );
        $resource->save();
        static::assertInstanceOf(\Stripe\Charge::class, $resource);
    }

    public function testIsUpdatable()
    {
        $this->expectsRequest(
            'post',
            '/v1/charges/' . self::TEST_RESOURCE_ID
        );
        $resource = Charge::update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Stripe\Charge::class, $resource);
    }

    public function testCanCapture()
    {
        $charge = Charge::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'post',
            '/v1/charges/' . $charge->id . '/capture'
        );
        $resource = $charge->capture();
        static::assertInstanceOf(\Stripe\Charge::class, $resource);
        static::assertSame($resource, $charge);
    }

    public function testIsSearchable()
    {
        $this->expectsRequest(
            'get',
            '/v1/search/charges'
        );
        $resource = Charge::search([
            'query' => 'metadata["foo"]:"bar"',
            'limit' => 3
        ]);
        static::assertInstanceOf(\Stripe\SearchResult::class, $resource);
        static::assertInternalType('array', $resource->data);
        static::assertInstanceOf(\Stripe\Charge::class, $resource->data[0]);
    }
}
