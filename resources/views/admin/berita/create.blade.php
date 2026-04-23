@extends('layouts.admin')

@section('title', 'Tambah Informasi')

@push('styles')
<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
<script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
<style>
    trix-editor { min-height: 300px; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 0.9rem; }
    trix-toolbar .trix-button-group button { border-radius: 4px; }
</style>
@endpush

@section('content')
<div class="max-w-4xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.informasi.index') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <div>
            <h2 class="text-xl font-bold text-gray-800">Tambah Informasi Baru</h2>
            <p class="text-sm text-gray-500">Isi form berikut untuk menambahkan artikel informasi</p>
        </div>
    </div>

    <form action="{{ route('admin.informasi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="bg-white rounded-2xl shadow-sm p-6 space-y-5">
            {{-- Title --}}
            <div>
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-1.5">Judul Informasi <span class="text-red-500">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title') }}"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-bmkg-blue/30 focus:border-bmkg-blue transition-colors @error('title') border-red-400 @enderror"
                       placeholder="Masukkan judul informasi...">
                @error('title') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="published_by" class="block text-sm font-semibold text-gray-700 mb-1.5">Dipublikasikan Oleh</label>
                <input type="text" id="published_by" name="published_by" value="{{ old('published_by', 'Admin (BMKG Amahai)') }}"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-bmkg-blue/30 focus:border-bmkg-blue transition-colors @error('published_by') border-red-400 @enderror"
                       placeholder="Contoh: Tim Humas BMKG">
                @error('published_by') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Images Upload with Preview --}}
            <div x-data="{ previews: [] }">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Gambar (Bisa lebih dari 1, gambar pertama jadi thumbnail)</label>
                <div class="flex flex-col gap-4">
                    <input type="file" id="images" name="images[]" multiple accept="image/*"
                           @change="previews = Array.from($event.target.files).map(file => URL.createObjectURL(file))"
                           class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-bmkg-sky file:text-bmkg-blue hover:file:bg-blue-100 cursor-pointer">
                    <p class="text-xs text-gray-400 mt-1.5">Format: JPG, PNG, WebP. Maks 2MB per gambar.</p>
                    @error('images') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    @error('images.*') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror

                    {{-- Previews and Captions --}}
                    <div class="flex flex-col gap-4 mt-3" x-show="previews.length > 0" style="display: none;">
                        <template x-for="(url, index) in previews" :key="index">
                            <div class="flex flex-col sm:flex-row gap-4 items-start p-3 border border-gray-100 rounded-xl bg-gray-50/50">
                                <div class="relative w-32 h-24 shrink-0 rounded-lg overflow-hidden border border-gray-200">
                                    <img :src="url" class="w-full h-full object-cover">
                                    <div x-show="index === 0" class="absolute top-1 left-1 bg-bmkg-blue text-white text-[10px] px-2 py-0.5 rounded-md font-bold shadow">Thumbnail</div>
                                </div>
                                <div class="flex-1 w-full">
                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Caption / Keterangan Gambar (Opsional)</label>
                                    <input type="text" name="image_captions[]" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-bmkg-blue/30 focus:border-bmkg-blue transition-colors" placeholder="Masukkan keterangan untuk gambar ini...">
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            {{-- Content (Trix) --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Isi Informasi <span class="text-red-500">*</span></label>
                <input id="content-input" type="hidden" name="content" value="{{ old('content') }}">
                <trix-editor input="content-input" class="rounded-xl border border-gray-200 focus:ring-2 focus:ring-bmkg-blue/30"></trix-editor>
                @error('content') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-6 space-y-4">
            <h3 class="font-semibold text-gray-700 text-sm">Pengaturan Publikasi</h3>
            <div class="flex items-center gap-3">
                <input type="checkbox" id="is_published" name="is_published" value="1"
                       {{ old('is_published') ? 'checked' : '' }}
                       class="w-4 h-4 rounded border-gray-300 text-bmkg-blue focus:ring-bmkg-blue">
                <label for="is_published" class="text-sm font-medium text-gray-700">Publikasikan sekarang</label>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.informasi.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-600 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors">Batal</a>
            <button type="submit" class="px-6 py-2.5 text-sm font-bold text-white bg-bmkg-blue rounded-xl hover:bg-bmkg-navy transition-colors shadow-sm">
                Simpan Informasi
            </button>
        </div>
    </form>
</div>
@endsection
