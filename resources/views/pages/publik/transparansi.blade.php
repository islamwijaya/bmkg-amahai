@extends('layouts.app')

@section('title', 'Transparansi Kinerja — BMKG Amahai')
@section('meta_description', 'Dokumen transparansi kinerja Stasiun Meteorologi Kelas III Amahai meliputi Rencana Kinerja Tahunan, Laporan Kinerja Tahunan, dan Perjanjian Kinerja Tahunan.')

@section('breadcrumb')
<svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
<span class="text-bmkg-blue font-medium">Transparansi Kinerja</span>
@endsection

@section('content')
{{-- Page Hero --}}
<div class="bg-gradient-to-br from-bmkg-navy to-bmkg-blue py-12">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <p class="text-bmkg-gold text-sm font-semibold uppercase tracking-widest mb-2">Dokumen Resmi</p>
        <h1 class="text-2xl md:text-3xl font-extrabold text-white leading-tight">Transparansi Kinerja</h1>
        <p class="text-white/70 text-sm mt-2">Stasiun Meteorologi Kelas III Amahai</p>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 py-12 space-y-8">

    {{-- ── Rencana Kinerja Tahunan ── --}}
    <div class="rounded-2xl overflow-hidden shadow-sm border border-gray-100">
        <div class="bg-bmkg-blue px-6 py-4">
            <h2 class="text-white font-bold text-lg text-center tracking-wide">Rencana Kinerja Tahunan</h2>
        </div>
        <div class="bg-white divide-y divide-gray-100">
            @forelse($rencana as $doc)
            <a href="{{ Storage::url($doc->file_path) }}" target="_blank"
               class="flex items-center gap-3 px-6 py-3.5 hover:bg-bmkg-sky transition-colors group">
                <svg class="w-4 h-4 text-gray-400 group-hover:text-bmkg-blue shrink-0 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                <span class="text-sm text-gray-700 group-hover:text-bmkg-blue font-medium transition-colors">{{ $doc->title }}</span>
            </a>
            @empty
            <p class="px-6 py-5 text-sm text-gray-400 text-center">Belum ada dokumen yang tersedia.</p>
            @endforelse
        </div>
    </div>

    {{-- ── Laporan Kinerja Tahunan ── --}}
    <div class="rounded-2xl overflow-hidden shadow-sm border border-gray-100">
        <div class="bg-emerald-600 px-6 py-4">
            <h2 class="text-white font-bold text-lg text-center tracking-wide">Laporan Kinerja Tahunan</h2>
        </div>
        <div class="bg-white divide-y divide-gray-100">
            @forelse($laporan as $doc)
            <a href="{{ Storage::url($doc->file_path) }}" target="_blank"
               class="flex items-center gap-3 px-6 py-3.5 hover:bg-emerald-50 transition-colors group">
                <svg class="w-4 h-4 text-gray-400 group-hover:text-emerald-600 shrink-0 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                <span class="text-sm text-gray-700 group-hover:text-emerald-700 font-medium transition-colors">{{ $doc->title }}</span>
            </a>
            @empty
            <p class="px-6 py-5 text-sm text-gray-400 text-center">Belum ada dokumen yang tersedia.</p>
            @endforelse
        </div>
    </div>

    {{-- ── Perjanjian Kinerja Tahunan ── --}}
    <div class="rounded-2xl overflow-hidden shadow-sm border border-gray-100">
        <div class="bg-cyan-500 px-6 py-4">
            <h2 class="text-white font-bold text-lg text-center tracking-wide">Perjanjian Kinerja Tahunan</h2>
        </div>
        <div class="bg-white divide-y divide-gray-100">
            @forelse($perjanjian as $doc)
            <a href="{{ Storage::url($doc->file_path) }}" target="_blank"
               class="flex items-center gap-3 px-6 py-3.5 hover:bg-cyan-50 transition-colors group">
                <svg class="w-4 h-4 text-gray-400 group-hover:text-cyan-600 shrink-0 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                <span class="text-sm text-gray-700 group-hover:text-cyan-700 font-medium transition-colors">{{ $doc->title }}</span>
            </a>
            @empty
            <p class="px-6 py-5 text-sm text-gray-400 text-center">Belum ada dokumen yang tersedia.</p>
            @endforelse
        </div>
    </div>

</div>
@endsection
