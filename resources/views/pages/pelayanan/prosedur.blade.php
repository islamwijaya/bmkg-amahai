@extends('layouts.app')

@section('title', 'Prosedur Pelayanan Data & Informasi | BMKG Meteorologi Amahai')
@section('meta_description', 'Informasi lengkap mengenai prosedur permohonan data meteorologi, klimatologi, dan geofisika di BMKG Amahai, baik secara online maupun offline.')
@section('meta_keywords', 'prosedur layanan bmkg, permintaan data meteorologi, ptsp bmkg, data online bmkg, layanan publik amahai')

@section('breadcrumb')
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <a href="#" class="hover:text-bmkg-blue">Pelayanan Data</a>
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <span class="text-bmkg-blue font-semibold">Prosedur</span>
@endsection

@section('content')
<div class="max-w-5xl mx-auto px-4 py-10">
    {{-- Page Header --}}
    <div class="relative overflow-hidden bg-gradient-to-r from-bmkg-navy to-emerald-700 rounded-2xl p-8 mb-10 text-white shadow-xl">
        <div class="absolute inset-0 z-0 pointer-events-none">
            <div class="absolute inset-0 bg-gradient-to-r from-bmkg-navy via-bmkg-navy/80 to-transparent z-10 w-[80%] md:w-[60%]"></div>
            <img src="{{ asset('assets/img/foto-kantor.png') }}" alt="Gedung BMKG" class="absolute right-0 top-0 w-full md:w-1/2 h-full object-cover opacity-30 mix-blend-luminosity grayscale">
        </div>
        <div class="relative z-20">
            <div class="flex items-center gap-3 mb-2">
                <div class="h-1 w-8 bg-bmkg-gold rounded-full"></div>
                <p class="text-bmkg-lgold text-sm font-semibold uppercase tracking-wider">Pelayanan Terpadu</p>
            </div>
            <h1 class="text-2xl md:text-3xl font-black mb-2 uppercase tracking-tight">Prosedur Pelayanan Data & Informasi MKG</h1>
            <p class="text-white/70 text-sm md:text-base">Mekanisme standar operasional pelayanan data meteorologi, klimatologi, dan geofisika</p>
        </div>
    </div>

    <div class="space-y-12">
        {{-- Visual Flow Diagram --}}
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 md:p-12 relative overflow-hidden">
            {{-- Background Decorative Element --}}
            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-blue-600 via-bmkg-gold to-emerald-600"></div>

            {{-- START PATHS: ONLINE vs OFFLINE --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-16 mb-12 relative">
                {{-- ONLINE PATH --}}
                <div class="relative">
                    <div class="bg-blue-600 text-white font-black text-center py-3 rounded-xl mb-6 shadow-lg transform -skew-x-6">
                        <span class="inline-block transform skew-x-6 italic tracking-widest">ONLINE</span>
                    </div>
                    
                    <div class="space-y-6 relative">
                        {{-- Step 1 Online --}}
                        <div class="bg-white border-2 border-blue-500/20 rounded-2xl p-5 shadow-sm hover:shadow-md transition-all relative z-10">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center font-bold shrink-0">1</div>
                                <p class="text-sm font-bold text-gray-700">Mengisi form permohonan</p>
                            </div>
                        </div>

                        {{-- Arrow Down --}}
                        <div class="flex justify-center -my-2 opacity-40">
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 14l-7 7-7-7"/></svg>
                        </div>

                        {{-- Step 2 Online --}}
                        <div class="bg-white border-2 border-blue-500/20 rounded-2xl p-5 shadow-sm hover:shadow-md transition-all relative z-10">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center font-bold shrink-0">2</div>
                                <div>
                                    <p class="text-sm font-bold text-gray-700">Cek ketersediaan data & kelengkapan dokumen</p>
                                    <p class="text-[10px] text-blue-600 mt-1 italic font-medium">*tarif Rp. 0,-(nol) rupiah mengikuti ketentuan yang berlaku</p>
                                </div>
                            </div>
                        </div>

                        {{-- Final Connector to Center --}}
                        <div class="absolute -bottom-10 left-1/2 -translate-x-1/2 w-0.5 h-10 bg-gradient-to-b from-blue-500 to-bmkg-gold hidden md:block"></div>
                    </div>
                </div>

                {{-- OFFLINE PATH --}}
                <div class="relative">
                    <div class="bg-emerald-600 text-white font-black text-center py-3 rounded-xl mb-6 shadow-lg transform skew-x-6">
                        <span class="inline-block transform -skew-x-6 italic tracking-widest">OFFLINE</span>
                    </div>

                    <div class="space-y-6 relative">
                        {{-- Step 1 Offline --}}
                        <div class="bg-white border-2 border-emerald-500/20 rounded-2xl p-5 shadow-sm hover:shadow-md transition-all relative z-10">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-lg flex items-center justify-center font-bold shrink-0">1</div>
                                <p class="text-sm font-bold text-gray-700">Mengisi buku tamu & form permohonan</p>
                            </div>
                        </div>

                        {{-- Arrow Down --}}
                        <div class="flex justify-center -my-2 opacity-40">
                            <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 14l-7 7-7-7"/></svg>
                        </div>

                        {{-- Step 2 Offline --}}
                        <div class="bg-white border-2 border-emerald-500/20 rounded-2xl p-5 shadow-sm hover:shadow-md transition-all relative z-10">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-lg flex items-center justify-center font-bold shrink-0">2</div>
                                <div>
                                    <p class="text-sm font-bold text-gray-700">Cek ketersediaan data & kelengkapan dokumen</p>
                                    <p class="text-[10px] text-emerald-600 mt-1 italic font-medium">*tarif Rp. 0,-(nol) rupiah mengikuti ketentuan yang berlaku</p>
                                </div>
                            </div>
                        </div>

                        {{-- Final Connector to Center --}}
                        <div class="absolute -bottom-10 left-1/2 -translate-x-1/2 w-0.5 h-10 bg-gradient-to-b from-emerald-500 to-bmkg-gold hidden md:block"></div>
                    </div>
                </div>
                
                {{-- Arrow connectors for Mobile --}}
                <div class="md:hidden flex flex-col items-center py-4">
                    <div class="w-1 h-8 bg-gradient-to-b from-gray-200 to-bmkg-gold"></div>
                </div>
            </div>

            {{-- MERGE POINT: PENETAPAN TARIF --}}
            <div class="flex justify-center mb-10">
                <div class="w-full md:w-2/3 bg-bmkg-navy text-white p-6 rounded-2xl shadow-xl text-center border-b-4 border-bmkg-gold relative z-20">
                    <div class="absolute -top-3 left-1/2 -translate-x-1/2 bg-bmkg-gold text-bmkg-navy text-[10px] font-black px-4 py-1 rounded-full uppercase tracking-tighter shadow-sm">TAHAP LANJUT</div>
                    <div class="flex flex-col items-center gap-1">
                        <h3 class="font-bold text-lg">Penetapan tarif PNBP</h3>
                    </div>
                </div>
            </div>

            {{-- SHARED LINEAR PATH --}}
            <div class="max-w-2xl mx-auto space-y-6">
                @php
                $sharedSteps = [
                    ['Simponi','Pembuatan tagihan pembayaran dengan aplikasi Simponi'],
                    ['Pembayaran','Pembayaran PNBP & konfirmasi bukti bayar sesuai tagihan pada kode billing'],
                    ['Survey IKM','Mengisi survey IKM'],
                    ['Selesai','Menerima data/informasi']
                ];
                @endphp

                @foreach($sharedSteps as $i => $step)
                <div class="flex flex-col items-center">
                    {{-- Shared Step Card --}}
                    <div class="w-full bg-white border-2 border-bmkg-blue/20 rounded-2xl p-5 shadow-sm hover:shadow-md transition-all relative z-10">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-bmkg-sky text-bmkg-blue rounded-lg flex items-center justify-center font-bold shrink-0">{{ $i + 4 }}</div>
                            <p class="text-sm font-bold text-gray-700 leading-snug">{{ $step[1] }}</p>
                        </div>
                    </div>

                    {{-- Arrow Down (except last) --}}
                    @if(!$loop->last)
                    <div class="py-2 opacity-40">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 14l-7 7-7-7"/></svg>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>

        {{-- Additional Info Sections --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Syarat --}}
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8">
                <h3 class="font-extrabold text-bmkg-navy text-lg mb-6 flex items-center gap-3">
                    <span class="w-1.5 h-6 bg-bmkg-gold rounded-full"></span>
                    Dokumen Pendukung
                </h3>
                <div class="space-y-3">
                    @foreach([
                        'Fotokopi KTP/Identitas resmi',
                        'Surat permohonan resmi (jika instansi)',
                        'Surat pernyataan tidak memperjualbelikan data',
                        'Formulir permohonan yang telah diisi'
                    ] as $s)
                    <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-2xl group hover:bg-bmkg-sky transition-colors cursor-default">
                        <div class="mt-1 w-5 h-5 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 shrink-0">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-gray-700 text-sm font-medium">{{ $s }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Waktu Layanan --}}
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8">
                <h3 class="font-extrabold text-bmkg-navy text-lg mb-6 flex items-center gap-3">
                    <span class="w-1.5 h-6 bg-blue-600 rounded-full"></span>
                    Waktu Layanan
                </h3>
                <div class="grid grid-cols-1 gap-4">
                    <div class="p-6 border-2 border-bmkg-sky bg-blue-50/30 rounded-2xl">
                        <p class="text-bmkg-navy font-bold text-sm mb-1 uppercase tracking-wider">Senin — Jumat</p>
                        <p class="text-2xl font-black text-blue-600 tracking-tight">07.30 — 16.00 <span class="text-sm text-blue-400 font-bold ml-1">WIT</span></p>
                    </div>
                    <div class="p-6 bg-gray-50 rounded-2xl">
                        <p class="text-gray-400 font-bold text-xs mb-1 uppercase tracking-wider">Sabtu, Minggu & Hari Libur</p>
                        <p class="text-lg font-bold text-gray-400">Tutup</p>
                    </div>
                </div>
                <p class="text-[11px] text-gray-500 mt-6 leading-relaxed bg-amber-50 p-3 rounded-xl border border-amber-100">
                    <span class="font-bold text-amber-700 uppercase">Perhatian:</span> Layanan di luar jam operasional hanya tersedia untuk koordinasi darurat (Bencana/SAR).
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
