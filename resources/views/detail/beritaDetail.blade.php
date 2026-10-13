@extends('layouts.frontend')

@section('content')
    <style>
        .berita-wrapper {
            padding-top: 90px;
            padding-bottom: 70px;
        }

        .berita-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .berita-header h2 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .berita-header p {
            color: #6c757d;
            margin: 0;
        }

        .berita-card {
            border: 0;
            border-radius: 18px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.07);
            transition: all 0.3s ease;
            height: 100%;
        }

        .berita-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
        }

        .berita-card-image {
            height: 200px;
            overflow: hidden;
            background: #f1f3f5;
        }

        .berita-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .berita-card:hover .berita-card-image img {
            transform: scale(1.04);
        }

        .berita-card-body {
            padding: 24px;
        }

        .berita-card-title {
            font-size: 17px;
            font-weight: 700;
            color: #212529;
            margin-bottom: 10px;
        }

        .berita-date {
            font-size: 12px;
            color: #8a94a6;
            margin-bottom: 12px;
        }

        .berita-description {
            font-size: 14px;
            line-height: 1.7;
            color: #6c757d;
            margin-bottom: 18px;
        }

        .berita-link {
            color: #3b82f6;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.2s;
        }

        .berita-link:hover {
            color: #2563eb;
        }

        .detail-berita-wrapper {
            padding-top: 115px;
            padding-bottom: 70px;
            min-height: 650px;
        }

        .detail-berita-card {
            max-width: 1050px;
            height: 380px;
            margin: 0 auto;
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .detail-berita-card:hover {
            transform: translateY(-7px);
            box-shadow: 0 18px 35px rgba(0, 0, 0, 0.13);
        }

        .detail-berita-image {
            width: 100%;
            height: 380px;
            object-fit: cover;
            display: block;
        }

        .detail-berita-content {
            height: 380px;
            padding: 35px 38px;
            display: flex;
            flex-direction: column;
        }

        .detail-label {
            color: #3b82f6;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            flex-shrink: 0;
        }

        .detail-berita-title {
            font-size: 25px;
            font-weight: 700;
            line-height: 1.3;
            color: #212529;
            margin-bottom: 10px;
            flex-shrink: 0;
        }

        .detail-meta {
            font-size: 12px;
            color: #8a94a6;
            margin-bottom: 18px;
            flex-shrink: 0;
        }

        .detail-meta i {
            color: #3b82f6;
            margin-right: 4px;
        }

        .detail-berita-scroll {
            flex: 1;
            overflow-y: auto;
            padding-right: 12px;
        }

        .detail-berita-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .detail-berita-scroll::-webkit-scrollbar-track {
            background: #f1f3f5;
            border-radius: 10px;
        }

        .detail-berita-scroll::-webkit-scrollbar-thumb {
            background: #b8c0cc;
            border-radius: 10px;
        }

        .detail-berita-scroll::-webkit-scrollbar-thumb:hover {
            background: #8d98a8;
        }

        .detail-berita-text {
            font-size: 14px;
            line-height: 1.9;
            color: #657080;
            margin: 0;
        }

        .detail-back {
            max-width: 1050px;
            margin: 25px auto 0;
        }

        .detail-back a {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
        }

        .detail-back a:hover {
            color: #2563eb;
        }

        @media (max-width: 991px) {
            .detail-berita-card {
                height: auto;
            }

            .detail-berita-image {
                height: 300px;
            }

            .detail-berita-content {
                height: 350px;
            }
        }

        @media (max-width: 767px) {

            .berita-wrapper,
            .detail-berita-wrapper {
                padding-top: 70px;
            }

            .berita-header h2 {
                font-size: 27px;
            }

            .detail-berita-image {
                height: 250px;
            }

            .detail-berita-content {
                height: 350px;
                padding: 25px;
            }

            .detail-berita-title {
                font-size: 22px;
            }
        }
    </style>

    @isset($beritas)
        <div class="container berita-wrapper">
            <div class="berita-header" data-aos="zoom-in-up">
                <h2>Semua Berita Sekolah</h2>
                <p>Informasi terbaru seputar kegiatan dan berbagai kabar sekolah.</p>
            </div>
            <div class="row g-4">
                @forelse ($beritas as $item)
                    <div class="col-xl-4 col-lg-4 col-md-6" data-aos="zoom-in-up" data-aos-duration="700"
                        data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="berita-card">
                            <div class="berita-card-image">
                                @if ($item->gambar)
                                    <img src="{{ asset('storage/berita/' . $item->gambar) }}" alt="{{ $item->judul }}">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                                        <i class="ti ti-photo-off fs-2"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="berita-card-body">
                                <h5 class="berita-card-title">{{ $item->judul }}</h5>
                                <div class="berita-date">
                                    <i class="ti ti-calendar-event me-1 text-primary"></i>
                                    {{ $item->tanggal ?? '-' }}
                                </div>
                                <p class="berita-description">
                                    {{ Str::limit($item->isi, 120, '...') }}
                                </p>
                                <a href="{{ route('landing.berita.detail', $item->id_berita ?? $item->id) }}"
                                    class="berita-link">
                                    Baca Selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">Belum ada berita yang ditampilkan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    @endisset


    @isset($berita)
        <div class="container detail-berita-wrapper">
            <div class="detail-berita-card" data-aos="zoom-in-up" data-aos-duration="800">
                <div class="row g-0 h-100">
                    <div class="col-lg-6">
                        @if ($berita->gambar)
                            <img src="{{ asset('storage/berita/' . $berita->gambar) }}" alt="{{ $berita->judul }}"
                                class="detail-berita-image">
                        @else
                            <div class="detail-berita-image bg-light d-flex align-items-center justify-content-center">
                                <div class="text-center text-muted">
                                    <i class="ti ti-photo-off fs-1"></i>
                                    <p class="mb-0 mt-2">Tidak ada gambar</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-6">
                        <div class="detail-berita-content">
                            <div class="detail-label">Informasi Berita</div>
                            <h1 class="detail-berita-title">{{ $berita->judul }}</h1>
                            <div class="detail-meta">
                                <span>
                                    <i class="ti ti-calendar-event"></i>
                                    {{ $berita->tanggal ?? '-' }}
                                </span>
                                <span class="ms-3">
                                    <i class="ti ti-user"></i>
                                    Admin Sekolah
                                </span>
                            </div>
                            <div class="detail-berita-scroll">
                                <p class="detail-berita-text">
                                    {!! nl2br(e($berita->isi)) !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="detail-back">
                <a href="{{ route('landing.berita.index') }}">
                    <i class="ti ti-arrow-left me-1"></i>
                    Kembali ke Daftar Berita
                </a>
            </div>
        </div>
    @endisset
@endsection
