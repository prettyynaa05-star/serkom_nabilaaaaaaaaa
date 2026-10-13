<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use Illuminate\Support\Facades\Crypt;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $siswas = Siswa::when($search, function ($query, $search) {
            return $query->where('nama_siswa', 'like', "%{$search}%")
                ->orWhere('nisn', 'like', "%{$search}%");
        })->get();

        return view('siswa.index', compact('siswas'));
    }

    public function create()
    {
        return view('siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn'          => 'required|max:10|unique:siswas,nisn',
            'nama_siswa'    => 'required|max:40',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'tahun_masuk'   => 'required|digits:4',
        ], [
            'nisn.unique'   => 'NISN ini sudah terdaftar, gunakan NISN yang lain!',
        ]);

        Siswa::create([
            'nisn'          => $request->nisn,
            'nama_siswa'    => $request->nama_siswa,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tahun_masuk'   => $request->tahun_masuk,
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan!');
    }

    public function edit($id)
    {
        try {
            $decryptedId = Crypt::decryptString(base64_decode($id));
            $siswa = Siswa::findOrFail($decryptedId);
            return view('siswa.edit', compact('siswa'));
        } catch (\Exception $e) {
            return redirect()->route('siswa.index')->with('error', 'Akses tidak valid!');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $decryptedId = Crypt::decryptString(base64_decode($id));

            $request->validate([
                'nisn' => 'required|max:10|unique:siswas,nisn,' . $decryptedId . ',id_siswa',
                'nama_siswa' => 'required|max:40',
                'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
                'tahun_masuk' => 'required|digits:4',
            ]);

            $siswa = Siswa::findOrFail($decryptedId);
            $siswa->update([
                'nisn' => $request->nisn,
                'nama_siswa' => $request->nama_siswa,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tahun_masuk' => $request->tahun_masuk,
            ]);

            return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->route('siswa.index')->with('error', 'Terjadi kesalahan sistem.');
        }
    }
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus!');
    }
}
