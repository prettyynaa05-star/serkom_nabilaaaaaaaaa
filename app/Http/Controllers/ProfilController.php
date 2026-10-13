<?php

namespace App\Http\Controllers;

use App\Models\ProfilSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function index()
    {
        $profil = ProfilSekolah::first();
        return view('profil.index', compact('profil'));
    }

    public function edit()
    {
        $profil = ProfilSekolah::first();
        return view('profil.edit', compact('profil'));
    }

    public function update(Request $request)
    {
        // Validasi input form
        $request->validate([
            'nama_sekolah'   => 'required',
            'kepala_sekolah' => 'required',
            'alamat'         => 'required',
            'kontak'         => 'nullable',
            'npsn'           => 'nullable',
            'tahun_berdiri'  => 'nullable',
            'visi_misi'      => 'nullable',
            'deskripsi'      => 'nullable',
            'logo'           => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'foto'           => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $profil = ProfilSekolah::first();
        $data = $request->except(['logo', 'foto']);

        if ($request->hasFile('logo')) {
            if ($profil && $profil->logo && Storage::disk('public')->exists($profil->logo)) {
                Storage::disk('public')->delete($profil->logo);
            }
            $data['logo'] = $request->file('logo')->store('logo-sekolah', 'public');
        } else {
            $data['logo'] = $profil->logo ?? null;
        }

        if ($request->hasFile('foto')) {
            if ($profil && $profil->foto && Storage::disk('public')->exists($profil->foto)) {
                Storage::disk('public')->delete($profil->foto);
            }
            $data['foto'] = $request->file('foto')->store('foto-sekolah', 'public');
        } else {
            $data['foto'] = $profil->foto ?? null;
        }

        if ($profil) {
            $profil->update($data);
        } else {
            ProfilSekolah::create($data);
        }

        return redirect()->route('profil.index')->with('success', 'Profil sekolah berhasil diperbarui!');
    }
}
