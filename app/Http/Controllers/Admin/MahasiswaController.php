<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'mahasiswa');
        
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        if ($request->has('prodi') && $request->prodi != '') {
            $query->where('prodi', $request->prodi);
        }

        $mahasiswas = $query->orderBy('name')->paginate(10)->withQueryString();
        return view('admin.mahasiswa.index', compact('mahasiswas'));
    }

    public function create()
    {
        return view('admin.mahasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'nim' => 'required|string|unique:users',
            'prodi' => ['required', Rule::in(['Teknik Informatika', 'Sistem Informasi'])]
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'mahasiswa',
            'nim' => $request->nim,
            'prodi' => $request->prodi,
        ]);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Akun mahasiswa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $mahasiswa = User::where('role', 'mahasiswa')->findOrFail($id);
        return view('admin.mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = User::where('role', 'mahasiswa')->findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($mahasiswa->id)],
            'nim' => ['required', 'string', Rule::unique('users')->ignore($mahasiswa->id)],
            'prodi' => ['required', Rule::in(['Teknik Informatika', 'Sistem Informasi'])]
        ]);

        $mahasiswa->update([
            'name' => $request->name,
            'email' => $request->email,
            'nim' => $request->nim,
            'prodi' => $request->prodi,
        ]);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $mahasiswa = User::where('role', 'mahasiswa')->findOrFail($id);
        $mahasiswa->delete();

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Akun mahasiswa berhasil dihapus.');
    }

    public function resetPassword(Request $request, $id)
    {
        $mahasiswa = User::where('role', 'mahasiswa')->findOrFail($id);
        
        $request->validate([
            'password' => 'required|string|min:8'
        ]);

        $mahasiswa->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Password mahasiswa berhasil direset.');
    }
}
