@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="page-header mb-4">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <h2 class="mb-0">Selamat Datang, {{ Auth::user()->name ?? Auth::user()->username }} ! 👋</h2>
                    <p class="text-muted mt-1">Berikut adalah ringkasan informasi sistem informasi sekolah saat ini.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted fw-bold text-uppercase fs-7">Total Siswa</span>
                            <h2 class="mb-0 mt-2 fw-bold text-primary">{{ number_format($totalSiswa, 0, ',', '.') }}</h2>
                        </div>
                        <div class="bg-primary text-white rounded p-3">
                            <i class="fas fa-user-graduate fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted fw-bold text-uppercase fs-7">Total Guru</span>
                            <h2 class="mb-0 mt-2 fw-bold text-success">{{ number_format($totalGuru, 0, ',', '.') }}</h2>
                        </div>
                        <div class="bg-success text-white rounded p-3">
                            <i class="fas fa-chalkboard-teacher fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted fw-bold text-uppercase fs-7">Total Berita</span>
                            <h2 class="mb-0 mt-2 fw-bold text-warning">{{ number_format($totalBerita, 0, ',', '.') }}</h2>
                        </div>
                        <div class="bg-warning text-white rounded p-3">
                            <i class="fas fa-newspaper fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">📢 Pengumuman Sekolah Terbaru</h5>
                    <a href="{{ route('pengumuman.index') }}" class="text-decoration-none">Lihat Semua →</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4">#</th>
                                    <th>Judul Pengumuman</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pengumumanTerbaru as $index => $p)
                                    <tr>
                                        <td class="ps-4">{{ $index + 1 }}</td>
                                        <td>
                                            <strong>{{ $p->judul }}</strong>
                                            <br>
                                            <small class="text-muted">{{ Str::limit($p->isi, 50) }}</small>
                                        </td>
                                        <td>{{ $p->tanggal ?? '-' }}</td>
                                        <td>
                                            <span class="badge bg-success">{{ $p->status ?? 'Publish' }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">Belum ada pengumuman terbaru.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
