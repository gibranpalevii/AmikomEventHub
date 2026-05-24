<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partner;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $partners = Partner::when($search, function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        })->latest()->get();

        return view('admin.partners.index', compact('partners'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'logo_url' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $logo = null;

        if ($request->hasFile('logo_url')) {

            $file = $request->file('logo_url');

            $logo = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('uploads/partners'), $logo);
        }

        Partner::create([
            'name' => $request->name,
            'logo_url' => $logo
        ]);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner berhasil ditambahkan');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'logo_url' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $partner = Partner::findOrFail($id);

        $logo = $partner->logo_url;

        if ($request->hasFile('logo_url')) {

            $file = $request->file('logo_url');

            $logo = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('uploads/partners'), $logo);
        }

        $partner->update([
            'name' => $request->name,
            'logo_url' => $logo
        ]);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $partner = Partner::findOrFail($id);

        $partner->delete();

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner berhasil dihapus');
    }
}