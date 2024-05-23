<?php

namespace App\DTO;

/**
 * Describes a special offer price
 */
class ProductOfferPriceDTO extends ProductPriceDTO
{
    /**
     * @var int
     */
    private int $quantity;

    /**
     * @param float $price
     * @param string $product_code
     * @param int $quantity
     */
    public function __construct(float $price, string $product_code, int $quantity)
    {
        parent::__construct($price, $product_code);
        $this->quantity = $quantity;
    }

    /**
     * @return float
     */
    public function getQuantity(): float
    {
        return $this->quantity;
    }
}