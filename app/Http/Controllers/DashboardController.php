<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Berita;
use App\Models\Pengumuman;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSiswa = Siswa::count();
        $totalGuru = Guru::count();
        $totalBerita = Berita::count();
        $pengumumanTerbaru = Pengumuman::orderBy('id_pengumuman', 'desc')->take(5)->get();

        return view('dashboard', compact(
            'totalSiswa',
            'totalGuru',
            'totalBerita',
            'pengumumanTerbaru'
        ));
    }
}
