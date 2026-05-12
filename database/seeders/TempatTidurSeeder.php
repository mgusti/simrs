<?php

namespace Database\Seeders;

use App\Models\TempatTidur;
use Illuminate\Database\Seeder;

class TempatTidurSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['kodekelas' => 'VIP', 'kelas' => 'VIP', 'ruang' => 'VIP', 'kode_ruang' => 'VIP', 'tersedia' => 2, 'kapasitas' => 6, 'tersediawanita' => 0, 'tersediapria' => 2, 'tersediapriawanita' => 0, 'ts' => '2026-05-10 08:42:48'],
            ['kodekelas' => 'KL3', 'kelas' => 'III', 'ruang' => 'Bedah', 'kode_ruang' => 'BD3', 'tersedia' => 4, 'kapasitas' => 4, 'tersediawanita' => 2, 'tersediapria' => 2, 'tersediapriawanita' => 0, 'ts' => '2026-05-10 08:37:17'],
            ['kodekelas' => 'KL3', 'kelas' => 'III', 'ruang' => 'Paru', 'kode_ruang' => 'PR3', 'tersedia' => 5, 'kapasitas' => 8, 'tersediawanita' => 2, 'tersediapria' => 3, 'tersediapriawanita' => 0, 'ts' => '2026-05-10 08:40:50'],
            ['kodekelas' => 'KL2', 'kelas' => 'II', 'ruang' => 'Paru', 'kode_ruang' => 'PR2', 'tersedia' => 2, 'kapasitas' => 2, 'tersediawanita' => 1, 'tersediapria' => 1, 'tersediapriawanita' => 0, 'ts' => '2026-05-10 08:40:33'],
            ['kodekelas' => 'KL2', 'kelas' => 'II', 'ruang' => 'Anak', 'kode_ruang' => 'AN2', 'tersedia' => 3, 'kapasitas' => 8, 'tersediawanita' => 1, 'tersediapria' => 2, 'tersediapriawanita' => 0, 'ts' => '2026-05-10 08:36:01'],
            ['kodekelas' => 'KL3', 'kelas' => 'III', 'ruang' => 'Anak', 'kode_ruang' => 'AN3', 'tersedia' => 0, 'kapasitas' => 4, 'tersediawanita' => 0, 'tersediapria' => 0, 'tersediapriawanita' => 0, 'ts' => '2026-05-10 08:36:06'],
            ['kodekelas' => 'KL2', 'kelas' => 'II', 'ruang' => 'Bedah', 'kode_ruang' => 'BD2', 'tersedia' => 1, 'kapasitas' => 4, 'tersediawanita' => 0, 'tersediapria' => 1, 'tersediapriawanita' => 0, 'ts' => '2026-05-10 08:37:02'],
            ['kodekelas' => 'KL1', 'kelas' => 'I', 'ruang' => 'Bedah', 'kode_ruang' => 'BD1', 'tersedia' => 3, 'kapasitas' => 4, 'tersediawanita' => 1, 'tersediapria' => 2, 'tersediapriawanita' => 0, 'ts' => '2026-05-10 08:36:45'],
            ['kodekelas' => 'KL1', 'kelas' => 'I', 'ruang' => 'Anak', 'kode_ruang' => 'AN1', 'tersedia' => 2, 'kapasitas' => 2, 'tersediawanita' => 1, 'tersediapria' => 1, 'tersediapriawanita' => 0, 'ts' => '2026-05-10 08:35:42'],
            ['kodekelas' => 'KL3', 'kelas' => 'III', 'ruang' => 'Mata, Kulit, THT', 'kode_ruang' => 'MT3', 'tersedia' => 1, 'kapasitas' => 2, 'tersediawanita' => 0, 'tersediapria' => 1, 'tersediapriawanita' => 0, 'ts' => '2026-05-10 08:39:26'],
            ['kodekelas' => 'KL2', 'kelas' => 'II', 'ruang' => 'Mata, Kulit, THT', 'kode_ruang' => 'MT2', 'tersedia' => 2, 'kapasitas' => 2, 'tersediawanita' => 1, 'tersediapria' => 1, 'tersediapriawanita' => 0, 'ts' => '2026-05-10 08:39:15'],
            ['kodekelas' => 'KL1', 'kelas' => 'I', 'ruang' => 'Mata, Kulit, THT', 'kode_ruang' => 'MT1', 'tersedia' => 2, 'kapasitas' => 2, 'tersediawanita' => 1, 'tersediapria' => 1, 'tersediapriawanita' => 0, 'ts' => '2026-05-10 08:39:01'],
            ['kodekelas' => 'KL3', 'kelas' => 'III', 'ruang' => 'Jantung', 'kode_ruang' => 'JTG3', 'tersedia' => 0, 'kapasitas' => 4, 'tersediawanita' => 0, 'tersediapria' => 0, 'tersediapriawanita' => 0, 'ts' => '2026-05-10 08:38:47'],
            ['kodekelas' => 'KL2', 'kelas' => 'II', 'ruang' => 'Jantung', 'kode_ruang' => 'JTG2', 'tersedia' => 3, 'kapasitas' => 4, 'tersediawanita' => 2, 'tersediapria' => 1, 'tersediapriawanita' => 0, 'ts' => '2026-05-10 08:38:36'],
            ['kodekelas' => 'KL1', 'kelas' => 'I', 'ruang' => 'Jantung', 'kode_ruang' => 'JTG1', 'tersedia' => 0, 'kapasitas' => 2, 'tersediawanita' => 0, 'tersediapria' => 0, 'tersediapriawanita' => 0, 'ts' => '2026-05-10 08:38:24'],
            ['kodekelas' => 'KL2', 'kelas' => 'II', 'ruang' => 'Penyakit Dalam', 'kode_ruang' => 'PD2', 'tersedia' => 3, 'kapasitas' => 4, 'tersediawanita' => 2, 'tersediapria' => 1, 'tersediapriawanita' => 0, 'ts' => '2026-05-10 08:39:54'],
            ['kodekelas' => 'KL1', 'kelas' => 'I', 'ruang' => 'Penyakit Dalam', 'kode_ruang' => 'PD1', 'tersedia' => 0, 'kapasitas' => 2, 'tersediawanita' => 0, 'tersediapria' => 0, 'tersediapriawanita' => 0, 'ts' => '2026-05-10 08:39:44'],
            ['kodekelas' => 'KL3', 'kelas' => 'III', 'ruang' => 'Penyakit Dalam', 'kode_ruang' => 'PD3', 'tersedia' => 4, 'kapasitas' => 6, 'tersediawanita' => 2, 'tersediapria' => 2, 'tersediapriawanita' => 0, 'ts' => '2026-05-10 08:40:05'],
            ['kodekelas' => 'KL3', 'kelas' => 'III', 'ruang' => 'Rawat Gabung', 'kode_ruang' => 'RG3', 'tersedia' => 3, 'kapasitas' => 4, 'tersediawanita' => 3, 'tersediapria' => 0, 'tersediapriawanita' => 0, 'ts' => '2026-05-10 08:41:42'],
            ['kodekelas' => 'KL2', 'kelas' => 'II', 'ruang' => 'Rawat Gabung', 'kode_ruang' => 'RG2', 'tersedia' => 3, 'kapasitas' => 4, 'tersediawanita' => 3, 'tersediapria' => 0, 'tersediapriawanita' => 0, 'ts' => '2026-05-10 08:41:33'],
            ['kodekelas' => 'KL1', 'kelas' => 'I', 'ruang' => 'Rawat Gabung', 'kode_ruang' => 'RG1', 'tersedia' => 2, 'kapasitas' => 2, 'tersediawanita' => 2, 'tersediapria' => 0, 'tersediapriawanita' => 0, 'ts' => '2026-05-10 08:41:23'],
            ['kodekelas' => 'ICU', 'kelas' => 'ICU', 'ruang' => 'ICU', 'kode_ruang' => 'ICU', 'tersedia' => 6, 'kapasitas' => 8, 'tersediawanita' => 0, 'tersediapria' => 0, 'tersediapriawanita' => 0, 'ts' => '2026-05-10 08:37:42'],
            ['kodekelas' => 'KL1', 'kelas' => 'I', 'ruang' => 'Paru', 'kode_ruang' => 'PR1', 'tersedia' => 0, 'kapasitas' => 0, 'tersediawanita' => 0, 'tersediapria' => 0, 'tersediapriawanita' => 0, 'ts' => '2026-05-10 08:40:13'],
            ['kodekelas' => 'ISOP', 'kelas' => 'Isolasi', 'ruang' => 'Isolasi Paru', 'kode_ruang' => 'ISOP', 'tersedia' => 1, 'kapasitas' => 4, 'tersediawanita' => 0, 'tersediapria' => 1, 'tersediapriawanita' => 0, 'ts' => '2026-05-10 08:38:01'],
            ['kodekelas' => 'ISOB', 'kelas' => 'Isolasi', 'ruang' => 'Isolasi Bedah', 'kode_ruang' => 'ISOB', 'tersedia' => 2, 'kapasitas' => 2, 'tersediawanita' => 1, 'tersediapria' => 1, 'tersediapriawanita' => 0, 'ts' => '2026-05-10 08:37:48'],
            ['kodekelas' => 'PRT', 'kelas' => 'PRT', 'ruang' => 'Perinatologi', 'kode_ruang' => 'PRT', 'tersedia' => 5, 'kapasitas' => 6, 'tersediawanita' => 0, 'tersediapria' => 0, 'tersediapriawanita' => 0, 'ts' => '2026-05-10 08:41:09'],
            ['kodekelas' => 'HCU', 'kelas' => 'HCU', 'ruang' => 'HCU', 'kode_ruang' => 'HCU', 'tersedia' => 3, 'kapasitas' => 4, 'tersediawanita' => 0, 'tersediapria' => 0, 'tersediapriawanita' => 0, 'ts' => '2026-05-10 08:37:26'],
            ['kodekelas' => 'KL1', 'kelas' => 'I', 'ruang' => 'Saraf', 'kode_ruang' => 'SRF1', 'tersedia' => 1, 'kapasitas' => 2, 'tersediawanita' => 1, 'tersediapria' => 0, 'tersediapriawanita' => 0, 'ts' => '2026-05-10 08:42:05'],
            ['kodekelas' => 'KL2', 'kelas' => 'II', 'ruang' => 'Saraf', 'kode_ruang' => 'SRF2', 'tersedia' => 0, 'kapasitas' => 2, 'tersediawanita' => 0, 'tersediapria' => 0, 'tersediapriawanita' => 0, 'ts' => '2026-05-10 08:42:14'],
            ['kodekelas' => 'KL3', 'kelas' => 'III', 'ruang' => 'Saraf', 'kode_ruang' => 'SRF3', 'tersedia' => 3, 'kapasitas' => 6, 'tersediawanita' => 1, 'tersediapria' => 2, 'tersediapriawanita' => 0, 'ts' => '2026-05-10 08:42:27'],
        ];

        foreach ($data as $bed) {
            TempatTidur::create($bed);
        }
    }
}
