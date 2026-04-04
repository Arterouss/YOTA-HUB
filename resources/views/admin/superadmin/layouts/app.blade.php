<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{ darkMode: localStorage.getItem('dark') === 'true', sidebarOpen: true }"
      x-init="$watch('darkMode', val => localStorage.setItem('dark', val))"
      :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Super Panel | {{ config('app.name', 'YOTA HUB') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; transition: background-color 0.3s ease; }
        .font-heading { font-family: 'Bungee', cursive; }

        /* Admin Specific Scrollbar */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #bef264; border-radius: 10px; }

        .dark .bg-admin-gradient {
            background: radial-gradient(circle at top left, #021510 0%, #020617 100%);
        }
        .bg-admin-gradient {
            background: #f8fafc;
        }

        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(163, 230, 53, 0.2);
        }
        .dark .glass-panel {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(163, 230, 53, 0.1);
        }
    </style>
</head>
<body class="bg-admin-gradient min-h-screen text-slate-900 dark:text-slate-100 antialiased overflow-x-hidden flex">

    <aside :class="sidebarOpen ? 'w-64' : 'w-20'" class="hidden md:flex flex-col bg-slate-900 border-r border-lime-500/20 transition-all duration-300 h-screen sticky top-0 overflow-y-auto">
        @include('admin.superadmin.layouts.sidebar')
    </aside>

    <div class="flex-1 flex flex-col min-w-0 h-screen overflow-y-auto">

        @include('admin.superadmin.layouts.heade')

        <main class="flex-1 p-6 md:p-10 relative">
            <div class="absolute top-0 right-0 w-64 h-64 bg-lime-500/5 blur-[100px] pointer-events-none"></div>

            <div class="max-w-[1600px] mx-auto">
                {{-- Bagian dinamis untuk Master Data/User Management --}}
                @yield('content')
            </div>
        </main>
<div class="md:hidden">
            @include('admin.superadmin.layouts.bottom-nav')
        </div>
        @include('admin.superadmin.layouts.footer')
    </div>

    <div x-show="!sidebarOpen" class="md:hidden fixed inset-0 bg-black/50 z-[60]" @click="sidebarOpen = true"></div>

</body>
</html>
