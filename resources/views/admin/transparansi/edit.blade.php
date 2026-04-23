@extends('layouts.admin')

@section('title', 'Edit Dokumen Transparansi')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.transparansi.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-bmkg-blue transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Kembali ke daftar
    </a>
</div>

<div class="max-w-2xl">
    <div class="bg-white rounded-2xl shadow-sm p-6">
        <h2 class="text-lg font-bold text-gray-800 mb-6">Edit Dokumen Transparansi Kinerja</h2>

        @if($errors->any())
        <div class="mb-4 bg-red-50 border border-red-200 rounded-xl p-4 text-sm text-red-700">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.transparansi.update', $transparansi) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Judul Dokumen <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $transparansi->title) }}" required
                       class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-bmkg-blue/30 focus:border-bmkg-blue transition-colors">
            </div>

            @php
                $isCustom = !in_array($transparansi->category, ['rencana', 'laporan', 'perjanjian']);
                $initialCategory = $isCustom ? 'custom' : $transparansi->category;
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4" x-data="{ category: '{{ old('category', $initialCategory) }}' }">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kategori <span class="text-red-500">*</span></label>
                    <select name="category" required x-model="category"
                            class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-bmkg-blue/30 focus:border-bmkg-blue transition-colors bg-white">
                        <option value="rencana">Rencana Kinerja Tahunan</option>
                        <option value="laporan">Laporan Kinerja Tahunan</option>
                        <option value="perjanjian">Perjanjian Kinerja Tahunan</option>
                        <option value="custom">-- Isi Sendiri --</option>
                    </select>

                    <div x-show="category === 'custom'" x-cloak x-transition class="mt-3">
                        <label class="block text-xs font-bold text-bmkg-blue uppercase tracking-wider mb-1">Nama Kategori Kustom</label>
                        <input type="text" name="custom_category" 
                               value="{{ old('custom_category', $isCustom ? $transparansi->category : '') }}"
                               placeholder="cth: Evaluasi Reformasi Birokrasi"
                               :required="category === 'custom'"
                               class="w-full border border-bmkg-blue/30 bg-bmkg-sky/5 rounded-xl px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-bmkg-blue/30 focus:border-bmkg-blue transition-colors">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tahun <span class="text-red-500">*</span></label>
                    <input type="number" name="year" value="{{ old('year', $transparansi->year) }}" required min="2000" max="2099"
                           class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-bmkg-blue/30 focus:border-bmkg-blue transition-colors">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Ganti File PDF <span class="text-gray-400 font-normal">(opsional)</span></label>
                <div class="mb-2 flex items-center gap-2 text-sm text-gray-500">
                    <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                    File saat ini:
                    <a href="{{ Storage::url($transparansi->file_path) }}" target="_blank" class="text-bmkg-blue hover:underline">Buka PDF</a>
                </div>
                <label class="flex flex-col items-center justify-center gap-2 border-2 border-dashed border-gray-200 rounded-xl p-6 cursor-pointer hover:border-bmkg-blue hover:bg-bmkg-sky/30 transition-colors">
                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                    <span class="text-sm text-gray-500" id="file-label">Klik untuk ganti file PDF (opsional)</span>
                    <input type="file" name="file_path" accept=".pdf" class="hidden"
                           onchange="document.getElementById('file-label').textContent = this.files[0]?.name || 'Klik untuk ganti file PDF (opsional)'">
                </label>
            </div>

            <div class="flex items-center justify-end gap-3 pt-2">
                <a href="{{ route('admin.transparansi.index') }}" class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 rounded-xl hover:bg-gray-200 transition-colors">Batal</a>
                <button type="submit" class="px-5 py-2 text-sm font-semibold text-white bg-bmkg-blue rounded-xl hover:bg-bmkg-navy transition-colors shadow-sm">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
