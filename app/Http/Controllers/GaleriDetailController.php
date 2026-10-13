<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;

class GaleriDetailController extends Controller
{
    public function index()
    {
        $galeris = Galeri::all();

        return view('detail.galeriDetail', compact('galeris'));
    }

    public function show($id)
    {
        $galeri = Galeri::where('id_galeri', $id)->firstOrFail();

        return view('detail.galeriDetail', compact('galeri'));
    }
}
