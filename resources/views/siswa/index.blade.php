@extends('layouts.app')

@section('content')
    <div class="pc-content">
        <div class="card border-0 shadow-sm rounded-4">

            <div
                class="card-header bg-white border-0 pt-4 pb-3 px-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h3 class="mb-1 fw-bold text-dark" style="letter-spacing: -0.5px;">Data Siswa</h3>
                    <p class="text-muted text-sm mb-0">Kelola informasi data siswa sekolah.</p>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <div class="input-group input-group-sm shadow-sm rounded-pill overflow-hidden bg-white border"
                        style="width: 250px;">
                        <span class="input-group-text bg-white border-0 ps-3 text-muted">
                            <i class="ti ti-search"></i>
                        </span>
                        <input type="text" id="search-input" class="form-control border-0 px-2 shadow-none"
                            placeholder="Cari nama atau NISN..." value="{{ request('search') }}" autocomplete="off">
                    </div>

                    @if (Auth::user()->role === 'Admin')
                        <a href="{{ route('siswa.create') }}"
                            class="btn btn-primary btn-sm rounded-pill px-4 shadow-sm text-nowrap">
                            <i class="ti ti-plus"></i> Tambah Siswa
                        </a>
                    @endif
                </div>
            </div>

            <div class="card-body px-4 pb-4">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4"
                        role="alert">
                        <i class="ti ti-check me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive" id="table-siswa-container">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NISN</th>
                                <th>Nama Siswa</th>
                                <th>Jenis Kelamin</th>
                                <th>Tahun Masuk</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="siswa-table-body">
                            @forelse($siswas as $index =>$siswa)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $siswa->nisn }}</td>
                                    <td>{{ $siswa->nama_siswa }}</td>
                                    <td>{{ $siswa->jenis_kelamin }}</td>
                                    <td>{{ $siswa->tahun_masuk }}</td>
                                    <td class="text-center">
                                        @if (Auth::user()->role === 'Admin')
                                            <a href="{{ route('siswa.edit', base64_encode(Crypt::encryptString($siswa->id_siswa))) }}"
                                                class="btn btn-sm btn-warning text-white me-1" title="Edit">
                                                <i class="ti ti-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('siswa.destroy', $siswa->id_siswa) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                    <i class="ti ti-trash"></i> Hapus
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-muted">akses dibatasi</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">Data siswa tidak ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const tableBody = document.getElementById('siswa-table-body');

            let debounceTimer;

            searchInput.addEventListener('input', function() {
                clearTimeout(debounceTimer);
                let query = this.value;

                debounceTimer = setTimeout(function() {
                    fetch(`{{ route('siswa.index') }}?search=` + encodeURIComponent(query), {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.text())
                        .then(html => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
                            const newTbody = doc.getElementById('siswa-table-body');

                            if (newTbody) {
                                tableBody.innerHTML = newTbody.innerHTML;
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
