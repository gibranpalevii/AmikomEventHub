<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use App\Models\Partner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $partners = Partner::all();

        $events = Event::with(['category', 'organization'])
            ->when($request->category, function ($query) use ($request) {

                $query->whereHas('category', function ($q) use ($request) {
                    $q->where('slug', $request->category);
                });

            })
            ->latest()
            ->get();

        return view('welcome', compact(
            'events',
            'categories',
            'partners'
        ));
    }
}