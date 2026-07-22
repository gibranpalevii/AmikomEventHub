<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Super Admin melihat semua transaksi
        if ($user->role == 'admin') {

            $transactions = Transaction::with('event')
                ->latest()
                ->paginate(20);

        }

        // Organization hanya melihat transaksi event miliknya
        else {

            $eventIds = Event::where(
                'organization_id',
                $user->organization_id
            )->pluck('id');

            $transactions = Transaction::with('event')
                ->whereIn('event_id', $eventIds)
                ->latest()
                ->paginate(20);

        }

        return view(
            'admin.transactions.index',
            compact('transactions')
        );
    }
}