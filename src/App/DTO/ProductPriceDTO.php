<?php

namespace App\DTO;

/**
 * Describes a product price
 */
class ProductPriceDTO
{
    /**
     * @var float
     */
    private float $price;

    /**
     * @var string
     */
    private string $product_code;

    /**
     * @param float $price
     * @param string $product_code
     */
    public function __construct(float $price, string $product_code)
    {
        $this->price = $price;
        $this->product_code = $product_code;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getProductCode(): string
    {
        return $this->product_code;
    }
}