@extends('layouts.frontend')

@section('content')
    <!-- 2. HERO SECTION -->
    <section id="beranda" class="hero-section text-center text-lg-start position-relative overflow-hidden"
        style="background-image: linear-gradient(rgba(15, 23, 42, 0.75), rgba(30, 27, 75, 0.85)), url('{{ asset('storage/' . $profil->foto) }}') !important; background-size: cover !important; background-position: center !important; background-repeat: no-repeat !important;">
        <div class="container py-5 position-relative" style="z-index: 2;">
            <div class="row align-items-center g-5">
                <div class="col-lg-7" data-aos="fade-right" data-aos-duration="1000">
                    <span class="badge badge-soft px-3 py-2 rounded-pill mb-3 fw-bold">✨ Selamat Datang di Portal
                        Resmi</span>
                    <h1 class="display-4 fw-bold mb-3 lh-sm text-white">
                        {{ $profil->nama_sekolah ?? 'Membangun Generasi Unggul & Berprestasi' }}</h1>
                    <p class="lead text-white-50 mb-4">
                        {{ $profil->sejarah ?? 'Pusat informasi akademik, kegiatan siswa, prestasi gemilang, dan profil lengkap sekolah kami.' }}
                    </p>
                    <div class="d-flex justify-content-center justify-content-lg-start gap-3">
                        <a href="#berita" class="btn btn-primary btn-lg rounded-pill px-5 shadow">Jelajahi Berita</a>
                        <a href="{{ url('/tentang') }}" class="btn btn-outline-light btn-lg rounded-pill px-5">Profil
                            Kami</a>
                    </div>
                </div>
                <div class="col-lg-5 text-center" data-aos="fade-left" data-aos-duration="1000">
                    <div
                        class="p-4 bg-white bg-opacity-10 backdrop-blur rounded-5 border border-light border-opacity-10 shadow-lg">
                        <i class="fa-solid fa-school-flag text-primary display-1 mb-3 text-white"></i>
                        <h3 class="fw-bold text-white">Terakreditasi {{ $profil->akreditasi ?? 'A' }}</h3>
                        <p class="text-white-50 small mb-0">Berkomitmen melahirkan lulusan berkarakter, kompeten, dan siap
                            bersaing di era digital.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Statistik Minimalis -->
    <div class="container" style="position: relative; z-index: 10; margin-top: -50px;" data-aos="fade-up"
        data-aos-duration="1000">
        <div class="card border-0 shadow-lg rounded-5 overflow-hidden"
            style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);">
            <div class="card-body py-4 px-4 px-lg-5">
                <div class="row text-center g-4 align-items-center justify-content-around">
                    <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                        <div class="d-flex align-items-center justify-content-center gap-3">
                            <i class="ti ti-certificate fs-1 text-primary"></i>
                            <div class="text-start">
                                <h2 class="fw-bold display-6 mb-0 text-dark">{{ $profil->akreditasi ?? 'A' }}</h2>
                                <small class="text-muted fw-semibold">Akreditasi</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                        <div class="d-flex align-items-center justify-content-center gap-3">
                            <i class="ti ti-users fs-1 text-primary"></i>
                            <div class="text-start">
                                <h2 class="fw-bold display-6 mb-0 text-dark">{{ $totalSiswa ?? 0 }}</h2>
                                <small class="text-muted fw-semibold">Siswa</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                        <div class="d-flex align-items-center justify-content-center gap-3">
                            <i class="ti ti-user-shield fs-1 text-primary"></i>
                            <div class="text-start">
                                <h2 class="fw-bold display-6 mb-0 text-dark">{{ $totalGuru ?? 0 }}</h2>
                                <small class="text-muted fw-semibold">Guru</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                        <div class="d-flex align-items-center justify-content-center gap-3">
                            <i class="ti ti-trophy fs-1 text-primary"></i>
                            <div class="text-start">
                                <h2 class="fw-bold display-6 mb-0 text-dark">{{ $totalEskul ?? 0 }}</h2>
                                <small class="text-muted fw-semibold">Ekstrakurikuler</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Sambutan Kepala Sekolah -->
    <section id="tentang" class="py-5">
        <div class="container">
            <style>
                .card-hover {
                    transition: transform 0.3s ease, box-shadow 0.3s ease;
                }

                .card-hover:hover {
                    transform: translateY(-6px);
                    box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
                }
            </style>
            <div class="card border-0 shadow-sm rounded-4 p-4 p-lg-5 bg-white">
                <div class="row align-items-center g-4">
                    <div class="col-lg-7" data-aos="fade-right" data-aos-duration="1000">
                        <span class="text-primary fw-semibold small text-uppercase">Sambutan Kepala Sekolah</span>
                        <h2 class="fw-bold text-dark mb-3">Mewujudkan Pendidikan Bermutu Berbasis Karakter</h2>
                        <p class="text-muted mb-4">
                            {{ $profil->sambutan ?? 'Selamat datang di website resmi sekolah kami. Teknologi dan informasi terus berkembang, dan kami siap menghadirkan transparansi serta kemudahan akses informasi bagi orang tua, siswa, dan masyarakat.' }}
                        </p>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div class="p-3 border rounded-4 bg-light h-100 card-hover">
                                    <h6 class="fw-bold text-dark mb-1"><i class="ti ti-book me-2 text-primary"></i>Kurikulum
                                    </h6>
                                    <p class="text-muted small mb-0">
                                        {{ $profil->kurikulum ?? 'Kurikulum Merdeka / Nasional' }}</p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="p-3 border rounded-4 bg-light h-100 card-hover">
                                    <h6 class="fw-bold text-dark mb-1"><i class="ti ti-award me-2 text-primary"></i>Mutu
                                    </h6>
                                    <p class="text-muted small mb-0">{{ $profil->mutu ?? 'Unggul & Berprestasi' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5" data-aos="fade-left" data-aos-duration="1000">
                        <div class="card border rounded-4 shadow-sm text-center p-4 bg-light card-hover">
                            <div class="card-body">
                                <div class="mb-3 d-flex justify-content-center">
                                    <div class="overflow-hidden rounded-4 shadow-sm border-3 border-white"
                                        style="width: 180px; height: 220px;">
                                        <img src="{{ asset('storage/images/kepalasekolah.jpg') }}" alt="Kepala Sekolah"
                                            class="w-100 h-100 object-fit-cover">
                                    </div>
                                </div>
                                <h5 class="fw-bold text-dark mb-1">{{ $profil->kepala_sekolah }}</h5>
                                <p class="text-muted small mb-0">Kepala Sekolah</p>
                                <hr class="my-3 text-muted opacity-25">
                                <p class="fst-italic small text-muted mb-0">"Pendidikan adalah investasi paling berharga
                                    untuk masa depan bangsa."</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Daftar Guru & Staff -->
    <section class="py-5 bg-light" id="guru">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-dark">Daftar Guru & Staff</h2>
                <p class="text-muted">Tenaga pendidik profesional yang berdedikasi di sekolah kami.</p>
            </div>
            <div class="row g-4 justify-content-center">
                @forelse ($gurus as $item)
                    <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="800">
                        <a href="{{ route('guru.show', $item->id_guru ?? $item->id) }}"
                            class="d-block text-decoration-none h-100">
                            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white card-hover"
                                style="transition: transform 0.3s ease, box-shadow 0.3s ease;">
                                <div
                                    class="card-body p-4 text-center d-flex flex-column align-items-center justify-content-center">
                                    <div class="mb-3">
                                        @if ($item->foto)
                                            <div class="overflow-hidden rounded-circle shadow-sm mx-auto"
                                                style="width: 85px; height: 85px;">
                                                <img src="{{ asset('storage/' . $item->foto) }}"
                                                    alt="Foto {{ $item->nama_guru }}"
                                                    class="w-100 h-100 object-fit-cover">
                                            </div>
                                        @endif
                                    </div>
                                    <h5 class="fw-bold text-dark mb-1">{{ $item->nama_guru ?? $item->nama }}</h5>
                                    <p class="text-primary small mb-1">{{ $item->mapel ?? $item->mata_pelajaran }}</p>
                                    <p class="text-muted small mb-0">NIP: {{ $item->nip }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="text-center text-muted">
                        <p>Belum ada data guru.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Section Ekstrakurikuler -->
    <section class="py-5 bg-light" id="ekstrakurikuler">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="800">
                <span class="text-primary fw-semibold small text-uppercase">Ekstrakurikuler</span>
                <h2 class="fw-bold text-dark">Kegiatan untuk Mengembangkan Bakat & Minat</h2>
                <p class="text-muted">Pilihan kegiatan ekstrakurikuler yang aktif dan dibimbing oleh pelatih profesional di
                    sekolah kami.</p>
            </div>
            <div class="row g-4 justify-content-center">
                @forelse ($ekstrakurikulers as $item)
                    <div class="col-xl-4 col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="800">
                        <a href="{{ route('ekstrakurikuler.detail', $item->id_eskul ?? $item->id) }}"
                            class="d-block text-decoration-none h-100">
                            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white overflow-hidden card-eskul-hover"
                                style="transition: transform 0.3s ease, box-shadow 0.3s ease;">
                                <div style="height: 200px; width: 100%; overflow: hidden;"
                                    class="bg-light position-relative">
                                    @if ($item->gambar)
                                        <img src="{{ asset('storage/ekstrakurikuler/' . $item->gambar) }}" alt="Gambar"
                                            class="w-100 h-100 object-fit-cover position-absolute top-0 start-0">
                                    @else
                                        <div
                                            class="w-100 h-100 d-flex align-items-center justify-content-center text-muted bg-secondary bg-opacity-10">
                                            <i class="ti ti-photo-off fs-2"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-body p-4 d-flex flex-column justify-content-between">
                                    <div>
                                        <h5 class="fw-bold text-dark mb-2">{{ $item->nama_eskul }}</h5>
                                        <p class="text-muted small mb-3">
                                            <i class="ti ti-user-shield me-1 text-primary"></i> Pembina:
                                            {{ $item->pembina ?? '-' }}
                                        </p>
                                    </div>
                                    @if (isset($item->jadwal_latihan))
                                        <div
                                            class="badge bg-light text-primary border p-2 rounded-3 w-100 text-center fw-medium text-dark">
                                            <i class="ti ti-calendar-event me-1"></i> {{ $item->jadwal_latihan }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center" data-aos="fade-up">
                        <p class="text-muted">Belum ada data ekstrakurikuler yang ditampilkan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Section Berita -->
    <section class="py-5 bg-light" id="berita">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="800">
                <span class="text-primary fw-semibold small text-uppercase">Informasi terkini</span>
                <h2 class="fw-bold text-dark">Berita Terbaru Sekolah</h2>
                <p class="text-muted">Informasi terbaru seputar kegiatan, prestasi, dan berbagai kabar terkini dari sekolah
                    kami.</p>
            </div>
            <div class="row g-4 justify-content-center">
                @forelse ($beritas as $item)
                    <div class="col-xl-4 col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="800">
                        <div class="card border-0 shadow-sm rounded-4 h-100 bg-white overflow-hidden card-berita-hover"
                            style="transition: transform 0.3s ease, box-shadow 0.3s ease;">
                            <div style="height: 200px; width: 100%; overflow: hidden;" class="bg-light position-relative">
                                @if ($item->gambar)
                                    <img src="{{ asset('storage/berita/' . $item->gambar) }}" alt="Gambar"
                                        class="w-100 h-100 object-fit-cover position-absolute top-0 start-0">
                                @else
                                    <div
                                        class="w-100 h-100 d-flex align-items-center justify-content-center text-muted bg-secondary bg-opacity-10">
                                        <i class="ti ti-photo-off fs-2"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="card-body p-4 d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="fw-bold text-dark mb-2">{{ $item->judul }}</h5>
                                    <p class="text-muted small">
                                        <i class="ti ti-user-shield me-1 text-primary"></i> {{ $item->tanggal ?? '-' }}
                                    </p>
                                    <div class="text-primary fw-medium text-dark">
                                        <i class="ti ti-calendar-event me-1"></i> {{ Str::limit($item->isi, 50, '...') }}
                                    </div>
                                </div>
                                <a href="{{ route('landing.berita.detail', ['id_berita' => $item->id_berita]) }}"
                                    class="text-primary fw-semibold text-decoration-none mt-auto d-flex align-items-center gap-1">
                                    Baca Selengkapnya <i class="ti ti-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center" data-aos="fade-up">
                        <p class="text-muted">Belum ada berita yang ditampilkan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Section Galeri Kegiatan Sekolah -->
    <section id="galeri" class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="800">
                <span class="text-primary fw-bold text-uppercase small">Dokumentasi</span>
                <h2 class="fw-bold display-6">Galeri Kegiatan Sekolah</h2>
            </div>
            <div class="row g-4">
                @forelse($galeris as $galeri)
                    <div class="col-md-4" data-aos="fade-up" data-aos-duration="800">
                        <div class="card border-0 shadow-sm rounded-4 h-100 bg-white overflow-hidden card-galeri-hover"
                            style="transition: transform 0.3s ease, box-shadow 0.3s ease;">
                            <div style="height: 200px; width: 100%; overflow: hidden;"
                                class="bg-dark position-relative rounded-top">
                                @if ($galeri->file)
                                    @if (preg_match('/\.(mp4|mkv|webm|ogg|mov)$/i', $galeri->file))
                                        <video class="w-100 h-100 object-fit-cover position-absolute top-0 start-0"
                                            autoplay muted loop playsinline>
                                            <source src="{{ asset('storage/galeri/' . basename($galeri->file)) }}"
                                                type="video/{{ pathinfo($galeri->file, PATHINFO_EXTENSION) }}">
                                            Browser Anda tidak mendukung tag video.
                                        </video>
                                    @else
                                        <img src="{{ asset('storage/galeri/' . basename($galeri->file)) }}"
                                            alt="{{ $galeri->judul }}"
                                            class="w-100 h-100 object-fit-cover position-absolute top-0 start-0">
                                    @endif
                                @else
                                    <div
                                        class="w-100 h-100 d-flex align-items-center justify-content-center text-muted bg-secondary bg-opacity-10">
                                        <i class="ti ti-photo-off fs-2"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="p-4">
                                <h4 class="fw-bold text-dark mb-2">{{ $galeri->judul }}</h4>
                                <p class="text-muted small mb-4">
                                    {{ Str::limit($galeri->keterangan ?? '', 50, '...') }}
                                </p>
                                <a href="{{ route('landing.galeri.detail', ['id' => $galeri->id_galeri]) }}"
                                    class="text-primary fw-semibold text-decoration-none mt-auto d-flex align-items-center gap-1">
                                    Baca Selengkapnya <i class="ti ti-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-4" data-aos="fade-up">
                        <p class="text-muted">Belum ada dokumentasi galeri yang diunggah.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
