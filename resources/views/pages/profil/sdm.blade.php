@extends('layouts.app')

@section('title', 'Sumber Daya Manusia & Pegawai | BMKG Meteorologi Amahai')
@section('meta_description', 'Profil Aparatur Sipil Negara (ASN) dan tenaga profesional di lingkungan BMKG Stasiun Meteorologi Amahai yang bertugas mengamati cuaca 24 jam.')
@section('meta_keywords', 'pegawai bmkg amahai, sdm bmkg, profil anggota bmkg, meteorologi maluku tengah, asn bmkg')

@section('breadcrumb')
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <a href="{{ url('/profil/sejarah') }}" class="hover:text-bmkg-blue">Profil</a>
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <span class="text-bmkg-blue font-semibold">SDM</span>
@endsection

@section('content')

<div class="max-w-7xl mx-auto px-4 py-10">
    {{-- PAGE HEADER --}}
    <div class="relative overflow-hidden bg-gradient-to-r from-bmkg-navy to-bmkg-blue rounded-2xl p-8 mb-10 text-white shadow-xl">
        <div class="absolute inset-0 z-0 pointer-events-none">
            <div class="absolute inset-0 bg-gradient-to-r from-bmkg-navy via-bmkg-navy/80 to-transparent z-10 w-[80%] md:w-[60%]"></div>
            <img src="{{ asset('assets/img/foto-kantor.png') }}" alt="Gedung BMKG" class="absolute right-0 top-0 w-full md:w-1/2 h-full object-cover opacity-30 mix-blend-luminosity grayscale">
        </div>
        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-2">
                <div class="h-1 w-8 bg-bmkg-gold rounded-full"></div>
                <p class="text-bmkg-lgold text-sm font-semibold uppercase tracking-wider">Profil</p>
            </div>
            <h1 class="text-xl md:text-2xl font-black mb-2">Sumber Daya Manusia</h1>
            <p class="text-white/70">Struktur Organisasi Pegawai Stasiun Meteorologi Kelas III Amahai — BMKG</p>
        </div>
    </div>


    {{-- ═══════════════════════════════════════════════════════ --}}
    {{-- KEPALA UPT — centered at top                           --}}
    {{-- ═══════════════════════════════════════════════════════ --}}
    @if($kepalaUpt)
    <div class="flex flex-col items-center mb-10">
        <div class="w-40 sm:w-48 bg-white rounded-2xl border-2 border-bmkg-gold shadow-lg overflow-hidden group">
            <div class="aspect-square relative overflow-hidden bg-gray-50">
                @if(!empty($kepalaUpt['foto']))
                <img src="{{ $kepalaUpt['foto'] }}" alt="{{ $kepalaUpt['nama'] }}" class="w-full h-full object-cover">
                @else
                @php $initials = collect(explode(' ', $kepalaUpt['nama']))->filter(fn($w) => strlen($w) > 0)->map(fn($w) => strtoupper($w[0]))->take(2)->join(''); @endphp
                <div class="w-full h-full flex flex-col items-center justify-center">
                    <div class="w-16 h-16 rounded-full bg-bmkg-navy flex items-center justify-center">
                        <span class="text-white font-extrabold text-xl">{{ $initials }}</span>
                    </div>
                </div>
                @endif
            </div>
            <div class="h-1.5 bg-gradient-to-r from-bmkg-gold to-yellow-400 w-full"></div>
            <div class="p-4 text-center">
                <h3 class="font-bold text-bmkg-navy text-sm leading-tight tracking-tight mb-1">{{ $kepalaUpt['nama'] }}</h3>
                <p class="text-bmkg-blue text-[11px] font-semibold tracking-wider">{{ $kepalaUpt['jabatan'] }}</p>
            </div>
        </div>
    </div>
    @endif



    {{-- ═══════════════════════════════════════════════════════ --}}
    {{-- TIM KERJA                                              --}}
    {{-- ═══════════════════════════════════════════════════════ --}}
    @if(!empty($timKerja))
    <div class="mb-10">
        {{-- Group header --}}
        <div class="flex items-center gap-3 mb-6">
            <div class="w-1.5 h-8 bg-bmkg-blue rounded-full"></div>
            <div>
                <h2 class="text-lg font-black text-bmkg-navy uppercase tracking-wide">Tim Kerja</h2>
                <p class="text-xs text-gray-400">Pelaksana tugas pokok fungsional dan teknis</p>
            </div>
        </div>

        <div class="space-y-8">
            @foreach($timKerja as $subKey => $sub)
            <div>
                {{-- Sub-unit header --}}
                <div class="flex items-center gap-2 mb-4 pl-1">
                    <svg class="w-4 h-4 text-bmkg-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    <h3 class="text-sm font-bold text-bmkg-navy uppercase tracking-wider">{{ $sub['label'] }}</h3>
                    <div class="flex-1 h-px bg-gray-200"></div>
                    <span class="text-xs text-gray-400 font-medium">{{ count($sub['members']) + ($sub['ketua'] ? 1 : 0) }} orang</span>
                </div>

                {{-- Member cards grid --}}
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
                    {{-- Render Ketua Tim --}}
                    @if($sub['ketua'])
                    @php $p = $sub['ketua']; $initials = collect(explode(' ', $p['nama']))->filter(fn($w) => strlen($w) > 0)->map(fn($w) => strtoupper($w[0]))->take(2)->join(''); @endphp
                    <div class="bg-white rounded-xl border border-bmkg-gold shadow-sm hover:shadow-md hover:ring-1 hover:ring-bmkg-gold/50 transition-all duration-300 overflow-hidden group relative">
                        <div class="absolute top-0 right-0 bg-bmkg-gold text-white text-[9px] font-black px-2 py-1 rounded-bl-lg z-10 shadow-sm uppercase tracking-widest">
                            Ketua
                        </div>
                        <div class="aspect-square relative overflow-hidden bg-gray-50">
                            @if(!empty($p['foto']))
                            <img src="{{ $p['foto'] }}" alt="{{ $p['nama'] }}" class="w-full h-full object-cover">
                            @else
                            <div class="w-full h-full flex flex-col items-center justify-center p-4 text-center">
                                <div class="w-12 h-12 rounded-full bg-bmkg-sky flex items-center justify-center mb-2">
                                    <span class="text-bmkg-blue font-extrabold text-sm">{{ $initials }}</span>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="h-1 bg-gradient-to-r from-bmkg-gold to-yellow-400 w-full"></div>
                        <div class="p-3 text-center">
                            <p class="text-bmkg-gold text-[9px] font-bold uppercase tracking-wider mb-1">Ketua Tim Kerja</p>
                            <h4 class="font-bold text-bmkg-navy text-xs leading-tight tracking-tight mb-1 group-hover:text-bmkg-blue transition-colors">{{ $p['nama'] }}</h4>
                            <p class="text-bmkg-blue text-[10px] font-semibold tracking-wider">{{ $p['jabatan'] }}</p>
                        </div>
                    </div>
                    @endif

                    {{-- Render Members --}}
                    @foreach($sub['members'] as $i => $p)
                    @php $initials = collect(explode(' ', $p['nama']))->filter(fn($w) => strlen($w) > 0)->map(fn($w) => strtoupper($w[0]))->take(2)->join(''); @endphp
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md hover:ring-1 hover:ring-bmkg-blue/30 transition-all duration-300 overflow-hidden group">
                        <div class="aspect-square relative overflow-hidden bg-gray-50">
                            @if(!empty($p['foto']))
                            <img src="{{ $p['foto'] }}" alt="{{ $p['nama'] }}" class="w-full h-full object-cover">
                            @else
                            <div class="w-full h-full flex flex-col items-center justify-center p-4 text-center">
                                <div class="w-12 h-12 rounded-full bg-bmkg-sky flex items-center justify-center mb-2">
                                    <span class="text-bmkg-blue font-extrabold text-sm">{{ $initials }}</span>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="h-1 bg-bmkg-blue w-full"></div>
                        <div class="p-3 text-center">
                            <h4 class="font-bold text-bmkg-navy text-xs leading-tight tracking-tight mb-1 group-hover:text-bmkg-blue transition-colors">{{ $p['nama'] }}</h4>
                            <p class="text-bmkg-blue text-[10px] font-semibold tracking-wider">{{ $p['jabatan'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Empty state --}}
    @if(!$kepalaUpt && empty($timKerja))
    <div class="text-center py-16">
        <svg class="mx-auto w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
        </svg>
        <p class="text-gray-400 text-sm">Belum ada data pegawai yang tersedia.</p>
    </div>
    @endif
</div>
@endsection
