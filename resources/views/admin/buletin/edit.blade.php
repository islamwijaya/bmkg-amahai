@extends('layouts.admin')

@section('title', 'Edit Buletin')

@section('content')
<div class="max-w-2xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.buletin.index') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <div>
            <h2 class="text-xl font-bold text-gray-800">Edit Buletin</h2>
            <p class="text-sm text-gray-500">{{ $bulletin->title }}</p>
        </div>
    </div>

    <form action="{{ route('admin.buletin.update', $bulletin) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PATCH')

        <div class="bg-white rounded-2xl shadow-sm p-6 space-y-5">
            <div>
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-1.5">Judul Buletin <span class="text-red-500">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title', $bulletin->title) }}"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-bmkg-blue/30 focus:border-bmkg-blue transition-colors @error('title') border-red-400 @enderror">
                @error('title') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="edition" class="block text-sm font-semibold text-gray-700 mb-1.5">Edisi <span class="text-red-500">*</span></label>
                <input type="text" id="edition" name="edition" value="{{ old('edition', $bulletin->edition) }}"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-bmkg-blue/30 focus:border-bmkg-blue transition-colors @error('edition') border-red-400 @enderror">
                @error('edition') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="year" class="block text-sm font-semibold text-gray-700 mb-1.5">Tahun <span class="text-red-500">*</span></label>
                    <select id="year" name="year" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-bmkg-blue/30">
                        @for($y = date('Y'); $y >= 2015; $y--)
                        <option value="{{ $y }}" {{ old('year', $bulletin->year) == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label for="month" class="block text-sm font-semibold text-gray-700 mb-1.5">Bulan <span class="text-red-500">*</span></label>
                    <select id="month" name="month" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-bmkg-blue/30">
                        @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $i => $bln)
                        <option value="{{ $i+1 }}" {{ old('month', $bulletin->month) == $i+1 ? 'selected' : '' }}>{{ $bln }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi Singkat</label>
                <textarea id="description" name="description" rows="2"
                          class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-bmkg-blue/30 resize-none">{{ old('description', $bulletin->description) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Ganti File Dokumen <span class="text-gray-400 font-normal">(opsional)</span></label>
                <div class="flex items-center gap-3 p-3 bg-red-50 rounded-xl mb-3">
                    <svg class="w-5 h-5 text-red-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs text-red-700 font-medium">File Dokumen saat ini</p>
                        <a href="{{ $bulletin->file_url }}" target="_blank" class="text-xs text-bmkg-blue hover:underline">Lihat Dokumen →</a>
                    </div>
                </div>
                <input type="file" id="file" name="file" accept=".pdf,.pub"
                       class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-bmkg-sky file:text-bmkg-blue hover:file:bg-blue-100 cursor-pointer">
                <p class="text-xs text-gray-400 mt-1.5">Kosongkan jika tidak ingin mengganti file. Format PDF/PUB, maks 10MB.</p>
                @error('file') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div x-data="{ previewUrl: '{{ $bulletin->cover_url }}' }">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Ganti Cover <span class="text-gray-400 font-normal">(opsional)</span></label>
                <div class="flex items-start gap-4">
                    <div class="w-20 h-28 border-2 border-dashed border-gray-200 rounded-xl overflow-hidden flex items-center justify-center bg-gray-50 shrink-0">
                        <template x-if="previewUrl">
                            <img :src="previewUrl" class="w-full h-full object-cover">
                        </template>
                        <template x-if="!previewUrl">
                            <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </template>
                    </div>
                    <div class="flex-1">
                        <input type="file" id="cover" name="cover" accept="image/*"
                               @change="previewUrl = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null"
                               class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-bmkg-sky file:text-bmkg-blue hover:file:bg-blue-100 cursor-pointer">
                        <p class="text-xs text-gray-400 mt-1.5">Format: JPG, PNG, WebP. Maks 2MB.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.buletin.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-600 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors">Batal</a>
            <button type="submit" class="px-6 py-2.5 text-sm font-bold text-white bg-bmkg-blue rounded-xl hover:bg-bmkg-navy transition-colors shadow-sm">
                Perbarui Buletin
            </button>
        </div>
    </form>
</div>
@endsection
