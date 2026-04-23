@extends('layouts.app')

@section('title', 'Kritik & Saran Pelayanan | BMKG Meteorologi Amahai')
@section('meta_description', 'Sampaikan kritik, saran, atau keluhan Anda mengenai pelayanan BMKG Amahai. Masukan Anda sangat berarti bagi peningkatan kualitas layanan kami.')
@section('meta_keywords', 'kritik saran bmkg, pengaduan masyarakat, layanan pelanggan bmkg, feedback publik, kotak saran')

@section('breadcrumb')
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <span class="text-bmkg-blue font-semibold">Kritik & Saran</span>
@endsection

@section('content')
<div class="max-w-3xl mx-auto px-4 py-10">
    <div class="relative overflow-hidden bg-gradient-to-r from-bmkg-navy to-emerald-700 rounded-2xl p-8 mb-8 text-white shadow-xl">
        <div class="absolute inset-0 z-0 pointer-events-none">
            <div class="absolute inset-0 bg-gradient-to-r from-bmkg-navy via-bmkg-navy/80 to-transparent z-10 w-[80%] md:w-[60%]"></div>
            <img src="{{ asset('assets/img/foto-kantor.png') }}" alt="Gedung BMKG" class="absolute right-0 top-0 w-full md:w-1/2 h-full object-cover opacity-30 mix-blend-luminosity grayscale">
        </div>
        <div class="relative z-20">
            <div class="flex items-center gap-3 mb-2">
                <div class="h-1 w-8 bg-bmkg-gold rounded-full"></div>
                <p class="text-bmkg-lgold text-sm font-semibold uppercase tracking-wider">Publik</p>
            </div>
            <h1 class="text-xl md:text-2xl font-black mb-2">Kritik & Saran</h1>
            <p class="text-white/70">Masukan Anda sangat berarti untuk peningkatan layanan kami</p>
        </div>
    </div>

    {{-- Session Success --}}
    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4 mb-6 flex items-center gap-3">
        <svg class="w-6 h-6 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <div>
            <p class="text-emerald-800 font-bold text-sm">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="bg-bmkg-sky px-6 py-4 border-b border-blue-100">
            <h2 class="text-lg font-bold text-bmkg-navy">Form Kritik & Saran</h2>
            <p class="text-gray-500 text-xs mt-0.5">Identitas Anda bersifat opsional. Kolom bertanda <span class="text-red-500 font-bold">*</span> wajib diisi</p>
        </div>

        <form action="{{ url('/publik/kritik-saran') }}" method="POST" x-data="{ jenis: '{{ old('jenis', '') }}', rating: {{ old('rating', 0) }} }" class="p-6 space-y-5">
            @csrf

            {{-- Nama (opsional) --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama <span class="text-red-500">*</span></label>
                <input type="text" name="nama" value="{{ old('nama') }}" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-bmkg-blue/30 focus:border-bmkg-blue transition-all"
                    placeholder="Masukkan nama lengkap Anda">
            </div>

            {{-- Email (opsional) --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email <span class="text-red-500">*</span></label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full border rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 transition-all {{ $errors->has('email') ? 'border-red-400 focus:ring-red-200 bg-red-50' : 'border-gray-200 focus:ring-bmkg-blue/30 focus:border-bmkg-blue' }}"
                    placeholder="email@contoh.com">
                @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Jenis --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Masukan <span class="text-red-500">*</span></label>
                <input type="hidden" name="jenis" :value="jenis">
                <div class="grid grid-cols-2 gap-3">
                    <button type="button" @click="jenis = 'kritik'"
                        class="flex items-center gap-3 p-3.5 rounded-xl border-2 transition-all text-left"
                        :class="jenis === 'kritik' ? 'border-red-400 bg-red-50' : 'border-gray-200 hover:border-gray-300'">
                        <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-7h.01M12 10h.01"/></svg>
                        </div>
                        <div>
                            <p class="font-bold text-sm" :class="jenis === 'kritik' ? 'text-red-700' : 'text-gray-700'">Kritik</p>
                            <p class="text-xs text-gray-500">Sampaikan kritik atas layanan kami</p>
                        </div>
                    </button>
                    <button type="button" @click="jenis = 'saran'"
                        class="flex items-center gap-3 p-3.5 rounded-xl border-2 transition-all text-left"
                        :class="jenis === 'saran' ? 'border-emerald-400 bg-emerald-50' : 'border-gray-200 hover:border-gray-300'">
                        <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                        </div>
                        <div>
                            <p class="font-bold text-sm" :class="jenis === 'saran' ? 'text-emerald-700' : 'text-gray-700'">Saran</p>
                            <p class="text-xs text-gray-500">Berikan saran untuk perbaikan kami</p>
                        </div>
                    </button>
                </div>
                @error('jenis')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Aspek --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Aspek yang Dinilai <span class="text-red-500">*</span></label>
                <select name="aspek"
                    class="w-full border rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 transition-all bg-white {{ $errors->has('aspek') ? 'border-red-400 focus:ring-red-200' : 'border-gray-200 focus:ring-bmkg-blue/30 focus:border-bmkg-blue' }}">
                    <option value="">-- Pilih Aspek --</option>
                    @foreach(['Akurasi Informasi Cuaca','Kecepatan Penyampaian Informasi','Kemudahan Akses Layanan','Keramahan Petugas','Website & Media Sosial','Prosedur Pelayanan Data','Tarif Layanan','Lainnya'] as $asp)
                    <option value="{{ $asp }}" {{ old('aspek') === $asp ? 'selected' : '' }}>{{ $asp }}</option>
                    @endforeach
                </select>
                @error('aspek')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Rating --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Penilaian Keseluruhan <span class="text-red-500">*</span></label>
                <input type="hidden" name="rating" :value="rating">
                <div class="flex gap-2">
                    <template x-for="star in [1,2,3,4,5]" :key="star">
                        <button type="button" @click="rating = star"
                            class="text-4xl md:text-3xl transition-transform hover:scale-110 p-1"
                            :class="rating >= star ? 'text-bmkg-gold' : 'text-gray-300'">★</button>
                    </template>
                    <span class="ml-2 text-sm text-gray-500 self-center" x-text="['','Sangat Buruk','Buruk','Cukup','Baik','Sangat Baik'][rating] || 'Pilih bintang'"></span>
                </div>
                @error('rating')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Pesan --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Isi Kritik/Saran <span class="text-red-500">*</span></label>
                <textarea name="pesan" rows="5"
                    class="w-full border rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 transition-all resize-none {{ $errors->has('pesan') ? 'border-red-400 focus:ring-red-200 bg-red-50' : 'border-gray-200 focus:ring-bmkg-blue/30 focus:border-bmkg-blue' }}"
                    placeholder="Tuliskan kritik atau saran Anda di sini...">{{ old('pesan') }}</textarea>
                @error('pesan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="w-full bg-bmkg-navy hover:bg-bmkg-blue text-white font-bold py-3 px-6 rounded-xl transition-all flex items-center justify-center gap-2 shadow-lg">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                Kirim Masukan
            </button>
        </form>
    </div>
</div>
@endsection
