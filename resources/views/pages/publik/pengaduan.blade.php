@extends('layouts.app')

@section('title', 'Pengaduan')

@section('breadcrumb')
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <span class="text-bmkg-blue font-semibold">Pengaduan</span>
@endsection

@section('content')
<div class="max-w-3xl mx-auto px-4 py-10">
    <div class="relative overflow-hidden bg-gradient-to-r from-red-700 to-bmkg-navy rounded-2xl p-8 mb-8 text-white shadow-xl">
        <div class="absolute inset-0 z-0 pointer-events-none">
            <div class="absolute inset-0 bg-gradient-to-r from-red-700 via-red-700/80 to-transparent z-10 w-[80%] md:w-[60%]"></div>
            <img src="{{ asset('assets/img/foto-kantor.png') }}" alt="Gedung BMKG" class="absolute right-0 top-0 w-full md:w-1/2 h-full object-cover opacity-30 mix-blend-luminosity grayscale">
        </div>
        <div class="relative z-20">
            <div class="flex items-center gap-3 mb-2">
                <div class="h-1 w-8 bg-bmkg-gold rounded-full"></div>
                <p class="text-bmkg-lgold text-sm font-semibold uppercase tracking-wider">Publik</p>
            </div>
            <h1 class="text-xl md:text-2xl font-black mb-2">Form Pengaduan</h1>
            <p class="text-white/70">Sampaikan keluhan atau pengaduan Anda terkait layanan Stasiun Meteorologi Amahai</p>
        </div>
    </div>

    {{-- Info box --}}
    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-6 flex items-start gap-3">
        <svg class="w-5 h-5 text-blue-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <p class="text-blue-800 text-sm">Pastikan data yang Anda isi sudah benar dan lengkap.</p>
    </div>

    {{-- Session Success --}}
    @if(session('success'))
    <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-6 flex items-start gap-3">
        <svg class="w-6 h-6 text-green-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <div>
            <p class="text-green-800 font-bold text-sm">{{ session('success') }}</p>
            @if(session('tiket'))
            <p class="text-green-700 text-xs mt-0.5">Nomor tiket Anda: <strong>{{ session('tiket') }}</strong>. Kami akan merespons dalam 5 hari kerja.</p>
            @endif
        </div>
    </div>
    @endif

    {{-- Rate limit error --}}
    @if($errors->has('throttle'))
    <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6 flex items-start gap-3">
        <svg class="w-5 h-5 text-red-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        <p class="text-red-800 text-sm font-medium">Terlalu banyak pengaduan. Silakan coba lagi nanti.</p>
    </div>
    @endif

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="bg-bmkg-sky px-6 py-4 border-b border-blue-100">
            <h2 class="text-lg font-bold text-bmkg-navy">Data Pengaduan</h2>
            <p class="text-gray-500 text-xs mt-0.5">Semua kolom bertanda <span class="text-red-500 font-bold">*</span> wajib diisi</p>
        </div>
        <form action="{{ url('/publik/pengaduan') }}" method="POST" class="p-6 space-y-5">
            @csrf

            {{-- Nama --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" name="nama" value="{{ old('nama') }}"
                    class="w-full border rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 transition-all {{ $errors->has('nama') ? 'border-red-400 focus:ring-red-200 bg-red-50' : 'border-gray-200 focus:ring-bmkg-blue/30 focus:border-bmkg-blue' }}"
                    placeholder="Masukkan nama lengkap Anda">
                @error('nama')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- NIK --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">NIK (Nomor Induk Kependudukan) <span class="text-red-500">*</span></label>
                <input type="text" name="nik" value="{{ old('nik') }}"
                    class="w-full border rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 transition-all {{ $errors->has('nik') ? 'border-red-400 focus:ring-red-200 bg-red-50' : 'border-gray-200 focus:ring-bmkg-blue/30 focus:border-bmkg-blue' }}"
                    placeholder="16 digit NIK sesuai KTP" maxlength="16">
                @error('nik')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email & Telepon --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email <span class="text-red-500">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full border rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 transition-all {{ $errors->has('email') ? 'border-red-400 focus:ring-red-200 bg-red-50' : 'border-gray-200 focus:ring-bmkg-blue/30 focus:border-bmkg-blue' }}"
                        placeholder="email@contoh.com">
                    @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">No. Telepon <span class="text-red-500">*</span></label>
                    <input type="tel" name="telepon" value="{{ old('telepon') }}"
                        class="w-full border rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 transition-all {{ $errors->has('telepon') ? 'border-red-400 focus:ring-red-200 bg-red-50' : 'border-gray-200 focus:ring-bmkg-blue/30 focus:border-bmkg-blue' }}"
                        placeholder="08xxxxxxxxxx">
                    @error('telepon')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Kategori --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kategori Pengaduan <span class="text-red-500">*</span></label>
                <select name="kategori"
                    class="w-full border rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 transition-all bg-white {{ $errors->has('kategori') ? 'border-red-400 focus:ring-red-200 bg-red-50' : 'border-gray-200 focus:ring-bmkg-blue/30 focus:border-bmkg-blue' }}">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach(['Kualitas Pelayanan','Ketepatan Informasi Cuaca','Pelayanan Data Meteorologi','Perilaku Petugas','Fasilitas & Sarana','Lainnya'] as $kat)
                    <option value="{{ $kat }}" {{ old('kategori') === $kat ? 'selected' : '' }}>{{ $kat }}</option>
                    @endforeach
                </select>
                @error('kategori')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Judul --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Judul Pengaduan <span class="text-red-500">*</span></label>
                <input type="text" name="judul" value="{{ old('judul') }}"
                    class="w-full border rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 transition-all {{ $errors->has('judul') ? 'border-red-400 focus:ring-red-200 bg-red-50' : 'border-gray-200 focus:ring-bmkg-blue/30 focus:border-bmkg-blue' }}"
                    placeholder="Judul singkat pengaduan Anda">
                @error('judul')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Isi Pengaduan --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Isi Pengaduan <span class="text-red-500">*</span></label>
                <textarea name="isi" rows="5"
                    class="w-full border rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 transition-all resize-none {{ $errors->has('isi') ? 'border-red-400 focus:ring-red-200 bg-red-50' : 'border-gray-200 focus:ring-bmkg-blue/30 focus:border-bmkg-blue' }}"
                    placeholder="Uraikan pengaduan Anda secara jelas dan lengkap...">{{ old('isi') }}</textarea>
                @error('isi')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Captcha-like checkbox --}}
            <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 flex items-center gap-3">
                <input type="checkbox" name="konfirmasi" id="konfirmasi" value="1" {{ old('konfirmasi') ? 'checked' : '' }} class="w-5 h-5 accent-bmkg-blue cursor-pointer rounded">
                <label for="konfirmasi" class="text-sm text-gray-700 cursor-pointer">
                    Saya menyatakan bahwa data yang saya isi adalah <strong>benar dan dapat dipertanggungjawabkan</strong>.
                </label>
            </div>
            @error('konfirmasi')
            <p class="text-red-500 text-xs -mt-3">{{ $message }}</p>
            @enderror

            {{-- Submit --}}
            <button type="submit"
                class="w-full bg-bmkg-navy hover:bg-bmkg-blue text-white font-bold py-3 px-6 rounded-xl transition-all flex items-center justify-center gap-2 shadow-lg hover:shadow-bmkg-blue/30">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                Kirim Pengaduan
            </button>
        </form>
    </div>
</div>
@endsection
