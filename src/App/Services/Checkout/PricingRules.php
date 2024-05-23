<?php

namespace App\Services\Checkout;

use App\DTO\ProductOfferPriceDTO;
use App\DTO\ProductPriceDTO;
use App\Exceptions\CheckoutException;

class PricingRules
{
    /**
     * @var ProductPriceDTO[]
     */
    private array $prices = [];

    /**
     * @var ProductOfferPriceDTO[]
     */
    private array $offers = [];

    /**
     * @param ProductPriceDTO $price
     * @return void
     */
    public function addPrice(ProductPriceDTO $price): void
    {
        $this->prices[] = $price;
    }

    /**
     * @param ProductOfferPriceDTO $offer
     * @return void
     */
    public function addOffer(ProductOfferPriceDTO $offer): void
    {
        $this->offers[] = $offer;
    }

    /**
     * @return ProductPriceDTO[]
     */
    public function getPrices(): array
    {
        return $this->prices;
    }

    /**
     * @return ProductOfferPriceDTO[]
     */
    public function getOffers(): array
    {
        return $this->offers;
    }

    /**
     * @param string $product_code
     * @return float
     * @throws CheckoutException
     */
    public function getProductPrice(string $product_code): float
    {
        foreach ($this->prices as $price) {
            if ($price->getProductCode() === $product_code) {
                return $price->getPrice();
            }
        }

        throw new CheckoutException("Cannot find product price for $product_code");
    }
}