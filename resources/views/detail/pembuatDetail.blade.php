@extends('layouts.frontend')

@section('title', 'Detail Pembuat Aplikasi')

@section('content')
    <div class="container py-5 my-5">
        <div class="row text-center mb-5" data-aos="fade-up" data-aos-duration="800">
            <div class="col-lg-8 mx-auto">
                <span class="badge badge-soft px-3 py-2 rounded-pill mb-3 fw-bold">👨‍💻 Profil Pembuat Website</span>
                <h1 class="fw-bold display-5 mb-3">Tentang Pembuat Website</h1>
                <p class="text-muted lead">Informasi detail kreator di balik pengembangan sistem informasi sekolah ini.</p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8" data-aos="fade-up" data-aos-duration="1000">
                @if (isset($pembuat))
                    <div class="card card-hover border-0 shadow-lg rounded-4 p-4 text-center">
                        <div class="card-body">
                            <div class="mb-4">
                                <img src="{{ asset('storage/images/pembuat.jpg') }}" alt="Pembuat"
                                    class="rounded-circle shadow-sm border border-4 border-primary object-fit-cover"
                                    style="width: 140px; height: 140px;">
                            </div>

                            <h2 class="fw-bold mb-1">{{ $pembuat->nama }}</h2>
                            <p class="text-primary fw-medium mb-3">
                                <i class="fa-solid fa-venus-mars me-1"></i> {{ $pembuat->jenis_kelamin }}
                            </p>

                            <hr class="text-muted opacity-25 my-4">

                            <div class="text-start px-3 mb-4">
                                <div class="d-flex align-items-start mb-3">
                                    <i class="fa-solid fa-location-dot text-primary fs-4 me-3 mt-1"></i>
                                    <div>
                                        <span class="text-muted small d-block">Alamat</span>
                                        <strong class="text-dark">{{ $pembuat->alamat }}</strong>
                                    </div>
                                </div>
                                <div class="d-flex align-items-start">
                                    <i class="fa-solid fa-phone text-success fs-4 me-3 mt-1"></i>
                                    <div>
                                        <span class="text-muted small d-block">Nomor Telepon / WhatsApp</span>
                                        <strong class="text-dark">{{ $pembuat->no_hp }}</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <a href="{{ url('/') }}" class="btn btn-outline-primary rounded-pill px-4 shadow-sm">
                                    <i class="fa-solid fa-arrow-left me-2"></i> Kembali ke Beranda
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-5 bg-white rounded-4 shadow-sm" data-aos="fade-in">
                        <i class="fa-solid fa-user-slash display-4 text-muted mb-3"></i>
                        <h5 class="text-muted">Belum ada data pembuat yang dimasukkan ke database.</h5>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
