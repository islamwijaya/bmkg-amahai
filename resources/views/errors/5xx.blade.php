@extends('layouts.app')

@section('title', ($exception->getStatusCode() ?? 'Error') . ' - Kesalahan Server')

@section('content')
<div class="min-h-[60vh] flex items-center justify-center px-4 py-12">
    <div class="max-w-md w-full text-center">
        <div class="mb-8">
            <h1 class="text-9xl font-extrabold text-red-600 opacity-10">{{ $exception->getStatusCode() }}</h1>
            <div class="-mt-20">
                <svg class="w-32 h-32 mx-auto text-red-500 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
        </div>

        <h2 class="text-3xl font-bold text-bmkg-navy mb-4">Terjadi Kesalahan Server</h2>
        <p class="text-gray-600 mb-8 leading-relaxed">
            @php
                $message = $exception->getMessage();
                if (!$message) {
                    switch ($exception->getStatusCode()) {
                        case 503: $message = 'Layanan sedang tidak tersedia. Kami sedang melakukan pemeliharaan rutin. Silakan kembali lagi nanti.'; break;
                        default: $message = 'Maaf, terjadi kesalahan internal pada server kami. Silakan coba memuat ulang halaman.';
                    }
                }
            @endphp
            {{ $message }}
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
