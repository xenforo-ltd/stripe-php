<?php

declare(strict_types=1);

namespace Stripe;

/**
 * @internal
 * @covers \Stripe\CreditNote
 */
final class CreditNoteTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'cn_123';

    public function testIsListable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/credit_notes'
        );
        $resources = CreditNote::all();
        static::assertIsArray($resources->data);
        static::assertInstanceOf(\Stripe\CreditNote::class, $resources->data[0]);
    }

    public function testIsRetrievable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/credit_notes/' . self::TEST_RESOURCE_ID
        );
        $resource = CreditNote::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\CreditNote::class, $resource);
    }

    public function testIsCreatable(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/credit_notes'
        );
        $resource = CreditNote::create([
            'amount' => 100,
            'invoice' => 'in_132',
            'reason' => 'duplicate',
        ]);
        static::assertInstanceOf(\Stripe\CreditNote::class, $resource);
    }

    public function testIsSaveable(): void
    {
        $resource = CreditNote::retrieve(self::TEST_RESOURCE_ID);
        $resource->metadata['key'] = 'value';
        $this->expectsRequest(
            'post',
            '/v1/credit_notes/' . $resource->id
        );
        $resource->save();
        static::assertInstanceOf(\Stripe\CreditNote::class, $resource);
    }

    public function testIsUpdatable(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/credit_notes/' . self::TEST_RESOURCE_ID
        );
        $resource = CreditNote::update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Stripe\CreditNote::class, $resource);
    }

    public function testCanPreview(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/credit_notes/preview'
        );
        $resource = CreditNote::preview([
            'amount' => 100,
            'invoice' => 'in_123',
        ]);
        static::assertInstanceOf(\Stripe\CreditNote::class, $resource);
    }

    public function testCanVoidCreditNote(): void
    {
        $creditNote = CreditNote::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'post',
            '/v1/credit_notes/' . $creditNote->id . '/void'
        );
        $resource = $creditNote->voidCreditNote();
        static::assertInstanceOf(\Stripe\CreditNote::class, $resource);
        static::assertSame($resource, $creditNote);
    }

    public function testCanListLines(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/credit_notes/' . self::TEST_RESOURCE_ID . '/lines'
        );
        $resources = CreditNote::allLines(self::TEST_RESOURCE_ID);
        static::assertIsArray($resources->data);
    }
}
