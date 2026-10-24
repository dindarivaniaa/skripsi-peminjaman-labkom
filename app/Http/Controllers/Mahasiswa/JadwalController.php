<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\JadwalLaboratorium;
use App\Models\Laboratorium;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Carbon\Carbon;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $laboratoriums = Laboratorium::all();

        $selectedLabId = $request->input('laboratorium_id', $laboratoriums->first()?->id);

        $selectedLab = Laboratorium::find($selectedLabId);

        // Ambil jadwal praktikum rutin untuk lab yang dipilih
        $jadwalRutin = [];
        if ($selectedLabId) {
            $jadwalRutin = JadwalLaboratorium::where('laboratorium_id', $selectedLabId)
                ->orderBy('jam_mulai', 'asc')
                ->get()
                ->groupBy('hari');
        }

        // Ambil 10 peminjaman disetujui mendatang untuk lab yang dipilih
        $peminjamanDisetujui = [];
        if ($selectedLabId) {
            $peminjamanDisetujui = Peminjaman::with('user')
                ->where('laboratorium_id', $selectedLabId)
                ->where('status', 'disetujui')
                ->where('tanggal_pinjam', '>=', Carbon::today()->toDateString())
                ->orderBy('tanggal_pinjam', 'asc')
                ->orderBy('jam_mulai', 'asc')
                ->limit(10)
                ->get();
        }

        return view('mahasiswa.jadwal.index', compact(
            'laboratoriums',
            'selectedLabId',
            'selectedLab',
            'jadwalRutin',
            'peminjamanDisetujui'
        ));
    }
}
