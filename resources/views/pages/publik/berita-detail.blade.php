@extends('layouts.app')

@section('title', $berita->title . ' | BMKG Meteorologi Amahai')
@section('meta_description', Str::limit(strip_tags($berita->content), 155))
@section('meta_keywords', 'berita bmkg, info cuaca maluku, ' . $berita->title . ', bmkg amahai')

@section('breadcrumb')
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <a href="{{ route('informasi.index') }}" class="hover:text-bmkg-blue">Informasi</a>
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <span class="text-bmkg-blue font-semibold truncate max-w-xs">{{ Str::limit($berita->title, 40) }}</span>
@endsection

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    {{-- Article Header --}}
    <div class="mb-6">
        <p class="text-bmkg-gold text-sm font-semibold uppercase tracking-wide mb-1">
            {{ $berita->published_at ? \Carbon\Carbon::parse($berita->published_at)->locale('id')->isoFormat('dddd, D MMMM Y') : \Carbon\Carbon::parse($berita->created_at)->locale('id')->isoFormat('dddd, D MMMM Y') }}
        </p>
        <p class="text-gray-500 text-xs italic mb-3">
            Dipublikasikan oleh : {{ $berita->published_by ?? 'Admin (BMKG Amahai)' }}
        </p>
        <h1 class="text-xl md:text-2xl font-black text-bmkg-navy leading-tight mb-4">{{ $berita->title }}</h1>
    </div>

    {{-- Grid Images & Captions --}}
    @if(count($berita->images_urls) > 0)
    <div class="mb-8" x-data="{ modalOpen: false, modalImageUrl: '' }">
        <div class="flex flex-wrap justify-center gap-6">
            @foreach($berita->images_urls as $index => $imageUrl)
            <div class="flex flex-col items-center justify-start {{ count($berita->images_urls) > 1 ? 'w-full md:w-[calc(50%-12px)]' : 'w-full max-w-3xl' }}">
                <div class="cursor-pointer transition-transform hover:scale-[1.02] w-full flex justify-center" @click="modalOpen = true; modalImageUrl = '{{ $imageUrl }}'">
                    <img src="{{ $imageUrl }}" alt="{{ $berita->title }}" class="{{ count($berita->images_urls) > 1 ? 'w-full h-auto rounded-xl shadow-sm border border-gray-100 object-cover' : 'max-w-full h-auto max-h-[80vh] object-contain' }}">
                </div>
                @if(!empty($berita->image_captions) && isset($berita->image_captions[$index]) && $berita->image_captions[$index] !== null)
                    <p class="mt-2 text-sm text-gray-500 italic text-center px-4">{{ $berita->image_captions[$index] }}</p>
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

    {{-- Article Content --}}
    <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
        {!! $berita->content !!}
    </div>

    {{-- Back Button --}}
    <div class="mt-10 pt-6 border-t border-gray-100">
        <a href="{{ route('informasi.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-bmkg-blue hover:text-bmkg-navy transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Informasi
        </a>
    </div>

    {{-- Related Articles --}}
    @if($related->isNotEmpty())
    <div class="mt-10">
        <h2 class="text-lg font-bold text-bmkg-navy mb-4">Informasi Lainnya</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            @foreach($related as $r)
            <a href="{{ route('informasi.show', $r) }}" class="bg-white rounded-xl border border-gray-100 p-4 hover:shadow-md transition-shadow group">
                <p class="text-xs text-bmkg-gold font-semibold mb-1">{{ $r->published_at?->format('d M Y') }}</p>
                <p class="font-semibold text-sm text-gray-800 group-hover:text-bmkg-blue transition-colors line-clamp-2">{{ $r->title }}</p>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
