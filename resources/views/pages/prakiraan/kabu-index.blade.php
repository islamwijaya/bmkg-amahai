@extends('layouts.app')

@section('title', 'Prakiraan Cuaca Maluku Hari Ini | BMKG Meteorologi Amahai')
@section('meta_description', 'Cek prakiraan cuaca hari ini dan besok untuk Amahai, Maluku Tengah dan sekitarnya. Sumber informasi hidrometeorologi resmi BMKG Stasiun Amahai.')
@section('meta_keywords', 'prakiraan cuaca, cuaca amahai, cuaca maluku tengah, prediksi hujan, bmkg amahai, cuaca hari ini, cuaca besok, prakiraan cuaca harian')

@section('breadcrumb')
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <span class="text-bmkg-blue font-semibold">Prakiraan Cuaca Maluku Tengah</span>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    {{-- PAGE HEADER --}}
    <div class="bg-gradient-to-r from-bmkg-navy to-bmkg-blue rounded-2xl p-8 mb-8 text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg viewBox="0 0 400 200" class="w-full h-full"><circle cx="350" cy="100" r="150" fill="white"/><circle cx="50" cy="150" r="80" fill="white"/></svg>
        </div>
        <div class="relative">
            <div class="flex items-center gap-3 mb-2">
                <div class="h-1 w-8 bg-bmkg-gold rounded-full"></div>
                <p class="text-bmkg-lgold text-sm font-semibold uppercase tracking-wider">Prakiraan Cuaca</p>
            </div>
            <h1 class="text-xl md:text-2xl font-black mb-2">Kabupaten Maluku Tengah</h1>
            <p class="text-white/70">Pilih Kecamatan untuk melihat detail prakiraan cuaca per Desa/Negeri</p>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="bg-bmkg-sky px-6 py-4 border-b border-blue-100 flex justify-between items-center">
            <h2 class="text-lg font-bold text-bmkg-navy">Daftar Kecamatan</h2>
            <span class="bg-white text-bmkg-blue text-xs font-bold px-3 py-1 rounded-full border border-blue-200">Total: {{ count($wilayah) }}</span>
        </div>
        
        <div class="p-6">
            <div class="overflow-x-auto rounded-xl border border-gray-200 hidden md:block">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-bold w-16 text-center">No</th>
                            <th scope="col" class="px-6 py-4 font-bold">Nama Kecamatan</th>
                            <th scope="col" class="px-6 py-4 font-bold text-center">Jumlah Desa</th>
                            <th scope="col" class="px-6 py-4 font-bold text-center w-40">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @php $no = 1; @endphp
                        @forelse($wilayah as $id => $kec)
                            <tr class="hover:bg-blue-50/50 transition-colors group">
                                <td class="px-6 py-4 font-medium text-gray-500 text-center">{{ $no++ }}</td>
                                <td class="px-6 py-4 font-bold text-bmkg-navy">{{ $kec['nama'] }}</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="bg-blue-100 text-blue-800 py-1 px-3 rounded-full text-xs font-semibold">
                                        {{ count($kec['desa']) }} Desa/Negeri
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('prakiraan.cuaca.desa', $id) }}" 
                                       class="inline-flex items-center gap-2 bg-white text-bmkg-blue hover:text-white border border-bmkg-blue hover:bg-bmkg-blue px-4 py-2 rounded-xl text-xs font-bold transition-all shadow-sm hover:shadow-md group">
                                        Pilih
                                        <svg class="w-3.5 h-3.5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                                    Data kecamatan tidak tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- MOBILE VIEW: Cards --}}
            <div class="md:hidden space-y-3">
                @php $noCards = 1; @endphp
                @forelse($wilayah as $id => $kec)
                    <div class="bg-white border border-gray-100 rounded-xl p-4 shadow-sm relative pl-12 flex flex-col items-start gap-4">
                        <div class="absolute left-4 top-4 w-6 h-6 rounded-full bg-bmkg-sky flex justify-center items-center text-bmkg-blue font-bold text-xs">
                            {{ $noCards++ }}
                        </div>
                        <div class="w-full">
                            <h3 class="font-bold text-bmkg-navy mb-1">{{ $kec['nama'] }}</h3>
                            <span class="bg-blue-100 text-blue-800 py-0.5 px-2 rounded-md text-[10px] font-semibold">
                                {{ count($kec['desa']) }} Desa/Negeri
                            </span>
                        </div>
                        <a href="{{ route('prakiraan.cuaca.desa', $id) }}" 
                           class="w-full text-center inline-flex justify-center items-center gap-2 bg-white text-bmkg-blue hover:text-white border border-bmkg-blue hover:bg-bmkg-blue px-4 py-2 rounded-xl text-xs font-bold transition-all">
                            Pilih Kecamatan
                        </a>
                    </div>
                @empty
                    <div class="py-6 text-center text-gray-400 border border-dashed border-gray-200 rounded-xl">
                        Data kecamatan tidak tersedia.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
