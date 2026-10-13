@extends('layouts.app')

@section('title', 'Edit Profil Sekolah')

@section('content')
    <div class="page-header mb-4">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <h2 class="mb-0">Edit Profil Sekolah</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Terjadi Kesalahan!</strong> Mohon periksa kembali inputan Anda:
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Sekolah</label>
                                <input type="text" class="form-control @error('nama_sekolah') is-invalid @enderror"
                                    name="nama_sekolah" value="{{ old('nama_sekolah', $profil->nama_sekolah ?? '') }}"
                                    required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kepala Sekolah</label>
                                <input type="text" class="form-control @error('kepala_sekolah') is-invalid @enderror"
                                    name="kepala_sekolah" value="{{ old('kepala_sekolah', $profil->kepala_sekolah ?? '') }}"
                                    required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">NPSN</label>
                                <input type="text" class="form-control" name="npsn"
                                    value="{{ old('npsn', $profil->npsn ?? '') }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tahun Berdiri</label>
                                <input type="text" class="form-control" name="tahun_berdiri"
                                    value="{{ old('tahun_berdiri', $profil->tahun_berdiri ?? '') }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Logo Sekolah</label>
                                <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                    name="logo">
                                <small class="text-muted">Format: JPG, PNG, JPEG, WEBP. Maksimal 2MB.</small>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Foto Sekolah</label>
                                <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                    name="foto">
                                <small class="text-muted">Format: JPG, PNG, JPEG, WEBP. Maksimal 2MB.</small>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kontak / Telepon</label>
                                <input type="text" class="form-control" name="kontak"
                                    value="{{ old('kontak', $profil->kontak ?? '') }}">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Alamat Lengkap</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" rows="2" required>{{ old('alamat', $profil->alamat ?? '') }}</textarea>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Visi & Misi</label>
                                <textarea class="form-control" name="visi_misi" rows="4">{{ old('visi_misi', $profil->visi_misi ?? '') }}</textarea>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" rows="4">{{ old('deskripsi', $profil->deskripsi ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="text-end mt-3">
                            <a href="{{ route('profil.index') }}" class="btn btn-secondary me-2">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
