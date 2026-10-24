<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['laboratorium'])
                            ->where('user_id', Auth::id())
                            ->orderBy('tanggal_pinjam', 'desc')
                            ->paginate(10);
                            
        return view('mahasiswa.status.index', compact('peminjamans'));
    }
}
