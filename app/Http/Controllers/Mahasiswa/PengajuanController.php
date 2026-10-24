<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\JadwalLaboratorium;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PengajuanController extends Controller
{
    public function index()
    {
        return redirect()->route('mahasiswa.dashboard');
    }

    public function cekJadwal(Request $request)
    {
        $request->validate([
            'laboratorium_id' => 'required|exists:laboratoriums,id',
            'tanggal_pinjam' => 'required|date',
        ]);

        $carbonDate = Carbon::parse($request->tanggal_pinjam);
        $daysMap = [1 => 'senin', 2 => 'selasa', 3 => 'rabu', 4 => 'kamis', 5 => 'jumat', 6 => 'sabtu', 7 => 'minggu'];
        $namaHari = $daysMap[$carbonDate->dayOfWeekIso] ?? '';

        // Ambil peminjaman mahasiswa
        $jadwalPeminjaman = Peminjaman::where('laboratorium_id', $request->laboratorium_id)
            ->where('tanggal_pinjam', $request->tanggal_pinjam)
            ->whereIn('status', ['disetujui', 'menunggu'])
            ->orderBy('jam_mulai', 'asc')
            ->get(['id', 'jam_mulai', 'jam_selesai', 'status', 'keperluan']);

        // Ambil jadwal praktikum rutin untuk hari tersebut
        $jadwalRutin = JadwalLaboratorium::where('laboratorium_id', $request->laboratorium_id)
            ->where('hari', $namaHari)
            ->orderBy('jam_mulai', 'asc')
            ->get(['id', 'nama_matkul', 'dosen', 'kelas', 'jam_mulai', 'jam_selesai']);

        return response()->json([
            'success' => true,
            'data' => $jadwalPeminjaman,
            'jadwal_rutin' => $jadwalRutin,
            'hari' => ucfirst($namaHari)
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'laboratorium_id' => 'required|exists:laboratoriums,id',
            'tanggal_pinjam' => 'required|date|after_or_equal:today',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'keperluan' => 'required|string|max:1000'
        ]);

        $carbonDate = Carbon::parse($request->tanggal_pinjam);
        $daysMap = [1 => 'senin', 2 => 'selasa', 3 => 'rabu', 4 => 'kamis', 5 => 'jumat', 6 => 'sabtu', 7 => 'minggu'];
        $namaHari = $daysMap[$carbonDate->dayOfWeekIso] ?? '';

        // 1. Cek Bentrok Waktu dengan Jadwal Praktikum Rutin
        $bentrokRutin = JadwalLaboratorium::where('laboratorium_id', $request->laboratorium_id)
            ->where('hari', $namaHari)
            ->where(function ($q) use ($request) {
                $q->where('jam_mulai', '<', $request->jam_selesai)
                  ->where('jam_selesai', '>', $request->jam_mulai);
            })
            ->first();

        if ($bentrokRutin) {
            $jamMulaiFormatted = substr($bentrokRutin->jam_mulai, 0, 5);
            $jamSelesaiFormatted = substr($bentrokRutin->jam_selesai, 0, 5);
            $pesan = "Jadwal Bentrok! Laboratorium pada hari " . ucfirst($namaHari) . " jam {$jamMulaiFormatted} - {$jamSelesaiFormatted} digunakan untuk Jadwal Praktikum Rutin '{$bentrokRutin->nama_matkul}' (Kelas {$bentrokRutin->kelas}). Silakan pilih jam lain.";

            return redirect()->back()
                ->withInput()
                ->with('error', $pesan)
                ->withErrors([
                    'jam_mulai' => "Jam {$request->jam_mulai} - {$request->jam_selesai} bentrok dengan Jadwal Praktikum Rutin ({$jamMulaiFormatted} - {$jamSelesaiFormatted})."
                ]);
        }

        // 2. Cek Bentrok Waktu dengan Peminjaman Mahasiswa Lain (Double Booking Validation)
        $bentrok = Peminjaman::where('laboratorium_id', $request->laboratorium_id)
            ->where('tanggal_pinjam', $request->tanggal_pinjam)
            ->whereIn('status', ['disetujui', 'menunggu'])
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('jam_mulai', '<', $request->jam_selesai)
                      ->where('jam_selesai', '>', $request->jam_mulai);
                });
            })
            ->first();

        if ($bentrok) {
            $statusBentrok = $bentrok->status == 'disetujui' ? 'sudah disetujui' : 'sedang dalam proses pengajuan';
            $jamMulaiFormatted = substr($bentrok->jam_mulai, 0, 5);
            $jamSelesaiFormatted = substr($bentrok->jam_selesai, 0, 5);
            $pesan = "Jadwal Bentrok! Laboratorium pada tanggal {$request->tanggal_pinjam} {$statusBentrok} pada jam {$jamMulaiFormatted} - {$jamSelesaiFormatted}. Silakan pilih jam lain atau lakukan reschedule tanggal.";

            return redirect()->back()
                ->withInput()
                ->with('error', $pesan)
                ->withErrors([
                    'jam_mulai' => "Jam {$request->jam_mulai} - {$request->jam_selesai} bentrok dengan peminjaman jam {$jamMulaiFormatted} - {$jamSelesaiFormatted}."
                ]);
        }

        Peminjaman::create([
            'user_id' => Auth::id(),
            'laboratorium_id' => $request->laboratorium_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'keperluan' => $request->keperluan,
            'status' => 'menunggu'
        ]);

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Pengajuan peminjaman laboratorium berhasil dikirim dan sedang menunggu verifikasi.');
    }
}
