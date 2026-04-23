@extends('layouts.app')

@section('title', '404 - Halaman Tidak Ditemukan')

@section('content')
<div class="min-h-[60vh] flex items-center justify-center px-4 py-12">
    <div class="max-w-md w-full text-center">
        <div class="mb-8">
            <h1 class="text-9xl font-extrabold text-bmkg-navy opacity-10">404</h1>
            <div class="-mt-20">
                <svg class="w-24 h-24 mx-auto text-bmkg-gold fill-current opacity-90 animate-bounce" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"/>
                    <circle cx="8" cy="9" r="1.5" class="text-white fill-current"/>
                    <circle cx="16" cy="9" r="1.5" class="text-white fill-current"/>
                    <path fill="none" stroke="white" stroke-width="1.5" stroke-linecap="round" d="M9 17c0-2 6-2 6 0"/>
                </svg>
            </div>
        </div>

        <h2 class="text-3xl font-bold text-bmkg-navy mb-4">Halaman Tidak Ditemukan</h2>
        <p class="text-gray-600 mb-8 leading-relaxed">
            Maaf, halaman yang Anda cari tidak dapat ditemukan atau telah dipindahkan. Silakan periksa kembali URL Anda atau kembali ke halaman utama.
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ url('/') }}" class="w-full sm:w-auto px-8 py-3 bg-bmkg-navy text-white font-bold rounded-xl shadow-lg shadow-bmkg-navy/20 hover:bg-bmkg-blue transition-all transform hover:-translate-y-1">
                Kembali ke Beranda
            </a>
            <button onclick="window.location.reload()" class="w-full sm:w-auto px-8 py-3 bg-white text-bmkg-navy border-2 border-bmkg-navy/10 font-bold rounded-xl hover:bg-bmkg-sky transition-all transform hover:-translate-y-1">
                Muat Ulang
            </button>
        </div>
    </div>
</div>
@endsection
