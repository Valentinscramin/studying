<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Http\Request;
use Inertia\Inertia;

class SiteController extends Controller
{
    public function index()
    {
        return Inertia::render('Site/Home', ['logged' => Auth::check()]);
    }

    public function shop()
    {
        return Inertia::render('Site/Shop', ['categories' => Categories::where('active', 1)->get(), 'logged' => Auth::check()]);
    }

    public function about()
    {
        return Inertia::render('Site/About', ['logged' => Auth::check()]);
    }

    public function contact()
    {
        return Inertia::render('Site/Contact', ['logged' => Auth::check()]);
    }
}
