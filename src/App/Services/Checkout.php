<?php

namespace App\Services;

use App\Exceptions\CheckoutException;
use App\Services\Checkout\PricingRules;


/**
 * Class used for Checkout and total price calculation
 */
class Checkout {
    /**
     * @var PricingRules
     */
    private PricingRules $pricing_rules;

    /**
     * Total basket price
     *
     * @var float
     */
    public float $total;

    /**
     * Internal basket items with quantities ( Product_code => Quantity )
     *
     * Example structure:
     * [
     *  [SR1] => 3
     *  [FR1] => 1
     * ]
     *
     * @var array
     */
    private array $basket = [];

    /**
     * @param PricingRules $pricing_rules
     * @throws CheckoutException
     */
    public function __construct(PricingRules $pricing_rules) {
        if (count($pricing_rules->getPrices()) == 0) {
            throw new CheckoutException('No default prices found in price list');
        }

        $this->pricing_rules = $pricing_rules;
    }

    /**
     * "Scans" and item by adding it to the internal "basket" and updates the total price
     *
     * @param $item
     * @return void
     * @throws CheckoutException
     */
    public function scan($item)
    {
        if (array_key_exists($item, $this->basket)) {
            $this->basket[$item]++;
        } else {
            $this->basket[$item] = 1;
        }

        $this->total = 0;

        $this->addProductsWithOffersToTotal();
        $this->addProductsWithoutOffersToTotal();
    }

    /**
     * Go through the special offers and the products with offers to the total price
     *
     * @return void
     * @throws CheckoutException
     */
    private function addProductsWithOffersToTotal(): void
    {
        if (count($this->pricing_rules->getOffers()) == 0) {
            return;
        }

        //handle products that have special offers
        foreach ($this->pricing_rules->getOffers() as $offerPrice) {
            if (isset($this->basket[$offerPrice->getProductCode()])) {
                //find items that match special offers and add them to total
                $rule_matches_count = intdiv($this->basket[$offerPrice->getProductCode()], $offerPrice->getQuantity());
                if ($rule_matches_count > 0) {
                    //add item to total with special price
                    $this->total += $rule_matches_count * $offerPrice->getQuantity() * $offerPrice->getPrice();
                }

                //find items that fall short of special offer rules and add them to total
                $rule_unmatched_count = fmod($this->basket[$offerPrice->getProductCode()], $offerPrice->getQuantity());
                //add price to total
                $this->total += $rule_unmatched_count * $this->pricing_rules->getProductPrice($offerPrice->getProductCode());
            }
        }
    }

    /**
     * Add products that don't have special offers to total price
     *
     * @return void
     * @throws CheckoutException
     */
    private function addProductsWithoutOffersToTotal(): void
    {
        //get keys of items with special offers, so we can ignore them
        $products_with_offers = [];

        foreach ($this->pricing_rules->getOffers() as $offerPrice) {
            $products_with_offers[] = $offerPrice->getProductCode();
        }

        //find item prices for products that don't have special offers
        foreach ($this->basket as $product_code => $quantity) {
            if (!in_array($product_code, $products_with_offers)) {
                //add price to total
                $this->total += $this->basket[$product_code] * $this->pricing_rules->getProductPrice($product_code);
            }
        }
    }
}
