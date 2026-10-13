<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profil->nama_sekolah ?? 'Website Resmi Sekolah' }}</title>

    <!-- Bootstrap CSS Offline -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- CSS Utama -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link">

    <style>
        :root {
            --primary-color: #4f46e5;
            --secondary-color: #3b82f6;
        }

        body {
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }

        .hero-section {
            background-size: cover !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
            color: white !important;
            padding: 130px 0 100px 0 !important;
            position: relative !important;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 50px;
            background: linear-gradient(to top, #f8fafc, transparent);
            pointer-events: none;
        }

        .card-guru-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
        }

        .card-hover {
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1),
                0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border-color: rgba(79, 70, 229, 0.2);
        }

        .card-eskul-hover,
        .card-berita-hover,
        .card-galeri-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-eskul-hover:hover,
        .card-berita-hover:hover,
        .card-galeri-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
        }

        .navbar {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.9) !important;
        }

        .badge-soft {
            background-color: rgba(79, 70, 229, 0.1);
            color: var(--primary-color);
        }
    </style>
</head>

<body class="bg-light d-flex flex-column min-vh-100">

    @include('layouts.navbar')

    <main class="flex-grow-1">
        @yield('content')
    </main>

    @include('layouts.footer')

    <!-- Bootstrap JavaScript Offline -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

</body>

</html>
