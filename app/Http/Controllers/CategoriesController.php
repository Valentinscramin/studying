<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriesRequest;
use App\Models\Categories;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoriesController extends Controller
{
    public function index()
    {
        return Inertia::render('DashBoard/Categories/Home', ['categories' => Categories::paginate(10)]);
    }

    public function store(CategoriesRequest $categoriesRequest)
    {
        Categories::create([
            'name' => $categoriesRequest->name,
            'active' => $categoriesRequest->active,
        ]);
        return redirect()->to('/categories')->with('message', 'Categoria Criado Com Sucesso!');
    }

    public function update(CategoriesRequest $categoriesRequest, Categories $category)
    {

        $category->update([
            'name' => $categoriesRequest->name,
            'active' => $categoriesRequest->active,
        ]);

        return redirect()->to('/categories')->with('message', 'Categoria Atualizado Com Sucesso!');
    }

    public function create()
    {
        return Inertia::render('DashBoard/Categories/Create');
    }

    public function edit(Categories $category)
    {
        return Inertia::render('DashBoard/Categories/Edit', [
            'categorie' => $category,
        ]);
    }
}
