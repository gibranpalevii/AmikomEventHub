<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Category;
use App\Models\Partner;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Statistik Dashboard
        |--------------------------------------------------------------------------
        */

        $totalRevenue = Transaction::whereIn('status', ['success', 'settlement'])
            ->sum('total_price');

        $ticketsSold = Transaction::whereIn('status', ['success', 'settlement'])
            ->count();

        $activeEvents = Event::count();

        $totalUsers = User::count();

        $totalCategories = Category::count();

        $totalPartners = Partner::count();

        $pendingOrders = Transaction::where('status', 'pending')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Transaksi Terbaru
        |--------------------------------------------------------------------------
        */

        $recentTransactions = Transaction::with('event')
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Data Grafik (Stok Event)
        |--------------------------------------------------------------------------
        */

        $events = Event::all();

        $eventLabels = $events->pluck('title');

        $ticketData = $events->pluck('stock');

        /*
        |--------------------------------------------------------------------------
        | Kirim ke View
        |--------------------------------------------------------------------------
        */

        return view('admin.dashboard', compact(
            'totalRevenue',
            'ticketsSold',
            'activeEvents',
            'totalUsers',
            'totalCategories',
            'totalPartners',
            'pendingOrders',
            'recentTransactions',
            'eventLabels',
            'ticketData'
        ));
    }
}