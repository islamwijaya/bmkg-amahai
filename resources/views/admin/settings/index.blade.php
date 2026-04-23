@extends('layouts.admin')

@section('title', 'Pengaturan Website')

@push('styles')
<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
<script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
<style>
    trix-editor { min-height: 300px; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 0.9rem; }
    trix-toolbar .trix-button-group button { border-radius: 4px; }
    @keyframes marquee { 0% { transform: translateX(100%); } 100% { transform: translateX(-100%); } }
    .animate-marquee-text { display: inline-block; animation: marquee 35s linear infinite; }
</style>
@endpush

@section('content')
<div class="max-w-5xl mx-auto" x-data="{ tab: '{{ request('tab', 'banner') }}' }">
    <div class="mb-6 flex space-x-2 border-b border-gray-200">
        <button @click="tab = 'banner'" :class="{ 'border-bmkg-blue text-bmkg-blue': tab === 'banner', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'banner' }" class="whitespace-nowrap pb-4 px-4 border-b-2 font-bold text-sm transition-colors focus:outline-none">
            Beranda: Running Banner
        </button>
        <button @click="tab = 'promo'" :class="{ 'border-bmkg-blue text-bmkg-blue': tab === 'promo', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'promo' }" class="whitespace-nowrap pb-4 px-4 border-b-2 font-bold text-sm transition-colors focus:outline-none">
            Beranda: Promo Buletin
        </button>
        <button @click="tab = 'sejarah'" :class="{ 'border-bmkg-blue text-bmkg-blue': tab === 'sejarah', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'sejarah' }" class="whitespace-nowrap pb-4 px-4 border-b-2 font-bold text-sm transition-colors focus:outline-none">
            Profil: Sejarah
        </button>
        <button @click="tab = 'kontak'" :class="{ 'border-bmkg-blue text-bmkg-blue': tab === 'kontak', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'kontak' }" class="whitespace-nowrap pb-4 px-4 border-b-2 font-bold text-sm transition-colors focus:outline-none">
            Profil: Kontak
        </button>
    </div>

    {{-- TAB 1: RUNNING BANNER --}}
    <div x-show="tab === 'banner'" x-cloak>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 bg-bmkg-dark">
                <h2 class="text-xl font-bold text-white">Pengaturan Banner & Informasi</h2>
                <p class="text-white/60 text-xs mt-1">Kelola teks berjalan utama yang tampil di bagian atas website.</p>
            </div>

            <div class="p-8">
                <form action="{{ route('admin.settings.update') }}" method="POST">
                    @csrf @method('PUT')
                    <input type="hidden" name="form_type" value="banner">

                    <div class="mb-8">
                        <label for="running_banner" class="block text-sm font-bold text-gray-700 mb-3 flex items-center gap-2">
                            <svg class="w-4 h-4 text-bmkg-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Teks Running Banner
                        </label>
                        <textarea name="running_banner" id="running_banner" rows="4" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-700 focus:ring-2 focus:ring-bmkg-blue/20 focus:border-bmkg-blue outline-none transition-all resize-none" placeholder="Masukkan teks preview...">{{ old('running_banner', $settings['running_banner'] ?? '') }}</textarea>
                        @error('running_banner')<p class="text-red-500 text-xs mt-2 italic">{{ $message }}</p>@enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-bmkg-navy text-white px-8 py-3 rounded-xl font-bold text-sm hover:bg-bmkg-blue transition-all shadow-md active:scale-95">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-8 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-bold text-gray-800 mb-4 text-sm">Pratinjau Banner Saat Ini:</h3>
            <div class="bg-bmkg-dark py-2 px-4 rounded-lg overflow-hidden relative">
                 <div class="whitespace-nowrap inline-block animate-marquee-text text-white text-[10px] font-medium italic">
                    <span class="text-bmkg-gold font-bold">INFO:</span> {!! $settings['running_banner'] ?? '' !!}
                 </div>
            </div>
        </div>
    </div>

    {{-- TAB 1.5: PROMO BULETIN --}}
    <div x-show="tab === 'promo'" x-cloak>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 bg-bmkg-dark">
                <h2 class="text-xl font-bold text-white">Promo Buletin Beranda</h2>
                <p class="text-white/60 text-xs mt-1">Kelola variasi teks AIDA (Attention, Interest, Desire, Action) untuk carousel buletin di beranda.</p>
            </div>

            <div class="p-8">
                <form action="{{ route('admin.settings.update') }}" method="POST">
                    @csrf @method('PUT')
                    <input type="hidden" name="form_type" value="promo_buletin">

                    @php
                        $variations = isset($settings['promo_buletin_variations']) ? json_decode($settings['promo_buletin_variations'], true) : [];
                    @endphp

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="flex items-center gap-3">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="promo_buletin_is_random" value="1" class="sr-only peer" {{ ($settings['promo_buletin_is_random'] ?? '0') === '1' ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-bmkg-blue"></div>
                                <span class="ml-3 text-sm font-bold text-gray-700">Acak Variasi Otomatis</span>
                            </label>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Interval Acak (Hari)</label>
                            <input type="number" name="promo_buletin_interval_days" min="1" value="{{ old('promo_buletin_interval_days', $settings['promo_buletin_interval_days'] ?? 7) }}" class="w-full md:w-1/2 border border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-bmkg-blue/20">
                            @error('promo_buletin_interval_days')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="border-t border-gray-100 pt-6" x-data="{ variations: {{ json_encode($variations) }} }">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-bold text-gray-800">Daftar Variasi AIDA</h3>
                            <button type="button" @click="variations.push({id: '', attention: '', interest_desire: '', action: ''})" class="text-sm bg-bmkg-sky text-bmkg-blue font-bold px-4 py-2 rounded-xl hover:bg-bmkg-blue hover:text-white transition-colors">+ Tambah Variasi</button>
                        </div>
                        
                        <div class="space-y-6">
                            <template x-for="(item, index) in variations" :key="index">
                                <div class="p-5 border border-gray-200 rounded-xl bg-gray-50 relative">
                                    <button type="button" @click="variations.splice(index, 1)" class="absolute top-4 right-4 text-red-500 hover:text-red-700 p-1">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                    
                                    <h4 class="font-bold text-bmkg-navy mb-4 text-sm" x-text="'Variasi #' + (index + 1)"></h4>
                                    
                                    <input type="hidden" :name="`promo_buletin_variations[${index}][id]`" x-model="item.id">
                                    
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-xs font-bold text-gray-700 mb-1">Attention (Headline)</label>
                                            <input type="text" :name="`promo_buletin_variations[${index}][attention]`" x-model="item.attention" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-1 focus:ring-bmkg-blue">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-bold text-gray-700 mb-1">Interest & Desire (Deskripsi)</label>
                                            <textarea :name="`promo_buletin_variations[${index}][interest_desire]`" x-model="item.interest_desire" required rows="3" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-1 focus:ring-bmkg-blue resize-none"></textarea>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-bold text-gray-700 mb-1">Action (Teks Tombol)</label>
                                            <input type="text" :name="`promo_buletin_variations[${index}][action]`" x-model="item.action" required class="w-full md:w-1/2 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-1 focus:ring-bmkg-blue">
                                        </div>
                                    </div>
                                </div>
                            </template>
                            
                            <div x-show="variations.length === 0" class="text-center py-6 text-gray-500 text-sm italic">
                                Belum ada variasi. Klik tombol tambah untuk membuat teks promosi.
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end mt-8 border-t border-gray-100 pt-6">
                        <button type="submit" class="bg-bmkg-navy text-white px-8 py-3 rounded-xl font-bold text-sm hover:bg-bmkg-blue transition-all shadow-md active:scale-95">Simpan Pengaturan Buletin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- TAB 2: SEJARAH --}}
    <div x-show="tab === 'sejarah'" x-cloak>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 bg-bmkg-dark">
                <h2 class="text-xl font-bold text-white">Laman Sejarah Stasiun</h2>
                <p class="text-white/60 text-xs mt-1">Edit artikel sejarah dan unggah gambar dokumentasi.</p>
            </div>

            <div class="p-8">
                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <input type="hidden" name="form_type" value="sejarah">

                    <div class="space-y-6">
                        {{-- Isi Konten --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Teks Sejarah Utama <span class="text-red-500">*</span></label>
                            <input id="sejarah_isi" type="hidden" name="profil_sejarah_isi" value="{{ old('profil_sejarah_isi', $settings['profil_sejarah_isi'] ?? '') }}">
                            <trix-editor input="sejarah_isi" class="rounded-xl border border-gray-200 focus:ring-2 focus:ring-bmkg-blue/30"></trix-editor>
                            @error('profil_sejarah_isi')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Images Upload --}}
                        <div x-data="{ previews: [] }" class="pt-6 border-t border-gray-100">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Galeri Gambar (Opsional)</label>
                            <p class="text-xs text-gray-500 mb-4">Maks 2MB per gambar. <b>Catatan:</b> Mengunggah gambar baru akan menggantikan seluruh gambar sejarah yang lama.</p>
                            
                            <input type="file" id="sejarah_images" name="images[]" multiple accept="image/*"
                                   @change="previews = Array.from($event.target.files).map(file => URL.createObjectURL(file))"
                                   class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-bmkg-sky file:text-bmkg-blue hover:file:bg-blue-100 cursor-pointer">
                            @error('images') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror

                            {{-- New Previews --}}
                            <div class="flex flex-col gap-4 mt-4" x-show="previews.length > 0" style="display: none;">
                                <p class="text-sm font-semibold text-gray-600">Gambar Baru yang akan diunggah:</p>
                                <template x-for="(url, index) in previews" :key="index">
                                    <div class="flex flex-col sm:flex-row gap-4 items-start p-3 border border-gray-100 rounded-xl bg-gray-50">
                                        <div class="relative w-32 h-24 shrink-0 rounded-lg overflow-hidden border border-gray-200">
                                            <img :src="url" class="w-full h-full object-cover">
                                        </div>
                                        <div class="flex-1 w-full">
                                            <label class="block text-xs font-semibold text-gray-700 mb-1">Keterangan Gambar</label>
                                            <input type="text" name="image_captions[]" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm" placeholder="Tuliskan keterangan...">
                                        </div>
                                    </div>
                                </template>
                            </div>

                            {{-- Existing Images --}}
                            @php
                                $existingImages = isset($settings['profil_sejarah_images']) ? json_decode($settings['profil_sejarah_images'], true) : [];
                                $existingCaptions = isset($settings['profil_sejarah_image_captions']) ? json_decode($settings['profil_sejarah_image_captions'], true) : [];
                            @endphp

                            @if(!empty($existingImages))
                                <div class="mt-6" x-show="previews.length === 0">
                                    <p class="text-sm font-semibold text-gray-600 mb-3">Gambar Saat Ini:</p>
                                    <div class="flex flex-col gap-4">
                                        @foreach($existingImages as $index => $imgData)
                                        <div class="flex flex-col sm:flex-row gap-4 items-start p-3 border border-gray-100 rounded-xl bg-gray-50">
                                            <div class="relative w-32 h-24 shrink-0 rounded-lg overflow-hidden border border-gray-200">
                                                <img src="{{ Storage::url($imgData) }}" class="w-full h-full object-cover">
                                            </div>
                                            <div class="flex-1 w-full">
                                                <label class="block text-xs font-semibold text-gray-700 mb-1">Keterangan Gambar</label>
                                                <input type="text" name="existing_captions[]" value="{{ $existingCaptions[$index] ?? '' }}" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm">
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end">
                        <button type="submit" class="bg-bmkg-navy text-white px-8 py-3 rounded-xl font-bold text-sm hover:bg-bmkg-blue shadow-md transition-all active:scale-95">Simpan Halaman Sejarah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- TAB 3: KONTAK --}}
    <div x-show="tab === 'kontak'" x-cloak>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 bg-bmkg-dark">
                <h2 class="text-xl font-bold text-white">Laman Kontak</h2>
                <p class="text-white/60 text-xs mt-1">Perbarui nomor telepon, email, alamat, dan media sosial kantor.</p>
            </div>

            <div class="p-8">
                <form action="{{ route('admin.settings.update') }}" method="POST">
                    @csrf @method('PUT')
                    <input type="hidden" name="form_type" value="kontak">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">WhatsApp / Telepon</label>
                            <input type="text" name="kontak_wa" value="{{ old('kontak_wa', $settings['kontak_wa'] ?? '+6282198942869') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm">
                            <p class="text-xs text-gray-500 mt-1">Format referensi: +628xxx (dengan awalan +62)</p>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Email</label>
                            <input type="email" name="kontak_email" value="{{ old('kontak_email', $settings['kontak_email'] ?? 'stamet.amahai@bmkg.go.id') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Lengkap Kantor</label>
                            <textarea name="kontak_alamat" rows="2" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm resize-none">{{ old('kontak_alamat', $settings['kontak_alamat'] ?? 'BMKG Amahai, Jl. Bandara Amahai, Amahai, Kabupaten Maluku Tengah, Provinsi Maluku, Kode Pos 97516') }}</textarea>
                        </div>
                        <div class="pt-4 border-t border-gray-100 md:col-span-2">
                            <h3 class="text-sm font-bold text-bmkg-navy mb-4">Media Sosial</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">URL Facebook</label>
                                    <input type="url" name="kontak_fb" value="{{ old('kontak_fb', $settings['kontak_fb'] ?? 'https://www.facebook.com/BMKG.AMAHAI/') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">URL Instagram</label>
                                    <input type="url" name="kontak_ig" value="{{ old('kontak_ig', $settings['kontak_ig'] ?? 'https://www.instagram.com/stamet.amahai.bmkg/') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-6 border-t border-gray-100">
                        <button type="submit" class="bg-bmkg-navy text-white px-8 py-3 rounded-xl font-bold text-sm hover:bg-bmkg-blue shadow-md transition-all active:scale-95">Simpan Info Kontak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
