<?php

namespace App\Http\Controllers;

use App\Models\JadwalDokter;
use App\Models\Dokter;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JadwalDokterController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->id !== 1 && !$user->access_jadwal_dokter) {
            abort(403);
        }

        // Get doctors who have at least one record in jadwal_dokters
        $dokters = Dokter::whereHas('jadwal')->with(['jadwal.ruangan'])->orderBy('nm_dokter')->get()->map(function($dokter) {
            // Only consider active days for display in the table
            $dokter->active_days = $dokter->jadwal->where('aktivasi', 1)->pluck('hari_kerja')->toArray();
            $dokter->all_days_status = $dokter->jadwal->pluck('aktivasi', 'hari_kerja')->toArray();
            $dokter->ruangan_utama = $dokter->jadwal->first()?->ruangan;
            return $dokter;
        });

        // Get all doctors who DON'T have a schedule yet for the Add Modal autocomplete
        $allDokters = Dokter::whereDoesntHave('jadwal')->orderBy('nm_dokter')->get();
        $ruangans = Ruangan::orderBy('nama_ruangan')->get();

        return view('pages.jadwal-dokter', [
            'title' => 'Jadwal Dokter',
            'dokters' => $dokters,
            'allDokters' => $allDokters,
            'ruangans' => $ruangans
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ruangan_id' => 'required|exists:ruangans,id',
            'hari' => 'nullable|array',
        ]);

        $dokterId = $id;
        $ruanganId = $request->ruangan_id;
        $selectedDays = $request->hari ?? [];

        DB::transaction(function () use ($dokterId, $ruanganId, $selectedDays) {
            $daysOfWeek = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            
            foreach ($daysOfWeek as $hari) {
                $status = in_array($hari, $selectedDays) ? 1 : 0;
                $jamMulai = '08:00:00';
                $jamSelesai = ($hari === 'Jumat') ? '10:00:00' : '12:00:00';

                JadwalDokter::updateOrCreate(
                    ['dokter_id' => $dokterId, 'hari_kerja' => $hari],
                    [
                        'ruangan_id' => $ruanganId,
                        'jam_mulai' => $jamMulai,
                        'jam_selesai' => $jamSelesai,
                        'aktivasi' => $status
                    ]
                );
            }
        });

        return back()->with('success', 'Jadwal dokter berhasil diperbarui.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'dokter_id' => 'required|exists:dokters,id',
            'ruangan_id' => 'required|exists:ruangans,id',
            'hari' => 'nullable|array',
        ]);

        // Check if doctor already has a schedule to prevent accidental double entry
        if (JadwalDokter::where('dokter_id', $request->dokter_id)->exists()) {
            return back()->withErrors(['dokter_id' => 'Dokter ini sudah memiliki jadwal. Silakan edit jadwal yang sudah ada.'])->withInput();
        }

        return $this->update($request, $request->dokter_id);
    }

    public function destroy($id)
    {
        // Instead of deleting everything, maybe just set all to inactive? 
        // But user said "Hapus seluruh jadwal", so deleting rows is fine to remove them from the list.
        JadwalDokter::where('dokter_id', $id)->delete();
        return back()->with('success', 'Seluruh data jadwal dokter berhasil dihapus dari daftar.');
    }

    public function storeDokter(Request $request)
    {
        $request->validate([
            'nm_dokter' => 'required|string|max:100',
        ]);

        Dokter::create([
            'nm_dokter' => $request->nm_dokter,
        ]);

        return back()->with('success', 'Dokter baru berhasil ditambahkan.');
    }
}
