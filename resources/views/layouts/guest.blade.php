<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{ darkMode: localStorage.getItem('dark') === 'true' }"
      x-init="$watch('darkMode', val => localStorage.setItem('dark', val))"
      :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Kuest') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; transition: background-color 0.3s ease, color 0.3s ease; }
        .font-heading { font-family: 'Bungee', cursive; }

        /* Light Mode Gradient */
        .bg-lemon-gradient {
            background: radial-gradient(circle at top left, #dcfce7 0%, #f7fee7 50%, #ecfccb 100%);
        }

        /* Dark Mode Gradient (Deep Lime/Forest) */
        .dark .bg-lemon-gradient {
            background: radial-gradient(circle at top left, #064e3b 0%, #022c22 50%, #064e3b 100%);
            color: #ecfccb;
        }

        /* Glassmorphism */
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            border: 2px solid rgba(163, 230, 53, 0.3);
            box-shadow: 0 8px 32px 0 rgba(101, 163, 13, 0.1);
            transition: all 0.3s ease;
        }

        .dark .glass-card {
            background: rgba(6, 78, 59, 0.4);
            border: 2px solid rgba(163, 230, 53, 0.1);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.4);
        }

        /* Buttons */
        .btn-lemon {
            background-color: #bef264;
            color: #1a2e05;
            transition: all 0.2s ease;
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

        /* Switch Toggle Design */
        .theme-toggle-btn {
            width: 48px;
            height: 48px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</head>
<body class="bg-lemon-gradient min-h-screen text-slate-900 dark:text-lime-50 antialiased overflow-x-hidden">

    <nav class="p-6 flex justify-between items-center max-w-7xl mx-auto relative z-50">
        <div class="flex items-center gap-2">
            <div class="w-10 h-10 bg-lime-500 rounded-xl flex items-center justify-center shadow-lg transform rotate-12">
                <span class="text-white font-heading text-xl">K</span>
            </div>
            <span class="font-heading text-2xl tracking-tighter text-lime-900 dark:text-lime-400 hidden sm:block">KUEST.</span>
        </div>

        <div class="flex items-center gap-3 sm:gap-6">
            <button @click="darkMode = !darkMode" class="theme-toggle-btn bg-white/50 dark:bg-lime-900/50 border-2 border-lime-400/30 shadow-sm hover:scale-110 active:scale-95">
                <svg x-show="!darkMode" class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707.707M12 8a4 4 0 100 8 4 4 0 000-8z" />
                </svg>
                <svg x-show="darkMode" class="w-6 h-6 text-lime-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
            </button>

            <div class="flex gap-2 sm:gap-4 items-center">
                <a href="/login" class="text-xs sm:text-sm font-bold text-lime-800 dark:text-lime-300 hover:underline">Log In</a>
                <a href="/register" class="btn-lemon px-4 sm:px-6 py-2 rounded-full font-bold text-xs sm:text-sm">Join Now</a>
            </div>
        </div>
    </nav>

    <main class="relative z-10 px-4 py-8 sm:px-6">
        @yield('content')
    </main>

    <div class="fixed top-20 -left-10 w-40 h-40 bg-lime-300 dark:bg-lime-900 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse"></div>
    <div class="fixed bottom-10 -right-10 w-64 h-64 bg-yellow-200 dark:bg-emerald-900 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>

</body>
</html>
