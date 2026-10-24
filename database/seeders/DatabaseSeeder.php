<?php

namespace Database\Seeders;

use App\Models\Laboratorium;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
        * Seed the application's database.
        */
    public function run(): void
    {
        // Buat Akun Admin (Kepala Laboratorium)
        User::create([
            'name' => 'Kepala Laboratorium',
            'email' => 'admin@unibba.ac.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Buat Akun Mahasiswa Demo
        User::create([
            'name' => 'Rian Hidayat',
            'email' => 'mahasiswa@unibba.ac.id',
            'password' => Hash::make('mahasiswa123'),
            'role' => 'mahasiswa',
            'nim' => '10121005',
            'prodi' => 'Teknik Informatika',
        ]);

        // Buat Data Laboratorium
        Laboratorium::firstOrCreate([
            'nama' => 'Labkom 1'
        ], [
            'deskripsi' => 'Laboratorium Komputer 1',
            'kapasitas' => 30
        ]);

        Laboratorium::firstOrCreate([
            'nama' => 'Labkom 2'
        ], [
            'deskripsi' => 'Laboratorium Komputer 2',
            'kapasitas' => 30
        ]);

        // Seed Jadwal Praktikum Rutin
        $this->call(JadwalLaboratoriumSeeder::class);
    }
}
