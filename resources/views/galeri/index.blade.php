@extends('layouts.app')

@section('title', 'Data Galeri Sekolah')

@section('content')
    <div class="pc-content">
        <div class="card border-0 shadow-sm rounded-4">
            <div
                class="card-header bg-white border-0 pt-4 pb-3 px-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h3 class="mb-1 fw-bold text-dark">Data Galeri Sekolah</h3>
                    <p class="text-muted text-sm mb-0">Kelola dokumentasi foto dan video kegiatan sekolah dalam bentuk
                        galeri.</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <div class="input-group input-group-sm shadow-sm rounded-pill overflow-hidden bg-white border"
                        style="width: 240px;">
                        <span class="input-group-text bg-white border-0 ps-3 text-muted">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" id="search-galeri" class="form-control border-0 px-2 shadow-none"
                            placeholder="Cari judul atau keterangan..." value="{{ request('search') }}" autocomplete="off">
                    </div>
                    <a href="{{ route('galeri.create') }}"
                        class="btn btn-primary btn-sm rounded-pill px-4 shadow-sm text-nowrap">
                        <i class="bi bi-plus-lg me-1"></i> Tambah Galeri
                    </a>
                </div>
            </div>

            <div class="card-body px-4 pb-4">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4 shadow-sm" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div id="galeri-container">
                    <div class="row g-4">
                        @forelse ($galeris as $galeri)
                            <div class="col-xl-4 col-md-6">
                                <div class="card shadow-sm rounded-4 h-100 overflow-hidden bg-white">
                                    <div class="position-relative w-100 bg-dark" style="height: 260px;">
                                        @php
                                            $extension = pathinfo($galeri->file, PATHINFO_EXTENSION);
                                        @endphp

                                        @if (in_array(strtolower($extension), ['mp4', 'mkv', 'webm']))
                                            <video class="w-100 h-100 object-fit-cover" controls>
                                                <source src="{{ asset('storage/galeri/' . $galeri->file) }}"
                                                    type="video/{{ $extension }}">
                                                Browser Anda tidak mendukung tag video.
                                            </video>
                                        @else
                                            <img src="{{ asset('storage/galeri/' . $galeri->file) }}"
                                                alt="{{ $galeri->judul }}" class="w-100 h-100 object-fit-cover">
                                        @endif

                                        <div class="position-absolute bottom-0 start-0 w-100 p-3 text-white"
                                            style="background: linear-gradient(to top, rgba(0,0,0,0.85), rgba(0,0,0,0));">
                                            <div class="small mb-1 text-light opacity-75">
                                                <i class="bi bi-calendar3 me-1"></i>
                                                {{ date('d M Y', strtotime($galeri->tanggal)) }}
                                            </div>
                                            <h5 class="fw-bold mb-0 text-white text-truncate" title="{{ $galeri->judul }}">
                                                {{ $galeri->judul }}
                                            </h5>
                                        </div>
                                    </div>

                                    <div class="card-body d-flex flex-column p-4">
                                        <p class="text-muted small mb-4 flex-grow-1"
                                            style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
                                            {{ $galeri->keterangan }}
                                        </p>

                                        <div class="mt-auto pt-3 border-top d-flex gap-2">
                                            <a href="{{ route('galeri.edit', base64_encode(Crypt::encryptString($galeri->id_galeri))) }}"
                                                class="btn btn-sm btn-warning text-white me-1" title="Edit">
                                                <i class="ti ti-edit"></i> Edit
                                            </a>

                                            <form action="{{ route('galeri.destroy', $galeri->id_galeri) }}" method="POST"
                                                class="flex-grow-1"
                                                onsubmit="return confirm('Yakin ingin menghapus galeri ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-outline-danger btn-sm rounded-pill w-100 py-2 fw-semibold">
                                                    <i class="bi bi-trash me-1"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="card border-0 shadow-sm rounded-4 text-center py-5 bg-light">
                                    <div class="card-body py-5">
                                        <div class="mb-3">
                                            <i class="bi bi-images display-3 text-muted opacity-50"></i>
                                        </div>
                                        <h5 class="fw-bold text-dark">Belum Ada Galeri</h5>
                                        <p class="text-muted mb-4">Silakan tambahkan dokumentasi foto atau video kegiatan
                                            sekolah terlebih dahulu.</p>
                                        <a href="{{ route('galeri.create') }}"
                                            class="btn btn-primary rounded-pill px-4 shadow-sm">
                                            <i class="bi bi-plus-lg me-1"></i> Tambah Galeri Baru
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('search-galeri');
                const galeriContainer = document.getElementById('galeri-container');
                let debounceTimer;

                if (searchInput && galeriContainer) {
                    searchInput.addEventListener('input', function() {
                        clearTimeout(debounceTimer);
                        let keyword = this.value;

                        debounceTimer = setTimeout(function() {
                            fetch(`{{ route('galeri.index') }}?search=` + encodeURIComponent(
                                    keyword), {
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest'
                                    }
                                })
                                .then(response => response.text())
                                .then(html => {
                                    let parser = new DOMParser();
                                    let doc = parser.parseFromString(html, 'text/html');
                                    let newContainer = doc.getElementById('galeri-container');

                                    if (newContainer) {
                                        galeriContainer.innerHTML = newContainer.innerHTML;
                                    }

                                    const newInput = document.getElementById('search-galeri');
                                    if (newInput) {
                                        let val = newInput.value;
                                        newInput.value = '';
                                        newInput.value = val;
                                        newInput.focus();
                                    }
                                })
                                .catch(error => console.error('Error:', error));
                        }, 300);
                    });
                }
            });
        </script>
    @endpush
@endsection
