<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartProducts extends Model
{
    protected $table = 'cart_products';
    protected $primaryKey = 'id';
    protected $fillable = ['price', 'multiple_price', 'quantity', 'cart_id', 'product_id'];
    use HasFactory;

    public static function merge($cartId, $products)
    {
        $toCreate = [];
        foreach ($products as $product) {
            $toCreate[] = [
                'cart_id' => $cartId,
                'product_id' => $product['id'],
                'price' => $product['price'],
                'multiple_price' => $product['multiple_price'],
                'quantity' => $product['quantity'],
            ];
        }
        return $toCreate;
    }
}
