<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $galeris = Galeri::when($search, function ($query) use ($search) {
            return $query->where('judul', 'like', "%{$search}%")
                ->orWhere('keterangan', 'like', "%{$search}%");
        })->orderBy('id_galeri', 'desc')->get();

        return view('galeri.index', compact('galeris'));
    }

    public function create()
    {
        return view('galeri.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'      => 'required|max:50',
            'keterangan' => 'required',
            'file'       => 'required|file|mimes:jpeg,png,jpg,mp4,mkv|max:10240',
            'kategori'   => 'required|in:Foto,Video',
            'tanggal'    => 'required|date',
        ]);

        try {
            $namaFile = null;
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $namaFile = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('storage/galeri'), $namaFile);
            }

            Galeri::create([
                'judul'      => $request->judul,
                'keterangan' => $request->keterangan,
                'file'       => $namaFile,
                'kategori'   => $request->kategori,
                'tanggal'    => $request->tanggal,
            ]);

            return redirect()->route('galeri.index')->with('success', 'Galeri berhasil ditambahkan!');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $decryptedId = Crypt::decryptString(base64_decode($id));

            $galeri = Galeri::findOrFail($decryptedId);
            return view('galeri.edit', compact('galeri'));
        } catch (\Exception $e) {
            return redirect()->route('galeri.index')->with('error', 'Akses tidak valid!');
        }
    }

    public function update(Request $request, $id)
    {
        // Validasi diletakkan di luar try-catch agar error form muncul secara normal
        $request->validate([
            'judul'      => 'required|max:50',
            'keterangan' => 'required',
            'file'       => 'nullable|file|mimes:jpeg,png,jpg,mp4,mkv,webm,mov|max:10240',
            'kategori'   => 'required|in:Foto,Video',
            'tanggal'    => 'required|date',
        ]);

        try {
            $decryptedId = Crypt::decryptString(base64_decode($id));
            $galeri = Galeri::findOrFail($decryptedId);

            $namaFile = $galeri->file;
            if ($request->hasFile('file')) {
                // Hapus file lama jika ada
                if ($galeri->file && file_exists(public_path('storage/galeri/' . $galeri->file))) {
                    @unlink(public_path('storage/galeri/' . $galeri->file));
                }

                $file = $request->file('file');
                $namaFile = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('storage/galeri'), $namaFile);
            }

            $galeri->update([
                'judul'      => $request->judul,
                'keterangan' => $request->keterangan,
                'file'       => $namaFile,
                'kategori'   => $request->kategori,
                'tanggal'    => $request->tanggal,
            ]);

            return redirect()->route('galeri.index')->with('success', 'Data galeri berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->route('galeri.index')->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        if ($galeri->file && file_exists(public_path('storage/galeri/' . $galeri->file))) {
            unlink(public_path('storage/galeri/' . $galeri->file));
        }
        $galeri->delete();
        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil dihapus!');
    }
}
