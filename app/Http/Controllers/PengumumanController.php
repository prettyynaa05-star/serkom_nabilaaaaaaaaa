<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class PengumumanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $pengumumans = Pengumuman::with('user')->when($search, function ($query) use ($search) {
            return $query->where('judul', 'like', "%{$search}%")
                ->orWhere('isi', 'like', "%{$search}%");
        })->orderBy('id_pengumuman', 'desc')->get();

        return view('pengumuman.index', compact('pengumumans'));
    }

    public function create()
    {
        return view('pengumuman.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'   => 'required|max:50',
            'isi'     => 'required',
            'tanggal' => 'required|date',
            'status'  => 'required|in:Publish,Draft',
        ]);

        Pengumuman::create([
            'judul'   => $request->judul,
            'isi'     => $request->isi,
            'tanggal' => $request->tanggal,
            'status'  => $request->status,
            'id_user' => Auth::id(),
        ]);

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil ditambahkan!');
    }

    public function edit($id)
    {
        try {
            $decryptedId = Crypt::decryptString(base64_decode($id));

            $pengumuman = Pengumuman::findOrFail($decryptedId);
            return view('pengumuman.edit', compact('pengumuman'));
        } catch (\Exception $e) {
            return redirect()->route('pengumuman.index')->with('error', 'Akses tidak valid!');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $decryptedId = Crypt::decryptString(base64_decode($id));

            $request->validate([
                'judul' => 'required|max:100',
                'isi' => 'required',
            ]);

            $pengumuman = Pengumuman::findOrFail($decryptedId);
            $pengumuman->update($request->all());

            return redirect()->route('pengumuman.index')->with('success', 'Data pengumuman berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->route('pengumuman.index')->with('error', 'Terjadi kesalahan sistem.');
        }
    }
    public function destroy($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->delete();

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil dihapus!');
    }
}
