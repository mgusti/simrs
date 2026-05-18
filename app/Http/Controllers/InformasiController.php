<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    // For Admin Panel (HTML)
    public function index()
    {
        $informasi = Informasi::orderBy('created_at', 'desc')->get();
        return view('pages.informasi', [
            'title' => 'Informasi',
            'informasi' => $informasi
        ]);
    }

    // For React App (JSON)
    public function getApiData()
    {
        $informasi = Informasi::orderBy('created_at', 'desc')->get();
        return response()->json($informasi)
                         ->header('Access-Control-Allow-Origin', '*');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'link' => 'nullable|string|max:255',
            'kategori' => 'required|string',
            'deskripsi' => 'nullable|string',
            'nomor' => 'nullable|string|max:255',
        ]);

        Informasi::create($request->all());

        return back()->with('success', 'Informasi berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'link' => 'nullable|string|max:255',
            'kategori' => 'required|string',
            'deskripsi' => 'nullable|string',
            'nomor' => 'nullable|string|max:255',
        ]);

        $informasi = Informasi::findOrFail($id);
        $informasi->update($request->all());

        return back()->with('success', 'Informasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $informasi = Informasi::findOrFail($id);
        $informasi->delete();

        return back()->with('success', 'Informasi berhasil dihapus.');
    }
}
