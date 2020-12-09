<?php

declare(strict_types=1);

namespace Stripe\Radar;

/**
 * @internal
 * @covers \Stripe\Radar\ValueList
 */
final class ValueListTest extends \PHPUnit\Framework\TestCase
{
    use \Stripe\TestHelper;

    const TEST_RESOURCE_ID = 'rsl_123';

    public function testIsListable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/radar/value_lists'
        );
        $resources = ValueList::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Stripe\Radar\ValueList::class, $resources->data[0]);
    }

    public function testIsRetrievable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/radar/value_lists/' . self::TEST_RESOURCE_ID
        );
        $resource = ValueList::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\Radar\ValueList::class, $resource);
    }

    public function testIsCreatable(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/radar/value_lists'
        );
        $resource = ValueList::create([
            'alias' => 'alias',
            'name' => 'name',
        ]);
        static::assertInstanceOf(\Stripe\Radar\ValueList::class, $resource);
    }

    public function testIsSaveable(): void
    {
        $resource = ValueList::retrieve(self::TEST_RESOURCE_ID);
        $resource->metadata['key'] = 'value';
        $this->expectsRequest(
            'post',
            '/v1/radar/value_lists/' . self::TEST_RESOURCE_ID
        );
        $resource->save();
        static::assertInstanceOf(\Stripe\Radar\ValueList::class, $resource);
    }

    public function testIsUpdatable(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/radar/value_lists/' . self::TEST_RESOURCE_ID
        );
        $resource = ValueList::update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Stripe\Radar\ValueList::class, $resource);
    }

    public function testIsDeletable(): void
    {
        $resource = ValueList::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'delete',
            '/v1/radar/value_lists/' . self::TEST_RESOURCE_ID
        );
        $resource->delete();
        static::assertInstanceOf(\Stripe\Radar\ValueList::class, $resource);
    }
}
