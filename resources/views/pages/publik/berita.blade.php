@extends('layouts.app')

@section('title', 'Berita & Informasi Terkini | BMKG Meteorologi Amahai')
@section('meta_description', 'Kumpulan berita, rilis pers, dan informasi terbaru seputar meteorologi, klimatologi, dan kegiatan BMKG Stasiun Meteorologi Amahai di Maluku Tengah.')
@section('meta_keywords', 'berita bmkg, info cuaca ambon, rilis pers bmkg, info bmkg amahai, berita meteorologi')

@section('breadcrumb')
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <span class="text-bmkg-blue font-semibold">Informasi</span>
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
                <p class="text-bmkg-lgold text-sm font-semibold uppercase tracking-wider">Informasi</p>
            </div>
            <h1 class="text-xl md:text-2xl font-black mb-2">Informasi Terkini</h1>
            <p class="text-white/70">Warta dan kabar terbaru dari Stasiun Meteorologi Kelas III Amahai</p>
        </div>
    </div>

    {{-- News Grid --}}
    @if($beritas->isEmpty())
    <div class="text-center py-16 text-gray-400">
        <svg class="w-12 h-12 mx-auto mb-4 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
        <p class="text-lg font-medium">Belum ada informasi yang dipublikasikan.</p>
    </div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($beritas as $berita)
        <article class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden group hover:-translate-y-0.5">
            {{-- Thumbnail --}}
            <a href="{{ route('informasi.show', $berita) }}" class="block">
                @if($berita->thumbnail_url)
                <img src="{{ $berita->thumbnail_url }}" alt="{{ $berita->title }}" class="w-full h-44 object-cover group-hover:scale-105 transition-transform duration-300">
                @else
                <div class="w-full h-44 bg-gradient-to-br from-bmkg-navy to-bmkg-blue flex items-center justify-center">
                    <svg class="w-12 h-12 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                </div>
                @endif
            </a>
            {{-- Info --}}
            <div class="p-5">
                <p class="text-xs text-bmkg-gold font-semibold uppercase tracking-wide mb-2">
                    {{ $berita->published_at ? $berita->published_at->translatedFormat('d F Y') : $berita->created_at->translatedFormat('d F Y') }}
                </p>
                <h2 class="text-lg font-bold text-bmkg-navy leading-snug mb-3 group-hover:text-bmkg-blue transition-colors line-clamp-2">
                    <a href="{{ route('informasi.show', $berita) }}">{{ $berita->title }}</a>
                </h2>
                <div class="text-sm text-gray-500 line-clamp-2 mb-4">
                    {!! Str::limit(strip_tags($berita->content), 120) !!}
                </div>
                <a href="{{ route('informasi.show', $berita) }}"
                   class="inline-flex items-center gap-1.5 text-sm font-semibold text-bmkg-blue hover:text-bmkg-navy transition-colors">
                    Baca selengkapnya
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </article>
        @endforeach
    </div>

    {{-- Pagination --}}
    @if($beritas->hasPages())
    <div class="mt-8 flex justify-center">{{ $beritas->links() }}</div>
    @endif
    @endif
</div>
@endsection
