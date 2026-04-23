@extends('layouts.app')
@section('title', 'Tugas & Fungsi Pokok | BMKG Meteorologi Amahai')
@section('meta_description', 'Pelajari tugas dan fungsi pokok Stasiun Meteorologi Amahai dalam menyelenggarakan pengamatan, pengolahan, dan pelayanan data meteorologi di Maluku.')
@section('meta_keywords', 'tugas fungsi bmkg, peran bmkg amahai, pengamatan meteorologi, pelayanan data cuaca, maluku tengah')
@section('breadcrumb')
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <a href="#" class="hover:text-bmkg-blue">Profil</a>
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <span class="text-bmkg-blue font-semibold">Tugas & Fungsi</span>
@endsection
@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    {{-- Hero --}}
    <div class="relative overflow-hidden bg-gradient-to-r from-bmkg-navy to-bmkg-blue rounded-2xl mb-8 text-white shadow-xl">
        <div class="absolute inset-0 z-0 pointer-events-none">
            <div class="absolute inset-0 bg-gradient-to-r from-bmkg-navy via-bmkg-navy/80 to-transparent z-10 w-[80%] md:w-[60%]"></div>
            <img src="{{ asset('assets/img/foto-kantor.png') }}" alt="Gedung BMKG" class="absolute right-0 top-0 w-full md:w-1/2 h-full object-cover opacity-30 mix-blend-luminosity grayscale">
        </div>
        <div class="relative z-10 p-8">
            <div class="flex items-center gap-3 mb-2"><div class="h-1 w-8 bg-bmkg-gold rounded-full"></div><p class="text-bmkg-lgold text-sm font-semibold uppercase tracking-wider">Profil</p></div>
            <h1 class="text-xl md:text-2xl font-black mb-2">Tugas dan Fungsi</h1>
            <p class="text-white/70">Badan Meteorologi, Klimatologi, dan Geofisika — BMKG</p>
        </div>
    </div>

    <div class="space-y-6">
        {{-- Tugas --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
            <div class="mb-4">
                <h2 class="text-lg font-bold text-bmkg-navy mb-4">Tugas</h2>
            </div>
            <p class="text-gray-700 leading-relaxed text-sm border-l-4 border-bmkg-gold pl-5">
                BMKG mempunyai tugas melaksanakan tugas pemerintahan di bidang penyelenggaraan meteorologi, klimatologi, dan geofisika.
            </p>
        </div>

        {{-- Fungsi --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
            <div class="mb-5">
                <h2 class="text-lg font-bold text-bmkg-navy mb-4">Fungsi</h2>
            </div>
            <p class="text-gray-600 text-sm mb-4">Dalam melaksanakan tugas sebagaimana dimaksud di atas, Badan Meteorologi, Klimatologi, dan Geofisika menyelenggarakan fungsi:</p>
            <div class="space-y-3">
                @foreach([
                    'Perumusan dan penetapan kebijakan nasional, umum, dan teknis di bidang pengamatan, pengelolaan data, pelayanan, sarana dan prasarana meteorologi, klimatologi, dan geofisika, serta modifikasi cuaca.',
                    'Pelaksanaan kebijakan umum dan teknis di bidang pengamatan, pengelolaan data, pelayanan, sarana dan prasarana meteorologi, klimatologi, dan geofisika, serta modifikasi cuaca.',
                    'Koordinasi pelaksanaan kebijakan umum dan teknis di bidang modifikasi cuaca.',
                    'Koordinasi pelaksanaan tugas, pembinaan, dan dukungan administrasi kepada seluruh unsur organisasi di lingkungan BMKG.',
                    'Penyusunan dan penetapan norma, standar, prosedur, dan kriteria di bidang pengamatan, pengelolaan data, pelayanan, serta sarana dan prasarana meteorologi, klimatologi, dan geofisika, serta modifikasi cuaca.',
                    'Pemberian bimbingan teknis, supervisi, pengendalian, dan pengawasan di bidang pengamatan, pengelolaan data, pelayanan, sarana dan prasarana meteorologi, klimatologi, dan geofisika, serta modifikasi cuaca.',
                    'Pelaksanaan kerja sama internasional di bidang pengamatan, pengelolaan data, pelayanan, sarana dan prasarana meteorologi, klimatologi, dan geofisika, serta modifikasi cuaca.',
                    'Pengelolaan barang milik negara yang menjadi tanggung jawab BMKG.',
                    'Pelaksanaan dukungan yang bersifat substantif kepada seluruh unsur organisasi di lingkungan BMKG.',
                    'Pengawasan atas pelaksanaan tugas di lingkungan BMKG.',
                ] as $i => $f)
                <div class="flex items-start gap-4 py-3 border-b border-gray-100 last:border-b-0">
                    <div class="w-7 h-7 bg-bmkg-navy rounded-full flex items-center justify-center text-white text-xs font-bold shrink-0">{{ $i+1 }}</div>
                    <p class="text-gray-700 text-sm leading-relaxed">{{ $f }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
