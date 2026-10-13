@extends('layouts.app')

@section('content')
    <div class="pc-content">
        <div class="card border-0 shadow-sm rounded-4">
            <div
                class="card-header bg-white border-0 pt-4 pb-3 px-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h3 class="mb-1 fw-bold text-dark" style="letter-spacing: -0.5px;">Data Guru</h3>
                    <p class="text-muted text-sm mb-0">Kelola informasi data guru dan pengajar sekolah.</p>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <div class="input-group input-group-sm shadow-sm rounded-pill overflow-hidden bg-white border"
                        style="width: 250px;">
                        <span class="input-group-text bg-white border-0 ps-3 text-muted">
                            <i class="ti ti-search"></i>
                        </span>
                        <input type="text" id="search-input" class="form-control border-0 px-2 shadow-none"
                            placeholder="Cari nama atau NIP..." value="{{ request('search') }}" autocomplete="off">
                    </div>
                    @if (Auth::user()->role === 'Admin')
                        <a href="{{ route('guru.create') }}"
                            class="btn btn-primary btn-sm rounded-pill px-4 shadow-sm text-nowrap">
                            <i class="ti ti-plus"></i> Tambah Guru Baru
                        </a>
                    @endif
                </div>
            </div>

            <div class="card-body px-4 pb-4">
                <!-- [ Alert Pesan Berhasil ] -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4"
                        role="alert">
                        <i class="ti ti-check me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div id="guru-container-wrapper">
                    <div class="row g-3" id="guru-grid-body">
                        @forelse ($gurus as $item)
                            <div class="col-xl-3 col-lg-4 col-md-6">
                                <div class="card border shadow-sm rounded-4 h-100">
                                    <div class="card-body p-3 text-center d-flex flex-column justify-content-between">

                                        <div>
                                            <div class="d-flex justify-content-center mb-2">
                                                @if ($item->foto)
                                                    <div class="overflow-hidden rounded-circle shadow-sm"
                                                        style="width: 65px; height: 65px;">
                                                        <img src="{{ asset('storage/' . $item->foto) }}"
                                                            alt="Foto {{ $item->nama_guru }}"
                                                            class="w-100 h-100 object-fit-cover">
                                                    </div>
                                                @else
                                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold shadow-sm"
                                                        style="width: 65px; height: 65px; font-size: 1.2rem;">
                                                        {{ strtoupper(substr($item->nama_guru, 0, 1)) }}
                                                    </div>
                                                @endif
                                            </div>
                                            <h6 class="fw-bold text-dark mb-0 text-truncate">{{ $item->nama_guru }}</h6>
                                            <small class="text-muted">NIP: {{ $item->nip }}</small>
                                            <hr class="my-2 text-muted opacity-25">
                                            <div class="text-start px-2 small">
                                                <div class="d-flex justify-content-between mb-1">
                                                    <span class="text-muted">Mapel:</span>
                                                    <span class="fw-semibold text-dark text-truncate"
                                                        style="max-width: 120px;"
                                                        title="{{ $item->mapel }}">{{ $item->mapel }}</span>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <span class="text-muted">Gender:</span>
                                                    <span
                                                        class="badge bg-light text-dark border">{{ $item->jenis_kelamin }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex gap-2 mt-3 pt-2 border-top">
                                            @if (Auth::user()->role === 'Admin')
                                                <a href="{{ route('guru.edit', base64_encode(Crypt::encryptString($item->id_guru))) }}"
                                                    class="btn btn-sm btn-warning w-50 rounded-pill text-white fw-semibold">
                                                    <i class="ti ti-edit me-1"></i> Edit
                                                </a>
                                                <form action="{{ route('guru.destroy', $item->id_guru) }}" method="POST"
                                                    class="w-50 m-0"
                                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-outline-danger w-100 rounded-pill fw-semibold">
                                                        Hapus
                                                    </button>
                                                </form>
                                            @else
                                                <div class="w-100 text-center text-muted small py-1">Akses dibatasi</div>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="card border-0 shadow-sm rounded-4 text-center py-5">
                                    <div class="card-body">
                                        <i class="ti ti-folder-open display-4 text-muted mb-3"></i>
                                        <p class="text-muted mb-0">Data guru tidak ditemukan.</p>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const gridBody = document.getElementById('guru-grid-body');
            let debounceTimer;
            searchInput.addEventListener('input', function() {
                clearTimeout(debounceTimer);
                let query = this.value;

                debounceTimer = setTimeout(function() {
                    fetch(`{{ route('guru.index') }}?search=` + encodeURIComponent(query), {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.text())
                        .then(html => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
                            const newGridBody = doc.getElementById('guru-grid-body');

                            if (newGridBody) {
                                gridBody.innerHTML = newGridBody.innerHTML;
                            }

                            const newInput = document.getElementById('search-input');
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
        });
    </script>
@endsection
