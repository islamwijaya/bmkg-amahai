@extends('layouts.app')

@section('title', 'Struktur Organisasi | BMKG Meteorologi Amahai')
@section('meta_description', 'Struktur organisasi Stasiun Meteorologi Kelas III Amahai BMKG. Bagan hierarki kepegawaian dan unit kerja.')
@section('meta_keywords', 'struktur organisasi bmkg amahai, bagan organisasi, unit kerja bmkg, kepala stasiun amahai')

@section('breadcrumb')
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
    </svg>
    <a href="{{ url('/profil/sejarah') }}" class="hover:text-bmkg-blue">Profil</a>
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
    </svg>
    <span class="text-bmkg-blue font-semibold">Struktur Organisasi</span>
@endsection

@section('content')
    <div class="bg-gray-50/50 py-12 min-h-screen">
        <div class="max-w-[1200px] mx-auto px-4">

            {{-- Page Header --}}
            <div class="text-center mb-10">
                <h1 class="text-2xl md:text-3xl font-black text-bmkg-navy uppercase tracking-tight leading-relaxed">Bagan
                    Organisasi<br>Stasiun Meteorologi Kelas III Amahai Maluku Tengah</h1>
                <div class="h-1 w-20 bg-bmkg-gold mx-auto mt-5 rounded-full"></div>
            </div>

            {{-- Image Container --}}
            <div class="w-full flex justify-center pb-12">
                <div class="bg-white p-4 rounded-3xl shadow-xl border border-gray-100 inline-block">
                    <img src="{{ asset('assets/img/bagan.png') }}"
                        alt="Bagan Organisasi Stasiun Meteorologi Kelas III Amahai"
                        class="h-[400px] w-auto object-contain rounded-xl">
                </div>
            </div>

        </div>
    </div>
@endsection