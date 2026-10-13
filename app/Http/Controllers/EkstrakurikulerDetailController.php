<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ekstrakurikuler;

class EkstrakurikulerDetailController extends Controller
{
    public function index()
    {
        $ekstrakurikulers = Ekstrakurikuler::all();
        return view('detail.ekstrakurikulerDetail', compact('ekstrakurikulers'));
    }

    public function show($id)
    {
        // Langsung cari berdasarkan primary key 'id'
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);

        return view('detail.ekstrakurikulerDetail', compact('ekstrakurikuler'));
    }
}
