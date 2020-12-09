<?php

declare(strict_types=1);

namespace Stripe\Util;

/**
 * @internal
 * @covers \Stripe\Util\RequestOptions
 */
final class RequestOptionsTest extends \PHPUnit\Framework\TestCase
{
    use \Stripe\TestHelper;

    public function testParseString(): void
    {
        $opts = RequestOptions::parse('foo');
        static::assertSame('foo', $opts->apiKey);
        static::assertSame([], $opts->headers);
        static::assertNull($opts->apiBase);
    }

    public function testParseStringStrict(): void
    {
        $this->expectException(\Stripe\Exception\InvalidArgumentException::class);
        $this->expectExceptionMessageRegExp('#Do not pass a string for request options.#');

        $opts = RequestOptions::parse('foo', true);
    }

    public function testParseNull(): void
    {
        $opts = RequestOptions::parse(null);
        static::assertNull($opts->apiKey);
        static::assertSame([], $opts->headers);
        static::assertNull($opts->apiBase);
    }

    public function testParseArrayEmpty(): void
    {
        $opts = RequestOptions::parse([]);
        static::assertNull($opts->apiKey);
        static::assertSame([], $opts->headers);
        static::assertNull($opts->apiBase);
    }

    public function testParseArrayWithAPIKey(): void
    {
        $opts = RequestOptions::parse(
            [
                'api_key' => 'foo',
            ]
        );
        static::assertSame('foo', $opts->apiKey);
        static::assertSame([], $opts->headers);
        static::assertNull($opts->apiBase);
    }

    public function testParseArrayWithIdempotencyKey(): void
    {
        $opts = RequestOptions::parse(
            [
                'idempotency_key' => 'foo',
            ]
        );
        static::assertNull($opts->apiKey);
        static::assertSame(['Idempotency-Key' => 'foo'], $opts->headers);
        static::assertNull($opts->apiBase);
    }

    public function testParseArrayWithAPIKeyAndIdempotencyKey(): void
    {
        $opts = RequestOptions::parse(
            [
                'api_key' => 'foo',
                'idempotency_key' => 'foo',
            ]
        );
        static::assertSame('foo', $opts->apiKey);
        static::assertSame(['Idempotency-Key' => 'foo'], $opts->headers);
        static::assertNull($opts->apiBase);
    }

    public function testParseArrayWithAPIKeyAndUnexpectedKeys(): void
    {
        $opts = RequestOptions::parse(
            [
                'api_key' => 'foo',
                'foo' => 'bar',
            ]
        );
        static::assertSame('foo', $opts->apiKey);
        static::assertSame([], $opts->headers);
        static::assertNull($opts->apiBase);
    }

    public function testParseArrayWithAPIKeyAndUnexpectedKeysStrict(): void
    {
        $this->expectException(\Stripe\Exception\InvalidArgumentException::class);
        $this->expectExceptionMessage('Got unexpected keys in options array: foo');

        $opts = RequestOptions::parse(
            [
                'api_key' => 'foo',
                'foo' => 'bar',
            ],
            true
        );
    }

    public function testParseArrayWithAPIBase(): void
    {
        $opts = RequestOptions::parse(
            [
                'api_base' => 'https://example.com',
            ]
        );
        static::assertNull($opts->apiKey);
        static::assertSame([], $opts->headers);
        static::assertSame('https://example.com', $opts->apiBase);
    }

    public function testParseWrongType(): void
    {
        $this->expectException(\Stripe\Exception\InvalidArgumentException::class);

        $opts = RequestOptions::parse(5);
    }

    public function testMerge(): void
    {
        $baseOpts = RequestOptions::parse(
            [
                'api_key' => 'foo',
                'idempotency_key' => 'foo',
            ]
        );
        $opts = $baseOpts->merge(
            [
                'idempotency_key' => 'bar',
            ]
        );
        static::assertSame('foo', $opts->apiKey);
        static::assertSame(['Idempotency-Key' => 'bar'], $opts->headers);
        static::assertNull($opts->apiBase);
    }

    public function testDiscardNonPersistentHeaders(): void
    {
        $opts = RequestOptions::parse(
            [
                'stripe_account' => 'foo',
                'idempotency_key' => 'foo',
            ]
        );
        $opts->discardNonPersistentHeaders();
        static::assertSame(['Stripe-Account' => 'foo'], $opts->headers);
    }

    public function testDebugInfo(): void
    {
        $opts = RequestOptions::parse(['api_key' => 'sk_test_1234567890abcdefghijklmn']);
        $debugInfo = \print_r($opts, true);
        static::assertContains('[apiKey] => sk_test_********************klmn', $debugInfo);

        $opts = RequestOptions::parse(['api_key' => 'sk_1234567890abcdefghijklmn']);
        $debugInfo = \print_r($opts, true);
        static::assertContains('[apiKey] => sk_********************klmn', $debugInfo);

        $opts = RequestOptions::parse(['api_key' => '1234567890abcdefghijklmn']);
        $debugInfo = \print_r($opts, true);
        static::assertContains('[apiKey] => ********************klmn', $debugInfo);
    }
}
