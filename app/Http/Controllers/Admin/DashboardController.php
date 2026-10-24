<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laboratorium;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalLab = Laboratorium::count();
        $totalMahasiswa = User::where('role', 'mahasiswa')->count();
        
        $peminjamanAktif = Peminjaman::where('status', 'disetujui')
                                ->whereDate('tanggal_pinjam', '>=', date('Y-m-d'))
                                ->count();
                                
        $menungguPersetujuan = Peminjaman::where('status', 'menunggu')->count();
        
        $recentPeminjaman = Peminjaman::with(['user', 'laboratorium'])
                                ->orderBy('created_at', 'desc')
                                ->take(5)
                                ->get();

        return view('admin.dashboard', compact(
            'totalLab', 'totalMahasiswa', 'peminjamanAktif', 'menungguPersetujuan', 'recentPeminjaman'
        ));
    }
}
