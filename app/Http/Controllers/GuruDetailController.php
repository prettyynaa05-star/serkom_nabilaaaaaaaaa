<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfilSekolah;
use App\Models\Guru;

class GuruDetailController extends Controller
{
    public function index()
    {
        $profil = ProfilSekolah::first();
        $gurus = Guru::all();

        return view('detail.guruDetail', compact('profil', 'gurus'));
    }

    public function show($id_guru)
    {
        $profil = ProfilSekolah::first();
        $guru = Guru::findOrFail($id_guru);

        return view('detail.guruDetail', compact('profil', 'guru'));
    }
}
