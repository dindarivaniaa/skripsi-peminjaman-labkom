<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Laboratorium;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $totalPengajuan = Peminjaman::where('user_id', $user->id)->count();
        $disetujui = Peminjaman::where('user_id', $user->id)->where('status', 'disetujui')->count();
        $menunggu = Peminjaman::where('user_id', $user->id)->where('status', 'menunggu')->count();
        $ditolak = Peminjaman::where('user_id', $user->id)->where('status', 'ditolak')->count();
        
        $laboratoriums = Laboratorium::all();
        
        $recentPeminjaman = Peminjaman::where('user_id', $user->id)
                            ->with('laboratorium')
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();

        return view('mahasiswa.dashboard', compact(
            'user', 'totalPengajuan', 'disetujui', 'menunggu', 'ditolak', 'laboratoriums', 'recentPeminjaman'
        ));
    }
}
