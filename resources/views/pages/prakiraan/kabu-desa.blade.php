@extends('layouts.app')

@section('title', 'Pilih Desa/Negeri - ' . $kecamatan['nama'])

@section('breadcrumb')
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <a href="{{ route('prakiraan.cuaca') }}" class="hover:text-bmkg-blue transition-colors">Maluku Tengah</a>
    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <span class="text-bmkg-blue font-semibold whitespace-nowrap overflow-hidden text-ellipsis max-w-[150px] inline-block align-bottom">{{ $kecamatan['nama'] }}</span>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    
    {{-- BUTTON BACK --}}
    <a href="{{ route('prakiraan.cuaca') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-bmkg-navy mb-6 transition-colors text-sm font-semibold">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Daftar Kecamatan
    </a>

    {{-- PAGE HEADER --}}
    <div class="bg-gradient-to-r from-teal-700 to-bmkg-blue rounded-2xl p-6 md:p-8 mb-6 md:mb-8 text-white relative overflow-hidden shadow-lg">
        <div class="absolute right-0 top-0 opacity-10">
            <svg viewBox="0 0 200 200" class="w-48 h-48 md:w-64 md:h-64"><path fill="white" d="M42.7,-73.4C55.4,-65.4,65.9,-53.4,74.5,-40.1C83.2,-26.7,90.1,-11.9,89.5,2.6C89,17.1,81.1,31.4,71.2,43.3C61.3,55.3,49.4,64.9,35.7,71.7C21.9,78.5,6.3,82.5,-8.4,79.5C-23,76.5,-36.8,66.6,-49.6,56C-62.4,45.4,-74.3,34.1,-79.8,20.2C-85.3,6.3,-84.5,-10.2,-78,-24C-71.5,-37.8,-59.4,-48.9,-46.7,-57.1C-34,-65.4,-20.7,-70.7,-6.2,-63.3C8.2,-55.9,29.9,-81.4,42.7,-73.4Z" transform="translate(100 100)" /></svg>
        </div>
        <div class="relative">
            <div class="flex items-center gap-3 mb-2">
                <div class="h-1 w-8 bg-bmkg-gold rounded-full"></div>
                <p class="text-bmkg-lgold text-sm font-semibold uppercase tracking-wider">Maluku Tengah</p>
            </div>
            <h1 class="text-xl md:text-2xl font-black mb-1">{{ $kecamatan['nama'] }}</h1>
            <p class="text-white/80 text-sm md:text-base">Silakan pilih Desa/Negeri untuk melihat detail prakiraan cuaca</p>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="bg-bmkg-sky px-6 py-4 border-b border-blue-100 flex justify-between items-center text-sm">
            <h2 class="text-lg font-bold text-bmkg-navy">Daftar Desa & Negeri</h2>
            <span class="bg-white text-gray-600 px-3 py-1 rounded-full border border-gray-200 shadow-sm font-medium">
                Total: <strong class="text-bmkg-blue">{{ count($kecamatan['desa']) }}</strong>
            </span>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse($kecamatan['desa'] as $i => $desa)
                    <a href="{{ route('prakiraan.cuaca.detail', $desa['id']) }}" 
                       class="flex items-center justify-between p-4 bg-white border border-gray-100 hover:border-bmkg-blue/50 hover:bg-bmkg-sky/30 rounded-xl transition-all shadow-sm hover:shadow group text-left">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 font-bold text-xs group-hover:bg-bmkg-blue group-hover:text-white transition-colors">
                                {{ $i + 1 }}
                            </div>
                            <div>
                                <h3 class="font-bold text-bmkg-navy group-hover:text-bmkg-blue transition-colors">{{ $desa['nama'] }}</h3>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-gray-300 group-hover:text-bmkg-blue transition-all group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                @empty
                    <div class="col-span-full py-10 text-center text-gray-500 border-2 border-dashed border-gray-200 rounded-xl">
                        Tidak ada data desa/negeri untuk kecamatan ini.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
