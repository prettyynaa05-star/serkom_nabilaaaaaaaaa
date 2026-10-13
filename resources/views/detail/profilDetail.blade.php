@extends('layouts.frontend')

@section('content')
    <style>
        .about-page {
            background: #f5f8fd;
            padding: 55px 0 70px;
        }

        .about-page .section-label {
            display: inline-block;
            color: #3978f6;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .about-page .section-title {
            color: #172b4d;
            font-size: clamp(25px, 3vw, 34px);
            font-weight: 800;
            margin-bottom: 14px;
        }

        .about-page .section-description {
            color: #718096;
            line-height: 1.8;
            max-width: 760px;
            margin: 0 auto;
        }

        .about-page .about-card {
            background: #fff;
            border: 1px solid #edf1f7;
            border-radius: 22px;
            box-shadow: 0 8px 30px rgba(30, 55, 90, .045);
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .about-page .about-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 35px rgba(30, 55, 90, .09);
        }

        .about-page .principal-photo {
            width: 145px;
            height: 175px;
            object-fit: cover;
            border-radius: 18px;
            border: 4px solid #fff;
            box-shadow: 0 5px 20px rgba(30, 55, 90, .12);
        }

        .about-page .info-item {
            display: flex;
            align-items: center;
            gap: 16px;
            height: 100%;
            padding: 20px;
            border: 1px solid #e7edf7;
            border-radius: 17px;
            background: #fff;
            transition: border-color .2s ease, background .2s ease;
        }

        .about-page .info-item:hover {
            border-color: #b9d0ff;
            background: #fbfdff;
        }

        .about-page .info-icon {
            width: 52px;
            height: 52px;
            min-width: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #3978f6;
            background: #edf3ff;
            border-radius: 15px;
            font-size: 25px;
        }

        .about-page .info-label {
            display: block;
            color: #8390a7;
            font-size: 12px;
            margin-bottom: 6px;
        }

        .about-page .info-value {
            display: block;
            color: #233653;
            font-size: 14px;
            font-weight: 700;
            line-height: 1.7;
            overflow-wrap: anywhere;
        }

        .about-page .welcome-heading {
            color: #1d3153;
            font-size: 25px;
            font-weight: 800;
            line-height: 1.45;
        }

        .about-page .content-text {
            color: #718096;
            font-size: 14px;
            line-height: 1.9;
            overflow-wrap: anywhere;
        }

        .about-page .mini-card {
            height: 100%;
            padding: 18px;
            background: #f7f9fe;
            border: 1px solid #edf1fa;
            border-radius: 15px;
        }

        .about-page .mini-card i {
            color: #3978f6;
            font-size: 23px;
        }

        .about-page .mini-card h6 {
            color: #233653;
            font-weight: 700;
            margin: 10px 0 6px;
        }

        .about-page .mini-card p {
            color: #718096;
            font-size: 13px;
            line-height: 1.7;
            margin: 0;
            white-space: pre-line;
            overflow-wrap: anywhere;
        }

        .about-page .vision-box {
            background: linear-gradient(135deg, #edf4ff, #f8faff);
            border: 1px solid #dfeaff;
            border-radius: 17px;
            padding: 25px;
            height: 100%;
        }

        .about-page .vision-box h5 {
            color: #233d68;
            font-weight: 800;
            margin-bottom: 14px;
        }

        .about-page .vision-box p {
            color: #62738d;
            font-size: 14px;
            line-height: 1.9;
            margin-bottom: 0;
            white-space: pre-line;
            overflow-wrap: anywhere;
        }

        .about-page .back-button {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 12px 24px;
            border: 1px solid #3978f6;
            border-radius: 50px;
            color: #3978f6;
            background: #fff;
            font-weight: 600;
            text-decoration: none;
            transition: all .2s ease;
        }

        .about-page .back-button:hover {
            color: #fff;
            background: #3978f6;
        }

        @media (max-width: 767px) {
            .about-page {
                padding: 35px 0 45px;
            }

            .about-page .about-card {
                border-radius: 17px;
            }

            .about-page .welcome-heading {
                font-size: 22px;
            }

            .about-page .info-item {
                padding: 15px;
                gap: 12px;
            }

            .about-page .info-icon {
                width: 45px;
                height: 45px;
                min-width: 45px;
                font-size: 22px;
            }
        }
    </style>

    <section class="about-page">
        <div class="container">

            <div class="text-center mb-5" data-aos="fade-up">
                <span class="section-label">Tentang Sekolah</span>
                <h1 class="section-title">
                    Mengenal {{ $profil->nama_sekolah ?? 'SMP Negeri 14 Bandung' }}
                </h1>
                <p class="section-description">
                    {{ $profil->deskripsi ?? 'Mengenal lebih dekat identitas, visi, misi, dan lingkungan sekolah kami.' }}
                </p>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-lg-8" data-aos="fade-right">
                    <div class="about-card p-4 p-md-5 h-100">
                        <span class="section-label">Sambutan Kepala Sekolah</span>
                        <h2 class="welcome-heading mb-3">
                            Mewujudkan Pendidikan Bermutu Berbasis Karakter
                        </h2>
                        <p class="content-text mb-4">
                            {{ $profil->sambutan ?? 'Selamat datang di website resmi sekolah. Kami berkomitmen menciptakan lingkungan pendidikan yang nyaman, inspiratif, dan mendukung perkembangan potensi setiap peserta didik.' }}
                        </p>

                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div class="mini-card">
                                    <i class="ti ti-book-2"></i>
                                    <h6>Kurikulum</h6>
                                    <p>{{ $profil->kurikulum ?? 'Kurikulum Merdeka' }}</p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mini-card">
                                    <i class="ti ti-trophy"></i>
                                    <h6>Komitmen Sekolah</h6>
                                    <p>{{ $profil->mutu ?? 'Unggul, berkarakter, kreatif, dan berprestasi.' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4" data-aos="fade-left">
                    <div
                        class="about-card p-4 text-center h-100 d-flex flex-column align-items-center justify-content-center">
                        <span class="section-label">Pimpinan Sekolah</span>
                        <img src="{{ asset('storage/images/kepalasekolah.jpg') }}" alt="Foto Kepala Sekolah"
                            class="principal-photo mb-3" onerror="this.style.display='none'">
                        <h5 class="fw-bold mb-2" style="color:#233653;">
                            {{ $profil->kepala_sekolah ?? 'Kepala Sekolah' }}
                        </h5>
                        <p class="text-muted small mb-3">Kepala Sekolah</p>
                        <div class="p-3 rounded-4 w-100" style="background:#f5f8ff;">
                            <i class="ti ti-quote fs-3 text-primary"></i>
                            <p class="content-text fst-italic mb-0">
                                Pendidikan adalah investasi berharga untuk membangun masa depan generasi bangsa.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="about-card p-4 p-md-5 mb-4" data-aos="fade-up">
                <div class="mb-4">
                    <span class="section-label">Arah Pendidikan</span>
                    <h3 class="section-title mb-2">Visi & Misi Sekolah</h3>
                    <p class="content-text mb-0">
                        Landasan dan tujuan sekolah dalam membentuk peserta didik yang berkualitas.
                    </p>
                </div>

                <div class="row g-4 mb-5">
                    <!-- Kotak Visi & Misi (Disatukan sesuai kolom database) -->
                    <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
                        <div class="card border-0 shadow-sm rounded-4 h-100 p-4 bg-white card-hover">
                            <div class="card-body">
                                <div class="mb-3"><i class="ti ti-target text-primary fs-2"></i></div>
                                <h4 class="fw-bold text-dark mb-3">Visi & Misi Sekolah</h4>
                                <p class="text-muted mb-0" style="white-space: pre-line;">
                                    {{ $profil->visi_misi ?? 'Belum diatur.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 mb-5 bg-white">
                <div class="mb-4">
                    <span class="text-primary fw-bold small text-uppercase">
                        Informasi Umum
                    </span>
                    <h3 class="fw-bold text-dark mt-2 mb-2">Profil Singkat Sekolah</h3>
                    <p class="text-muted mb-0">
                        Informasi dasar mengenai identitas dan lokasi sekolah.
                    </p>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3 p-3 border rounded-4 h-100">
                            <div class="d-flex align-items-center justify-content-center rounded-3 flex-shrink-0"
                                style="width:54px;height:54px;background:#eaf1ff;">
                                <i class="bi bi-building text-primary fs-3"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block mb-1">Nama Sekolah</small>
                                <strong class="text-dark">
                                    {{ $profil->nama_sekolah ?? '-' }}
                                </strong>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3 p-3 border rounded-4 h-100">
                            <div class="d-flex align-items-center justify-content-center rounded-3 flex-shrink-0"
                                style="width:54px;height:54px;background:#eaf1ff;">
                                <i class="bi bi-calendar-event text-primary fs-3"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block mb-1">Tahun Berdiri</small>
                                <strong class="text-dark">
                                    {{ $profil->tahun_berdiri ?? '-' }}
                                </strong>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3 p-3 border rounded-4 h-100">
                            <div class="d-flex align-items-center justify-content-center rounded-3 flex-shrink-0"
                                style="width:54px;height:54px;background:#eaf1ff;">
                                <i class="bi bi-geo-alt text-primary fs-3"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block mb-1">Alamat Sekolah</small>
                                <strong class="text-dark">
                                    {{ $profil->alamat ?? '-' }}
                                </strong>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3 p-3 border rounded-4 h-100">
                            <div class="d-flex align-items-center justify-content-center rounded-3 flex-shrink-0"
                                style="width:54px;height:54px;background:#eaf1ff;">
                                <i class="bi bi-person-badge text-primary fs-3"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block mb-1">Kepala Sekolah</small>
                                <strong class="text-dark">
                                    {{ $profil->kepala_sekolah ?? '-' }}
                                </strong>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3 p-3 border rounded-4 h-100">
                            <div class="d-flex align-items-center justify-content-center rounded-3 flex-shrink-0"
                                style="width:54px;height:54px;background:#eaf1ff;">
                                <i class="bi bi-telephone text-primary fs-3"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block mb-1">Kontak Sekolah</small>
                                <strong class="text-dark">
                                    {{ $profil->kontak ?? '-' }}
                                </strong>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3 p-3 border rounded-4 h-100">
                            <div class="d-flex align-items-center justify-content-center rounded-3 flex-shrink-0"
                                style="width:54px;height:54px;background:#eaf1ff;">
                                <i class="bi bi-card-text text-primary fs-3"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block mb-1">NPSN</small>
                                <strong class="text-dark">
                                    {{ $profil->npsn ?? '-' }}
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5" data-aos="fade-up">
                <a href="{{ url('/') }}" class="back-button">
                    <i class="ti ti-arrow-left"></i>
                    Kembali ke Beranda
                </a>
            </div>

        </div>
    </section>
@endsection
