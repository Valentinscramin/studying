<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsRequest;
use App\Models\Products;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('DashBoard/Product/Home', [
            'products' => Products::paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('DashBoard/Product/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductsRequest $productsRequest)
    {
        Products::create([
            'name' => $productsRequest->name,
            'description' => $productsRequest->description,
            'price' => $productsRequest->price,
        ]);

        return redirect()->to('/products')->with('message', 'Produto Criado Com Sucesso!');
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
    public function edit(Products $product)
    {
        return Inertia::render('DashBoard/Product/Edit', [
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductsRequest $productsRequest, Products $product)
    {
        $product->update([
            'name' => $productsRequest->name,
            'description' => $productsRequest->description,
            'price' => $productsRequest->price,
        ]);

        return redirect()->to('/products')->with('message', 'Produto Atualizado Com Sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $product)
    {
        $product->delete();
        return redirect()
            ->to('/products')
            ->with('message', 'O produto: ' . $product->name . ' foi excluido com sucesso!');
    }
}
