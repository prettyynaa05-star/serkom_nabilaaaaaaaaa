@extends('layouts.app')

@section('title', 'Data Ekstrakurikuler')

@section('content')
    <div class="pc-content">
        <div class="card border-0 shadow-sm rounded-4">
            <div
                class="card-header bg-white border-0 pt-4 pb-3 px-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h3 class="mb-1 fw-bold text-dark">Data Ekstrakurikuler</h3>
                    <p class="text-muted text-sm mb-0">Kelola informasi kegiatan ekstrakurikuler sekolah.</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <div class="input-group input-group-sm shadow-sm rounded-pill overflow-hidden bg-white border"
                        style="width: 240px;">
                        <span class="input-group-text bg-white border-0 ps-3 text-muted">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" id="search-eskul" class="form-control border-0 px-2 shadow-none"
                            placeholder="Cari nama eskul atau pembina..." value="{{ request('search') }}"
                            autocomplete="off">
                    </div>
                    @if (Auth::user()->role === 'Admin')
                        <a href="{{ route('ekstrakurikuler.create') }}"
                            class="btn btn-primary btn-sm rounded-pill px-4 shadow-sm text-nowrap">
                            <i class="bi bi-plus-lg me-1"></i> Tambah Eskul Baru
                        </a>
                    @endif
                </div>
            </div>

            <div class="card-body px-4 pb-4">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4"
                        role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row" id="eskul-container">
                    @forelse ($ekstrakurikulers as $eskul)
                        <div class="col-lg-6 mb-4">
                            <div class="card border shadow-sm rounded-4 overflow-hidden h-100">
                                <div class="row g-0 h-100">
                                    <div class="col-md-5 position-relative bg-light" style="min-height: 200px;">
                                        @if ($eskul->gambar && file_exists(public_path('storage/ekstrakurikuler/' . $eskul->gambar)))
                                            <img src="{{ asset('storage/ekstrakurikuler/' . $eskul->gambar) }}"
                                                alt="Gambar"
                                                class="w-100 h-100 object-fit-cover position-absolute top-0 start-0">
                                        @else
                                            <div
                                                class="w-100 h-100 d-flex align-items-center justify-content-center text-primary bg-primary bg-opacity-10 position-absolute top-0 start-0">
                                                <i class="bi bi-image display-5"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-7 d-flex flex-column">
                                        <div class="card-body p-4 d-flex flex-column justify-content-between h-100">
                                            <div>
                                                <div class="d-flex justify-content-between align-items-start mb-1">
                                                    <h4 class="fw-bold text-dark mb-0" style="font-size: 1.15rem;">
                                                        {{ $eskul->nama_eskul }}</h4>
                                                </div>
                                                <span
                                                    class="badge bg-primary bg-opacity-10 text-primary px-3 py-1 rounded-pill fs-8 fw-semibold mb-2">
                                                    <i class="bi bi-person-badge me-1"></i> {{ $eskul->pembina }}
                                                </span>
                                                <p class="text-muted text-sm mb-3">
                                                    {{ $eskul->deskripsi }}
                                                </p>
                                            </div>
                                            <div>
                                                <div
                                                    class="d-flex align-items-center text-secondary text-sm mb-3 bg-light px-3 py-2 rounded-3">
                                                    <i class="bi bi-calendar-week text-primary me-2"></i>
                                                    <span class="fw-semibold text-dark">{{ $eskul->jadwal_latihan }}</span>
                                                </div>
                                                @if (Auth::user()->role === 'Admin')
                                                    <div class="d-flex gap-2 pt-2 border-top border-light">
                                                        <a href="{{ route('ekstrakurikuler.edit', base64_encode(Crypt::encryptString($eskul->id_eskul))) }}"
                                                            class="btn btn-sm btn-warning text-white me-1" title="Edit">
                                                            <i class="ti ti-edit"></i> Edit
                                                        </a>
                                                        <form
                                                            action="{{ route('ekstrakurikuler.destroy', $eskul->id_eskul) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?');"
                                                            class="flex-fill">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-semibold w-100">
                                                                <i class="bi bi-trash-fill me-1"></i> Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="text-center py-5">
                                <div class="card-body text-muted">
                                    <i class="bi bi-trophy display-4 mb-3 d-block text-secondary opacity-50"></i>
                                    <h5 class="fw-bold text-dark">Data ekstrakurikuler tidak ditemukan</h5>
                                    <p class="text-sm mb-3">Coba gunakan kata kunci pencarian yang lain.</p>
                                    @if (Auth::user()->role === 'Admin')
                                        <a href="{{ route('ekstrakurikuler.create') }}"
                                            class="btn btn-primary rounded-pill px-4 shadow-sm btn-sm">
                                            <i class="bi bi-plus-lg me-1"></i> Tambah Eskul Baru
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('search-eskul');
                const eskulContainer = document.getElementById('eskul-container');
                let debounceTimer;

                if (searchInput && eskulContainer) {
                    searchInput.addEventListener('input', function() {
                        clearTimeout(debounceTimer);
                        let keyword = this.value;

                        debounceTimer = setTimeout(function() {
                            fetch(`{{ route('ekstrakurikuler.index') }}?search=` + encodeURIComponent(
                                    keyword), {
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest'
                                    }
                                })
                                .then(response => response.text())
                                .then(html => {
                                    let parser = new DOMParser();
                                    let doc = parser.parseFromString(html, 'text/html');
                                    let newContainer = doc.getElementById('eskul-container');

                                    if (newContainer) {
                                        eskulContainer.innerHTML = newContainer.innerHTML;
                                    }

                                    const newInput = document.getElementById('search-eskul');
                                    if (newInput) {
                                        newInput.focus();
                                        let val = newInput.value;
                                        newInput.value = '';
                                        newInput.value = val;
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
