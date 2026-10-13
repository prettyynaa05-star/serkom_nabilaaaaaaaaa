@extends('layouts.app')

@section('title', 'Manajemen User')

@section('content')
    <div class="pc-content">
        <div class="card border-0 shadow-sm rounded-4">
            <!-- Header Card dengan Judul, Search Bar, dan Tombol Tambah -->
            <div
                class="card-header bg-white border-0 pt-4 pb-3 px-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h3 class="mb-1 fw-bold text-dark">Manajemen User</h3>
                    <p class="text-muted text-sm mb-0">Kelola akun Admin dan Operator sistem.</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <div class="input-group input-group-sm shadow-sm rounded-pill overflow-hidden bg-white border"
                        style="width: 240px;">
                        <span class="input-group-text bg-white border-0 ps-3 text-muted">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" id="search-user" class="form-control border-0 px-2 shadow-none"
                            placeholder="Cari username atau role..." value="{{ request('search') }}" autocomplete="off">
                    </div>
                    <a href="{{ route('users.create') }}"
                        class="btn btn-primary btn-sm rounded-pill px-4 shadow-sm text-nowrap">
                        <i class="bi bi-plus-lg me-1"></i> Tambah User
                    </a>
                </div>
            </div>

            <div class="card-body px-4 pb-4">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4 shadow-sm border-0"
                        role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show rounded-4 mb-4 shadow-sm border-0"
                        role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive" id="user-container">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-uppercase fs-8 text-secondary">
                            <tr>
                                <th class="py-3 ps-3" style="width: 60px;">No</th>
                                <th class="py-3">Username</th>
                                <th class="py-3">Role</th>
                                <th class="py-3 text-end pe-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $index =>$item)
                                <tr>
                                    <td class="py-3 ps-3 fw-semibold text-muted">{{ $users->firstItem() + $index }}</td>
                                    <td class="py-3">
                                        <span class="fw-bold text-dark"><i
                                                class="bi bi-person-badge text-primary me-2"></i>{{ $item->username }}</span>
                                    </td>
                                    <td class="py-3">
                                        @if ($item->role == 'Admin')
                                            <span
                                                class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill fw-semibold fs-8">Admin</span>
                                        @else
                                            <span
                                                class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-semibold fs-8">Operator</span>
                                        @endif
                                    </td>
                                    <td class="py-3 text-end pe-3">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('users.edit', base64_encode(Crypt::encryptString($item->id_user))) }}"
                                                class="btn btn-sm btn-warning text-white me-1" title="Edit">
                                                <i class="ti ti-edit"></i> Edit
                                            </a>

                                            <form action="{{ route('users.destroy', $item->id_user) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-outline-danger btn-sm rounded-pill px-3 fw-semibold">
                                                    <i class="bi bi-trash-fill me-1"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">
                                        <i class="bi bi-people display-4 mb-3 d-block text-secondary opacity-50"></i>
                                        <h5 class="fw-bold text-dark">Belum ada data user</h5>
                                        <p class="text-sm mb-3">Silakan tambahkan akun user baru melalui tombol di bawah.
                                        </p>
                                        <a href="{{ route('users.create') }}"
                                            class="btn btn-primary rounded-pill px-4 shadow-sm btn-sm">
                                            <i class="bi bi-plus-lg me-1"></i> Tambah User
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('search-user');
                const userContainer = document.getElementById('user-container');
                let debounceTimer;

                if (searchInput && userContainer) {
                    searchInput.addEventListener('input', function() {
                        clearTimeout(debounceTimer);
                        let keyword = this.value;

                        debounceTimer = setTimeout(function() {
                            fetch(`{{ route('users.index') }}?search=` + encodeURIComponent(keyword), {
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest'
                                    }
                                })
                                .then(response => response.text())
                                .then(html => {
                                    let parser = new DOMParser();
                                    let doc = parser.parseFromString(html, 'text/html');
                                    let newContainer = doc.getElementById('user-container');

                                    if (newContainer) {
                                        userContainer.innerHTML = newContainer.innerHTML;
                                    }

                                    const newInput = document.getElementById('search-user');
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
