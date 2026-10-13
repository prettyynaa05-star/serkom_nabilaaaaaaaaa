<?php

namespace App\Http\Controllers;

use App\Models\ProfilSekolah;

class ProfilDetailController extends Controller
{
    public function index()
    {
        $profil = ProfilSekolah::first();

        return view('detail.profilDetail', compact('profil'));
    }
}
