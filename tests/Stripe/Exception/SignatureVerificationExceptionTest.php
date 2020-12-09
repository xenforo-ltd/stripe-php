<?php

declare(strict_types=1);

namespace Stripe\Exception;

/**
 * @internal
 * @covers \Stripe\Exception\SignatureVerificationException
 */
final class SignatureVerificationExceptionTest extends \PHPUnit\Framework\TestCase
{
    use \Stripe\TestHelper;

    public function testGetters(): void
    {
        $e = SignatureVerificationException::factory('message', 'payload', 'sig_header');
        static::assertSame('message', $e->getMessage());
        static::assertSame('payload', $e->getHttpBody());
        static::assertSame('sig_header', $e->getSigHeader());
    }
}
