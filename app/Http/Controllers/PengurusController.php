<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class PengurusController extends Controller
{
    /**
     * Menampilkan semua data pengurus.
     */
    public function index()
    {
        $pengurus = Pengurus::with('jabatan')->get();

        return view('pengurus.index', compact('pengurus'));
    }

    /**
     * Menampilkan form tambah pengurus.
     */
    public function create()
    {
        $jabatans = Jabatan::all();

        return view('pengurus.create', compact('jabatans'));
    }

    /**
     * Menyimpan data pengurus baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jabatan_id' => 'required|exists:jabatans,id',
            'name' => 'required|max:100',
            'description' => 'required|max:255',
            'salary' => 'required|numeric',
            'created_by' => 'required|max:100',
        ]);

        Pengurus::create([
            'jabatan_id' => $request->jabatan_id,
            'name' => $request->name,
            'description' => $request->description,
            'salary' => $request->salary,
            'created_by' => $request->created_by,
            'updated_by' => null,
        ]);

        return redirect()
            ->route('pengurus.index')
            ->with('success', 'Data pengurus berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit pengurus.
     */
    public function edit(string $id)
    {
        $pengurus = Pengurus::findOrFail($id);
        $jabatans = Jabatan::all();

        return view('pengurus.edit', compact('pengurus', 'jabatans'));
    }

    /**
     * Mengupdate data pengurus.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'jabatan_id' => 'required|exists:jabatans,id',
            'name' => 'required|max:100',
            'description' => 'required|max:255',
            'salary' => 'required|numeric',
            'updated_by' => 'nullable|max:100',
        ]);

        $pengurus = Pengurus::findOrFail($id);

        $pengurus->update([
            'jabatan_id' => $request->jabatan_id,
            'name' => $request->name,
            'description' => $request->description,
            'salary' => $request->salary,
            'updated_by' => $request->updated_by,
        ]);

        return redirect()
            ->route('pengurus.index')
            ->with('success', 'Data pengurus berhasil diupdate.');
    }

    /**
     * Menghapus data pengurus.
     */
    public function destroy(string $id)
    {
        $pengurus = Pengurus::findOrFail($id);

        $pengurus->delete();

        return redirect()
            ->route('pengurus.index')
            ->with('success', 'Data pengurus berhasil dihapus.');
    }
}