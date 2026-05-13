<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index()
    {
        $pengaduans = Pengaduan::orderBy('id', 'desc')->paginate(10);
        return view('pages.pengaduan', [
            'title' => 'Daftar Pengaduan',
            'pengaduans' => $pengaduans
        ]);
    }

    public function downloadExcel()
    {
        $pengaduans = Pengaduan::orderBy('id', 'desc')->get();
        
        $fileName = 'daftar_pengaduan_' . date('Y-m-d_H-i') . '.csv';
        
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('No', 'Pelapor', 'HP', 'Alamat', 'Isi Pengaduan', 'Tanggal');

        $callback = function() use($pengaduans, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($pengaduans as $index => $item) {
                fputcsv($file, array(
                    $index + 1,
                    $item->nama ?? 'Anonim',
                    $item->hp ?? '-',
                    $item->alamat ?? '-',
                    $item->pengaduan ?? '-',
                    \Carbon\Carbon::parse($item->created_at)->format('d M Y H:i')
                ));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
