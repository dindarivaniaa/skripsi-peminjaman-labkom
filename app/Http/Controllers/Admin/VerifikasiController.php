<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['user', 'laboratorium'])
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);
                            
        return view('admin.verifikasi.index', compact('peminjamans'));
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::with(['user', 'laboratorium'])->findOrFail($id);
        return view('admin.verifikasi.show', compact('peminjaman'));
    }

    public function approve(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update([
            'status' => 'disetujui',
            'keterangan_admin' => $request->keterangan_admin ?? 'Disetujui oleh Kepala Laboratorium.'
        ]);

        return redirect()->back()->with('success', 'Peminjaman berhasil disetujui.');
    }

    public function reject(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update([
            'status' => 'ditolak',
            'keterangan_admin' => $request->keterangan_admin ?? 'Ditolak oleh Kepala Laboratorium.'
        ]);

        return redirect()->back()->with('success', 'Peminjaman berhasil ditolak.');
    }
}
