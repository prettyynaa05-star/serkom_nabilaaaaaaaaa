<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;

class BeritaDetailController extends Controller
{
    public function index()
    {
        $beritas = Berita::where('status', 'Publish')
            ->orderBy('id_berita', 'desc')
            ->get();

        return view('detail.beritaDetail', compact('beritas'));
    }

    public function show(string $id_berita)
    {
        $berita = Berita::where('id_berita', $id_berita)
            ->where('status', 'Publish')
            ->firstOrFail();

        return view('detail.beritaDetail', compact('berita'));
    }
}
