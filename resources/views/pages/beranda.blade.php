@extends('layouts.app')

@section('title', 'BMKG Meteorologi Amahai | Prakiraan Cuaca & Info Gempa Terkini')
@section('meta_description', 'Dapatkan prakiraan cuaca hari ini, peringatan dini, dan info iklim terkini untuk wilayah Maluku Tengah dan sekitarnya dari BMKG Stasiun Meteorologi Amahai.')
@section('meta_keywords', 'cuaca hari ini, prakiraan cuaca, info gempa terkini, cuaca amahai, maluku tengah, bmkg amahai, peringatan dini cuaca, satelit cuaca, radar cuaca, maluku')

@section('content')

    {{-- HERO WEATHER CAROUSEL --}}
    <section class="bg-gray-50 py-6">
        <h1 class="sr-only">BMKG Stasiun Meteorologi Amahai - Informasi Cuaca & Klimatologi Terkini Maluku Tengah</h1>
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h2 class="text-bmkg-navy font-bold text-2xl">Prakiraan Cuaca</h2>
                    <p class="text-gray-500 text-xs text-opacity-80">Kabupaten Maluku Tengah — Hari Ini</p>
                </div>
                <a href="{{ url('/prakiraan/cuaca') }}"
                    class="bg-bmkg-gold/20 border border-bmkg-gold/50 hover:bg-bmkg-gold hover:text-bmkg-dark text-bmkg-gold text-xs font-semibold px-4 py-2 rounded-full transition-all">
                    Lihat Lengkap →
                </a>
            </div>

            {{-- CAROUSEL --}}
            <div x-data="weatherCarousel()" @touchstart="touchStart" @touchmove="touchMove" @touchend="touchEnd"
                @mousedown="mouseDown" @mouseleave="mouseLeave" @mouseup="mouseUp" @mousemove="mouseMove"
                class="relative cursor-grab active:cursor-grabbing select-none">
                <div class="overflow-hidden rounded-2xl" @dragstart.prevent>
                    <div class="flex transition-transform duration-500 ease-in-out"
                        :style="`transform: translateX(-${current * (100/visibleCards)}%)`">
                        @foreach($weatherCards as $i => $card)
                            <div class="shrink-0 px-2" :style="`width: ${100/visibleCards}%`">
                                <a href="{{ url('/prakiraan/cuaca/kecamatan/' . $card['id']) }}" class="block h-full">
                                    <div
                                        class="bg-gradient-to-br from-bmkg-navy to-bmkg-blue border border-bmkg-blue/20 rounded-xl p-5 text-white shadow-md hover:shadow-lg transition-all cursor-pointer h-full group">
                                        <div class="flex items-start justify-between mb-3">
                                            <div>
                                                <p class="text-bmkg-gold font-bold text-[10px] uppercase tracking-wider">Kec.
                                                </p>
                                                <h3
                                                    class="font-bold text-base leading-tight group-hover:text-bmkg-gold transition-colors">
                                                    {{ $card['kecamatan'] }}</h3>
                                            </div>
                                            {{-- Weather Icon SVG --}}
                                            <div class="w-14 h-14">
                                                @if($card['icon'] === 'sunny')
                                                    <svg viewBox="0 0 48 48" class="w-full h-full">
                                                        <circle cx="24" cy="24" r="10" fill="#FDD835" />
                                                        <g stroke="#FDD835" stroke-width="2" stroke-linecap="round">
                                                            <line x1="24" y1="4" x2="24" y2="10" />
                                                            <line x1="24" y1="38" x2="24" y2="44" />
                                                            <line x1="4" y1="24" x2="10" y2="24" />
                                                            <line x1="38" y1="24" x2="44" y2="24" />
                                                            <line x1="9.4" y1="9.4" x2="13.7" y2="13.7" />
                                                            <line x1="34.3" y1="34.3" x2="38.6" y2="38.6" />
                                                            <line x1="38.6" y1="9.4" x2="34.3" y2="13.7" />
                                                            <line x1="13.7" y1="34.3" x2="9.4" y2="38.6" />
                                                        </g>
                                                    </svg>
                                                @elseif($card['icon'] === 'cloudy' || $card['icon'] === 'overcast')
                                                    <svg viewBox="0 0 48 48" class="w-full h-full">
                                                        <path d="M36 34H12a8 8 0 010-16 7.9 7.9 0 013.4.77A10 10 0 1136 34z"
                                                            fill="#90CAF9" />
                                                    </svg>
                                                @elseif($card['icon'] === 'partly')
                                                    <svg viewBox="0 0 48 48" class="w-full h-full">
                                                        <circle cx="18" cy="18" r="8" fill="#FDD835" />
                                                        <path d="M38 34H18a7 7 0 010-14 6.9 6.9 0 012.9.65A8.5 8.5 0 1138 34z"
                                                            fill="#BBDEFB" />
                                                    </svg>
                                                @elseif($card['icon'] === 'rainy')
                                                    <svg viewBox="0 0 48 48" class="w-full h-full">
                                                        <path d="M36 28H12a8 8 0 010-16 7.9 7.9 0 013.4.77A10 10 0 1136 28z"
                                                            fill="#90CAF9" />
                                                        <g stroke="#1565C0" stroke-width="2" stroke-linecap="round">
                                                            <line x1="16" y1="33" x2="14" y2="39" />
                                                            <line x1="24" y1="33" x2="22" y2="39" />
                                                            <line x1="32" y1="33" x2="30" y2="39" />
                                                        </g>
                                                    </svg>
                                                @else
                                                    <svg viewBox="0 0 48 48" class="w-full h-full">
                                                        <path d="M36 24H12a8 8 0 010-16 7.9 7.9 0 013.4.77A10 10 0 1136 24z"
                                                            fill="#78909C" />
                                                        <g stroke="#0D47A1" stroke-width="2.5" stroke-linecap="round">
                                                            <line x1="14" y1="30" x2="12" y2="38" />
                                                            <line x1="22" y1="30" x2="20" y2="38" />
                                                            <line x1="30" y1="30" x2="28" y2="38" />
                                                            <line x1="38" y1="30" x2="36" y2="38" />
                                                        </g>
                                                    </svg>
                                                @endif
                                            </div>
                                        </div>
                                        <p class="text-white/80 text-sm font-medium mb-3">{{ $card['cuaca'] }}</p>
                                        <div class="bg-white/10 rounded-lg p-3 space-y-2">
                                            <div class="flex justify-between items-center text-xs">
                                                <span class="text-white/60">Suhu</span>
                                                <span class="font-bold text-bmkg-lgold">{{ $card['suhu_min'] }}° —
                                                    {{ $card['suhu_max'] }}°C</span>
                                            </div>
                                            <div class="flex justify-between items-center text-xs">
                                                <span class="text-white/60">Kelembaban</span>
                                                <span class="font-semibold">{{ $card['kelembaban'] }}%</span>
                                            </div>
                                            <div class="flex justify-between items-center text-xs">
                                                <span class="text-white/60">Angin</span>
                                                <span class="font-semibold text-right">{{ $card['angin'] }}
                                                    {{ $card['kec_angin'] ?? 0 }} km/j</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Dots --}}
                <div class="flex justify-center flex-wrap gap-1.5 mt-5 px-4" x-show="weatherCards.length > visibleCards">
                    <template x-for="i in totalDots" :key="i">
                        <button @click="goTo(i-1)" class="w-2 h-2 rounded-full transition-all shrink-0"
                            :class="current === i-1 ? 'bg-bmkg-gold w-6' : 'bg-gray-300'"></button>
                    </template>
                </div>
            </div>
        </div>
    </section>

    {{-- CITRA SATELIT --}}
    @include('components.citra-satelit')

    {{-- PROMO BULETIN AIDA --}}
    <section class="bg-bmkg-navy py-8 lg:py-10 overflow-hidden relative border-b border-gray-800"
        x-data="{ scrollProgress: 0 }" @scroll.window="
                let rect = $el.getBoundingClientRect();
                let vh = window.innerHeight;
                // Progress is 0 when section enters from bottom, 1 when it reaches top of screen
                scrollProgress = Math.max(0, Math.min(1, (vh - rect.top) / vh));
             ">

        {{-- Interactive Dark Gradient Overlay --}}
        <div class="absolute inset-0 bg-gradient-to-b from-bmkg-navy via-[#0a192f] to-[#010912] pointer-events-none z-0 transition-opacity duration-100 ease-linear"
            :style="`opacity: ${scrollProgress}`"></div>

        {{-- Decorative Background Elements --}}
        <div
            class="absolute top-0 right-0 w-96 h-96 bg-bmkg-blue/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3 z-0 pointer-events-none">
        </div>
        <div
            class="absolute bottom-0 left-0 w-64 h-64 bg-bmkg-gold/10 rounded-full blur-3xl translate-y-1/3 -translate-x-1/4 z-0 pointer-events-none">
        </div>

        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">

                {{-- AIDA Text Content (Left) --}}
                <div class="lg:col-span-5">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="w-6 h-1 bg-bmkg-gold rounded-full"></span>
                        <span class="text-bmkg-gold font-bold text-[10px] uppercase tracking-widest">Layanan Buletin</span>
                    </div>

                    <h2 class="text-2xl lg:text-3xl font-black text-white mb-4 leading-tight">
                        {{ $activeAida['attention'] }}
                    </h2>

                    <p class="text-white/70 text-xs lg:text-sm leading-relaxed mb-6">
                        {{ $activeAida['interest_desire'] }}
                    </p>

                    <a href="{{ route('publik.buletin') }}"
                        class="inline-flex items-center gap-2 bg-bmkg-gold text-bmkg-dark px-6 py-2.5 rounded-full font-bold text-xs hover:bg-white transition-colors shadow-[0_0_15px_rgba(33,170,147,0.2)] group">
                        {{ $activeAida['action'] }}
                        <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>

                {{-- Bulletin Cards Carousel (Right) --}}
                <div class="lg:col-span-7" x-data="promoCarousel({{ count($promoBulletins) }})">
                    @if(count($promoBulletins) > 0)
                                    <div class="relative w-full h-[300px] md:h-[350px] flex items-center justify-center perspective-[1000px]"
                                        @mouseenter="pause()" @mouseleave="resume()">
                                        <template x-for="(card, index) in {{ json_encode($promoBulletins->map(function ($b) {
                            return [
                                'title' => $b->title,
                                'edition' => $b->edition,
                                'image' => $b->cover_url ?? null,
                                'file_url' => $b->file_url,
                                'is_pdf' => str_ends_with(strtolower($b->file_path), '.pdf'),
                                'url' => route('publik.buletin', ['tahun' => $b->year, 'bulan' => $b->month, 'active' => $b->id])
                            ];
                        })) }}" :key="index">
                                            <div class="absolute w-[160px] md:w-[200px] h-[240px] md:h-[280px] rounded-2xl shadow-xl transition-all duration-700 cursor-pointer overflow-hidden border border-white/10 group bg-white"
                                                @click="if (activeIndex === index) window.location.href = card.url; else activeIndex = index;"
                                                :class="{
                                                    'z-30 scale-100 opacity-100 translate-x-0': activeIndex === index,
                                                    'z-20 scale-90 opacity-60 md:translate-x-[60%] translate-x-[30%]': activeIndex === (index - 1 + total) % total || (index === 0 && activeIndex === total - 1 && total > 2) || (total === 2 && activeIndex === 0 && index === 1),
                                                    'z-20 scale-90 opacity-60 md:-translate-x-[60%] -translate-x-[30%]': activeIndex === (index + 1) % total || (index === total - 1 && activeIndex === 0 && total > 2) || (total === 2 && activeIndex === 1 && index === 0),
                                                    'z-10 scale-75 opacity-0': total > 3 && Math.abs(activeIndex - index) > 1 && !(activeIndex === 0 && index === total - 1) && !(activeIndex === total - 1 && index === 0)
                                                 }">

                                                {{-- Card Image (Manual Cover) --}}
                                                <template x-if="card.image">
                                                    <img :src="card.image" :alt="card.title"
                                                        class="absolute inset-0 w-full h-full object-cover">
                                                </template>

                                                {{-- PDF Auto Cover via Canvas --}}
                                                <template x-if="!card.image && card.is_pdf">
                                                    <div
                                                        class="absolute inset-0 w-full h-full bg-white flex items-center justify-center relative overflow-hidden">
                                                        <div :id="'pdf-loader-' + index"
                                                            class="absolute inset-0 flex items-center justify-center bg-gray-50 border border-gray-100 transition-opacity duration-300">
                                                            <svg class="w-6 h-6 text-gray-300 animate-spin" fill="none" viewBox="0 0 24 24">
                                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                                    stroke-width="4"></circle>
                                                                <path class="opacity-75" fill="currentColor"
                                                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                                </path>
                                                            </svg>
                                                        </div>
                                                        <canvas :id="'pdf-canvas-' + index"
                                                            class="w-full h-full object-cover relative z-10 transition-opacity duration-500 opacity-0"
                                                            x-init="if(!$store.pdfRendered) { $store.pdfRendered = {}; } if(!$store.pdfRendered[index]) { window.renderPdfCover(card.file_url, 'pdf-canvas-' + index, 'pdf-loader-' + index); $store.pdfRendered[index] = true; }"></canvas>
                                                    </div>
                                                </template>

                                                {{-- Placeholder for MS Publisher --}}
                                                <template x-if="!card.image && !card.is_pdf">
                                                    <div
                                                        class="absolute inset-0 w-full h-full bg-gradient-to-br from-bmkg-sky to-gray-100 flex flex-col items-center justify-center">
                                                        <svg class="w-12 h-12 text-bmkg-blue/20 mb-2" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                        </svg>
                                                        <span
                                                            class="text-[8px] font-bold text-bmkg-blue/30 uppercase tracking-widest">Dokumen
                                                            Publisher</span>
                                                    </div>
                                                </template>

                                                {{-- Card Overlay Gradient --}}
                                                <div
                                                    class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-bmkg-navy via-bmkg-navy/60 to-transparent">
                                                </div>

                                                {{-- Card Content --}}
                                                <div class="absolute bottom-0 left-0 right-0 p-4">
                                                    <div
                                                        class="transform translate-y-2 opacity-90 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                                                        <p class="text-bmkg-gold font-bold text-[8px] uppercase tracking-wider mb-1"
                                                            x-text="card.edition"></p>
                                                        <h3 class="text-white font-bold text-xs leading-snug line-clamp-2"
                                                            x-text="card.title"></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                    @else
                        <div
                            class="bg-gray-50 border border-gray-100 rounded-2xl p-8 text-center h-[200px] flex flex-col items-center justify-center">
                            <svg class="w-10 h-10 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            <p class="text-gray-500 font-medium text-sm">Belum ada buletin diterbitkan.</p>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </section>

    {{-- LATEST NEWS CAROUSEL --}}
    <section class="bg-gray-50 py-6 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-end justify-between mb-4">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="w-6 h-1 bg-bmkg-gold rounded-full"></span>
                        <span class="text-bmkg-gold font-bold text-[10px] uppercase tracking-widest">Warta Utama</span>
                    </div>
                    <h2 class="text-bmkg-navy font-bold text-2xl">Informasi Terkini</h2>
                </div>
                <a href="{{ route('informasi.index') }}"
                    class="text-bmkg-blue font-bold text-sm hover:underline hidden sm:block">Lihat Semua Informasi →</a>
            </div>

            @if($latestNews->count() > 0)
                <div x-data="newsCarousel({{ $latestNews->count() }})" class="relative group">
                    {{-- MAIN SLIDER --}}
                    <div class="relative overflow-hidden rounded-2xl bg-white shadow-2xl border border-gray-100 md:h-[280px]">
                        <div class="flex transition-transform duration-700 ease-out h-full"
                            :style="`transform: translateX(-${current * 100}%)`" @touchstart="touchStart" @touchend="touchEnd">
                            @foreach($latestNews as $news)
                                <div class="w-full shrink-0 flex flex-col md:flex-row h-full">
                                    {{-- Image Side --}}
                                    <div class="w-full md:w-5/12 h-56 md:h-full relative overflow-hidden">
                                        <img src="{{ $news->thumbnail_url }}" alt="{{ $news->title }}"
                                            class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                                    </div>
                                    {{-- Text Side --}}
                                    <div class="w-full md:w-7/12 p-6 md:p-10 flex flex-col justify-center bg-white relative">
                                        <div class="absolute top-0 right-0 p-4 md:p-6 opacity-5">
                                            <svg class="w-24 h-24 md:w-32 md:h-32 text-bmkg-navy" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017V14H17.017C15.3562 14 14.017 12.6608 14.017 11V7C14.017 5.34315 15.3562 4 17.017 4H20.017C21.6739 4 23.017 5.34315 23.017 7V11C23.017 12.6608 21.6739 14 20.017 14V16C20.017 17.1046 19.1216 18 18.017 18H16.017V21H14.017ZM1.017 21V18C1.017 16.8954 1.91243 16 3.017 16H6.017V14H4.017C2.35624 14 1.017 12.6608 1.017 11V7C1.017 5.34315 2.35624 4 4.017 4H7.017C8.67386 4 10.017 5.34315 10.017 7V11C10.017 12.6608 8.67386 14 7.017 14V16C7.017 17.1046 6.12157 18 5.017 18H3.017V21H1.017Z" />
                                            </svg>
                                        </div>
                                        <p class="text-bmkg-blue font-bold text-[10px] mb-2 flex items-center gap-2">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ ($news->published_at ?? $news->created_at)->format('d M Y') }}
                                        </p>
                                        <h3 class="text-lg font-black text-bmkg-navy mb-3 leading-tight">
                                            <a href="{{ route('informasi.show', $news->slug) }}"
                                                class="hover:text-bmkg-blue transition-colors">
                                                {{ $news->title }}
                                            </a>
                                        </h3>
                                        <div class="text-gray-500 line-clamp-3 mb-5 text-[11px] leading-relaxed">
                                            {!! strip_tags($news->content) !!}
                                        </div>
                                        <div class="mt-auto">
                                            <a href="{{ route('informasi.show', $news->slug) }}"
                                                class="inline-flex items-center gap-1.5 bg-bmkg-navy text-white px-4 py-2 rounded-full font-bold text-[10px] hover:bg-bmkg-blue transition-all group/btn shadow-md">
                                                Baca Selengkapnya
                                                <svg class="w-3.5 h-3.5 group-hover/btn:translate-x-1 transition-transform"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- CONTROLS --}}
                    @if($latestNews->count() > 1)
                        <div class="absolute inset-y-0 left-0 flex items-center px-4 pointer-events-none">
                            <button @click="prev"
                                class="w-10 h-10 rounded-full bg-white/90 shadow-md flex items-center justify-center text-bmkg-navy hover:bg-bmkg-gold hover:text-bmkg-navy transition-all border border-gray-100 pointer-events-auto">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                        </div>
                        <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                            <button @click="next"
                                class="w-10 h-10 rounded-full bg-white/90 shadow-md flex items-center justify-center text-bmkg-navy hover:bg-bmkg-gold hover:text-bmkg-navy transition-all border border-gray-100 pointer-events-auto">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>

                        {{-- DOTS --}}
                        <div class="flex justify-center gap-3 mt-6">
                            @foreach($latestNews as $i => $news)
                                <button @click="current = {{ $i }}" class="h-2 rounded-full transition-all duration-300"
                                    :class="current === {{ $i }} ? 'bg-bmkg-navy w-10' : 'bg-gray-200 w-2'"></button>
                            @endforeach
                        </div>
                    @endif
                </div>
            @else
                <div class="bg-white rounded-3xl p-12 text-center shadow-lg border border-dashed border-gray-200">
                    <p class="text-gray-400">Belum ada informasi yang diterbitkan.</p>
                </div>
            @endif
        </div>
    </section>

    {{-- SOCIAL MEDIA EMBED --}}
    <section class="max-w-7xl mx-auto px-4 py-6">
        <div class="flex items-center gap-3 mb-4">
            <div class="h-1 w-8 bg-bmkg-gold rounded-full"></div>
            <h2 class="text-bmkg-navy font-bold text-2xl">Media Sosial BMKG Amahai</h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-6">
            {{-- Facebook Embed --}}
            <div
                class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden flex flex-col h-[400px] md:h-[550px]">
                <div class="bg-[#1877F2] px-4 py-2 flex items-center gap-3 shrink-0">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z" />
                    </svg>
                    <span class="text-white font-bold text-xs">Facebook — BMKG Stamet Amahai</span>
                </div>
                <div class="flex-1 w-full bg-white flex justify-center overflow-hidden">
                    {{-- Refactored iframe to have 100% width on responsive --}}
                    <iframe
                        src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FBMKG.AMAHAI&tabs=timeline&width=500&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true"
                        style="border:none;overflow:hidden; width: 100%; max-width: 500px;" scrolling="no" frameborder="0"
                        allowfullscreen="true"
                        allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"
                        class="h-[400px] md:h-[550px]">
                    </iframe>
                    {{-- Placeholder jika embed tidak load --}}
                    <noscript>
                        <div class="flex w-full h-full items-center justify-center">
                            <p class="text-gray-400 text-sm">Facebook embed memerlukan JavaScript.</p>
                        </div>
                    </noscript>
                </div>
            </div>

            {{-- Instagram Embed --}}
            <div
                class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden flex flex-col h-[400px] md:h-[550px]">
                <div
                    class="bg-gradient-to-r from-[#833AB4] via-[#FD1D1D] to-[#FCB045] px-4 py-2 flex items-center gap-3 shrink-0">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                        <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" fill="url(#ig_grad)" stroke="white"
                            stroke-width="0.5" />
                        <circle cx="17.5" cy="6.5" r="1" fill="white" />
                        <defs>
                            <linearGradient id="ig_grad">
                                <stop offset="0%" stop-color="#833AB4" />
                                <stop offset="100%" stop-color="#FCB045" />
                            </linearGradient>
                        </defs>
                    </svg>
                    <span class="text-white font-bold text-xs">Instagram — @stamet.amahai.bmkg</span>
                </div>
                <div class="flex-1 w-full bg-white flex justify-center overflow-hidden">
                    {{-- Instagram Embed --}}
                    <iframe src="https://www.instagram.com/stamet.amahai.bmkg/embed"
                        style="border:none;overflow:hidden; width: 100%; max-width: 500px;" scrolling="no" frameborder="0"
                        allowfullscreen="true"
                        allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"
                        class="h-[400px] md:h-[550px]">
                    </iframe>
                    {{-- Placeholder jika embed tidak load --}}
                    <noscript>
                        <div class="flex w-full h-full items-center justify-center">
                            <p class="text-gray-400 text-sm">Instagram embed memerlukan JavaScript.</p>
                        </div>
                    </noscript>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.worker.min.js';

        window.renderPdfCover = function (url, canvasId, loaderId) {
            pdfjsLib.getDocument(url).promise.then(function (pdf) {
                pdf.getPage(1).then(function (page) {
                    var canvas = document.getElementById(canvasId);
                    if (!canvas) return;
                    var context = canvas.getContext('2d');

                    // Render highly crisp thumbnail
                    var viewport = page.getViewport({ scale: 1.5 });
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    var renderContext = {
                        canvasContext: context,
                        viewport: viewport
                    };

                    page.render(renderContext).promise.then(function () {
                        canvas.classList.remove('opacity-0');
                        var loader = document.getElementById(loaderId);
                        if (loader) loader.classList.add('opacity-0');
                    });
                });
            }).catch(function (error) {
                console.error('Error rendering PDF thumbnail:', error);
                var loader = document.getElementById(loaderId);
                if (loader) loader.classList.add('opacity-0');
            });
        };

        function promoCarousel(count) {
            return {
                activeIndex: 0,
                total: count,
                timer: null,
                next() {
                    if (this.total > 0) this.activeIndex = (this.activeIndex + 1) % this.total;
                },
                prev() {
                    if (this.total > 0) this.activeIndex = (this.activeIndex - 1 + this.total) % this.total;
                },
                resume() {
                    if (this.total > 1) {
                        this.timer = setInterval(() => this.next(), 4000);
                    }
                },
                pause() {
                    clearInterval(this.timer);
                },
                init() {
                    this.resume();
                    this.$watch('activeIndex', () => {
                        this.pause();
                        this.resume();
                    });
                }
            }
        }

        function newsCarousel(count) {
            return {
                current: 0,
                total: count,
                touchStartX: 0,
                next() {
                    this.current = (this.current + 1) % this.total;
                },
                prev() {
                    this.current = (this.current - 1 + this.total) % this.total;
                },
                touchStart(e) {
                    this.touchStartX = e.changedTouches[0].screenX;
                },
                touchEnd(e) {
                    const endX = e.changedTouches[0].screenX;
                    if (this.touchStartX - endX > 50) this.next();
                    if (endX - this.touchStartX > 50) this.prev();
                },
                init() {
                    setInterval(() => this.next(), 8000);
                }
            }
        }

        function weatherCarousel() {
            return {
                current: 0,
                total: {{ count($weatherCards) }},
                visibleCards: window.innerWidth < 768 ? 1 : (window.innerWidth < 1024 ? 3 : 5),
                touchStartX: 0,
                touchEndX: 0,
                isDown: false,
                startX: 0,
                walk: 0,
                get totalDots() { return Math.max(0, this.total - this.visibleCards + 1); },
                next() {
                    if (this.current < this.totalDots - 1) {
                        this.current++;
                    } else {
                        this.current = 0;
                    }
                },
                prev() {
                    if (this.current > 0) {
                        this.current--;
                    } else {
                        this.current = this.totalDots - 1;
                    }
                },
                goTo(i) { this.current = i; },

                // Touch events
                touchStart(e) {
                    this.touchStartX = e.changedTouches[0].screenX;
                },
                touchMove(e) {
                    this.touchEndX = e.changedTouches[0].screenX;
                },
                touchEnd() {
                    const threshold = 50;
                    if (this.touchStartX - this.touchEndX > threshold) {
                        this.next();
                    } else if (this.touchEndX - this.touchStartX > threshold) {
                        this.prev();
                    }
                },

                // Mouse events
                mouseDown(e) {
                    this.isDown = true;
                    this.startX = e.pageX;
                },
                mouseLeave() {
                    this.isDown = false;
                },
                mouseUp(e) {
                    if (!this.isDown) return;
                    this.isDown = false;
                    const endX = e.pageX;
                    const threshold = 50;
                    if (this.startX - endX > threshold) {
                        this.next();
                    } else if (endX - this.startX > threshold) {
                        this.prev();
                    }
                },
                mouseMove(e) {
                    if (!this.isDown) return;
                    // Additional tracking for visual feedback can be added here if needed
                },

                init() {
                    setInterval(() => {
                        if (!this.isDown) this.next();
                    }, 5000);
                    window.addEventListener('resize', () => {
                        this.visibleCards = window.innerWidth < 768 ? 1 : (window.innerWidth < 1024 ? 3 : 5);
                        this.current = 0;
                    });
                }
            }
        }
    </script>
@endpush