<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembuat;

class PembuatController extends Controller
{
    public function index()
    {
        $pembuat = Pembuat::first();
        return view('detail.pembuatDetail', compact('pembuat'));
    }

    public function pembuatDetail()
    {
        $pembuat = Pembuat::first();
        return view('detail.pembuatDetail', compact('pembuat'));
    }
}