@extends('layouts.admin')

@section('title', 'Edit Pegawai')

@section('content')
<div class="max-w-2xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.pegawai.index') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <div>
            <h2 class="text-xl font-bold text-gray-800">Edit Pegawai</h2>
            <p class="text-sm text-gray-500">{{ $pegawai->nama }}</p>
        </div>
    </div>

    <form action="{{ route('admin.pegawai.update', $pegawai) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PATCH')

        <div class="bg-white rounded-2xl shadow-sm p-6 space-y-5">

            <div x-data="{ previewUrl: '{{ $pegawai->foto_url }}' }" class="flex items-start gap-5">
                <div class="w-24 h-24 rounded-full border-2 border-dashed border-gray-200 overflow-hidden flex items-center justify-center bg-gray-50 shrink-0">
                    <template x-if="previewUrl">
                        <img :src="previewUrl" class="w-full h-full object-cover rounded-full">
                    </template>
                    <template x-if="!previewUrl">
                        <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </template>
                </div>
                <div class="flex-1">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Foto Pegawai</label>
                    <input type="file" id="foto" name="foto" accept="image/*"
                           @change="previewUrl = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null"
                           class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-bmkg-sky file:text-bmkg-blue hover:file:bg-blue-100 cursor-pointer">
                    <p class="text-xs text-gray-400 mt-1.5">Kosongkan jika tidak ingin mengubah foto. Format: JPG, PNG. Maks 2MB.</p>
                    @error('foto') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label for="nama" class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" id="nama" name="nama" value="{{ old('nama', $pegawai->nama) }}"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-bmkg-blue/30 focus:border-bmkg-blue transition-colors @error('nama') border-red-400 @enderror">
                @error('nama') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="nip" class="block text-sm font-semibold text-gray-700 mb-1.5">NIP <span class="text-red-500">*</span></label>
                <input type="text" id="nip" name="nip" value="{{ old('nip', $pegawai->nip) }}" maxlength="18"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-bmkg-blue/30 focus:border-bmkg-blue transition-colors @error('nip') border-red-400 @enderror">
                @error('nip') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="jabatan" class="block text-sm font-semibold text-gray-700 mb-1.5">Jabatan <span class="text-red-500">*</span></label>
                    <input type="text" id="jabatan" name="jabatan" list="jabatan-options" value="{{ old('jabatan', $pegawai->jabatan) }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-bmkg-blue/30 focus:border-bmkg-blue transition-colors bg-white @error('jabatan') border-red-400 @enderror"
                           placeholder="Pilih atau ketik jabatan...">
                    <datalist id="jabatan-options">
                        @foreach(\App\Models\Pegawai::JABATAN_OPTIONS as $jabatan)
                        <option value="{{ $jabatan }}">
                        @endforeach
                    </datalist>
                    @error('jabatan') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="sub_unit" class="block text-sm font-semibold text-gray-700 mb-1.5">Sub Unit <span class="text-red-500">*</span></label>
                    <select id="sub_unit" name="sub_unit"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-bmkg-blue/30 focus:border-bmkg-blue transition-colors bg-white @error('sub_unit') border-red-400 @enderror">
                        <option value="">— Pilih Sub Unit —</option>
                        @foreach(\App\Enums\SubUnit::cases() as $unit)
                        <option value="{{ $unit->value }}" @selected(old('sub_unit', $pegawai->sub_unit?->value) === $unit->value)>{{ $unit->label() }}</option>
                        @endforeach
                    </select>
                    @error('sub_unit') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="pendidikan" class="block text-sm font-semibold text-gray-700 mb-1.5">Pendidikan <span class="text-red-500">*</span></label>
                    <input type="text" id="pendidikan" name="pendidikan" value="{{ old('pendidikan', $pegawai->pendidikan) }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-bmkg-blue/30 focus:border-bmkg-blue transition-colors @error('pendidikan') border-red-400 @enderror">
                    @error('pendidikan') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="golongan" class="block text-sm font-semibold text-gray-700 mb-1.5">Golongan <span class="text-red-500">*</span></label>
                    <input type="text" id="golongan" name="golongan" value="{{ old('golongan', $pegawai->golongan) }}" maxlength="10"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-bmkg-blue/30 focus:border-bmkg-blue transition-colors @error('golongan') border-red-400 @enderror">
                    @error('golongan') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label for="urutan" class="block text-sm font-semibold text-gray-700 mb-1.5">Urutan Tampil <span class="text-red-500">*</span></label>
                <input type="number" id="urutan" name="urutan" value="{{ old('urutan', $pegawai->urutan) }}" min="0"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-bmkg-blue/30 transition-colors @error('urutan') border-red-400 @enderror">
                @error('urutan') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.pegawai.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-600 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors">Batal</a>
            <button type="submit" class="px-6 py-2.5 text-sm font-bold text-white bg-bmkg-blue rounded-xl hover:bg-bmkg-navy transition-colors shadow-sm">
                Perbarui Data Pegawai
            </button>
        </div>
    </form>
</div>
@endsection
