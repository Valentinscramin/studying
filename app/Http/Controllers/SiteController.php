<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
// use Illuminate\Http\Request;
use Inertia\Inertia;

class SiteController extends Controller
{
    public function index()
    {
        return Inertia::render('Site/Home', [
            'canLogin' => Route::getRoutes()->hasNamedRoute('login'),
            'canRegister' => Route::getRoutes()->hasNamedRoute('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }

    public function shop()
    {
        return Inertia::render('Site/Shop');
    }

    public function about()
    {
        return Inertia::render('Site/About');
    }

    public function contact()
    {
        return Inertia::render('Site/Contact');
    }
}