<?php

namespace App\Http\Controllers;

use App\Models\TempatTidur;
use Illuminate\Http\Request;

class TempatTidurController extends Controller
{
    public function index()
    {
        $beds = TempatTidur::orderBy('ruang', 'asc')
            ->orderBy('kelas', 'asc')
            ->get();
        return view('pages.tempat-tidur', ['title' => 'Tempat Tidur', 'beds' => $beds]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kodekelas' => 'required|string',
            'kode_ruang' => 'required|string',
            'ruangan' => 'required|string',
            'kapasitas' => 'required|integer',
            'tersedia' => 'required|integer',
            'tersediapria' => 'required|integer',
            'tersediawanita' => 'required|integer',
        ]);

        $bed = TempatTidur::findOrFail($id);
        
        $data = [
            'kodekelas' => $validated['kodekelas'],
            'kode_ruang' => $validated['kode_ruang'],
            'ruang' => $validated['ruangan'],
            'kapasitas' => $validated['kapasitas'],
            'tersedia' => $validated['tersedia'],
            'tersediapria' => $validated['tersediapria'],
            'tersediawanita' => $validated['tersediawanita'],
            'ts' => now(),
        ];

        $bed->update($data);

        return redirect()->route('tempat-tidur')->with('success', 'Data tempat tidur berhasil diperbarui');
    }
}

