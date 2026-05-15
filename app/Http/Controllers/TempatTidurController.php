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
            
        $classes = TempatTidur::select('kelas')->whereNotNull('kelas')->distinct()->pluck('kelas');
            
        return view('pages.tempat-tidur', [
            'title' => 'Tempat Tidur', 
            'beds' => $beds,
            'classes' => $classes
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kelas' => 'required|string',
            'ruangan' => 'required|string',
            'kapasitas' => 'required|integer',
            'tersedia' => 'required|integer',
            'tersediapria' => 'required|integer',
            'tersediawanita' => 'required|integer',
        ]);

        $bed = TempatTidur::findOrFail($id);
        
        $data = [
            'kelas' => $validated['kelas'],
            'ruang' => $validated['ruangan'],
            'kapasitas' => $validated['kapasitas'],
            'tersedia' => $validated['tersedia'],
            'tersediapria' => $validated['tersediapria'],
            'tersediawanita' => $validated['tersediawanita'],
            'ts' => now('Asia/Jakarta'),
        ];

        $bed->update($data);

        return redirect()->route('tempat-tidur')->with('success', 'Data tempat tidur berhasil diperbarui');
    }
}

