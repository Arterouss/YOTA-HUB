@extends('layouts.admin')

@section('title', 'Portal Mitra')
@section('page_header', 'Mitra Strategic Dashboard')

@section('sidebar_menu')
    <a href="#" class="block py-2 hover:text-blue-400">Kerjasama Bisnis</a>
    <a href="#" class="block py-2 hover:text-blue-400">Laporan Investasi</a>
@endsection

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-sm border-t-4 border-emerald-500">
        <h3 class="text-lg font-bold">Ringkasan Kerjasama PT Yota Inovasi Nusantara</h3>
        <p class="text-gray-600 mt-2">Daftar MoU aktif dan progress project kolaborasi tersedia di sini.</p>
    </div>
@endsection
