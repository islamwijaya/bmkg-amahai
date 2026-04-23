@extends('layouts.app')

@section('title', 'Sejarah Stasiun & Profil Instansi | BMKG Meteorologi Amahai')
@section('meta_description', 'Ketahui sejarah berdirinya Stasiun Meteorologi Amahai, peran strategisnya di Maluku Tengah, dan perjalanan pengamatan cuaca sejak masa kolonial hingga kini.')
@section('meta_keywords', 'sejarah bmkg amahai, profil stasiun, meteorologi amahai, maluku tengah, badan meteorologi klimatologi geofisika')

@section('breadcrumb')
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <a href="#" class="hover:text-bmkg-blue">Profil</a>
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <span class="text-bmkg-blue font-semibold">Sejarah</span>
@endsection

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <div class="relative overflow-hidden bg-gradient-to-r from-bmkg-navy to-bmkg-blue rounded-2xl mb-8 text-white shadow-xl">
        <div class="absolute inset-0 z-0 pointer-events-none">
            <div class="absolute inset-0 bg-gradient-to-r from-bmkg-navy via-bmkg-navy/80 to-transparent z-10 w-[80%] md:w-[60%]"></div>
            <img src="{{ asset('assets/img/foto-kantor.png') }}" alt="Gedung BMKG" class="absolute right-0 top-0 w-full md:w-1/2 h-full object-cover opacity-30 mix-blend-luminosity grayscale">
        </div>
        <div class="relative z-10 p-8">
            <div class="flex items-center gap-3 mb-2">
                <div class="h-1 w-8 bg-bmkg-gold rounded-full"></div>
                <p class="text-bmkg-lgold text-sm font-semibold uppercase tracking-wider">Profil Stasiun</p>
            </div>
            <h1 class="text-xl md:text-2xl font-black mb-2">Sejarah Stasiun Meteorologi Amahai</h1>
            <p class="text-white/70 text-sm md:text-base">Mengenal lebih dekat asal-usul dan peran strategis Stasiun Meteorologi Kelas III Amahai.</p>
        </div>
    </div>

    @php
        $sejarahIsi = \App\Models\Setting::getValue('profil_sejarah_isi', '');
        $imagesJson = \App\Models\Setting::getValue('profil_sejarah_images', '[]');
        $captionsJson = \App\Models\Setting::getValue('profil_sejarah_image_captions', '[]');
        
        $images = json_decode($imagesJson, true) ?? [];
        $captions = json_decode($captionsJson, true) ?? [];
    @endphp

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 md:p-12">
        {{-- Images Area Array --}}
        @if(count($images) > 0)
        <div class="mb-10 pb-6 border-b border-gray-100" x-data="{ modalOpen: false, modalImageUrl: '' }">
            <div class="flex flex-wrap justify-center gap-6">
                @foreach($images as $index => $imgData)
                <div class="flex flex-col items-center justify-start {{ count($images) > 1 ? 'w-full md:w-[calc(50%-12px)]' : 'w-full max-w-3xl' }}">
                    <div class="cursor-pointer transition-transform hover:scale-[1.02] w-full flex justify-center" @click="modalOpen = true; modalImageUrl = '{{ Storage::url($imgData) }}'">
                        <img src="{{ Storage::url($imgData) }}" class="{{ count($images) > 1 ? 'w-full h-auto rounded-xl shadow-sm border border-gray-200 object-cover' : 'max-w-full h-auto max-h-[80vh] object-contain shadow-sm border border-gray-200 rounded-xl' }}">
                    </div>
                    @if(!empty($captions) && isset($captions[$index]) && $captions[$index] !== null)
                        <p class="mt-3 text-sm text-gray-500 italic text-center px-4">{{ $captions[$index] }}</p>
                    @endif
                </div>
                @endforeach
            </div>

            {{-- Image Modal/Lightbox --}}
            <div x-show="modalOpen" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/80 backdrop-blur-sm p-4" x-transition.opacity>
                <div class="relative max-w-5xl w-full max-h-[90vh] flex items-center justify-center p-4" @click.away="modalOpen = false">
                    <button @click="modalOpen = false" class="absolute -top-10 right-0 text-white hover:text-gray-300 p-2">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                    <img :src="modalImageUrl" class="max-w-full max-h-[85vh] object-contain rounded-md shadow-2xl">
                </div>
            </div>
        </div>
        @endif

        {{-- Content Trix Area --}}
        @if($sejarahIsi)
        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed text-justify">
            {!! $sejarahIsi !!}
        </div>
        @else
        <p class="text-gray-500 font-medium italic text-center">Informasi profil dan sejarah stasiun saat ini belum ditambahkan pada sistem.</p>
        @endif
    </div>
</div>
@endsection
