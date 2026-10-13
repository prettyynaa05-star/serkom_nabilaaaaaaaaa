<style>
    .navbar {
        background-color: #fff;
        z-index: 1030;
    }

    .navbar-nav .nav-link {
        color: #343a40;
        font-weight: 600;
        padding: 10px 16px !important;
        border-radius: 50px;
        transition: all 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
        color: #0d6efd !important;
        background-color: #eef5ff;
    }

    .navbar-nav .nav-link.active {
        color: #0d6efd !important;
        background-color: #e7f1ff;
        font-weight: 700;
    }

    .navbar-brand img {
        height: 35px;
        width: auto;
        object-fit: contain;
    }

    @media (max-width: 991px) {
        .navbar-nav {
            padding-top: 15px;
            align-items: stretch !important;
        }

        .navbar-nav .nav-link {
            padding: 10px 15px !important;
        }

        .navbar-nav .nav-item {
            margin-left: 0 !important;
        }
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm py-3">
    <div class="container">

        <a class="navbar-brand fw-bold text-dark d-flex align-items-center gap-2" href="{{ route('landing') }}">
            @if (isset($profil) && $profil->logo)
                <img src="{{ asset('storage/' . $profil->logo) }}" alt="Logo">
            @elseif (isset($profil) && $profil->foto)
                <img src="{{ asset('storage/' . $profil->foto) }}" alt="Logo">
            @else
                <i class="fa-solid fa-graduation-cap text-primary fs-4"></i>
            @endif
            <span>{{ $profil->nama_sekolah ?? 'SMP NEGERI 14 BANDUNG' }}</span>
        </a>

        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center gap-3">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('landing') ? 'active' : '' }}"
                        href="{{ route('landing') }}" @if (request()->routeIs('landing')) aria-current="page" @endif>
                        Beranda
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('tentang*') || request()->is('profil-sekolah*') ? 'active' : '' }}"
                        href="{{ url('/tentang') }}" @if (request()->is('tentang*') || request()->is('profil-sekolah*')) aria-current="page" @endif>
                        Profil
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('info-guru*') ? 'active' : '' }}"
                        href="{{ route('landing.guru') }}">Guru & Staf</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('info-ekstrakurikuler*') ? 'active' : '' }}"
                        href="{{ route('landing.ekstrakurikuler') }}"
                        @if (request()->is('info-ekstrakurikuler*')) aria-current="page" @endif>
                        Ekstrakurikuler
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('info-galeri*') ? 'active' : '' }}"
                        href="{{ route('landing.galeri') }}"
                        @if (request()->is('info-galeri*')) aria-current="page" @endif>
                        Galeri
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('landing.berita.*') ? 'active' : '' }}"
                        href="{{ route('landing.berita.index') }}"
                        @if (request()->routeIs('landing.berita.*')) aria-current="page" @endif>
                        Berita
                    </a>
                </li>

                <!-- Tombol Halaman Pembuat -->
                <li class="nav-item ms-lg-2">
                    <a href="{{ route('detail.pembuatDetail') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
                        Pembuat
                    </a>
                </li>

                {{-- <!-- Tombol Login / Dashboard -->
                <li class="nav-item">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary rounded-pill px-4">
                            Login
                        </a>
                    @endauth
                </li> --}}
            </ul>
        </div>
    </div>
</nav>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuLinks = document.querySelectorAll(
            '.navbar-nav .nav-link'
        );

        function setActiveMenu(selectedLink) {
            menuLinks.forEach(function(link) {
                link.classList.remove('active');
                link.removeAttribute('aria-current');
            });

            if (selectedLink) {
                selectedLink.classList.add('active');
                selectedLink.setAttribute('aria-current', 'page');
            }
        }

        menuLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                const href = link.getAttribute('href');

                if (href && (link.dataset.menu === 'galeri' ||
                        link.dataset.menu === 'kontak')) {
                    setActiveMenu(link);
                }
            });
        });

        function updateScrollActive() {
            const galeri = document.getElementById('galeri');
            const kontak = document.getElementById('kontak');

            if (!galeri && !kontak) return;
            const scrollPosition = window.scrollY + 180;
            if (kontak && scrollPosition >= kontak.offsetTop) {
                setActiveMenu(document.querySelector('[data-menu="kontak"]'));
            } else if (galeri && scrollPosition >= galeri.offsetTop) {
                setActiveMenu(document.querySelector('[data-menu="galeri"]'));
            }
        }
        if (window.location.hash === '#galeri') {
            setActiveMenu(document.querySelector('[data-menu="galeri"]'));
        } else if (window.location.hash === '#kontak') {
            setActiveMenu(document.querySelector('[data-menu="kontak"]'));
        }
        window.addEventListener('scroll', updateScrollActive);
    });
</script>
