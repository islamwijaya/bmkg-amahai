@extends('layouts.app')

@section('title', 'Struktur Organisasi | BMKG Meteorologi Amahai')
@section('meta_description', 'Struktur organisasi Stasiun Meteorologi Kelas III Amahai BMKG. Bagan hierarki kepegawaian dan unit kerja.')
@section('meta_keywords', 'struktur organisasi bmkg amahai, bagan organisasi, unit kerja bmkg, kepala stasiun amahai')

@section('breadcrumb')
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <a href="{{ url('/profil/sejarah') }}" class="hover:text-bmkg-blue">Profil</a>
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <span class="text-bmkg-blue font-semibold">Struktur Organisasi</span>
@endsection

@push('styles')
<style>
    /* ── Org Chart Connector & Grid System ── */
    .org-tree {
        --line-color: #cbd5e1;
        --line-width: 2px;
    }
    
    .c-grid {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        width: 100%;
        min-width: 1300px;
    }

    /* Continuous unbroken lines via absolute placement */
    .line-v { position: absolute; width: var(--line-width); background: var(--line-color); transform: translateX(-50%); }
    .line-h { position: absolute; height: var(--line-width); background: var(--line-color); }

    /* ── Card Styles ── Berdasarkan Gambar Request User ── */
    .org-card {
        display: flex;
        align-items: center;
        gap: 12px;
        background: white;
        border: 1.5px solid #f1f5f9;
        border-radius: 20px; /* Rounded corners as per image */
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        padding: 12px 16px;
        transition: all 0.2s ease;
        cursor: default;
        width: 100%;
        max-width: 240px;
        z-index: 10;
        position: relative;
    }
    .org-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.06);
        border-color: #e2e8f0;
    }
    
    /* Highlight for specific major nodes - but same horizontal style */
    .org-card-head { border: 2px solid rgba(0,87,168,0.15); max-width: 280px; padding: 16px 20px; }
    .org-card-kasubag { border: 2px solid rgba(139,92,246,0.15); }
    .org-card-koordinator { border: 2px solid rgba(0,87,168,0.15); background: #f8fafc; }

    /* Avatars / Initials Circles */
    .avatar-circle {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8fafc;
        border: 1px solid #f1f5f9;
        flex-shrink: 0;
        overflow: hidden;
    }
    .avatar-circle-lg { width: 64px; height: 64px; }
    
    .avatar-img { width: 100%; height: 100%; object-fit: cover; }
    
    .initials-text {
        font-weight: 800;
        color: #64748b;
        font-size: 14px;
        letter-spacing: -0.02em;
    }
    .initials-text-lg { font-size: 18px; }

    /* Text Content */
    .card-content { min-width: 0; flex: 1; text-align: left; }
    
    .card-name {
        font-weight: 800;
        color: #003366; /* BMKG Navy as per image */
        font-size: 11px;
        line-height: 1.25;
        text-transform: uppercase;
        margin-bottom: 2px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .card-name-lg { font-size: 13px; }
    
    .card-title {
        font-weight: 700;
        color: #94a3b8; /* Slated Gray as per image */
        font-size: 9px;
        text-transform: uppercase;
        letter-spacing: 0.02em;
    }
    .card-title-lg { font-size: 10px; }

    /* Unit headers - now cards as well */
    .unit-card-header {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 18px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: white;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        white-space: nowrap;
        z-index: 10;
        text-align: center;
    }
    .unit-blue { background: linear-gradient(135deg, #0057A8, #003366); }
    .unit-purple { background: linear-gradient(135deg, #8b5cf6, #6d28d9); }
    .unit-green { background: linear-gradient(135deg, #10b981, #059669); }
    
    .sub-col { width: 100%; max-width: 220px; }
</style>
@endpush

@section('content')
<div class="bg-gray-50/50 py-12 min-h-screen">
    <div class="max-w-[1400px] mx-auto px-4">

        {{-- Page Header --}}
        <div class="text-center mb-10">
            <div class="flex items-center justify-center gap-3 mb-4">
                <img src="{{ asset('assets/img/logo-bmkg.png') }}" alt="BMKG" class="w-12 h-12 object-contain">
                <div class="text-left">
                    <p class="text-gray-500 text-xs font-bold uppercase tracking-widest">Stasiun Meteorologi Kelas III</p>
                    <p class="text-bmkg-navy text-xl font-black uppercase tracking-wide">Amahai</p>
                </div>
            </div>
            <h1 class="text-3xl font-black text-bmkg-navy uppercase tracking-tight">Struktur Organisasi</h1>
            <div class="h-1 w-20 bg-bmkg-gold mx-auto mt-4 rounded-full"></div>
        </div>

        {{-- Scrollable Org Chart --}}
        <div class="w-full overflow-x-auto pb-12 custom-scrollbar">
            <div class="org-tree c-grid mx-auto">
                
                {{-- ═════════════════════════════════════════ --}}
                {{-- ROW 1: KEPALA UPT                        --}}
                {{-- ═════════════════════════════════════════ --}}
                <div class="col-span-12 relative flex justify-center h-24 pt-2 z-10">
                    @if($kepalaUpt)
                    <div class="absolute" style="left: 50%; transform: translateX(-50%);">
                        <div class="org-card org-card-head">
                            <div class="avatar-circle avatar-circle-lg">
                                @if(!empty($kepalaUpt['foto']))
                                <img src="{{ $kepalaUpt['foto'] }}" alt="{{ $kepalaUpt['nama'] }}" class="avatar-img">
                                @else
                                @php $ki = collect(explode(' ', $kepalaUpt['nama']))->filter(fn($w) => strlen($w) > 0)->map(fn($w) => strtoupper($w[0]))->take(2)->join(''); @endphp
                                <span class="initials-text initials-text-lg">{{ $ki }}</span>
                                @endif
                            </div>
                            <div class="card-content">
                                <p class="card-name card-name-lg">{{ $kepalaUpt['nama'] }}</p>
                                <p class="card-title card-title-lg">{{ $kepalaUpt['jabatan'] }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Trunk to split --}}
                <div class="col-span-12 relative h-10">
                    <div class="line-v h-full" style="left: 50%; top: 0;"></div>
                </div>

                {{-- Split Horizontal Line --}}
                <div class="col-span-12 relative h-10">
                    <div class="line-h" style="top: 0; left: 33.333333%; width: 50%;"></div>
                    <div class="line-v h-full" style="left: 33.333333%; top: 0;"></div>
                    <div class="line-v h-full" style="left: 83.333333%; top: 0;"></div>
                </div>

                {{-- ═════════════════════════════════════════ --}}
                {{-- ROW 4: KASUBAG TU                        --}}
                {{-- ═════════════════════════════════════════ --}}
                <div class="col-span-8 flex justify-center items-start relative h-20">
                    {{-- Koordinator Removed - Line continues down --}}
                    <div class="line-v h-full" style="left: 50%; top: 0;"></div>
                </div>
                <div class="col-span-4 flex justify-center items-start relative h-20">
                    <div class="line-v h-full" style="left: 50%; top: 0;"></div>
                </div>

                {{-- Trunks down --}}
                <div class="col-span-12 relative h-10">
                    <div class="line-v h-full" style="left: 33.333333%; top: 0;"></div>
                    <div class="line-v h-full" style="left: 83.333333%; top: 0;"></div>
                </div>

                {{-- Horizontal connectors level 3 --}}
                <div class="col-span-8 relative h-8">
                    <div class="line-h" style="top: 0; left: 12.5%; right: 12.5%;"></div>
                    <div class="line-v h-full" style="left: 12.5%; top: 0;"></div>
                    <div class="line-v h-full" style="left: 37.5%; top: 0;"></div>
                    <div class="line-v h-full" style="left: 62.5%; top: 0;"></div>
                    <div class="line-v h-full" style="left: 87.5%; top: 0;"></div>
                </div>
                <div class="col-span-4 relative h-8">
                    <div class="line-h" style="top: 0; left: 25%; right: 25%;"></div>
                    <div class="line-v h-full" style="left: 25%; top: 0;"></div>
                    <div class="line-v h-full" style="left: 75%; top: 0;"></div>
                </div>

                {{-- ═════════════════════════════════════════ --}}
                {{-- ROW 7: SUB-UNITS & MEMBERS               --}}
                {{-- ═════════════════════════════════════════ --}}
                <div class="col-span-8 flex justify-between pr-0">
                    @foreach($unitOperasional as $subKey => $sub)
                    <div class="flex-1 flex flex-col items-center">
                        <div class="unit-card-header unit-blue mb-5">{{ $sub['label'] }}</div>
                        <div class="space-y-3 px-2 sub-col">
                            @foreach($sub['members'] as $p)
                            @php $initials = collect(explode(' ', $p['nama']))->filter(fn($w) => strlen($w) > 0)->map(fn($w) => strtoupper($w[0]))->take(2)->join(''); @endphp
                            <div class="org-card">
                                <div class="avatar-circle">
                                    @if(!empty($p['foto']))
                                    <img src="{{ $p['foto'] }}" alt="{{ $p['nama'] }}" class="avatar-img">
                                    @else
                                    <span class="initials-text">{{ $initials }}</span>
                                    @endif
                                </div>
                                <div class="card-content">
                                    <p class="card-name">{{ $p['nama'] }}</p>
                                    <p class="card-title">{{ $p['jabatan'] }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="col-span-4 flex justify-between">
                    {{-- TU --}}
                    <div class="flex-1 flex flex-col items-center">
                        <div class="unit-card-header unit-purple mb-5">Unit Tata Usaha</div>
                        <div class="space-y-3 px-2 sub-col">
                            @foreach($unitTataUsaha as $p)
                            @php $initials = collect(explode(' ', $p['nama']))->filter(fn($w) => strlen($w) > 0)->map(fn($w) => strtoupper($w[0]))->take(2)->join(''); @endphp
                            <div class="org-card">
                                <div class="avatar-circle">
                                    @if(!empty($p['foto']))
                                    <img src="{{ $p['foto'] }}" alt="{{ $p['nama'] }}" class="avatar-img">
                                    @else
                                    <span class="initials-text">{{ $initials }}</span>
                                    @endif
                                </div>
                                <div class="card-content">
                                    <p class="card-name">{{ $p['nama'] }}</p>
                                    <p class="card-title">{{ $p['jabatan'] }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- PPNPN --}}
                    <div class="flex-1 flex flex-col items-center">
                        <div class="unit-card-header unit-green mb-5">PPNPN</div>
                        <div class="space-y-3 px-2 sub-col">
                            @foreach($ppnpn as $p)
                            @php $initials = collect(explode(' ', $p['nama']))->filter(fn($w) => strlen($w) > 0)->map(fn($w) => strtoupper($w[0]))->take(2)->join(''); @endphp
                            <div class="org-card">
                                <div class="avatar-circle">
                                    @if(!empty($p['foto']))
                                    <img src="{{ $p['foto'] }}" alt="{{ $p['nama'] }}" class="avatar-img">
                                    @else
                                    <span class="initials-text">{{ $initials }}</span>
                                    @endif
                                </div>
                                <div class="card-content">
                                    <p class="card-name">{{ $p['nama'] }}</p>
                                    <p class="card-title">{{ $p['jabatan'] }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- Footer --}}
        <div class="mt-8 text-center border-t border-gray-300/60 pt-6 pb-2">
            <p class="text-gray-500 text-xs font-bold uppercase tracking-widest flex items-center justify-center gap-2">
                <svg class="w-4 h-4 text-bmkg-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Terakhir update pada {{ now()->translatedFormat('d F Y') }}
            </p>
        </div>
    </div>
</div>

<style>
/* Custom scrollbar */
.custom-scrollbar::-webkit-scrollbar { height: 8px; }
.custom-scrollbar::-webkit-scrollbar-track { background: #f8fafc; border-radius: 4px; border: 1px solid #e2e8f0; }
.custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
.custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
</style>
@endsection
