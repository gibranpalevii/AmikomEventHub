<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Menampilkan semua data jabatan.
     */
    public function index()
    {
        $jabatans = Jabatan::all();

        return view('jabatan.index', compact('jabatans'));
    }

    /**
     * Menampilkan form tambah jabatan.
     */
    public function create()
    {
        return view('jabatan.create');
    }

    /**
     * Menyimpan data jabatan baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'created_by' => 'required|max:100',
        ]);

        Jabatan::create([
            'name' => $request->name,
            'created_by' => $request->created_by,
            'updated_by' => null,
        ]);

        return redirect()
            ->route('jabatan.index')
            ->with('success', 'Data jabatan berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit jabatan.
     */
    public function edit(string $id)
    {
        $jabatan = Jabatan::findOrFail($id);

        return view('jabatan.edit', compact('jabatan'));
    }

    /**
     * Mengupdate data jabatan.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|max:100',
            'updated_by' => 'nullable|max:100',
        ]);

        $jabatan = Jabatan::findOrFail($id);

        $jabatan->update([
            'name' => $request->name,
            'updated_by' => $request->updated_by,
        ]);

        return redirect()
            ->route('jabatan.index')
            ->with('success', 'Data jabatan berhasil diupdate.');
    }

    /**
     * Menghapus data jabatan.
     */
    public function destroy(string $id)
    {
        $jabatan = Jabatan::findOrFail($id);

        $jabatan->delete();

        return redirect()
            ->route('jabatan.index')
            ->with('success', 'Data jabatan berhasil dihapus.');
    }
}