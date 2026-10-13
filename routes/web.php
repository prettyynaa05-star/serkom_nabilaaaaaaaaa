<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfilDetailController;
use App\Http\Controllers\BeritaDetailController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\GuruDetailController;
use App\Http\Controllers\EkstrakurikulerDetailController;
use App\Http\Controllers\GaleriDetailController;
use App\Http\Controllers\PembuatController;

Route::get('/', [LandingPageController::class, 'index'])->name('landing');
Route::get('/tentang', [ProfilDetailController::class, 'index'])->name('profil.sekolah');
Route::get('/guru/{id}', [LandingPageController::class, 'showGuru'])->whereNumber('id')->name('guru.show');
Route::get('/ekstrakurikuler/{id}', [EkstrakurikulerDetailController::class, 'show'])->whereNumber('id')->name('ekstrakurikuler.detail');
Route::get('/berita/{id_berita}', [BeritaDetailController::class, 'show'])->name('landing.berita.detail');


Route::get('/info-berita', [BeritaDetailController::class, 'index'])->name('landing.berita.index');
Route::get('/info-berita/{id_berita}', [BeritaDetailController::class, 'show'])->name('landing.berita.detail');
Route::get('/info-guru', [GuruDetailController::class, 'index'])->name('landing.guru');
Route::get('/info-guru/{id_guru}', [GuruDetailController::class, 'show'])->name('landing.guru.detail');


Route::get('/info-ekstrakurikuler', [EkstrakurikulerDetailController::class, 'index'])->name('landing.ekstrakurikuler');
Route::get('/info-ekstrakurikuler/{id}', [EkstrakurikulerDetailController::class, 'show'])->name('landing.ekstrakurikuler.detail');


Route::get('/info-galeri', [GaleriDetailController::class, 'index'])->name('landing.galeri');
Route::get('/info-galeri/{id}', [GaleriDetailController::class, 'show'])->name('landing.galeri.detail');

Route::get('/pembuat', [PembuatController::class, 'index'])->name('detail.pembuatDetail');


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});


Route::middleware(['auth'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
    Route::get('/profil/edit', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::post('/profil/update', [ProfilController::class, 'update'])->name('profil.update');

    Route::get('/siswa/edit/{id}', [SiswaController::class, 'edit'])->name('siswa.edit')->where('id', '.*');
    Route::put('/siswa/update/{id}', [SiswaController::class, 'update'])->name('siswa.update')->where('id', '.*');

    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
    Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
    Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');
    Route::delete('/siswa/delete/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');

    Route::get('/guru/edit/{id}', [GuruController::class, 'edit'])->name('guru.edit');
    Route::put('/guru/update/{id}', [GuruController::class, 'update'])->name('guru.update');

    Route::get('/guru', [GuruController::class, 'index'])->name('guru.index');
    Route::get('/guru/create', [GuruController::class, 'create'])->name('guru.create');
    Route::post('/guru', [GuruController::class, 'store'])->name('guru.store');
    Route::delete('/guru/delete/{id}', [GuruController::class, 'destroy'])->name('guru.destroy');

    Route::get('/ekstrakurikuler', [EkstrakurikulerController::class, 'index'])->name('ekstrakurikuler.index');
    Route::get('/ekstrakurikuler/create', [EkstrakurikulerController::class, 'create'])->name('ekstrakurikuler.create');
    Route::post('/ekstrakurikuler', [EkstrakurikulerController::class, 'store'])->name('ekstrakurikuler.store');
    Route::get('/ekstrakurikuler/edit/{id}', [EkstrakurikulerController::class, 'edit'])->name('ekstrakurikuler.edit');
    Route::put('/ekstrakurikuler/update/{id}', [EkstrakurikulerController::class, 'update'])->name('ekstrakurikuler.update');
    Route::delete('/ekstrakurikuler/delete/{id}', [EkstrakurikulerController::class, 'destroy'])->name('ekstrakurikuler.destroy');

    Route::get('/admin/berita', [BeritaController::class, 'index'])->name('berita.index');
    Route::get('/admin/berita/create', [BeritaController::class, 'create'])->name('berita.create');
    Route::post('/admin/berita', [BeritaController::class, 'store'])->name('berita.store');
    Route::get('/admin/berita/{id}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
    Route::put('/admin/berita/{id}', [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('/admin/berita/{id}', [BeritaController::class, 'destroy'])->name('berita.destroy');

    Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');
    Route::get('/pengumuman/create', [PengumumanController::class, 'create'])->name('pengumuman.create');
    Route::post('/pengumuman', [PengumumanController::class, 'store'])->name('pengumuman.store');
    Route::get('/pengumuman/edit/{id}', [PengumumanController::class, 'edit'])->name('pengumuman.edit');
    Route::put('/pengumuman/update/{id}', [PengumumanController::class, 'update'])->name('pengumuman.update');
    Route::delete('/pengumuman/delete/{id}', [PengumumanController::class, 'destroy'])->name('pengumuman.destroy');

    Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');
    Route::get('/galeri/create', [GaleriController::class, 'create'])->name('galeri.create');
    Route::post('/galeri', [GaleriController::class, 'store'])->name('galeri.store');
    Route::get('/galeri/edit/{id}', [GaleriController::class, 'edit'])->name('galeri.edit');
    Route::put('/galeri/update/{id}', [GaleriController::class, 'update'])->name('galeri.update');
    Route::delete('/galeri/delete/{id}', [GaleriController::class, 'destroy'])->name('galeri.destroy');


    Route::group(['middleware' => [function ($request, $next) {
        if (Auth::check() && Auth::user()->role === 'Admin') {
            return $next($request);
        }
        abort(403, 'Akses ditolak! Halaman ini khusus Admin.');
    }]], function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});
