<?php declare(strict_types=1);

namespace Services;

use App\DTO\ProductOfferPriceDTO;
use App\DTO\ProductPriceDTO;
use App\Exceptions\CheckoutException;
use App\Services\Checkout;
use App\Services\Checkout\PricingRules;
use PHPUnit\Framework\TestCase;

/**
 * Various tests for Checkout class
 */
final class CheckoutTest extends TestCase
{
    /**
     * @var array
     */
    private $pricing_rules = [
        'prices' => [
            'FR1' => 3.11,
            'SR1' => 5,
            'CF1' => 11.23,
        ],
        'offers' => [
            //fruit tea is buy one get one free, basically half price if there's two
            'FR1' => [
                'quantity' => 2,
                'updated_price' => 3.11 / 2
            ],
            //strawberry bulk rule, buy 3 price drops to £4.50
            'SR1' => [
                'quantity' => 3,
                'updated_price' => 4.5
            ]
        ]
    ];

    /**
     * Data provider function for below test
     *
     * @return array[]
     */
    public function dataProvider(): array
    {
        return [
            [['FR1', 'SR1', 'FR1', 'FR1', 'CF1'], 22.45],
            [['FR1', 'FR1'], 3.11],
            [['SR1', 'SR1', 'FR1', 'SR1'], 16.61],
            //the below is also an interesting test because we have 2 special offers in the same basket
            [['FR1', 'FR1', 'FR1', 'FR1'], 6.22]
        ];
    }

    /**
     * Helper function to generate a Checkout object
     */
    private function getCheckout(array $pricing_rules = [])
    {
        $pricing_rules_obj = new PricingRules();

        foreach ($pricing_rules['prices'] as $product_code => $price) {
            $pricing_rules_obj->addPrice(new ProductPriceDTO($price, $product_code));
        }

        if (isset($pricing_rules['offers'])) {
            foreach ($pricing_rules['offers'] as $product_code => $details) {
                $pricing_rules_obj->addOffer(new ProductOfferPriceDTO(
                    $details['updated_price'], $product_code, $details['quantity']
                ));
            }
        }

        return new Checkout($pricing_rules_obj);
    }

    /**
     * Comprehensive test checking total price is correctly calculated for various scenarios
     *
     * @param $basket
     * @param $expectedTotal
     * @return void
     * @throws \App\Exceptions\CheckoutException
     *
     * @dataProvider dataProvider
     *
     */
    public function testCheckoutCalculatesCorrectTotals($basket, $expectedTotal): void
    {
        $checkout = $this->getCheckout($this->pricing_rules);

        foreach ($basket as $item) {
            $checkout->scan($item);
        }

        $this->assertEquals($expectedTotal, $checkout->total);
    }

    /**
     * Check that expected exception is thrown if we have no default prices
     *
     * @return void
     * @throws \App\Exceptions\CheckoutException
     */
    public function testCheckoutExceptionNoDefaultPrices(): void
    {
        $this->expectException(CheckoutException::class);
        $this->expectExceptionMessage('No default prices found in price list');

        new Checkout(new PricingRules());
    }

    /**
     * Check that expected exception is thrown if product has no default price
     *
     * @return void
     * @throws \App\Exceptions\CheckoutException
     */
    public function testCheckoutExceptionNoProductPrice(): void
    {
        $this->expectException(CheckoutException::class);
        $this->expectExceptionMessage('Cannot find product price for SR1');

        $checkout = $this->getCheckout(
            [
                'prices' => [
                    'FR1' => 3.11,
                    //'SR1' => 5,
                    'CF1' => 11.23,
                ]
            ]
        );

        $checkout->scan('SR1');
    }
}