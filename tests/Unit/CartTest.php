<?php

namespace Tests\Unit;

use App\Models\Cart;
use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;

class CartTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function test_cart_create()
    {
        $cart = Mockery::mock('alias:App\Models\Cart');
        $cart
            ->shouldReceive('create')
            ->with(['user_id' => 1])
            ->andReturn(true);

        $result = $cart->create(['user_id' => 1]);

        $this->assertTrue($result);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
