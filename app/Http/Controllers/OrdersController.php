<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrdersController extends Controller
{
    public function index()
    {
        // dd(Cart::with(['cart_products'])->paginate(15));
        return Inertia::render('DashBoard/Orders/Home', ['orders' => Cart::with(['cart_products', 'user', 'cart_products.products'])->paginate(15)]);
    }
}
