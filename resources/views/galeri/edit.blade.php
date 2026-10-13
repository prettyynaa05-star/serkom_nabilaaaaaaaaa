@extends('layouts.app')

@section('title', 'Edit Data Galeri')

@section('content')
    <div class="pc-content">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-0 pt-4 pb-3 px-4">
                <h3 class="mb-1 fw-bold text-dark">Edit Data Galeri</h3>
                <p class="text-muted text-sm mb-0">Perbarui informasi dokumentasi foto atau video kegiatan sekolah.</p>
            </div>

            <div class="card-body px-4 pb-4">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show rounded-4 mb-4 shadow-sm" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> Terjadi kesalahan input. Periksa kembali form di
                        bawah.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form
                    action="{{ route('galeri.update', base64_encode(Crypt::encryptString($galeri->id_galeri ?? $galeri->id))) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="judul" class="form-label fw-semibold text-dark">Judul Kegiatan</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul"
                                name="judul" value="{{ old('judul', $galeri->judul) }}"
                                placeholder="Masukkan judul kegiatan...">
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="tanggal" class="form-label fw-semibold text-dark">Tanggal Kegiatan</label>
                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal"
                                name="tanggal" value="{{ old('tanggal', $galeri->tanggal) }}">
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- TAMBAHAN INPUT KATEGORI DI SINI -->
                        <div class="col-md-6">
                            <label for="kategori" class="form-label fw-semibold text-dark">Kategori</label>
                            <select class="form-control @error('kategori') is-invalid @enderror" id="kategori"
                                name="kategori">
                                <option value="">Pilih Kategori</option>
                                <option value="Foto" {{ old('kategori', $galeri->kategori) == 'Foto' ? 'selected' : '' }}>
                                    Foto</option>
                                <option value="Video"
                                    {{ old('kategori', $galeri->kategori) == 'Video' ? 'selected' : '' }}>Video</option>
                            </select>
                            @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="file" class="form-label fw-semibold text-dark">File Foto / Video</label>
                            <input type="file" class="form-control @error('file') is-invalid @enderror" id="file"
                                name="file">
                            <div class="form-text text-muted mt-1">Format: JPG, PNG, MP4, dll. Biarkan kosong jika tidak
                                ingin mengubah file.</div>
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @if ($galeri->file)
                            <div class="col-12">
                                <span class="d-block fw-semibold text-dark mb-2">File Saat Ini:</span>
                                <div class="overflow-hidden rounded-4 border shadow-sm bg-dark"
                                    style="width: 200px; height: 140px; position: relative;">
                                    @php
                                        $extension = pathinfo($galeri->file, PATHINFO_EXTENSION);
                                    @endphp
                                    @if (in_array(strtolower($extension), ['mp4', 'webm', 'ogg', 'mov']))
                                        <video class="w-100 h-100 object-fit-cover position-absolute top-0 start-0"
                                            controls>
                                            <source src="{{ asset('storage/galeri/' . $galeri->file) }}"
                                                type="video/{{ $extension }}">
                                        </video>
                                    @else
                                        <img src="{{ asset('storage/galeri/' . $galeri->file) }}" alt="Preview Galeri"
                                            class="w-100 h-100 object-fit-cover">
                                    @endif
                                </div>
                            </div>
                        @endif

                        <div class="col-12">
                            <label for="keterangan" class="form-label fw-semibold text-dark">Keterangan</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan"
                                rows="3" placeholder="Masukkan keterangan tambahan...">{{ old('keterangan', $galeri->keterangan) }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 d-flex justify-content-end gap-2 pt-3 border-top">
                            <a href="{{ route('galeri.index') }}" class="btn btn-secondary px-4 rounded-pill shadow-sm">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm">
                                Perbarui Data
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
