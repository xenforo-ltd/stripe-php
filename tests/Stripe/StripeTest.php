<?php

declare(strict_types=1);

namespace Stripe;

/**
 * @internal
 * @covers \Stripe\Stripe
 */
final class StripeTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    /** @var array */
    protected $orig;

    /**
     * @before
     */
    public function saveOriginalValues(): void
    {
        $this->orig = [
            'caBundlePath' => Stripe::$caBundlePath,
        ];
    }

    /**
     * @after
     */
    public function restoreOriginalValues(): void
    {
        Stripe::$caBundlePath = $this->orig['caBundlePath'];
    }

    public function testCABundlePathAccessors(): void
    {
        Stripe::setCABundlePath('path/to/ca/bundle');
        static::assertSame('path/to/ca/bundle', Stripe::getCABundlePath());
    }
}
