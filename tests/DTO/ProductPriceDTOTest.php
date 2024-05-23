<?php declare(strict_types=1);

namespace DTO;

use PHPUnit\Framework\TestCase;
use App\DTO\ProductPriceDTO;

/**
 * Tests for ProductPriceDTO class
 */
class ProductPriceDTOTest extends TestCase
{
    public function testGetters()
    {
        $product_price = new ProductPriceDTO(123, 'PO1');

        $this->assertEquals(123, $product_price->getPrice());
        $this->assertEquals('PO1', $product_price->getProductCode());
    }
}
