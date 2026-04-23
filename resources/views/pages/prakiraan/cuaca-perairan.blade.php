@extends('layouts.app')

@section('title', 'Prakiraan Cuaca Perairan & Maritim | BMKG Meteorologi Amahai')
@section('meta_description', 'Pantau prakiraan cuaca maritim, tinggi gelombang, dan kondisi perairan Maluku Tengah berkelanjutan dari sumber resmi BMKG Stasiun Meteorologi Amahai.')
@section('meta_keywords', 'cuaca perairan, maritim, gelombang tinggi, laut banda, perairan maluku, bmkg amahai, cuaca laut, info nelayan')

@section('breadcrumb')
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <a href="{{ url('/prakiraan/cuaca') }}" class="hover:text-bmkg-blue">Prakiraan</a>
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <span class="text-bmkg-blue font-semibold">Cuaca Perairan</span>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    {{-- Hero Section --}}
    <div class="bg-gradient-to-r from-bmkg-navy to-bmkg-blue rounded-3xl p-8 mb-10 text-white relative overflow-hidden shadow-2xl">
        <div class="absolute right-0 top-0 bottom-0 w-1/3 opacity-10 select-none flex items-center justify-center">
            <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 24 24">
                <path d="M3 15c4-4 8 4 12 0s4-4 8 0M3 10c4-4 8 4 12 0s4-4 8 0M3 20c4-4 8 4 12 0s4-4 8 0"/>
            </svg>
        </div>
        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-3">
                <div class="h-1 w-10 bg-bmkg-gold rounded-full"></div>
                <p class="text-bmkg-lgold text-sm font-bold uppercase tracking-[0.2em]">Maritime Forecast</p>
            </div>
            <h1 class="text-xl md:text-2xl font-black mb-3 tracking-tight">Prakiraan Cuaca Perairan</h1>
            <p class="text-white/80 max-w-2xl text-lg leading-relaxed font-medium">Informasi prakiraan cuaca maritim untuk wilayah perairan di sekitar Maluku Tengah dan sekitarnya.</p>
        </div>
    </div>

    {{-- Grid Content --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @php
            $perairan = [
                ['Perairan Kepulauan Banda Neira', 'https://maritim.bmkg.go.id/cuaca/perairan/perairan-kep-banda-neira'],
                ['Perairan Seram Bagian Timur (P. Gorong)', 'https://maritim.bmkg.go.id/cuaca/perairan/perairan-seram-bagian-timur-p-gorong'],
                ['Perairan Utara Maluku Tengah', 'https://maritim.bmkg.go.id/cuaca/perairan/perairan-utara-maluku-tengah'],
                ['Perairan Seram Bagian Barat', 'https://maritim.bmkg.go.id/cuaca/perairan/perairan-seram-bagian-barat'],
                ['Perairan Selatan Maluku Tengah', 'https://maritim.bmkg.go.id/cuaca/perairan/perairan-selatan-maluku-tengah'],
                ['Perairan Pulau Ambon hingga Kepulauan Lease', 'https://maritim.bmkg.go.id/cuaca/perairan/perairan-p-ambon-p-lease'],
                ['Perairan Seram bagian Timur (Utara)', 'https://maritim.bmkg.go.id/cuaca/perairan/perairan-seram-bagian-timur-utara'],
                ['Perairan Seram bagian Timur (Selatan)', 'https://maritim.bmkg.go.id/cuaca/perairan/perairan-seram-bagian-timur-selatan'],
            ];
        @endphp

        @foreach($perairan as $item)
        <a href="{{ $item[1] }}" target="_blank" class="group bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:border-bmkg-gold hover:shadow-xl transition-all duration-300 flex flex-col justify-between overflow-hidden relative">
            <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
                <svg class="w-20 h-20 text-bmkg-navy" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M3 15c4-4 8 4 12 0s4-4 8 0"/>
                </svg>
            </div>
            <div class="relative">
                <div class="w-12 h-12 bg-bmkg-sky rounded-xl flex items-center justify-center mb-4 group-hover:bg-bmkg-navy transition-colors duration-300">
                    <svg class="w-6 h-6 text-bmkg-blue group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/>
                    </svg>
                </div>
                <h3 class="text-bmkg-navy font-bold text-base leading-snug mb-2 transition-colors duration-300">{{ $item[0] }}</h3>
                <p class="text-gray-500 text-sm font-medium">Klik untuk melihat detail prakiraan cuaca maritim di wilayah ini.</p>
            </div>
            <div class="mt-6 flex items-center text-bmkg-navy font-bold text-sm tracking-wide group-hover:translate-x-1 transition-transform duration-300">
                Lihat Selengkapnya
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </div>
        </a>
        @endforeach
    </div>

    {{-- Footer Info --}}
    <div class="mt-12 bg-gray-50 rounded-2xl p-6 border border-gray-200 flex items-start gap-4">
        <div class="w-10 h-10 bg-bmkg-gold/10 rounded-full flex items-center justify-center shrink-0">
            <svg class="w-5 h-5 text-bmkg-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div>
            <h4 class="text-gray-900 font-bold mb-1">Informasi</h4>
            <p class="text-gray-600 text-sm leading-relaxed">Data prakiraan cuaca perairan bersumber langsung dari <span class="font-bold text-bmkg-navy">BMKG Maritime Meteorological Center</span>. Klik pada salah satu wilayah untuk diarahkan ke halaman detail prakiraan yang mencakup tinggi gelombang, arah angin, dan kondisi cuaca terkini.</p>
        </div>
    </div>
</div>
@endsection
