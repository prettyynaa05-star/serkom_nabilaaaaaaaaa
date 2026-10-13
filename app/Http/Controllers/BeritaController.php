<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $beritas = Berita::when($search, function ($query) use ($search) {
            return $query->where('judul', 'like', "%{$search}%")
                ->orWhere('isi', 'like', "%{$search}%");
        })->orderBy('id_berita', 'desc')->get();

        return view('berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:50',
            'isi' => 'required',
            'tanggal' => 'required|date',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:Publish,Draft',
        ]);

        $namaGambar = null;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaGambar = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/berita'), $namaGambar);
        }

        Berita::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tanggal' => $request->tanggal,
            'gambar' => $namaGambar,
            'status' => $request->status,
            'id_user' => Auth::id(),
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    public function edit($id)
    {
        try {
            $decryptedId = Crypt::decryptString(base64_decode($id));
            $berita = Berita::findOrFail($decryptedId);

            return view('berita.edit', compact('berita'));
        } catch (\Exception $e) {
            return redirect()->route('berita.index')->with('error', 'Akses tidak valid!');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $decryptedId = Crypt::decryptString(base64_decode($id));
            $berita = Berita::findOrFail($decryptedId);

            $request->validate([
                'judul' => 'required|max:50',
                'isi' => 'required',
                'tanggal' => 'required|date',
                'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'status' => 'required|in:Publish,Draft',
            ]);

            $data = [
                'judul' => $request->judul,
                'isi' => $request->isi,
                'tanggal' => $request->tanggal,
                'status' => $request->status,
            ];

            if ($request->hasFile('gambar')) {
                if ($berita->gambar && file_exists(public_path('storage/berita/' . $berita->gambar))) {
                    unlink(public_path('storage/berita/' . $berita->gambar));
                }

                $file = $request->file('gambar');
                $namaGambar = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('storage/berita'), $namaGambar);
                $data['gambar'] = $namaGambar;
            }

            $berita->update($data);

            return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan sistem.');
        }
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        if ($berita->gambar && file_exists(public_path('storage/berita/' . $berita->gambar))) {
            unlink(public_path('storage/berita/' . $berita->gambar));
        }

        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus!');
    }
}
