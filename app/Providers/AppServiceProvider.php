<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\ProfilSekolah;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Pakai wildcard '*' agar variabel $profil bisa dipakai di SELURUH file view Blade (termasuk sidebar)
        View::composer('*', function ($view) {
            $profil = ProfilSekolah::first();
            $view->with('profil', $profil);
        });
    }
}
