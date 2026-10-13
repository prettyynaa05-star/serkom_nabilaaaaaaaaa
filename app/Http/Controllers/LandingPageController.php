<?php

namespace App\Http\Controllers;

use App\Models\ProfilSekolah;
use App\Models\Berita;
use App\Models\Pengumuman;
use App\Models\Galeri;
use App\Models\Ekstrakurikuler;
use App\Models\Guru;
use App\Models\Siswa;

class LandingPageController extends Controller
{
    public function index()
    {
        $profil = ProfilSekolah::first();
        $gurus = Guru::take(3)->get();
        $ekstrakurikulers = Ekstrakurikuler::take(3)->get();
        $beritas = Berita::where('status', 'Publish')
            ->orderBy('id_berita', 'desc')
            ->take(3)
            ->get();
        $galeris = Galeri::take(3)->get();
        $pengumuman = Pengumuman::take(3)->get();

        $totalSiswa = Siswa::count();
        $totalGuru = Guru::count();
        $totalEskul = Ekstrakurikuler::count();

        return view('landingpage', compact(
            'profil',
            'gurus',
            'ekstrakurikulers',
            'beritas',
            'galeris',
            'pengumuman',
            'totalSiswa',
            'totalGuru',
            'totalEskul'
        ));
    }

    public function guru()
    {
        $profil = ProfilSekolah::first();
        $gurus = Guru::all();

        return view('guru.index', compact('profil', 'gurus'));
    }

    public function showGuru($id)
    {
        $profil = ProfilSekolah::first();
        $guru = Guru::findOrFail($id);

        return view('detail.guruDetail', compact('profil', 'guru')); // sesuaikan nama view detail guru kamu
    }

    public function showEkstrakurikuler($id)
    {
        $profil = ProfilSekolah::first();
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);

        return view('detail.ekstrakurikulerDetail', compact('profil', 'ekstrakurikuler'));
        // Sesuaikan 'ekstrakurikuler.detail' dengan nama file view folder detail eskul kamu
    }
}
