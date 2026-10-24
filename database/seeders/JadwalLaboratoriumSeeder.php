<?php

namespace Database\Seeders;

use App\Models\JadwalLaboratorium;
use App\Models\Laboratorium;
use Illuminate\Database\Seeder;

class JadwalLaboratoriumSeeder extends Seeder
{
    public function run(): void
    {
        // Temukan atau pastikan Labkom 1 dan Labkom 2 ada
        $lab1 = Laboratorium::firstOrCreate(
            ['nama' => 'Labkom 1'],
            ['deskripsi' => 'Laboratorium Komputer 1', 'kapasitas' => 30]
        );

        $lab2 = Laboratorium::firstOrCreate(
            ['nama' => 'Labkom 2'],
            ['deskripsi' => 'Laboratorium Komputer 2', 'kapasitas' => 30]
        );

        // Hapus data jadwal lama agar bersih
        JadwalLaboratorium::query()->delete();

        $jadwalData = [
            // ==================== LABKOM 1 ====================
            // 1Senin - Lab 1
            [
                'laboratorium_id' => $lab1->id,
                'hari' => 'senin',
                'jam_mulai' => '08:00',
                'jam_selesai' => '09:40',
                'nama_matkul' => 'Praktikum Sistem Multimedia',
                'dosen' => 'Mohammad Bayu A, S.Kom., M.Kom',
                'kelas' => '3B',
            ],
            [
                'laboratorium_id' => $lab1->id,
                'hari' => 'senin',
                'jam_mulai' => '10:00',
                'jam_selesai' => '11:40',
                'nama_matkul' => 'Praktikum Sistem Multimedia',
                'dosen' => 'Mohammad Bayu A, S.Kom., M.Kom',
                'kelas' => '3A',
            ],
            [
                'laboratorium_id' => $lab1->id,
                'hari' => 'senin',
                'jam_mulai' => '13:00',
                'jam_selesai' => '14:40',
                'nama_matkul' => 'Praktikum Pengantar Pemograman Game',
                'dosen' => 'Mohammad Bayu A, S.Kom., M.Kom',
                'kelas' => '3A',
            ],
            [
                'laboratorium_id' => $lab1->id,
                'hari' => 'senin',
                'jam_mulai' => '15:00',
                'jam_selesai' => '16:40',
                'nama_matkul' => 'Praktikum Pengantar Pemograman Game',
                'dosen' => 'Mohammad Bayu A, S.Kom., M.Kom',
                'kelas' => '3B',
            ],
            [
                'laboratorium_id' => $lab1->id,
                'hari' => 'senin',
                'jam_mulai' => '17:00',
                'jam_selesai' => '18:40',
                'nama_matkul' => 'Praktikum Sistem Multimedia',
                'dosen' => 'Mohammad Bayu A, S.Kom., M.Kom',
                'kelas' => '3C',
            ],
            [
                'laboratorium_id' => $lab1->id,
                'hari' => 'senin',
                'jam_mulai' => '19:00',
                'jam_selesai' => '20:40',
                'nama_matkul' => 'Praktikum Pengantar Pemograman Game',
                'dosen' => 'Mohammad Bayu A, S.Kom., M.Kom',
                'kelas' => '3C',
            ],

            // 2Selasa - Lab 1
            [
                'laboratorium_id' => $lab1->id,
                'hari' => 'selasa',
                'jam_mulai' => '08:00',
                'jam_selesai' => '09:40',
                'nama_matkul' => 'Praktikum Jaringan Komputer',
                'dosen' => 'Ahmad Faojan M, S.Kom',
                'kelas' => '5A',
            ],
            [
                'laboratorium_id' => $lab1->id,
                'hari' => 'selasa',
                'jam_mulai' => '10:00',
                'jam_selesai' => '11:40',
                'nama_matkul' => 'Praktikum Jaringan Komputer',
                'dosen' => 'Ahmad Faojan M, S.Kom',
                'kelas' => '5B',
            ],
            [
                'laboratorium_id' => $lab1->id,
                'hari' => 'selasa',
                'jam_mulai' => '17:00',
                'jam_selesai' => '18:40',
                'nama_matkul' => 'Praktikum Jaringan Komputer',
                'dosen' => 'Ahmad Faojan M, S.Kom',
                'kelas' => '5C',
            ],

            // 3Rabu - Lab 1
            [
                'laboratorium_id' => $lab1->id,
                'hari' => 'rabu',
                'jam_mulai' => '10:00',
                'jam_selesai' => '11:40',
                'nama_matkul' => 'Praktikum Pemodelan dan Simulasi',
                'dosen' => 'Mohammad Bayu A, S.Kom., M.Kom',
                'kelas' => '5A',
            ],
            [
                'laboratorium_id' => $lab1->id,
                'hari' => 'rabu',
                'jam_mulai' => '13:00',
                'jam_selesai' => '14:40',
                'nama_matkul' => 'Praktikum Pemodelan dan Simulasi',
                'dosen' => 'Mohammad Bayu A, S.Kom., M.Kom',
                'kelas' => '5B',
            ],
            [
                'laboratorium_id' => $lab1->id,
                'hari' => 'rabu',
                'jam_mulai' => '17:00',
                'jam_selesai' => '18:40',
                'nama_matkul' => 'Praktikum Pemodelan dan Simulasi',
                'dosen' => 'Mohammad Bayu A, S.Kom., M.Kom',
                'kelas' => '5C',
            ],

            // 5Jumat - Lab 1
            [
                'laboratorium_id' => $lab1->id,
                'hari' => 'jumat',
                'jam_mulai' => '08:00',
                'jam_selesai' => '09:40',
                'nama_matkul' => 'Praktikum Sistem Basis Data',
                'dosen' => 'Sutiyono, ST., M.Kom.',
                'kelas' => '5A',
            ],
            [
                'laboratorium_id' => $lab1->id,
                'hari' => 'jumat',
                'jam_mulai' => '10:00',
                'jam_selesai' => '11:40',
                'nama_matkul' => 'Praktikum Sistem Basis Data',
                'dosen' => 'Sutiyono, ST., M.Kom.',
                'kelas' => '5B',
            ],
            [
                'laboratorium_id' => $lab1->id,
                'hari' => 'jumat',
                'jam_mulai' => '13:00',
                'jam_selesai' => '14:40',
                'nama_matkul' => 'Praktikum Jaringan Komputer',
                'dosen' => 'Sutiyono, ST., M.Kom.',
                'kelas' => '5SORE',
            ],
            [
                'laboratorium_id' => $lab1->id,
                'hari' => 'jumat',
                'jam_mulai' => '17:00',
                'jam_selesai' => '18:40',
                'nama_matkul' => 'Praktikum Jaringan Komputer',
                'dosen' => 'Sutiyono, ST., M.Kom.',
                'kelas' => '5SORE',
            ],
            [
                'laboratorium_id' => $lab1->id,
                'hari' => 'jumat',
                'jam_mulai' => '19:00',
                'jam_selesai' => '20:40',
                'nama_matkul' => 'Praktikum Sistem Basis Data',
                'dosen' => 'Sutiyono, ST., M.Kom.',
                'kelas' => '5C',
            ],

            // 6Sabtu - Lab 1
            [
                'laboratorium_id' => $lab1->id,
                'hari' => 'sabtu',
                'jam_mulai' => '10:00',
                'jam_selesai' => '11:40',
                'nama_matkul' => 'Praktikum Aplikasi Dasar Komputer',
                'dosen' => 'Denny Rusdianto, ST., M.Kom.',
                'kelas' => '3PAGI',
            ],
            [
                'laboratorium_id' => $lab1->id,
                'hari' => 'sabtu',
                'jam_mulai' => '13:00',
                'jam_selesai' => '14:40',
                'nama_matkul' => 'Praktikum Analisis Dan Perancangan SI',
                'dosen' => 'Denny Rusdianto, ST., M.Kom.',
                'kelas' => '3PAGI',
            ],
            [
                'laboratorium_id' => $lab1->id,
                'hari' => 'sabtu',
                'jam_mulai' => '15:00',
                'jam_selesai' => '16:40',
                'nama_matkul' => 'Praktikum Aplikasi Dasar Komputer',
                'dosen' => 'Denny Rusdianto, ST., M.Kom.',
                'kelas' => '3SORE',
            ],
            [
                'laboratorium_id' => $lab1->id,
                'hari' => 'sabtu',
                'jam_mulai' => '17:00',
                'jam_selesai' => '18:40',
                'nama_matkul' => 'Praktikum Analisis Dan Perancangan SI',
                'dosen' => 'Denny Rusdianto, ST., M.Kom.',
                'kelas' => '3SORE',
            ],

            // ==================== LABKOM 2 ====================
            // 1Senin - Lab 2
            [
                'laboratorium_id' => $lab2->id,
                'hari' => 'senin',
                'jam_mulai' => '13:00',
                'jam_selesai' => '14:40',
                'nama_matkul' => 'Praktikum Pro Model',
                'dosen' => 'Yusuf Muharam, M.Kom.',
                'kelas' => '5SORE',
            ],
            [
                'laboratorium_id' => $lab2->id,
                'hari' => 'senin',
                'jam_mulai' => '15:00',
                'jam_selesai' => '16:40',
                'nama_matkul' => 'Praktikum Struktur Data',
                'dosen' => 'Khilda Nistrina, S.Pd., M.Sc.',
                'kelas' => '3PAGI',
            ],
            [
                'laboratorium_id' => $lab2->id,
                'hari' => 'senin',
                'jam_mulai' => '17:00',
                'jam_selesai' => '18:40',
                'nama_matkul' => 'Praktikum Struktur Data',
                'dosen' => 'Khilda Nistrina, S.Pd., M.Sc.',
                'kelas' => '3SORE',
            ],
            [
                'laboratorium_id' => $lab2->id,
                'hari' => 'senin',
                'jam_mulai' => '19:00',
                'jam_selesai' => '20:40',
                'nama_matkul' => 'Praktikum Pro Model',
                'dosen' => 'Yusuf Muharam, M.Kom.',
                'kelas' => '5SORE',
            ],

            // 2Selasa - Lab 2
            [
                'laboratorium_id' => $lab2->id,
                'hari' => 'selasa',
                'jam_mulai' => '10:00',
                'jam_selesai' => '11:40',
                'nama_matkul' => 'Praktikum Sistem Informasi Geografis',
                'dosen' => 'Yusuf Muharam, M.Kom.',
                'kelas' => '5PAGI',
            ],
            [
                'laboratorium_id' => $lab2->id,
                'hari' => 'selasa',
                'jam_mulai' => '13:00',
                'jam_selesai' => '14:40',
                'nama_matkul' => 'Praktikum Sistem Informasi Geografis',
                'dosen' => 'Yusuf Muharam, M.Kom.',
                'kelas' => '7A',
            ],
            [
                'laboratorium_id' => $lab2->id,
                'hari' => 'selasa',
                'jam_mulai' => '17:00',
                'jam_selesai' => '18:40',
                'nama_matkul' => 'Praktikum Sistem Informasi Geografis',
                'dosen' => 'Yusuf Muharam, M.Kom.',
                'kelas' => '7B',
            ],
            [
                'laboratorium_id' => $lab2->id,
                'hari' => 'selasa',
                'jam_mulai' => '19:00',
                'jam_selesai' => '20:40',
                'nama_matkul' => 'Praktikum Sistem Informasi Geografis',
                'dosen' => 'Yusuf Muharam, M.Kom.',
                'kelas' => '5SORE',
            ],

            // 3Rabu - Lab 2
            [
                'laboratorium_id' => $lab2->id,
                'hari' => 'rabu',
                'jam_mulai' => '13:00',
                'jam_selesai' => '14:40',
                'nama_matkul' => 'Praktikum Statistik & Probabilitas',
                'dosen' => 'Rosmalina, ST., M.Kom.',
                'kelas' => '1PAGI',
            ],
            [
                'laboratorium_id' => $lab2->id,
                'hari' => 'rabu',
                'jam_mulai' => '15:00',
                'jam_selesai' => '16:40',
                'nama_matkul' => 'Praktikum Akuntansi',
                'dosen' => 'Khilda Nistrina, S.Pd., M.Sc.',
                'kelas' => '3PAGI',
            ],
            [
                'laboratorium_id' => $lab2->id,
                'hari' => 'rabu',
                'jam_mulai' => '17:00',
                'jam_selesai' => '18:40',
                'nama_matkul' => 'Praktikum Statistik & Probabilitas',
                'dosen' => 'Rosmalina, ST., M.Kom.',
                'kelas' => '1SORE',
            ],
            [
                'laboratorium_id' => $lab2->id,
                'hari' => 'rabu',
                'jam_mulai' => '19:00',
                'jam_selesai' => '20:40',
                'nama_matkul' => 'Praktikum Akuntansi',
                'dosen' => 'Khilda Nistrina, S.Pd., M.Sc.',
                'kelas' => '3SORE',
            ],

            // 4Kamis - Lab 2
            [
                'laboratorium_id' => $lab2->id,
                'hari' => 'kamis',
                'jam_mulai' => '10:00',
                'jam_selesai' => '11:40',
                'nama_matkul' => 'Praktikum Algoritma Dan Pemrograman 1',
                'dosen' => 'Ahmad Faojan M, S.Kom',
                'kelas' => '1A',
            ],
            [
                'laboratorium_id' => $lab2->id,
                'hari' => 'kamis',
                'jam_mulai' => '13:00',
                'jam_selesai' => '14:40',
                'nama_matkul' => 'Praktikum Algoritma Dan Pemrograman 1',
                'dosen' => 'Ahmad Faojan M, S.Kom',
                'kelas' => '1B',
            ],
            [
                'laboratorium_id' => $lab2->id,
                'hari' => 'kamis',
                'jam_mulai' => '15:00',
                'jam_selesai' => '16:40',
                'nama_matkul' => 'Praktikum Algoritma Dan Pemrograman 1',
                'dosen' => 'Cecep Suwanda, M.Kom',
                'kelas' => '1PAGI',
            ],
            [
                'laboratorium_id' => $lab2->id,
                'hari' => 'kamis',
                'jam_mulai' => '17:00',
                'jam_selesai' => '18:40',
                'nama_matkul' => 'Praktikum Algoritma Dan Pemrograman 1',
                'dosen' => 'Ahmad Faojan M, S.Kom',
                'kelas' => '1C',
            ],
            [
                'laboratorium_id' => $lab2->id,
                'hari' => 'kamis',
                'jam_mulai' => '19:00',
                'jam_selesai' => '20:40',
                'nama_matkul' => 'Praktikum Algoritma Dan Pemrograman 1',
                'dosen' => 'Cecep Suwanda, M.Kom',
                'kelas' => '1SORE',
            ],

            // 6Sabtu - Lab 2
            [
                'laboratorium_id' => $lab2->id,
                'hari' => 'sabtu',
                'jam_mulai' => '08:00',
                'jam_selesai' => '09:40',
                'nama_matkul' => 'Praktikum Organisasi Dan Arsitektur Komputer',
                'dosen' => 'Ahmad Faojan M, S.Kom',
                'kelas' => '3A',
            ],
            [
                'laboratorium_id' => $lab2->id,
                'hari' => 'sabtu',
                'jam_mulai' => '10:00',
                'jam_selesai' => '11:40',
                'nama_matkul' => 'Praktikum Organisasi Dan Arsitektur Komputer',
                'dosen' => 'Ahmad Faojan M, S.Kom',
                'kelas' => '3B',
            ],
            [
                'laboratorium_id' => $lab2->id,
                'hari' => 'sabtu',
                'jam_mulai' => '13:00',
                'jam_selesai' => '14:40',
                'nama_matkul' => 'Praktikum Bahasa Pemograman Tingkat Rendah',
                'dosen' => 'Ahmad Faojan M, S.Kom',
                'kelas' => '3B',
            ],
            [
                'laboratorium_id' => $lab2->id,
                'hari' => 'sabtu',
                'jam_mulai' => '15:00',
                'jam_selesai' => '16:40',
                'nama_matkul' => 'Praktikum Bahasa Pemograman Tingkat Rendah',
                'dosen' => 'Ahmad Faojan M, S.Kom',
                'kelas' => '3A',
            ],
            [
                'laboratorium_id' => $lab2->id,
                'hari' => 'sabtu',
                'jam_mulai' => '17:00',
                'jam_selesai' => '18:40',
                'nama_matkul' => 'Praktikum Organisasi Dan Arsitektur Komputer',
                'dosen' => 'Ahmad Faojan M, S.Kom',
                'kelas' => '3C',
            ],
            [
                'laboratorium_id' => $lab2->id,
                'hari' => 'sabtu',
                'jam_mulai' => '19:00',
                'jam_selesai' => '20:40',
                'nama_matkul' => 'Praktikum Bahasa Pemograman Tingkat Rendah',
                'dosen' => 'Ahmad Faojan M, S.Kom',
                'kelas' => '3C',
            ],
        ];

        foreach ($jadwalData as $data) {
            JadwalLaboratorium::create($data);
        }
    }
}
