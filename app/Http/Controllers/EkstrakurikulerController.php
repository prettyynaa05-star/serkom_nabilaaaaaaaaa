<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class EkstrakurikulerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $ekstrakurikulers = Ekstrakurikuler::when($search, function ($query) use ($search) {
            return $query->where('nama_eskul', 'like', "%{$search}%")
                ->orWhere('pembina', 'like', "%{$search}%");
        })->get();

        return view('ekstrakurikuler.index', compact('ekstrakurikulers'));
    }

    public function create()
    {
        return view('ekstrakurikuler.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_eskul'     => 'required|max:40|unique:ekstrakurikulers,nama_eskul',
            'pembina'        => 'required|max:40',
            'jadwal_latihan' => 'required|max:40',
            'deskripsi'      => 'required',
            'gambar'         => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'nama_eskul.unique' => 'Nama ekstrakurikuler ini sudah terdaftar, tidak boleh sama!',
        ]);

        $namaGambar = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaGambar = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/ekstrakurikuler'), $namaGambar);
        }

        Ekstrakurikuler::create([
            'nama_eskul'     => $request->nama_eskul,
            'pembina'        => $request->pembina,
            'jadwal_latihan' => $request->jadwal_latihan,
            'deskripsi'      => $request->deskripsi,
            'gambar'         => $namaGambar,
        ]);

        return redirect()->route('ekstrakurikuler.index')->with('success', 'Data ekstrakurikuler berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        try {
            $decryptedId = Crypt::decryptString(base64_decode($id));

            $eskul = Ekstrakurikuler::findOrFail($decryptedId);
            return view('ekstrakurikuler.edit', compact('eskul'));
        } catch (\Exception $e) {
            return redirect()->route('ekstrakurikuler.index')->with('error', 'Akses tidak valid!');
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $decryptedId = Crypt::decryptString(base64_decode($id));

            $request->validate([
                'nama_eskul'     => 'required|max:40',
                'pembina'        => 'required|max:40',
                'jadwal_latihan' => 'required|max:40',
                'deskripsi'      => 'required',
                'gambar'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $eskul = Ekstrakurikuler::findOrFail($decryptedId);

            $data = $request->only([
                'nama_eskul',
                'pembina',
                'jadwal_latihan',
                'deskripsi',
            ]);

            // Ganti gambar hanya jika pengguna mengunggah gambar baru.
            if ($request->hasFile('gambar')) {
                $folder = public_path('storage/ekstrakurikuler');

                if (!is_dir($folder)) {
                    mkdir($folder, 0755, true);
                }

                $file = $request->file('gambar');
                $namaGambar = time() . '_' . $file->getClientOriginalName();

                $file->move($folder, $namaGambar);

                // Hapus gambar lama setelah gambar baru berhasil disimpan.
                if (
                    $eskul->gambar &&
                    file_exists($folder . DIRECTORY_SEPARATOR . $eskul->gambar)
                ) {
                    unlink($folder . DIRECTORY_SEPARATOR . $eskul->gambar);
                }

                $data['gambar'] = $namaGambar;
            }

            $eskul->update($data);

            return redirect()
                ->route('ekstrakurikuler.index')
                ->with('success', 'Data ekstrakurikuler berhasil diperbarui!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            report($e);

            return redirect()
                ->route('ekstrakurikuler.index')
                ->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }

    public function destroy(string $id)
    {
        $eskul = Ekstrakurikuler::findOrFail($id);

        if ($eskul->gambar && file_exists(public_path('storage/ekstrakurikuler/' . $eskul->gambar))) {
            unlink(public_path('storage/ekstrakurikuler/' . $eskul->gambar));
        }

        $eskul->delete();

        return redirect()->route('ekstrakurikuler.index')->with('success', 'Data ekstrakurikuler berhasil dihapus!');
    }
}
