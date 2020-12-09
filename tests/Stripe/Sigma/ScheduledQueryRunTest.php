<?php

declare(strict_types=1);

namespace Stripe\Sigma;

/**
 * @internal
 * @covers \Stripe\Sigma\ScheduledQueryRun
 */
final class ScheduledQueryRunTest extends \PHPUnit\Framework\TestCase
{
    use \Stripe\TestHelper;

    const TEST_RESOURCE_ID = 'sqr_123';

    public function testIsListable(): void
    {
        $resources = ScheduledQueryRun::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Stripe\Sigma\ScheduledQueryRun::class, $resources->data[0]);
    }

    public function testIsRetrievable(): void
    {
        $resource = ScheduledQueryRun::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\Sigma\ScheduledQueryRun::class, $resource);
    }
}
