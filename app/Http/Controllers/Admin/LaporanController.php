<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::with(['user', 'laboratorium'])->orderBy('tanggal_pinjam', 'desc');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal_pinjam', [$request->start_date, $request->end_date]);
        }

        $peminjamans = $query->get();
        return view('admin.laporan.index', compact('peminjamans'));
    }

    public function cetak(Request $request)
    {
        $query = Peminjaman::with(['user', 'laboratorium'])->orderBy('tanggal_pinjam', 'asc');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal_pinjam', [$request->start_date, $request->end_date]);
        }

        $peminjamans = $query->get();
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        return view('admin.laporan.cetak', compact('peminjamans', 'start_date', 'end_date'));
    }
}
