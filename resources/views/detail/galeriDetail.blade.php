@extends('layouts.frontend')

@section('content')
    <style>
        .galeri-wrapper {
            padding-top: 120px;
            padding-bottom: 70px;
        }

        .card-hover:hover {
            transform: translateY(-6px);
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
        }

        .detail-galeri-wrapper {
            padding-top: 120px;
            padding-bottom: 70px;
            min-height: 650px;
        }
    </style>

    @isset($galeris)
        <div class="container galeri-wrapper">
            <div class="text-center mb-5" data-aos="zoom-in-up" data-aos-duration="600">
                <h2 class="fw-bold">Galeri Kegiatan Sekolah</h2>
                <p class="text-muted">Dokumentasi foto kegiatan dan aktivitas di sekolah</p>
            </div>

            <div class="row g-4">
                @forelse ($galeris as $item)
                    <div class="col-md-4 col-lg-3" data-aos="zoom-in-up" data-aos-duration="700"
                        data-aos-delay="{{ $loop->index * 100 }}">

                        <a href="{{ route('landing.galeri.detail', ['id' => $item->id_galeri]) }}"
                            class="text-decoration-none text-dark">

                            <div class="card border-0 shadow-sm h-100 p-3 card-hover"
                                style="transition: transform 0.25s ease, box-shadow 0.25s ease;">

                                <div class="mb-3 overflow-hidden rounded bg-dark position-relative" style="height: 150px;">

                                    @if (!empty($item->file))
                                        @php
                                            $namaFile = basename($item->file);
                                            $urlFile = asset('storage/galeri/' . $namaFile);
                                            $ekstensi = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
                                        @endphp

                                        @if (in_array($ekstensi, ['mp4', 'mkv', 'webm', 'ogg', 'mov']))
                                            <video class="w-100 h-100 object-fit-cover position-absolute top-0 start-0"
                                                preload="metadata" muted playsinline>
                                                <source src="{{ $urlFile }}"
                                                    type="{{ $ekstensi === 'mkv' ? 'video/x-matroska' : 'video/' . $ekstensi }}">
                                                Browser Anda tidak mendukung tag video.
                                            </video>
                                        @else
                                            <img src="{{ $urlFile }}" alt="{{ $item->judul }}"
                                                class="w-100 h-100 object-fit-cover position-absolute top-0 start-0"
                                                style="object-fit: cover;"
                                                onerror="this.onerror=null; this.src='{{ Storage::url('galeri/' . $item->file) }}';">
                                        @endif
                                    @else
                                        <div
                                            class="w-100 h-100 d-flex align-items-center justify-content-center text-muted bg-light">
                                            <i class="ti ti-photo-off fs-2"></i>
                                        </div>
                                    @endif
                                </div>

                                <div class="card-body p-0 text-start">
                                    <h6 class="fw-bold mb-1 text-dark text-truncate">
                                        {{ $item->judul }}
                                    </h6>

                                    <p class="text-muted small mb-0">
                                        <i class="ti ti-calendar-event me-1"></i>
                                        {{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('d M Y') : '-' }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">Belum ada data galeri yang ditambahkan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    @endisset

    @isset($galeri)
        <div class="container detail-galeri-wrapper">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white p-4" data-aos="fade-up"
                data-aos-duration="900" style="max-width: 900px; margin: 0 auto;">

                <div class="row g-4 align-items-center">
                    <div class="col-lg-6">
                        @if (!empty($galeri->file))
                            @php
                                $namaFile = basename($galeri->file);
                                $urlFile = asset('storage/galeri/' . $namaFile);
                                $ekstensi = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
                            @endphp

                            <div class="rounded shadow-sm w-100 bg-dark overflow-hidden position-relative"
                                style="height: 300px;">

                                @if (in_array($ekstensi, ['mp4', 'mkv', 'webm', 'ogg', 'mov']))
                                    <video class="w-100 h-100 object-fit-cover position-absolute top-0 start-0" controls
                                        playsinline>
                                        <source src="{{ $urlFile }}"
                                            type="{{ $ekstensi === 'mkv' ? 'video/x-matroska' : 'video/' . $ekstensi }}">
                                        Browser Anda tidak mendukung tag video.
                                    </video>
                                @else
                                    <img src="{{ $urlFile }}" alt="{{ $galeri->judul }}"
                                        class="w-100 h-100 object-fit-cover position-absolute top-0 start-0"
                                        style="object-fit: cover;"
                                        onerror="this.onerror=null; this.src='{{ Storage::url('galeri/' . $galeri->file) }}';">
                                @endif
                            </div>
                        @else
                            <div class="rounded bg-light d-flex align-items-center justify-content-center shadow-sm w-100"
                                style="height: 300px;">
                                <i class="ti ti-photo-off fs-1 text-secondary"></i>
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-6">
                        <span class="text-primary fw-semibold small text-uppercase">
                            {{ $galeri->kategori ?? 'Informasi Galeri' }}
                        </span>

                        <h2 class="fw-bold text-dark mt-2 mb-3">
                            {{ $galeri->judul }}
                        </h2>

                        <p class="text-muted small mb-3">
                            <i class="ti ti-calendar-event me-1"></i>
                            {{ $galeri->tanggal ? \Carbon\Carbon::parse($galeri->tanggal)->format('d M Y') : '-' }}
                        </p>

                        <p class="text-muted" style="line-height: 1.6;">
                            {!! nl2br(e($galeri->keterangan ?? 'Tidak ada keterangan tambahan.')) !!}
                        </p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4" style="max-width: 900px; margin: 20px auto 0;" data-aos="fade-up"
                data-aos-duration="1000">

                <a href="{{ route('landing.galeri') }}" class="btn btn-primary px-4 rounded-pill">
                    <i class="ti ti-arrow-left me-2"></i>
                    Kembali ke Daftar Galeri
                </a>
            </div>
        </div>
    @endisset
@endsection
