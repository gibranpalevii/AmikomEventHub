<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;

class EventController extends Controller
{
    public function show(Event $event)
    {
        // Ambil semua kategori untuk navbar
        $categories = Category::all();

        // Ambil review beserta user yang memberi review
        $event->load([
            'category',
            'reviews.user'
        ]);

        return view('event-detail', compact(
            'event',
            'categories'
        ));
    }
}