<?php declare(strict_types=1);

namespace Exceptions;

use App\Exceptions\CheckoutException;
use PHPUnit\Framework\TestCase;

/**
 * Tests for CheckoutException class
 */
final class CheckoutExceptionTest extends TestCase
{
    /**
     * Test that CheckoutException behaves as expected
     *
     * @return void
     * @throws \App\Exceptions\CheckoutException
     */
    public function testCheckoutExceptionThrow(): void
    {
        $this->expectException(CheckoutException::class);
        $this->expectExceptionMessage('Some error message');

        throw new CheckoutException('Some error message');
    }
}