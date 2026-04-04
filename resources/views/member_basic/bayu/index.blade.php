{{--
    [2026-03-12] - Dikerjakan oleh Bayu
    Fungsi: Menampilkan halaman utama dari Open Module Bayu. 
    Merupakan fitur baru (tugas ketiga) yang menempati 1 layer tersendiri di Basic Member.
--}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Open Module Bayu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-4">Selamat Datang di Module Bayu</h3>
                    <p>
                        Ini adalah fitur baru Open Module yang dikembangkan oleh Bayu. Module ini menjadi salah satu dari 3 fitur yang berada di dalam layer Basic Member sesuai penugasan.
                    </p>
                    <p class="mt-4 text-sm text-gray-500">
                        *Catatan Developer (Bayu): Fitur ini disiapkan untuk dikembangkan lebih lanjut sesuai kebutuhan sistem.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>