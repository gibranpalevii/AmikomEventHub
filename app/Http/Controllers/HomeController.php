<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $partners = Partner::latest()->get();

        $categories = Category::latest()->get();

        return view('welcome', compact('partners', 'categories'));
    }
}