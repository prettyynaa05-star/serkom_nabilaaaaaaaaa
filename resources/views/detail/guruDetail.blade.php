@extends('layouts.frontend')

@section('content')
    <style>
        .card-hover:hover {
            transform: translateY(-6px);
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
        }
    </style>

    <div class="container py-5 mt-5">

        @isset($guru)
            <div class="row justify-content-center">
                <div class="col-md-8 aos-init" data-aos="fade-up" data-aos-duration="800" data-aos-easing="ease-out">

                    <div class="card border-0 shadow-sm p-4 text-center">
                        <div class="mb-4">
                            @if (!empty($guru->foto))
                                <img src="{{ asset('storage/' . $guru->foto) }}" alt="Foto Guru" class="rounded-circle shadow"
                                    style="width: 150px; height: 150px; object-fit: cover;"
                                    onerror="this.onerror=null; this.src='{{ asset('storage/guru/' . $guru->foto) }}';">
                            @else
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto shadow"
                                    style="width: 150px; height: 150px;">
                                    <i class="bi bi-person fs-1 text-secondary"></i>
                                </div>
                            @endif
                        </div>
                        <h2 class="fw-bold mb-1">{{ $guru->nama ?? ($guru->nama_guru ?? ($guru->name ?? 'Tanpa Nama')) }}</h2>
                        <p class="text-primary fw-semibold mb-4">{{ $guru->jabatan ?? ($guru->posisi ?? 'Guru / Staf') }}</p>
                        <hr class="text-muted opacity-25">
                        <div class="text-start mt-4 px-md-4">
                            <h5 class="fw-bold mb-3">Informasi Detail</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td class="text-muted w-25">NIP / NIY</td>
                                    <td class="fw-medium">: {{ $guru->nip ?? ($guru->niy ?? '-') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Jenis Kelamin</td>
                                    <td class="fw-medium">: {{ $guru->jenis_kelamin ?? ($guru->gender ?? '-') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Mata Pelajaran</td>
                                    <td class="fw-medium">: {{ $guru->mapel ?? ($guru->mata_pelajaran ?? '-') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('landing.guru') }}" class="btn btn-primary px-4 rounded-pill">
                            <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Guru & Staf
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center mb-5" data-aos="fade-down" data-aos-duration="600">
                <h2 class="fw-bold">Guru & Staf Sekolah</h2>
                <p class="text-muted">Tenaga pendidik dan kependidikan sekolah</p>
            </div>

            <div class="row g-4">
                @forelse($gurus as $item)
                    <div class="col-md-4 col-lg-3 aos-init" data-aos="zoom-in-up" data-aos-duration="800"
                        data-aos-delay="{{ $loop->index * 100 }}" data-aos-easing="ease-out">
                        <a href="{{ route('landing.guru.detail', ['id_guru' => $item->id_guru ?? $item->id]) }}"
                            class="text-decoration-none text-dark">
                            <div class="card border-0 shadow-sm h-100 text-center p-3 card-hover"
                                style="transition: transform 0.25s ease, box-shadow 0.25s ease;">
                                <div class="mb-3">
                                    @if (!empty($item->foto))
                                        <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto Guru"
                                            class="rounded-circle shadow-sm"
                                            style="width: 120px; height: 120px; object-fit: cover;"
                                            onerror="this.onerror=null; this.src='{{ asset('storage/guru/' . $item->foto) }}';">
                                    @else
                                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto shadow-sm"
                                            style="width: 120px; height: 120px;">
                                            <i class="bi bi-person fs-1 text-secondary"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-body p-0">
                                    <h5 class="fw-bold mb-1">
                                        {{ $item->nama ?? ($item->nama_guru ?? ($item->name ?? 'Tanpa Nama')) }}</h5>
                                    <p class="text-primary small mb-1">{{ $item->jabatan ?? ($item->posisi ?? 'Guru / Staf') }}
                                    </p>
                                    @if (!empty($item->nip) || !empty($item->niy))
                                        <p class="text-muted small mb-0">NIP: {{ $item->nip ?? $item->niy }}</p>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">Belum ada data guru atau staf yang ditambahkan.</p>
                    </div>
                @endforelse
            </div>
        @endisset

    </div>


@endsection
