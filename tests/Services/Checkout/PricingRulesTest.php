<?php declare(strict_types=1);

namespace Services\Checkout;

use App\DTO\ProductOfferPriceDTO;
use App\DTO\ProductPriceDTO;
use App\Exceptions\CheckoutException;
use App\Services\Checkout\PricingRules;
use PHPUnit\Framework\TestCase;

/**
 * Various tests for PricingRules class
 */
final class PricingRulesTest extends TestCase
{
    /**
     * Helper function to generate a PricingRules object
     */
    private function getPricingRules(): PricingRules
    {
        $pricing_rules_obj = new PricingRules();
        $pricing_rules_obj->addPrice(new ProductPriceDTO(123, 'PO1'));

        $pricing_rules_obj->addOffer(new ProductOfferPriceDTO(
            120, 'PO1', 2
        ));

        return $pricing_rules_obj;
    }

    /**
     * @return void
     */
    public function testGetters(): void
    {
        $pricing_rules = $this->getPricingRules();

        $this->assertEquals(123, $pricing_rules->getPrices()[0]->getPrice());
        $this->assertEquals('PO1', $pricing_rules->getPrices()[0]->getProductCode());
        $this->assertEquals('PO1', $pricing_rules->getOffers()[0]->getProductCode());
        $this->assertEquals(120, $pricing_rules->getOffers()[0]->getPrice());
        $this->assertEquals(2, $pricing_rules->getOffers()[0]->getQuantity());
    }

    /**
     * @return void
     * @throws CheckoutException
     */
    public function testGetProductPriceReturnsExpectedValue(): void
    {
        $pricing_rules = $this->getPricingRules();

        $this->assertEquals(123, $pricing_rules->getProductPrice('PO1'));
    }

    /**
     * @return void
     * @throws CheckoutException
     */
    public function testGetProductPriceThrowsException(): void
    {
        $this->expectException(CheckoutException::class);

        $pricing_rules = $this->getPricingRules();
        $pricing_rules->getProductPrice('bla');
    }
}
