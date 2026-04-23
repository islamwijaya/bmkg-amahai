@extends('layouts.app')

@section('title', 'Prakiraan Cuaca - ' . $desa_nama)

@section('breadcrumb')
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <a href="{{ route('prakiraan.cuaca') }}" class="hover:text-bmkg-blue transition-colors whitespace-nowrap">Maluku Tengah</a>
    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <span class="text-bmkg-blue font-semibold whitespace-nowrap overflow-hidden text-ellipsis max-w-[150px] inline-block align-bottom">{{ $desa_nama }}</span>
@endsection

@php
    function formatHari($dateStr) {
        $date = \Carbon\Carbon::parse($dateStr)->locale('id');
        $hariLokal = $date->isoFormat('dddd');
        return $hariLokal;
    }
    
    // Process the data to group properly by day. BMKG returns array of arrays, each sub-array seems to be a day.
    $hari_labels = ['Hari Ini', 'Besok', 'Lusa'];
@endphp

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">

    {{-- BUTTON BACK --}}
    <a href="javascript:history.back()" class="inline-flex items-center gap-2 text-gray-500 hover:text-bmkg-navy mb-6 transition-colors text-sm font-semibold">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali
    </a>

    {{-- PAGE HEADER --}}
    <div class="bg-gradient-to-r from-blue-900 to-indigo-800 rounded-2xl p-8 mb-8 text-white relative overflow-hidden shadow-lg border border-blue-800">
        <div class="absolute inset-0 opacity-20" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        <div class="relative flex flex-col md:flex-row gap-6 justify-between items-start md:items-center">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <p class="text-bmkg-lgold text-sm font-bold uppercase tracking-wider">Detail Prakiraan Cuaca BMKG</p>
                </div>
                <h1 class="text-xl md:text-2xl font-black mb-1 drop-shadow-md">{{ $desa_nama }}</h1>
                <p class="text-white/80 font-medium text-lg">{{ $kecamatan_nama }}, Maluku Tengah</p>
            </div>
            
            

        </div>
    </div>

    @if(empty($cuacaHarian))
        <div class="bg-red-50 border-l-4 border-red-500 p-6 rounded-xl text-red-700 font-medium shadow-sm">
            <svg class="w-6 h-6 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            Data prakiraan cuaca tidak ditemukan atau API BMKG sedang tidak tersedia untuk lokasi ini.
        </div>
    @else

    {{-- TABS SYSTEM (Alpine.js) --}}
    <div x-data="{ activeTab: 0 }" class="space-y-6">
        
        {{-- TAB BUTTONS --}}
        <div class="flex flex-wrap gap-2 md:gap-4 justify-center md:justify-start">
            @foreach($cuacaHarian as $index_hari => $prakiraan_harian)
                @php 
                    $label = $hari_labels[$index_hari] ?? 'Hari ' . ($index_hari + 1);
                    $first_entry_date = isset($prakiraan_harian[0]['local_datetime']) ? \Carbon\Carbon::parse($prakiraan_harian[0]['local_datetime'])->format('d M Y') : '';
                    $first_entry_hari = isset($prakiraan_harian[0]['local_datetime']) ? formatHari($prakiraan_harian[0]['local_datetime']) : '';
                @endphp
                <button @click="activeTab = {{ $index_hari }}" 
                        class="px-5 py-3 rounded-xl font-bold transition-all duration-300 relative flex flex-col items-center md:items-start group"
                        :class="activeTab === {{ $index_hari }} ? 'bg-bmkg-navy text-white shadow-lg scale-105 border-0' : 'bg-white text-gray-500 border border-gray-200 hover:border-bmkg-blue hover:text-bmkg-blue'">
                    <span class="text-sm md:text-base">{{ $label }}</span>
                    @if($first_entry_date)
                        <span class="text-xs font-normal" :class="activeTab === {{ $index_hari }} ? 'text-blue-100' : 'text-gray-400 group-hover:text-blue-400'">
                            {{ $first_entry_hari }}, {{ $first_entry_date }}
                        </span>
                    @endif
                </button>
            @endforeach
        </div>

        {{-- TAB CONTENT PANELS --}}
        <div class="bg-white border border-gray-100 rounded-3xl shadow-sm overflow-hidden p-6 relative">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-400 via-bmkg-blue to-teal-400"></div>
            
            @foreach($cuacaHarian as $index_hari => $prakiraan_harian)
            <div x-show="activeTab === {{ $index_hari }}" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                
                <div class="relative">
                    <div class="absolute right-0 top-0 bottom-0 w-8 bg-gradient-to-l from-white to-transparent pointer-events-none md:hidden z-10"></div>
                    <div class="overflow-x-auto pb-2 -mx-4 px-4 sm:mx-0 sm:px-0 scrollbar-hide">
                        <table class="w-full text-left border-collapse min-w-[640px]">
                        <thead>
                            <tr class="border-b-2 border-gray-100">
                                <th class="pb-3 pt-2 px-4 text-xs tracking-wider text-gray-400 uppercase font-bold w-24">Waktu</th>
                                <th class="pb-3 pt-2 px-4 text-xs tracking-wider text-gray-400 uppercase font-bold">Prakiraan</th>
                                <th class="pb-3 pt-2 px-4 text-xs tracking-wider text-gray-400 uppercase font-bold text-center">Suhu</th>
                                <th class="pb-3 pt-2 px-4 text-xs tracking-wider text-gray-400 uppercase font-bold text-center">Kelembapan</th>
                                <th class="pb-3 pt-2 px-4 text-xs tracking-wider text-gray-400 uppercase font-bold text-center w-32">Angin</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @if(is_array($prakiraan_harian))
                                @foreach($prakiraan_harian as $prakiraan)
                                    @php
                                        // Process Waktu
                                        $waktu_lokal_raw = isset($prakiraan["local_datetime"]) ? $prakiraan["local_datetime"] : null;
                                        $jam = $waktu_lokal_raw ? \Carbon\Carbon::parse($waktu_lokal_raw)->format('H:i') : "N/A";
                                        
                                        // Process image
                                        $raw_img = $prakiraan["image"] ?? "";
                                        $img_url = $raw_img ? str_replace(" ", "%20", $raw_img) : "";
                                        
                                        // Colors for Temp
                                        $temp = (int)($prakiraan["t"] ?? 0);
                                        $tempColor = 'text-gray-800';
                                        if($temp >= 33) $tempColor = 'text-red-600';
                                        elseif($temp >= 28) $tempColor = 'text-orange-600';
                                        elseif($temp <= 24) $tempColor = 'text-blue-600';

                                        // Wind Direction
                                        $arahAngin = [
                                            'N' => 'Utara', 'NNE' => 'Utara Timur Laut', 'NE' => 'Timur Laut', 'ENE' => 'Timur Timur Laut',
                                            'E' => 'Timur', 'ESE' => 'Timur Tenggara', 'SE' => 'Tenggara', 'SSE' => 'Selatan Tenggara',
                                            'S' => 'Selatan', 'SSW' => 'Selatan Barat Daya', 'SW' => 'Barat Daya', 'WSW' => 'Barat Barat Daya',
                                            'W' => 'Barat', 'WNW' => 'Barat Barat Laut', 'NW' => 'Barat Laut', 'NNW' => 'Utara Barat Laut',
                                            'C' => 'Tenang', 'VARIABLE' => 'Berubah-ubah'
                                        ];
                                        $wdRaw = strtoupper($prakiraan["wd"] ?? "");
                                        $wdTranslasi = $arahAngin[$wdRaw] ?? ($wdRaw ?: "-");
                                        
                                        // Wind Speed (km/h to knot)
                                        $wsKmh = (float)($prakiraan["ws"] ?? 0);
                                        $wsKnot = round($wsKmh * 0.539957, 1);
                                    @endphp
                                    <tr class="hover:bg-blue-50/40 transition-colors group">
                                        <td class="py-4 px-4">
                                            <div class="bg-gray-100 text-gray-700 group-hover:bg-bmkg-blue group-hover:text-white font-bold text-sm px-3 py-1.5 rounded-lg inline-block transition-colors">
                                                {{ $jam }}
                                            </div>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="flex items-center gap-4">
                                                @if($img_url)
                                                    <div class="w-12 h-12 bg-white rounded-full shadow-sm border border-gray-100 flex items-center justify-center -ml-2 p-1">
                                                        <img src="{{ $img_url }}" class="w-full h-full object-contain" alt="{{ $prakiraan['weather_desc'] ?? 'Cuaca' }}">
                                                    </div>
                                                @else
                                                    <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center -ml-2 text-xl">☁️</div>
                                                @endif
                                                <div class="font-bold text-gray-800 text-base">{{ $prakiraan["weather_desc"] ?? "N/A" }}</div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4 text-center">
                                            <div class="font-bold text-lg {{ $tempColor }}">{{ $prakiraan["t"] ?? "-" }}<span class="text-sm font-normal text-gray-500">°C</span></div>
                                        </td>
                                        <td class="py-4 px-4 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <span class="font-bold text-gray-700 text-lg">{{ $prakiraan["hu"] ?? "-" }}<span class="text-xs font-normal text-gray-400">%</span></span>
                                                <div class="w-10 h-1 mt-1 bg-gray-100 rounded-full overflow-hidden">
                                                    <div class="h-full bg-blue-400" style="width: {{ $prakiraan['hu'] ?? 0 }}%"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <div class="text-[11px] text-gray-500 mb-1 flex items-center justify-center gap-1 font-medium bg-gray-50 px-2 py-0.5 rounded border border-gray-100 w-full whitespace-nowrap">
                                                    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                                                    {{ $wdTranslasi }}
                                                </div>
                                                <div class="flex items-center justify-center gap-1.5 whitespace-nowrap">
                                                    <span class="font-bold text-gray-800">{{ $prakiraan["ws"] ?? "-" }} <span class="text-[10px] font-normal text-gray-500">km/jam</span></span>
                                                    @if(isset($prakiraan["ws"]))
                                                        <span class="text-gray-300 text-xs">|</span>
                                                        <span class="font-bold text-gray-800">{{ $wsKnot }} <span class="text-[10px] font-normal text-gray-500">knot</span></span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                    </table>
                </div>
                {{-- Mobile scroll hint --}}
                <div class="flex items-center justify-center gap-2 mt-3 text-gray-400 text-[10px] md:hidden">
                    <svg class="w-3 h-3 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                    <span>Geser untuk melihat detail</span>
                </div>
            </div>


            </div>
            @endforeach
        </div>
    </div>
    @endif
    
</div>
@endsection
