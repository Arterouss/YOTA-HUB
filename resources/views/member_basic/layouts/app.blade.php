<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{ darkMode: localStorage.getItem('dark') === 'true', sidebarOpen: true }"
      x-init="$watch('darkMode', val => localStorage.setItem('dark', val))"
      :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Learning Quest | {{ config('app.name', 'YOTA HUB') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; transition: background-color 0.5s ease; }
        .font-heading { font-family: 'Bungee', cursive; }

        /* Custom Participant Scrollbar (Lemon Style) */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #bef264; border-radius: 10px; }

        /* Glassmorphism Effect untuk Card Belajar */
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(163, 230, 53, 0.2);
        }
        .dark .glass-card {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(163, 230, 53, 0.1);
        }

        /* Lemon Button with Shadow */
        .btn-lemon {
            background-color: #bef264;
            color: #1a2e05;
            box-shadow: 0 4px 14px 0 rgba(190, 242, 100, 0.39);
            transition: all 0.2s ease;
        }
        .btn-lemon:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(190, 242, 100, 0.23); }

        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-slate-50 dark:bg-slate-950 min-h-screen text-slate-900 dark:text-slate-100 antialiased overflow-x-hidden flex flex-col md:flex-row">

    <aside :class="sidebarOpen ? 'w-72' : 'w-24'"
           class="hidden md:flex flex-col sticky top-0 h-screen transition-all duration-500 z-[100]">
        @include('member_basic.layouts.sidebar')
    </aside>

    <div class="flex-1 flex flex-col min-w-0 min-h-screen pb-24 md:pb-0">

        @include('member_basic.layouts.header')

        <main class="flex-1 p-4 md:p-8 lg:p-12 relative">
            <div class="absolute top-0 right-0 w-96 h-96 bg-lime-400/5 dark:bg-lime-500/10 blur-[120px] rounded-full pointer-events-none"></div>

            <div class="max-w-6xl mx-auto">
                {{-- Area konten utama untuk Materi, Tugas, dll --}}
                @yield('content')
            </div>
        </main>

        <div class="hidden md:block">
            @include('member_basic.layouts.footer')
        </div>
    </div>

    <div class="md:hidden">
        @include('member_basic.layouts.bottom-nav')
    </div>

    <div class="fixed -bottom-10 -left-10 w-64 h-64 bg-lime-300 dark:bg-lime-900/20 rounded-full mix-blend-multiply filter blur-3xl opacity-20 pointer-events-none"></div>

</body>
</html>
