<?php declare(strict_types=1);

namespace DTO;

use PHPUnit\Framework\TestCase;
use App\DTO\ProductOfferPriceDTO;

/**
 * Tests for ProductPriceDTO class
 */
class ProductOfferPriceDTOTest extends TestCase
{
    /**
     * @return void
     */
    public function testGetters()
    {
        $product_offer_price = new ProductOfferPriceDTO(120, 'PO1', 3);

        $this->assertEquals(120, $product_offer_price->getPrice());
        $this->assertEquals('PO1', $product_offer_price->getProductCode());
        $this->assertEquals(3, $product_offer_price->getQuantity());
    }
}
