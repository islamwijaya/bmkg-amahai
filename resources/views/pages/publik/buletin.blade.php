@extends('layouts.app')

@section('title', 'Buletin Meteorologi & Klimatologi | BMKG Meteorologi Amahai')
@section('meta_description', 'Daftar publikasi buletin bulanan dan tahunan mengenai analisis cuaca dan iklim di wilayah Maluku Tengah oleh BMKG Stasiun Meteorologi Amahai.')
@section('meta_keywords', 'buletin bmkg, publikasi meteorologi, analisis iklim maluku, laporan cuaca bulanan, jurnal bmkg amahai')

@section('breadcrumb')
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <span class="text-bmkg-blue font-semibold">Buletin</span>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    {{-- Page Header --}}
    <div class="relative overflow-hidden bg-gradient-to-r from-bmkg-navy to-bmkg-blue rounded-2xl p-8 mb-8 text-white shadow-xl">
        <div class="absolute inset-0 z-0 pointer-events-none">
            <div class="absolute inset-0 bg-gradient-to-r from-bmkg-navy via-bmkg-navy/80 to-transparent z-10 w-[80%] md:w-[60%]"></div>
            <img src="{{ asset('assets/img/foto-kantor.png') }}" alt="Gedung BMKG" class="absolute right-0 top-0 w-full md:w-1/2 h-full object-cover opacity-30 mix-blend-luminosity grayscale">
        </div>
        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-2">
                <div class="h-1 w-8 bg-bmkg-gold rounded-full"></div>
                <p class="text-bmkg-lgold text-sm font-semibold uppercase tracking-wider">Publikasi</p>
            </div>
            <h1 class="text-xl md:text-2xl font-black mb-2">Buletin Meteorologi</h1>
            <p class="text-white/70">Unduh PDF buletin iklim dan cuaca Maluku Tengah</p>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row gap-6">
        {{-- FILTER SIDEBAR --}}
        <aside class="lg:w-56 shrink-0" x-data="{ filterOpen: false }">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 lg:sticky lg:top-24">
                <div class="flex justify-between items-center lg:mb-4 cursor-pointer lg:cursor-default" @click="filterOpen = !filterOpen">
                    <h3 class="text-base font-bold text-bmkg-navy">Filter Buletin</h3>
                    <svg class="w-5 h-5 text-gray-500 lg:hidden transition-transform duration-200" :class="filterOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </div>
                
                <form method="GET" action="{{ route('publik.buletin') }}" class="space-y-3 mt-4 lg:mt-0" x-show="filterOpen || window.innerWidth >= 1024" x-collapse.duration.300ms>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5">Tahun</label>
                        <select name="tahun" onchange="this.form.submit()"
                                class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-bmkg-blue/30">
                            @foreach($years as $year)
                            <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5">Bulan</label>
                        <select name="bulan" onchange="this.form.submit()"
                                class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-bmkg-blue/30">
                            <option value="">Semua Bulan</option>
                            @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $i => $bln)
                            <option value="{{ $i+1 }}" {{ $selectedMonth == $i+1 ? 'selected' : '' }}>{{ $bln }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($selectedMonth)
                    <a href="{{ route('publik.buletin', ['tahun' => $selectedYear]) }}" class="block text-xs text-center text-bmkg-blue hover:underline pt-1">Reset filter bulan</a>
                    @endif
                </form>
            </div>
        </aside>

        {{-- BULLETIN CONTENT --}}
        <div class="flex-1 min-w-0">
            @if($activeBulletin)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-8">
                <div class="p-5 border-b border-gray-50 flex items-center justify-between bg-gray-50/50">
                    <div>
                        <h2 class="text-lg font-bold text-bmkg-navy">{{ $activeBulletin->title }}</h2>
                        <p class="text-xs text-bmkg-gold font-bold">{{ $activeBulletin->edition }}</p>
                    </div>
                    <a href="{{ $activeBulletin->file_url }}" target="_blank"
                       class="inline-flex items-center gap-2 px-4 py-2 bg-bmkg-navy text-white text-xs font-bold rounded-xl hover:bg-bmkg-blue transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Unduh PDF
                    </a>
                </div>
                @php
                   $isPdf = str_ends_with(strtolower($activeBulletin->file_path), '.pdf');
                @endphp
                @if($isPdf)
                {{-- PDF Viewer --}}
                <div class="aspect-[1/1.4] w-full bg-gray-100 relative">
                    <iframe src="{{ $activeBulletin->file_url }}#view=FitH" class="w-full h-full border-0 absolute inset-0 z-10" allow="fullscreen"></iframe>
                </div>
                @else
                {{-- Non-PDF Placeholder (.pub) --}}
                <div class="aspect-[1/1.4] w-full bg-gradient-to-br from-gray-50 to-gray-200 flex flex-col items-center justify-center p-8 text-center border-t border-gray-100">
                    <div class="w-24 h-24 bg-bmkg-blue/10 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-12 h-12 text-bmkg-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-bmkg-navy mb-2">Dokumen Publisher</h3>
                    <p class="text-gray-500 max-w-sm mb-8">Format .pub tidak dapat dipratinjau langsung di browser. Silakan unduh file untuk membacanya di perangkat Anda.</p>
                    <a href="{{ $activeBulletin->file_url }}" target="_blank" class="px-8 py-3 bg-bmkg-gold text-bmkg-dark rounded-full font-bold hover:bg-yellow-400 transition-colors shadow-lg shadow-bmkg-gold/30">
                        Unduh File Sekarang
                    </a>
                </div>
                @endif
                @if($activeBulletin->description)
                <div class="p-5 bg-gray-50/30 border-t border-gray-50">
                    <p class="text-sm text-gray-500 leading-relaxed">{{ $activeBulletin->description }}</p>
                </div>
                @endif
            </div>

            {{-- Other bulletins in this month/year if any --}}
            @if($bulletins->count() > 1)
            <h3 class="text-base font-bold text-bmkg-navy mb-4">Buletin Lainnya</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                @foreach($bulletins->filter(fn($b) => $b->id !== $activeBulletin->id) as $bulletin)
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden group">
                    <div class="bg-gradient-to-br from-bmkg-navy to-bmkg-blue aspect-[3/4] flex items-center justify-center overflow-hidden relative">
                        @if($bulletin->cover_url)
                        <img src="{{ $bulletin->cover_url }}" alt="{{ $bulletin->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                        <svg class="w-10 h-10 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                        @endif
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                             <a href="{{ route('publik.buletin', ['tahun' => $selectedYear, 'bulan' => $bulletin->month, 'active' => $bulletin->id]) }}"
                                class="p-2 bg-white text-bmkg-blue rounded-full shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                             </a>
                        </div>
                    </div>
                    <div class="p-3">
                        <p class="font-bold text-gray-800 text-[10px] leading-tight mb-1 line-clamp-2">{{ $bulletin->title }}</p>
                        <a href="{{ $bulletin->file_url }}" target="_blank" class="text-bmkg-blue text-[10px] font-bold hover:underline">Unduh PDF</a>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
            @else
            <div class="bg-white rounded-2xl p-12 text-center text-gray-400 border border-gray-100">
                <svg class="w-10 h-10 mx-auto mb-3 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
                <p class="font-medium">Tidak ada buletin untuk filter yang dipilih.</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
