<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{ darkMode: localStorage.getItem('dark') === 'true' }"
      x-init="$watch('darkMode', val => localStorage.setItem('dark', val))"
      :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'YOTA HUB') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Transisi warna global agar tidak kaku saat ganti mode */
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: background-color 0.5s ease, color 0.5s ease;
        }
        .font-heading { font-family: 'Bungee', cursive; }

        /* Custom Lemon Gradient Background */
        .bg-lemon-gradient {
            background: radial-gradient(circle at top left, #dcfce7 0%, #f7fee7 50%, #ecfccb 100%);
        }
        /* Gradient Khusus Dark Mode: Deep Forest Green */
        .dark .bg-lemon-gradient {
            background: radial-gradient(circle at top left, #064e3b 0%, #022c22 50%, #064e3b 100%);
        }

        /* Glassmorphism Effect */
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            border: 2px solid rgba(163, 230, 53, 0.3);
            box-shadow: 0 8px 32px 0 rgba(101, 163, 13, 0.1);
            transition: background 0.5s ease, border 0.5s ease;
        }
        .dark .glass-card {
            background: rgba(2, 44, 34, 0.6);
            border: 2px solid rgba(163, 230, 53, 0.15);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.4);
        }

        /* Gen Z Style Buttons */
        .btn-lemon {
            background-color: #bef264;
            color: #1a2e05;
            transition: all 0.3s ease;
            box-shadow: 4px 4px 0px #4d7c0f;
        }
        .btn-lemon:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px #4d7c0f;
        }
        .btn-lemon:active {
            transform: translate(2px, 2px);
            box-shadow: 0px 0px 0px #4d7c0f;
        }
    </style>
</head>
<body class="bg-lemon-gradient min-h-screen text-slate-900 dark:text-lime-50 antialiased overflow-x-hidden">

    @include('public.layouts.header')

    <main class="relative z-10">
        {{-- Konten utama akan menyesuaikan warna berdasarkan class dark pada html --}}
        @yield('content')
    </main>

    @include('public.layouts.footer')

    <div class="fixed top-20 -left-10 w-40 h-40 bg-lime-300 dark:bg-lime-800 rounded-full mix-blend-multiply filter blur-3xl opacity-30 dark:opacity-20 animate-pulse pointer-events-none"></div>
    <div class="fixed bottom-10 -right-10 w-64 h-64 bg-yellow-200 dark:bg-emerald-900 rounded-full mix-blend-multiply filter blur-3xl opacity-30 dark:opacity-20 pointer-events-none"></div>

</body>
</html>
