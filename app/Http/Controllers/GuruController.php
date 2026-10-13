<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\ProfilSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $gurus = Guru::when($search, function ($query, $search) {
            return $query->where('nama_guru', 'LIKE', "%{$search}%")
                ->orWhere('nip', 'LIKE', "%{$search}%");
        })->get();

        return view('guru.index', compact('gurus'));
    }

    public function create()
    {
        return view('guru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|max:20|unique:gurus,nip',
            'nama_guru' => 'required|max:50',
            'mapel' => 'required|max:50',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'nip.unique' => 'NIP ini sudah terdaftar!',
            'nip.required' => 'NIP wajib diisi!',
            'nama_guru.required' => 'Nama guru wajib diisi!',
            'mapel.required' => 'Mata pelajaran wajib diisi!',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih!',
        ]);

        $namaFoto = null;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/guru'), $filename);
            $namaFoto = 'guru/' . $filename;
        }

        Guru::create([
            'nip' => $request->nip,
            'nama_guru' => $request->nama_guru,
            'mapel' => $request->mapel,
            'jenis_kelamin' => $request->jenis_kelamin,
            'foto' => $namaFoto,
        ]);

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan!');
    }

    public function show($id)
    {

        $guru = Guru::findOrFail($id);
        $profil = ProfilSekolah::first();

        return view('guru.detail', compact('guru', 'profil'));
    }
    public function edit($id)
    {
        try {
            $decryptedId = Crypt::decryptString(base64_decode($id));
            $guru = Guru::findOrFail($decryptedId);
            return view('guru.edit', compact('guru'));
        } catch (\Exception $e) {
            return redirect()->route('guru.index')->with('error', 'Akses tidak valid!');
        }
    }

    public function update(Request $request, $id)
    {
        $decryptedId = Crypt::decryptString(base64_decode($id));
        $guru = Guru::findOrFail($decryptedId);

        $request->validate([
            'nip' => 'required',
            'nama_guru' => 'required',
            'mapel' => 'required',
            'jenis_kelamin' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'nip' => $request->nip,
            'nama_guru' => $request->nama_guru,
            'mapel' => $request->mapel,
            'jenis_kelamin' => $request->jenis_kelamin,
        ];

        if ($request->hasFile('foto')) {
            if ($guru->foto && file_exists(public_path('storage/' . $guru->foto))) {
                unlink(public_path('storage/' . $guru->foto));
            }

            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/guru'), $filename);
            $data['foto'] = 'guru/' . $filename;
        }

        $guru->update($data);

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $guru = Guru::findOrFail($id);

        if ($guru->foto && file_exists(public_path('storage/' . $guru->foto))) {
            unlink(public_path('storage/' . $guru->foto));
        }

        $guru->delete();

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus!');
    }
}
