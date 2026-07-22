<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Super Admin melihat semua event
        if ($user->role == 'superadmin') {

            $events = Event::with(['category', 'organization'])
                ->latest()
                ->paginate(10);

        } else {

            // Admin HIMA hanya melihat event organisasinya
            $events = Event::with(['category', 'organization'])
                ->where('organization_id', $user->organization_id)
                ->latest()
                ->paginate(10);

        }

        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.events.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:1',
            'poster' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('poster')) {
            $data['poster_path'] = $request->file('poster')->store('posters', 'public');
        }

        // Event otomatis menjadi milik organisasi admin yang login
        if (Auth::user()->role != 'superadmin') {
            $data['organization_id'] = Auth::user()->organization_id;
        }

        Event::create($data);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Data Event berhasil ditambahkan.');
    }

    public function edit(Event $event)
    {
        $user = Auth::user();

        // Super Admin bebas edit semua event
        if (
            $user->role != 'superadmin' &&
            $event->organization_id != $user->organization_id
        ) {
            abort(403, 'Akses ditolak');
        }

        $categories = Category::all();

        return view('admin.events.edit', compact('event', 'categories'));
    }

    public function update(Request $request, Event $event)
    {
        $user = Auth::user();

        if (
            $user->role != 'superadmin' &&
            $event->organization_id != $user->organization_id
        ) {
            abort(403, 'Akses ditolak');
        }

        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:1',
            'poster' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('poster')) {

            if ($event->poster_path) {
                Storage::disk('public')->delete($event->poster_path);
            }

            $data['poster_path'] = $request->file('poster')->store('posters', 'public');
        }

        $event->update($data);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event berhasil diperbarui.');
    }

    public function destroy(Event $event)
    {
        $user = Auth::user();

        if (
            $user->role != 'superadmin' &&
            $event->organization_id != $user->organization_id
        ) {
            abort(403, 'Akses ditolak');
        }

        if ($event->poster_path) {
            Storage::disk('public')->delete($event->poster_path);
        }

        $event->delete();

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Data berhasil dihapus.');
    }
}