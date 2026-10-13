@extends('layouts.frontend')

@section('content')
    <div class="container py-5 mt-5">

        @isset($ekstrakurikuler)
            <div class="row justify-content-center">
                <div class="col-md-8 aos-init" data-aos="fade-up" data-aos-duration="800" data-aos-easing="ease-out">

                    <div class="card border-0 shadow-sm p-4">
                        <div class="mb-4 text-center">
                            @if (!empty($ekstrakurikuler->foto) || !empty($ekstrakurikuler->gambar))
                                <img src="{{ asset('storage/' . ($ekstrakurikuler->foto ?? $ekstrakurikuler->gambar)) }}"
                                    alt="Ekstrakurikuler" class="rounded shadow-sm img-fluid"
                                    style="max-height: 300px; width: 100%; object-fit: cover;"
                                    onerror="this.onerror=null; this.src='{{ asset('storage/ekstrakurikuler/' . ($ekstrakurikuler->foto ?? $ekstrakurikuler->gambar)) }}';">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center mx-auto rounded shadow-sm"
                                    style="height: 250px; width: 100%;">
                                    <i class="bi bi-activity fs-1 text-secondary"></i>
                                </div>
                            @endif
                        </div>

                        <h2 class="fw-bold mb-2">
                            {{ $ekstrakurikuler->nama_eskul ?? ($ekstrakurikuler->nama ?? 'Ekstrakurikuler') }}
                        </h2>
                        <p class="text-primary fw-semibold mb-3">
                            <i class="bi bi-person-badge me-1"></i> Pembina:
                            {{ $ekstrakurikuler->pembina ?? ($ekstrakurikuler->guru_pembina ?? '-') }}
                        </p>

                        <hr class="text-muted opacity-25">

                        <div class="mt-3">
                            <h5 class="fw-bold mb-2">Deskripsi Kegiatan</h5>
                            <p class="text-muted" style="line-height: 1.7;">
                                {{ $ekstrakurikuler->deskripsi ?? ($ekstrakurikuler->keterangan ?? 'Belum ada deskripsi untuk kegiatan ekstrakurikuler ini.') }}
                            </p>
                        </div>

                        @if (!empty($ekstrakurikuler->jadwal))
                            <div class="mt-3">
                                <h5 class="fw-bold mb-2">Jadwal Kegiatan</h5>
                                <p class="text-dark fw-medium"><i
                                        class="bi bi-calendar-event me-2 text-primary"></i>{{ $ekstrakurikuler->jadwal }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('landing.ekstrakurikuler') }}" class="btn btn-primary px-4 rounded-pill">
                            <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Ekstrakurikuler
                        </a>
                    </div>

                </div>
            </div>
        @else
            <div class="text-center mb-5" data-aos="fade-down" data-aos-duration="600">
                <h2 class="fw-bold">Ekstrakurikuler Sekolah</h2>
                <p class="text-muted">Pilihan kegiatan pengembangan bakat dan minat siswa</p>
            </div>

            <div class="row g-4">
                @forelse($ekstrakurikulers as $item)
                    <div class="col-md-4 col-lg-3 aos-init" data-aos="zoom-in-up" data-aos-duration="800"
                        data-aos-delay="{{ $loop->index * 100 }}" data-aos-easing="ease-out">
                        <a href="{{ route('landing.ekstrakurikuler.detail', ['id' => $item->id_eskul ?? $item->id]) }}"
                            class="text-decoration-none text-dark">
                            <div class="card border-0 shadow-sm h-100 text-center p-3 card-hover"
                                style="transition: transform 0.25s ease, box-shadow 0.25s ease;">
                                <div class="mb-3">
                                    @if (!empty($item->foto) || !empty($item->gambar))
                                        <img src="{{ asset('storage/' . ($item->foto ?? $item->gambar)) }}" alt="Ekskul"
                                            class="rounded shadow-sm" style="width: 100%; height: 140px; object-fit: cover;"
                                            onerror="this.onerror=null; this.src='{{ asset('storage/ekstrakurikuler/' . ($item->foto ?? $item->gambar)) }}';">
                                    @else
                                        <div class="rounded bg-light d-flex align-items-center justify-content-center mx-auto shadow-sm"
                                            style="width: 100%; height: 140px;">
                                            <i class="bi bi-activity fs-1 text-secondary"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-body p-0 text-start">
                                    <h5 class="fw-bold mb-1 text-dark">
                                        {{ $item->nama_eskul ?? ($item->nama ?? 'Ekstrakurikuler') }}</h5>
                                    <p class="text-primary small mb-0 text-truncate">
                                        Pembina: {{ $item->pembina ?? ($item->guru_pembina ?? '-') }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">Belum ada data ekstrakurikuler yang ditambahkan.</p>
                    </div>
                @endforelse
            </div>
        @endisset

    </div>

    <style>
        .card-hover:hover {
            transform: translateY(-6px);
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
        }
    </style>
@endsection
