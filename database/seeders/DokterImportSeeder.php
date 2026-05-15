<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DokterImportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks for import
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Import Dokter
        $dokters = DB::connection('simanap')->table('dokter')->get();
        foreach ($dokters as $dokter) {
            DB::table('dokters')->updateOrInsert(
                ['id' => $dokter->id],
                [
                    'nm_dokter' => $dokter->nm_dokter,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }

        // Import Ruangan
        $ruangans = DB::connection('simanap')->table('ruangan')->get();
        foreach ($ruangans as $ruangan) {
            DB::table('ruangans')->updateOrInsert(
                ['id' => $ruangan->id],
                [
                    'nama_ruangan' => $ruangan->nama_ruangan,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }

        // Import Jadwal Dokter
        $jadwals = DB::connection('simanap')->table('jadwal_dokter')->get();
        foreach ($jadwals as $jadwal) {
            DB::table('jadwal_dokters')->updateOrInsert(
                ['id' => $jadwal->id],
                [
                    'dokter_id' => $jadwal->kd_dokter,
                    'ruangan_id' => $jadwal->kd_ruangan,
                    'jam_mulai' => $jadwal->jam_mulai,
                    'jam_selesai' => $jadwal->jam_selesai,
                    'hari_kerja' => $jadwal->hari_kerja,
                    'aktivasi' => $jadwal->aktivasi === 'B' ? 1 : 0,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $this->command->info('Data dokter, ruangan, dan jadwal berhasil diimport dari simanap.');
    }
}
