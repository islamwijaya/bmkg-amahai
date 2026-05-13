<!DOCTYPE html>
<html lang="id" x-data="{ mobileMenuOpen: false }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, viewport-fit=cover">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo-bmkg.png') }}">
    <title>@yield('title', 'Stasiun Meteorologi Kelas III Amahai') - BMKG</title>
    <meta name="description" content="@yield('meta_description', 'Website Resmi BMKG Stasiun Meteorologi Kelas III Amahai. Informasi cuaca, iklim, dan gempabumi wilayah Maluku Tengah dan sekitarnya.')">
    <meta name="keywords" content="@yield('meta_keywords', 'BMKG, Amahai, Maluku Tengah, Maluku, Cuaca, Iklim, Gempabumi, Prakiraan Cuaca, Peringatan Dini')">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Merriweather:ital,opsz,wght@0,18..144,300..900;1,18..144,300..900&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        bmkg: {
                            navy:   '#003366',
                            blue:   '#0057A8',
                            light:  '#1A78C2',
                            gold:   '#21AA93',
                            lgold:  '#E8C34A',
                            sky:    '#E8F4FF',
                            dark:   '#001F3F',
                        }
                    },
                    fontFamily: {
                        sans: ['Manrope', 'sans-serif'],
                        serif: ['Merriweather', 'serif'],
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
        .dropdown-group:hover .dropdown-menu { display: block; }
        .nav-link { position: relative; }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px; left: 50%; right: 50%;
            height: 2px;
            background: #C9A227;
            transition: left 0.25s ease, right 0.25s ease;
        }
        .nav-link:hover::after, .nav-link.active::after { left: 0; right: 0; }
        .top-bar-marquee { animation: marquee 35s linear infinite; white-space: nowrap; }
        @keyframes marquee { from { transform: translateX(100%); } to { transform: translateX(-100%); } }
        html { 
            -webkit-tap-highlight-color: transparent; 
            scroll-behavior: smooth;
        }
        body {
            /* Support iOS safe areas */
            padding-left: env(safe-area-inset-left);
            padding-right: env(safe-area-inset-right);
        }
    </style>
    @stack('styles')
</head>
<body class="font-sans bg-gray-50 text-gray-800 antialiased selection:bg-bmkg-gold/30 selection:text-bmkg-navy" x-data="{ mobileMenuOpen: false }">

{{-- TOP BAR INFO --}}
<div class="bg-bmkg-dark text-white text-xs py-1.5 overflow-hidden">
    <div class="flex items-center gap-2 px-4">
        <span class="shrink-0 font-semibold text-bmkg-gold tracking-wide">INFO:</span>
        <div class="overflow-hidden flex-1">
            <span class="top-bar-marquee inline-block">
                {!! $runningBanner !!}
            </span>
        </div>
    </div>
</div>

{{-- HEADER LOGO --}}
<header class="bg-white border-b-4 border-bmkg-gold shadow-md">
    <div class="max-w-7xl mx-auto px-4 py-3 flex items-center gap-3 sm:gap-4">
        {{-- Logo --}}
        <div class="flex items-center gap-2 sm:gap-3">
            <a href="{{ route('beranda') }}" class="shrink-0 bg-white rounded-full p-1.5 shadow-sm">
                <img src="{{ asset('assets/img/logo-bmkg.png') }}" alt="Logo BMKG" class="w-10 h-10 sm:w-16 sm:h-16 object-contain">
            </a>
            <div>
                <p class="text-bmkg-navy font-bold text-[10px] sm:text-xs tracking-widest uppercase line-clamp-1 sm:line-clamp-none">Badan Meteorologi, Klimatologi, dan Geofisika</p>
                <h1 class="text-bmkg-navy font-extrabold text-sm sm:text-lg leading-tight">Stasiun Meteorologi Kelas III Amahai</h1>
                <p class="text-bmkg-blue text-[10px] sm:text-xs font-medium hidden sm:block">Maluku Tengah — Provinsi Maluku</p>
            </div>
        </div>
        <div class="ml-auto flex flex-col items-end gap-1">
            <div class="flex items-center gap-3">
                <div class="text-right">
                    <p class="text-[10px] sm:text-xs text-gray-500 font-medium" id="live-date"></p>
                    <p class="text-bmkg-navy font-bold text-sm sm:text-lg" id="live-time"></p>
                </div>
            </div>
            <p class="text-[10px] sm:text-xs text-gray-400 hidden sm:block">WIT — Waktu Indonesia Timur</p>
            <p class="text-[10px] sm:text-xs text-gray-400 sm:hidden">WIT</p>
        </div>
    </div>
</header>

{{-- MAIN NAVIGATION --}}
<nav class="bg-bmkg-navy shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center justify-between">
            {{-- Desktop Menu --}}
            <div class="hidden md:flex items-center justify-center w-full">
                <a href="{{ url('/') }}" class="nav-link text-white text-sm font-semibold px-4 py-4 hover:text-bmkg-gold transition-colors {{ request()->is('/') ? 'text-bmkg-gold' : '' }}">
                    Beranda
                </a>

                {{-- Profil --}}
                <div class="dropdown-group relative">
                    <button class="nav-link text-white text-sm font-semibold px-4 py-4 hover:text-bmkg-gold transition-colors flex items-center gap-1.5 {{ request()->is('profil*') ? 'text-bmkg-gold' : '' }}">
                        Profil
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div class="dropdown-menu hidden absolute top-full left-0 w-48 bg-white rounded-b-xl shadow-2xl border-t-2 border-bmkg-gold overflow-hidden z-50">
                        <a href="{{ route('profil.sejarah') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-bmkg-sky hover:text-bmkg-blue font-medium transition-colors">
                            Sejarah
                        </a>
                        <a href="{{ url('/profil/visi-misi') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-bmkg-sky hover:text-bmkg-blue font-medium transition-colors border-t border-gray-100">
                            Visi & Misi
                        </a>
                        <a href="{{ url('/profil/sdm') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-bmkg-sky hover:text-bmkg-blue font-medium transition-colors border-t border-gray-100">
                            SDM
                        </a>
                        <a href="{{ route('profil.struktur') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-bmkg-sky hover:text-bmkg-blue font-medium transition-colors border-t border-gray-100">
                            Struktur Organisasi
                        </a>
                        <a href="{{ url('/profil/tugas-fungsi') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-bmkg-sky hover:text-bmkg-blue font-medium transition-colors border-t border-gray-100">
                            Tugas & Fungsi
                        </a>
                        <a href="{{ route('profil.kontak') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-bmkg-sky hover:text-bmkg-blue font-medium transition-colors border-t border-gray-100">
                            Kontak
                        </a>
                    </div>
                </div>

                {{-- Publik --}}
                <div class="dropdown-group relative">
                    <button class="nav-link text-white text-sm font-semibold px-4 py-4 hover:text-bmkg-gold transition-colors flex items-center gap-1.5 {{ request()->is('publik*') || request()->routeIs('informasi.*') ? 'text-bmkg-gold' : '' }}">
                        Publik
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div class="dropdown-menu hidden absolute top-full left-0 w-52 bg-white rounded-b-xl shadow-2xl border-t-2 border-bmkg-gold overflow-hidden z-50">
                        <a href="{{ route('informasi.index') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-bmkg-sky hover:text-bmkg-blue font-medium transition-colors">
                            Informasi
                        </a>
                        <a href="{{ route('publik.buletin') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-bmkg-sky hover:text-bmkg-blue font-medium transition-colors border-t border-gray-100">
                            Buletin
                        </a>
                        <a href="{{ url('/publik/kritik-saran') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-bmkg-sky hover:text-bmkg-blue font-medium transition-colors border-t border-gray-100">
                            Kritik & Saran
                        </a>
                        <a href="{{ url('/publik/survei') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-bmkg-sky hover:text-bmkg-blue font-medium transition-colors border-t border-gray-100">
                            Form Survei IKM
                        </a>

                        <a href="https://wbs.bmkg.go.id/" target="_blank" class="block px-4 py-3 text-sm text-gray-700 hover:bg-bmkg-sky hover:text-bmkg-blue font-medium transition-colors border-t border-gray-100">
                            Whistleblow BMKG
                        </a>
                        <a href="{{ route('publik.transparansi') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-bmkg-sky hover:text-bmkg-blue font-medium transition-colors border-t border-gray-100 {{ request()->routeIs('publik.transparansi') ? 'bg-bmkg-sky text-bmkg-blue' : '' }}">
                            Transparansi Kinerja
                        </a>
                    </div>
                </div>

                {{-- Prakiraan --}}
                <div class="dropdown-group relative">
                    <button class="nav-link text-white text-sm font-semibold px-4 py-4 hover:text-bmkg-gold transition-colors flex items-center gap-1.5 {{ request()->is('prakiraan*') ? 'text-bmkg-gold' : '' }}">
                        Prakiraan
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div class="dropdown-menu hidden absolute top-full left-1/2 -translate-x-1/2 w-[650px] bg-white rounded-b-xl shadow-2xl border-t-2 border-bmkg-gold p-6 z-50">
                        <div class="grid grid-cols-3 gap-8">
                            {{-- Column 1: Prakiraan Cuaca --}}
                            <div>
                                <h4 class="text-xs font-bold text-bmkg-navy uppercase tracking-wider mb-3 pb-2 border-b border-gray-100">Prakiraan Cuaca</h4>
                                <div class="flex flex-col gap-1">
                                    <a href="{{ url('/prakiraan/cuaca') }}" class="px-2 py-2 text-sm text-gray-700 hover:bg-bmkg-sky hover:text-bmkg-blue font-medium transition-colors rounded-lg">
                                        Prakiraan Cuaca
                                    </a>

                                    <a href="https://signature.bmkg.go.id/dwt/" target="_blank" class="px-2 py-2 text-sm text-gray-700 hover:bg-bmkg-sky hover:text-bmkg-blue font-medium transition-colors rounded-lg">
                                        Prakiraan Cuaca untuk Perjalanan
                                    </a>
                                    <a href="https://tropicalcyclone.bmkg.go.id/#4.63/-5.19/129.81" target="_blank" class="px-2 py-2 text-sm text-gray-700 hover:bg-bmkg-sky hover:text-bmkg-blue font-medium transition-colors rounded-lg">
                                        Informasi Siklon Tropis
                                    </a>
                                </div>
                            </div>
                            {{-- Column 2: Prakiraan Maritim --}}
                            <div>
                                <h4 class="text-xs font-bold text-bmkg-navy uppercase tracking-wider mb-3 pb-2 border-b border-gray-100">Prakiraan Maritim</h4>
                                <div class="flex flex-col gap-1">
                                    <a href="{{ route('prakiraan.cuaca-perairan') }}" class="px-2 py-2 text-sm text-gray-700 hover:bg-bmkg-sky hover:text-bmkg-blue font-medium transition-colors rounded-lg {{ request()->routeIs('prakiraan.cuaca-perairan') ? 'bg-bmkg-sky text-bmkg-blue' : '' }}">
                                        Prakiraan Cuaca Perairan
                                    </a>
                                    <a href="https://peta-maritim.bmkg.go.id/ofs/" target="_blank" class="px-2 py-2 text-sm text-gray-700 hover:bg-bmkg-sky hover:text-bmkg-blue font-medium transition-colors rounded-lg">
                                        Prakiraan Tinggi Gelombang
                                    </a>
                                </div>
                            </div>
                            {{-- Column 3: Prakiraan Penerbangan --}}
                            <div>
                                <h4 class="text-xs font-bold text-bmkg-navy uppercase tracking-wider mb-3 pb-2 border-b border-gray-100">Prakiraan Penerbangan</h4>
                                <div class="flex flex-col gap-1">
                                    <a href="https://web-aviation.bmkg.go.id/web/airport_forecast.php?icao=wapa" target="_blank" class="px-2 py-2 text-sm text-gray-700 hover:bg-bmkg-sky hover:text-bmkg-blue font-medium transition-colors rounded-lg">
                                        Prakiraan Cuaca Bandara
                                    </a>
                                    <a href="https://inasiam.bmkg.go.id" target="_blank" class="px-2 py-2 text-sm text-gray-700 hover:bg-bmkg-sky hover:text-bmkg-blue font-medium transition-colors rounded-lg">
                                        InaSIAM
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="{{ url('/gempa-bumi') }}" class="nav-link text-white text-sm font-semibold px-4 py-4 hover:text-bmkg-gold transition-colors {{ request()->is('gempa-bumi*') ? 'text-bmkg-gold' : '' }}">
                    Gempa Bumi
                </a>

                {{-- Pelayanan Data --}}
                <div class="dropdown-group relative">
                    <button class="nav-link text-white text-sm font-semibold px-4 py-4 hover:text-bmkg-gold transition-colors flex items-center gap-1.5 {{ request()->is('pelayanan*') ? 'text-bmkg-gold' : '' }}">
                        Pelayanan Data
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div class="dropdown-menu hidden absolute top-full left-0 w-52 bg-white rounded-b-xl shadow-2xl border-t-2 border-bmkg-gold overflow-hidden z-50">
                        <a href="{{ url('/pelayanan/prosedur') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-bmkg-sky hover:text-bmkg-blue font-medium transition-colors">
                            Prosedur
                        </a>
                        <a href="{{ url('/pelayanan/tarif') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-bmkg-sky hover:text-bmkg-blue font-medium transition-colors border-t border-gray-100">
                            Jenis dan Tarif Layanan
                        </a>
                        <a href="https://ptsp.bmkg.go.id/" target="_blank" class="block px-4 py-3 text-sm text-gray-700 hover:bg-bmkg-sky hover:text-bmkg-blue font-medium transition-colors border-t border-gray-100">
                            Pelayanan Terpadu Satu Pintu
                        </a>
                        <a href="https://dataonline.bmkg.go.id/dataonline-home" target="_blank" class="block px-4 py-3 text-sm text-gray-700 hover:bg-bmkg-sky hover:text-bmkg-blue font-medium transition-colors border-t border-gray-100">
                            Data Online BMKG
                        </a>
                    </div>
                </div>
            </div>

            {{-- Mobile Toggle --}}
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-white p-3 ml-auto">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Mobile Menu Dropdown --}}
        <div x-show="mobileMenuOpen" x-cloak x-transition.opacity.duration.300ms class="md:hidden border-t border-white/20 py-2 max-h-[80vh] overflow-y-auto">
            <a href="{{ url('/') }}" class="block px-4 py-3 text-white text-base font-medium hover:bg-bmkg-blue/40 border-b border-white/5 active:bg-bmkg-blue/60 transition-colors {{ request()->is('/') ? 'text-bmkg-gold bg-bmkg-blue/20' : '' }}">Beranda</a>
            <a href="{{ route('informasi.index') }}" class="block px-4 py-3 text-white text-base font-medium hover:bg-bmkg-blue/40 border-b border-white/5 active:bg-bmkg-blue/60 transition-colors {{ request()->routeIs('informasi.*') ? 'text-bmkg-gold bg-bmkg-blue/20' : '' }}">Informasi</a>
            
            {{-- Profil Mobile Accordion --}}
            <div x-data="{ openProfil: false }" class="border-b border-white/5">
                <button @click="openProfil = !openProfil" class="w-full flex items-center justify-between px-4 py-3 text-white text-base font-medium hover:bg-bmkg-blue/40 active:bg-bmkg-blue/60 transition-colors {{ request()->is('profil*') ? 'text-bmkg-gold bg-bmkg-blue/20' : '' }}">
                    Profil
                    <svg class="w-4 h-4 transition-transform duration-200" :class="openProfil ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="openProfil" x-collapse x-cloak class="bg-black/10 text-sm">
                    <a href="{{ route('profil.sejarah') }}" class="block pl-8 pr-4 py-3 text-white/90 hover:text-white hover:bg-white/5 active:bg-white/10 transition-colors">Sejarah</a>
                    <a href="{{ url('/profil/visi-misi') }}" class="block pl-8 pr-4 py-3 text-white/90 hover:text-white hover:bg-white/5 active:bg-white/10 transition-colors border-t border-white/5">Visi & Misi</a>
                    <a href="{{ url('/profil/sdm') }}" class="block pl-8 pr-4 py-3 text-white/90 hover:text-white hover:bg-white/5 active:bg-white/10 transition-colors border-t border-white/5">SDM</a>
                    <a href="{{ route('profil.struktur') }}" class="block pl-8 pr-4 py-3 text-white/90 hover:text-white hover:bg-white/5 active:bg-white/10 transition-colors border-t border-white/5">Struktur Organisasi</a>
                    <a href="{{ url('/profil/tugas-fungsi') }}" class="block pl-8 pr-4 py-3 text-white/90 hover:text-white hover:bg-white/5 active:bg-white/10 transition-colors border-t border-white/5">Tugas & Fungsi</a>
                    <a href="{{ route('profil.kontak') }}" class="block pl-8 pr-4 py-3 text-white/90 hover:text-white hover:bg-white/5 active:bg-white/10 transition-colors border-t border-white/5">Kontak</a>
                </div>
            </div>

            {{-- Publik Mobile Accordion --}}
            <div x-data="{ openPublik: false }" class="border-b border-white/5">
                <button @click="openPublik = !openPublik" class="w-full flex items-center justify-between px-4 py-3 text-white text-base font-medium hover:bg-bmkg-blue/40 active:bg-bmkg-blue/60 transition-colors {{ request()->is('publik*') ? 'text-bmkg-gold bg-bmkg-blue/20' : '' }}">
                    Publik
                    <svg class="w-4 h-4 transition-transform duration-200" :class="openPublik ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="openPublik" x-collapse x-cloak class="bg-black/10 text-sm">
                    <a href="{{ route('informasi.index') }}" class="block pl-8 pr-4 py-3 text-white/90 hover:text-white hover:bg-white/5 active:bg-white/10 transition-colors">Informasi</a>
                    <a href="{{ route('publik.buletin') }}" class="block pl-8 pr-4 py-3 text-white/90 hover:text-white hover:bg-white/5 active:bg-white/10 transition-colors border-t border-white/5">Buletin</a>
                    <a href="{{ url('/publik/kritik-saran') }}" class="block pl-8 pr-4 py-3 text-white/90 hover:text-white hover:bg-white/5 active:bg-white/10 transition-colors border-t border-white/5">Kritik & Saran</a>
                    <a href="{{ url('/publik/survei') }}" class="block pl-8 pr-4 py-3 text-white/90 hover:text-white hover:bg-white/5 active:bg-white/10 transition-colors border-t border-white/5">Form Survei IKM</a>

                    <a href="https://wbs.bmkg.go.id/" target="_blank" class="block pl-8 pr-4 py-3 text-white/90 hover:text-white hover:bg-white/5 active:bg-white/10 transition-colors border-t border-white/5">Whistleblow BMKG</a>
                    <a href="{{ route('publik.transparansi') }}" class="block pl-8 pr-4 py-3 text-white/90 hover:text-white hover:bg-white/5 active:bg-white/10 transition-colors border-t border-white/5">Transparansi Kinerja</a>
                </div>
            </div>

            {{-- Prakiraan Mobile Accordion --}}
            <div x-data="{ openPrakiraan: false }" class="border-b border-white/5">
                <button @click="openPrakiraan = !openPrakiraan" class="w-full flex items-center justify-between px-4 py-3 text-white text-base font-medium hover:bg-bmkg-blue/40 active:bg-bmkg-blue/60 transition-colors {{ request()->is('prakiraan*') ? 'text-bmkg-gold bg-bmkg-blue/20' : '' }}">
                    Prakiraan
                    <svg class="w-4 h-4 transition-transform duration-200" :class="openPrakiraan ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="openPrakiraan" x-collapse x-cloak class="bg-black/10 text-sm">
                    <div class="px-8 py-2 text-bmkg-gold text-[10px] font-bold uppercase tracking-wider">Cuaca</div>
                    <a href="{{ url('/prakiraan/cuaca') }}" class="block pl-8 pr-4 py-3 text-white/90 hover:text-white hover:bg-white/5 active:bg-white/10 transition-colors">Prakiraan Cuaca</a>

                    <a href="https://signature.bmkg.go.id/dwt/" target="_blank" class="block pl-8 pr-4 py-3 text-white/90 hover:text-white hover:bg-white/5 active:bg-white/10 transition-colors border-t border-white/5">Cuaca untuk Perjalanan</a>
                    <a href="https://tropicalcyclone.bmkg.go.id/#4.63/-5.19/129.81" target="_blank" class="block pl-8 pr-4 py-3 text-white/90 hover:text-white hover:bg-white/5 active:bg-white/10 transition-colors border-t border-white/5">Siklon Tropis</a>
                    
                    <div class="px-8 py-2 border-t border-white/10 text-bmkg-gold text-[10px] font-bold uppercase tracking-wider mt-1">Maritim & Penerbangan</div>
                    <a href="{{ route('prakiraan.cuaca-perairan') }}" class="block pl-8 pr-4 py-3 text-white/90 hover:text-white hover:bg-white/5 active:bg-white/10 transition-colors border-t border-white/5">Prakiraan Cuaca Perairan</a>
                    <a href="https://peta-maritim.bmkg.go.id/ofs/" target="_blank" class="block pl-8 pr-4 py-3 text-white/90 hover:text-white hover:bg-white/5 active:bg-white/10 transition-colors border-t border-white/5">Tinggi Gelombang</a>
                    <a href="https://web-aviation.bmkg.go.id/web/airport_forecast.php?icao=wapa" target="_blank" class="block pl-8 pr-4 py-3 text-white/90 hover:text-white hover:bg-white/5 active:bg-white/10 transition-colors border-t border-white/5">Cuaca Bandara</a>
                    <a href="https://inasiam.bmkg.go.id" target="_blank" class="block pl-8 pr-4 py-3 text-white/90 hover:text-white hover:bg-white/5 active:bg-white/10 transition-colors border-t border-white/5">InaSIAM</a>
                </div>
            </div>

            <a href="{{ url('/gempa-bumi') }}" class="block px-4 py-3 text-white text-base font-medium hover:bg-bmkg-blue/40 border-b border-white/5 active:bg-bmkg-blue/60 transition-colors {{ request()->is('gempa-bumi*') ? 'text-bmkg-gold bg-bmkg-blue/20' : '' }}">Gempa Bumi</a>
            
            {{-- Pelayanan Data Mobile Accordion --}}
            <div x-data="{ openPelayanan: false }">
                <button @click="openPelayanan = !openPelayanan" class="w-full flex items-center justify-between px-4 py-3 text-white text-base font-medium hover:bg-bmkg-blue/40 active:bg-bmkg-blue/60 transition-colors {{ request()->is('pelayanan*') ? 'text-bmkg-gold bg-bmkg-blue/20' : '' }}">
                    Pelayanan Data
                    <svg class="w-4 h-4 transition-transform duration-200" :class="openPelayanan ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="openPelayanan" x-collapse x-cloak class="bg-black/10 text-sm">
                    <a href="{{ url('/pelayanan/prosedur') }}" class="block pl-8 pr-4 py-3 text-white/90 hover:text-white hover:bg-white/5 active:bg-white/10 transition-colors">Prosedur</a>
                    <a href="{{ url('/pelayanan/tarif') }}" class="block pl-8 pr-4 py-3 text-white/90 hover:text-white hover:bg-white/5 active:bg-white/10 transition-colors border-t border-white/5">Jenis dan Tarif Layanan</a>
                    <a href="https://ptsp.bmkg.go.id/" target="_blank" class="block pl-8 pr-4 py-3 text-white/90 hover:text-white hover:bg-white/5 active:bg-white/10 transition-colors border-t border-white/5">Pelayanan Terpadu Satu Pintu</a>
                    <a href="https://dataonline.bmkg.go.id/dataonline-home" target="_blank" class="block pl-8 pr-4 py-3 text-white/90 hover:text-white hover:bg-white/5 active:bg-white/10 transition-colors border-t border-white/5">Data Online BMKG</a>
                </div>
            </div>
        </div>
    </div>
</nav>

{{-- BREADCRUMB --}}
@if(trim($__env->yieldContent('breadcrumb')))
<div class="bg-bmkg-sky border-b border-blue-100">
    <div class="max-w-7xl mx-auto px-4 py-2 flex items-center gap-2 text-xs text-gray-500">
        <a href="{{ url('/') }}" class="hover:text-bmkg-blue font-medium">Beranda</a>
        @yield('breadcrumb')
    </div>
</div>
@endif

{{-- PAGE CONTENT --}}
<main>
    @yield('content')
</main>

{{-- FOOTER --}}
<footer class="bg-bmkg-dark text-white mt-12">
    <div class="max-w-7xl mx-auto px-4 pt-10 pb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 pb-8 border-b border-white/10">
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="bg-white rounded-full p-1 shadow-sm">
                        <img src="{{ asset('assets/img/logo-bmkg.png') }}" alt="BMKG" class="w-10 h-10 object-contain">
                    </div>
                    <div>
                        <p class="font-bold text-bmkg-gold text-sm leading-tight">BMKG</p>
                        <p class="text-white/80 text-xs">Stamet Amahai</p>
                    </div>
                </div>
                <p class="text-white/60 text-sm leading-relaxed">Stasiun Meteorologi Kelas III Amahai melayani kebutuhan informasi meteorologi, klimatologi, dan geofisika untuk wilayah Maluku Tengah.</p>
            </div>
            <div>
                <h3 class="font-bold text-bmkg-gold text-sm uppercase tracking-wider mb-4">LINK TERKAIT</h3>
                <ul class="space-y-3">
                    @foreach([
                        ['BMKG', 'https://www.bmkg.go.id/'],
                        ['Meteorologi Penerbangan', 'https://aviation.bmkg.go.id/'],
                        ['INASIAM', 'https://inasiam.bmkg.go.id/'],
                        ['Cuaca BMKG', 'https://cuaca.bmkg.go.id/'],
                        ['Signature BMKG', 'https://signature.bmkg.go.id/'],
                        ['E-Pengaduan BMKG', 'https://epengaduan.bmkg.go.id/'],
                        ['PPID BMKG', 'https://ppid.bmkg.go.id/'],
                    ] as $link)
                    <li>
                        <a href="{{ $link[1] }}" target="_blank" class="text-white/70 text-sm hover:text-bmkg-gold transition-colors flex items-center justify-between group">
                            <span>{{ $link[0] }}</span>
                            <svg class="w-3 h-3 opacity-50 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h3 class="font-bold text-bmkg-gold text-sm uppercase tracking-wider mb-4">Kontak Kami</h3>
                <ul class="space-y-3 text-sm text-white/70">
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 mt-0.5 text-bmkg-gold shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        BMKG Amahai, Jl. Bandara Amahai, Amahai, Maluku Tengah
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-500 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.246 2.248 3.484 5.232 3.484 8.412-.003 6.557-5.338 11.892-11.893 11.892-1.997-.001-3.951-.5-5.688-1.448l-6.309 1.656zm6.29-4.143c1.565.933 3.176 1.423 4.842 1.425a10.063 10.063 0 0010.045-10.045c-.002-2.684-1.047-5.207-2.942-7.103a9.999 9.999 0 00-7.103-2.938 10.044 10.044 0 00-10.045 10.045c.002 1.761.474 3.483 1.367 5.011l-.974 3.557 3.655-.959zm11.722-6.841c-.322-.161-1.904-.94-2.202-1.049-.297-.108-.514-.162-.731.162-.217.324-.838 1.048-1.026 1.265-.188.217-.377.243-.699.082-.322-.161-1.359-.501-2.588-1.598-.956-.853-1.597-1.906-1.785-2.23-.188-.323-.02-.497.14-.658.145-.145.323-.377.484-.565.161-.188.215-.323.322-.538.108-.215.054-.404-.027-.565-.081-.161-.731-1.761-1.002-2.41-.264-.633-.53-.547-.731-.557-.188-.009-.404-.01-.621-.01s-.568.081-.865.404c-.297.324-1.137 1.11-1.137 2.709s1.163 3.141 1.325 3.357c.162.216 2.288 3.493 5.542 4.896.774.333 1.378.533 1.85.683.778.247 1.487.213 2.047.129.623-.093 1.904-.778 2.175-1.509.271-.73.271-1.357.19-1.487-.081-.131-.298-.21-.621-.371z"/></svg>
                        <a href="https://wa.me/+6282198942869" target="_blank" class="hover:text-emerald-400 transition-colors">+62 821 9894 2869</a>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-bmkg-gold shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        stamet.amahai@bmkg.go.id
                    </li>
                </ul>
                <div class="mt-4 flex gap-2">
                    <a href="https://www.facebook.com/BMKG.AMAHAI/" target="_blank" class="w-8 h-8 rounded-full bg-bmkg-blue/50 hover:bg-bmkg-blue flex items-center justify-center transition-colors" title="Facebook">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
                    </a>
                    <a href="https://www.instagram.com/stamet.amahai.bmkg/" target="_blank" class="w-8 h-8 rounded-full bg-bmkg-blue/50 hover:bg-bmkg-blue flex items-center justify-center transition-colors" title="Instagram">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" fill="#001F3F"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5" stroke="#001F3F" stroke-width="1.5" stroke-linecap="round"/></svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="pt-5 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex flex-col md:flex-row items-center gap-2 md:gap-4 text-center md:text-left">
                <p class="text-white/50 text-xs text-center md:text-left">© {{ date('Y') }} Stasiun Meteorologi Kelas III Amahai — BMKG.</p>
                <p class="text-white/40 text-[10px] hidden md:block">|</p>
                <a href="{{ route('login') }}" class="text-white/30 hover:text-bmkg-gold text-xs transition-colors py-2 md:py-0">Admin Login</a>
            </div>
            <p class="text-white/40 text-[10px] sm:text-xs text-center md:text-right">Badan Meteorologi, Klimatologi, dan Geofisika Republik Indonesia</p>
        </div>
    </div>
</footer>

<script>
function updateClock() {
    const now = new Date();
    const dateEl = document.getElementById('live-date');
    const timeEl = document.getElementById('live-time');
    if (dateEl && timeEl) {
        const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
        const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agt','Sep','Okt','Nov','Des'];
        dateEl.textContent = `${days[now.getDay()]}, ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;
        timeEl.textContent = now.toLocaleTimeString('id-ID', {hour:'2-digit', minute:'2-digit', second:'2-digit'});
    }
}
updateClock();
setInterval(updateClock, 1000);
</script>
@stack('scripts')
</body>
</html>
