<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{ route('dashboard') }}"
                class="b-brand text-primary d-flex align-items-center gap-2 text-decoration-none">
                @if (isset($profil) && $profil->logo)
                    <img src="{{ asset('storage/' . $profil->logo) }}" alt="Logo Sekolah"
                        style="max-height: 40px; width: auto; object-fit: contain;" />
                @else
                    <img src="{{ asset('assets/images/logo-dark.svg') }}" alt="logo" style="max-height: 40px;" />
                @endif
                <span class="fw-bold text-dark fs-6 text-truncate" style="max-width: 170px;">
                    {{ $profil->nama_sekolah ?? 'Profil Sekolah' }}
                </span>
            </a>
        </div>

        <div class="navbar-content" data-simplebar style="height: calc(100vh - 70px); overflow-y: auto;">
            <div class="dropdown pc-user-card px-3 py-2 mb-2">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle py-1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="flex-shrink-0">
                        <i class="ph-duotone ph-user-circle text-secondary"
                            style="font-size: 38px; line-height: 1;"></i>
                    </div>
                    <div class="flex-grow-1 ms-3 me-2 overflow-hidden">
                        <h6 class="mb-0 text-dark text-truncate fw-bold">{{ Auth::user()->username }}</h6>
                        <small class="text-muted">{{ Auth::user()->role }}</small>
                    </div>
                </a>
                <ul class="dropdown-menu shadow rounded-4 p-2 w-100 border-0">
                    <li>
                        <h6 class="dropdown-header text-uppercase fs-8">Informasi Akun</h6>
                    </li>
                    <li>
                        <hr class="dropdown-divider my-1">
                    </li>
                    <li>
                        <div class="px-3 py-1">
                            <span class="d-block text-muted" style="font-size: 11px;">Username:</span>
                            <strong class="text-dark">{{ Auth::user()->username }}</strong>
                        </div>
                    </li>
                    <li>
                        <div class="px-3 py-1 mb-2">
                            <span class="d-block text-muted" style="font-size: 11px;">Hak Akses:</span>
                            <span class="badge bg-light-primary text-primary">{{ Auth::user()->role }}</span>
                        </div>
                    </li>
                    <li>
                        <hr class="dropdown-divider my-1">
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger rounded-3 py-2 fw-semibold">
                                <i class="ph-duotone ph-sign-out me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>

            <ul class="pc-navbar">
                <li class="pc-item pc-caption">
                    <label>MENU UTAMA</label>
                </li>

                <li class="pc-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="pc-link">
                        <span class="pc-micon"><i class="ph-duotone ph-gauge"></i></span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>

                <li class="pc-item {{ request()->routeIs('profil.*') ? 'active' : '' }}">
                    <a href="{{ route('profil.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ph-duotone ph-buildings"></i></span>
                        <span class="pc-mtext">Profil Sekolah</span>
                    </a>
                </li>

                <li class="pc-item pc-caption">
                    <label>DATA AKADEMIK</label>
                </li>

                <li class="pc-item {{ request()->routeIs('siswa.*') ? 'active' : '' }}">
                    <a href="{{ route('siswa.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ph-duotone ph-student"></i></span>
                        <span class="pc-mtext">Data Siswa</span>
                    </a>
                </li>

                <li class="pc-item {{ request()->routeIs('guru.*') ? 'active' : '' }}">
                    <a href="{{ route('guru.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ph-duotone ph-chalkboard-teacher"></i></span>
                        <span class="pc-mtext">Data Guru</span>
                    </a>
                </li>

                <li class="pc-item {{ request()->routeIs('ekstrakurikuler.*') ? 'active' : '' }}">
                    <a href="{{ route('ekstrakurikuler.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ph-duotone ph-basketball"></i></span>
                        <span class="pc-mtext">Ekstrakurikuler</span>
                    </a>
                </li>

                <li class="pc-item pc-caption">
                    <label>INFORMASI & PUBLIKASI</label>
                </li>

                <li class="pc-item {{ request()->routeIs('berita.*') ? 'active' : '' }}">
                    <a href="{{ route('berita.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ph-duotone ph-newspaper"></i></span>
                        <span class="pc-mtext">Berita</span>
                    </a>
                </li>

                <li class="pc-item {{ request()->routeIs('pengumuman.*') ? 'active' : '' }}">
                    <a href="{{ route('pengumuman.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ph-duotone ph-bell"></i></span>
                        <span class="pc-mtext">Pengumuman</span>
                    </a>
                </li>

                <li class="pc-item {{ request()->routeIs('galeri.*') ? 'active' : '' }}">
                    <a href="{{ route('galeri.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ph-duotone ph-image"></i></span>
                        <span class="pc-mtext">Galeri</span>
                    </a>
                </li>

                @if (Auth::user()->role === 'Admin')
                    <li class="pc-item pc-caption">
                        <label>PENGATURAN</label>
                    </li>

                    <li class="pc-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
                        <a href="{{ route('users.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ph-duotone ph-user-gear"></i></span>
                            <span class="pc-mtext">Manajemen User</span>
                        </a>
                    </li>
                @endif

                <div class="mt-auto p-3 border-top">
                    <a href="{{ url('/') }}" target="_blank"
                        class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center gap-2 rounded-pill shadow-sm">
                        <i class="bi bi-globe"></i>
                        <span>Lihat Website</span>
                    </a>
                </div>
            </ul>
        </div>
    </div>
</nav>
