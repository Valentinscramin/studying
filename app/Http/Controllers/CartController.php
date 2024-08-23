<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try {
            return response()->json(['message' => 'success'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $cart = new Cart(['user_id' => Auth::id()]);
            $cart->save();
            $toCreate = CartProducts::merge($cart->id, $request->products);
            CartProducts::insert($toCreate);

            return redirect()->back()->with('message', 'Pedido realizado :)');
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }
}
