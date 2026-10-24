<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalLaboratorium;
use App\Models\Laboratorium;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $laboratoriums = Laboratorium::all();

        $query = JadwalLaboratorium::with('laboratorium');

        if ($request->filled('laboratorium_id')) {
            $query->where('laboratorium_id', $request->laboratorium_id);
        }

        if ($request->filled('hari')) {
            $query->where('hari', strtolower($request->hari));
        }

        // Custom order by hari: senin, selasa, rabu, kamis, jumat, sabtu
        $jadwalList = $query->get()->sortBy(function ($item) {
            $hariOrder = [
                'senin' => 1,
                'selasa' => 2,
                'rabu' => 3,
                'kamis' => 4,
                'jumat' => 5,
                'sabtu' => 6,
            ];
            $orderHari = $hariOrder[strtolower($item->hari)] ?? 7;
            return sprintf('%d-%s-%s', $orderHari, $item->laboratorium_id, $item->jam_mulai);
        });

        return view('admin.jadwal.index', compact('jadwalList', 'laboratoriums'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'laboratorium_id' => 'required|exists:laboratoriums,id',
            'nama_matkul'     => 'required|string|max:255',
            'dosen'           => 'required|string|max:255',
            'kelas'           => 'required|string|max:100',
            'hari'            => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu',
            'jam_mulai'       => 'required|date_format:H:i',
            'jam_selesai'     => 'required|date_format:H:i|after:jam_mulai',
        ]);

        // Cek bentrok antar jadwal praktikum rutin
        $bentrok = JadwalLaboratorium::where('laboratorium_id', $request->laboratorium_id)
            ->where('hari', strtolower($request->hari))
            ->where(function ($q) use ($request) {
                $q->where('jam_mulai', '<', $request->jam_selesai)
                  ->where('jam_selesai', '>', $request->jam_mulai);
            })
            ->first();

        if ($bentrok) {
            return redirect()->back()
                ->withInput()
                ->with('error', "Gagal menambahkan jadwal! Bentrok dengan jadwal '{$bentrok->nama_matkul}' ({$bentrok->kelas}) pada hari " . ucfirst($bentrok->hari) . " jam " . substr($bentrok->jam_mulai, 0, 5) . " - " . substr($bentrok->jam_selesai, 0, 5) . ".");
        }

        JadwalLaboratorium::create([
            'laboratorium_id' => $request->laboratorium_id,
            'nama_matkul'     => $request->nama_matkul,
            'dosen'           => $request->dosen,
            'kelas'           => $request->kelas,
            'hari'            => strtolower($request->hari),
            'jam_mulai'       => $request->jam_mulai,
            'jam_selesai'     => $request->jam_selesai,
        ]);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal laboratorium berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $jadwal = JadwalLaboratorium::findOrFail($id);

        $request->validate([
            'laboratorium_id' => 'required|exists:laboratoriums,id',
            'nama_matkul'     => 'required|string|max:255',
            'dosen'           => 'required|string|max:255',
            'kelas'           => 'required|string|max:100',
            'hari'            => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu',
            'jam_mulai'       => 'required|date_format:H:i',
            'jam_selesai'     => 'required|date_format:H:i|after:jam_mulai',
        ]);

        // Cek bentrok mengecualikan ID yang sedang diedit
        $bentrok = JadwalLaboratorium::where('laboratorium_id', $request->laboratorium_id)
            ->where('hari', strtolower($request->hari))
            ->where('id', '!=', $id)
            ->where(function ($q) use ($request) {
                $q->where('jam_mulai', '<', $request->jam_selesai)
                  ->where('jam_selesai', '>', $request->jam_mulai);
            })
            ->first();

        if ($bentrok) {
            return redirect()->back()
                ->withInput()
                ->with('error', "Gagal memperbarui jadwal! Bentrok dengan jadwal '{$bentrok->nama_matkul}' ({$bentrok->kelas}) pada hari " . ucfirst($bentrok->hari) . " jam " . substr($bentrok->jam_mulai, 0, 5) . " - " . substr($bentrok->jam_selesai, 0, 5) . ".");
        }

        $jadwal->update([
            'laboratorium_id' => $request->laboratorium_id,
            'nama_matkul'     => $request->nama_matkul,
            'dosen'           => $request->dosen,
            'kelas'           => $request->kelas,
            'hari'            => strtolower($request->hari),
            'jam_mulai'       => $request->jam_mulai,
            'jam_selesai'     => $request->jam_selesai,
        ]);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal laboratorium berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jadwal = JadwalLaboratorium::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal laboratorium berhasil dihapus.');
    }
}
