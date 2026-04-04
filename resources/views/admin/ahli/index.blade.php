@extends('layouts.admin')

@section('title', 'Panel Pakar')
@section('page_header', 'Expert Validation Lab')

@section('sidebar_menu')
    <a href="#" class="block py-2 hover:text-blue-400">Validasi Riset</a>
    <a href="#" class="block py-2 hover:text-blue-400">Peer Review</a>
@endsection

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-sm border-t-4 border-indigo-500">
        <h3 class="text-lg font-bold">Eksperimen Menunggu Validasi</h3>
        <div class="mt-4 p-4 border rounded bg-indigo-50 text-indigo-700">
            Ada 5 hasil riset dari Layer 3 yang perlu tinjauan teknis Anda.
        </div>
    </div>
@endsection
