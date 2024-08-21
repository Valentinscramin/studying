<?php

namespace Tests\Unit;

use Mockery;
use PHPUnit\Framework\TestCase;

class CartProductsTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_cart_products_create()
    {
        $cart_products = Mockery::mock('alias:App\Models\CartProducts');
        $cart_products
            ->shouldReceive('create')
            ->with([
                'price' => '100.00',
                'multiple_price' => '100.00',
                'quantity' => 1,
                'cart_id' => 1,
                'product_id' => 1
            ])
            ->andReturn(true);

        $result = $cart_products->create(['price' => '100.00', 'multiple_price' => '100.00', 'quantity' => 1, 'cart_id' => 1, 'product_id' => 1]);

        $this->assertTrue($result);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
