<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        $peminjamans = Peminjaman::with(['user', 'laboratorium'])
                            ->whereIn('status', ['disetujui', 'ditolak'])
                            ->orderBy('tanggal_pinjam', 'desc')
                            ->paginate(10);
                            
        return view('admin.riwayat.index', compact('peminjamans'));
    }
}
