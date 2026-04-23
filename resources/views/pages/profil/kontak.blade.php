@extends('layouts.app')

@section('title', 'Hubungi Kami & Alamat Stasiun | BMKG Meteorologi Amahai')
@section('meta_description', 'Hubungi BMKG Stasiun Meteorologi Amahai untuk pelayanan data dan konsultasi. Cari tahu alamat lokasi, nomor telepon, dan email resmi instansi kami.')
@section('meta_keywords', 'kontak bmkg amahai, alamat bmkg masohi, nomor telepon bmkg, email bmkg amahai, layanan pengaduan bmkg')

@section('breadcrumb')
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <a href="{{ url('/profil/sejarah') }}" class="hover:text-bmkg-blue">Profil</a>
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <span class="text-bmkg-blue font-semibold">Kontak</span>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    {{-- PAGE HEADER --}}
    <div class="bg-gradient-to-r from-bmkg-navy to-bmkg-blue rounded-3xl p-6 md:p-10 mb-8 md:mb-12 text-white relative overflow-hidden shadow-2xl">
        <div class="absolute inset-0 opacity-10">
            <svg viewBox="0 0 400 200" class="w-full h-full"><circle cx="350" cy="100" r="150" fill="white"/><circle cx="50" cy="150" r="80" fill="white"/></svg>
        </div>
        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-4">
                <div class="h-1 w-8 sm:w-12 bg-bmkg-gold rounded-full"></div>
                <p class="text-bmkg-lgold text-xs sm:text-sm font-bold uppercase tracking-widest">Hubungi Kami</p>
            </div>
            <h1 class="text-xl md:text-2xl font-black mb-3 md:mb-4">Kontak Resmi</h1>
            <p class="text-white/80 max-w-2xl text-sm md:text-lg leading-relaxed">Silakan hubungi kami untuk informasi lebih lanjut mengenai layanan meteorologi, klimatologi, dan geofisika di wilayah Maluku Tengah.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
        {{-- CONTACT INFO --}}
        <div class="space-y-6">
            <h2 class="text-lg font-bold text-bmkg-navy mb-4 flex items-center gap-3">
                <span class="w-1.5 h-8 bg-bmkg-gold rounded-full"></span>
                Informasi Kontak
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                {{-- WhatsApp --}}
                <a href="https://wa.me/{{ preg_replace('/[^0-9+]/', '', \App\Models\Setting::getValue('kontak_wa', '+6282198942869')) }}" target="_blank" class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all group block">
                    <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-emerald-500 transition-colors">
                        <svg class="w-6 h-6 text-emerald-600 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.246 2.248 3.484 5.232 3.484 8.412-.003 6.557-5.338 11.892-11.893 11.892-1.997-.001-3.951-.5-5.688-1.448l-6.309 1.656zm6.29-4.143c1.565.933 3.176 1.423 4.842 1.425a10.063 10.063 0 0010.045-10.045c-.002-2.684-1.047-5.207-2.942-7.103a9.999 9.999 0 00-7.103-2.938 10.044 10.044 0 00-10.045 10.045c.002 1.761.474 3.483 1.367 5.011l-.974 3.557 3.655-.959zm11.722-6.841c-.322-.161-1.904-.94-2.202-1.049-.297-.108-.514-.162-.731.162-.217.324-.838 1.048-1.026 1.265-.188.217-.377.243-.699.082-.322-.161-1.359-.501-2.588-1.598-.956-.853-1.597-1.906-1.785-2.23-.188-.323-.02-.497.14-.658.145-.145.323-.377.484-.565.161-.188.215-.323.322-.538.108-.215.054-.404-.027-.565-.081-.161-.731-1.761-1.002-2.41-.264-.633-.53-.547-.731-.557-.188-.009-.404-.01-.621-.01s-.568.081-.865.404c-.297.324-1.137 1.11-1.137 2.709s1.163 3.141 1.325 3.357c.162.216 2.288 3.493 5.542 4.896.774.333 1.378.533 1.85.683.778.247 1.487.213 2.047.129.623-.093 1.904-.778 2.175-1.509.271-.73.271-1.357.19-1.487-.081-.131-.298-.21-.621-.371z"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-bmkg-navy mb-1">WhatsApp</h3>
                    <p class="text-emerald-600 font-semibold">{{ \App\Models\Setting::getValue('kontak_wa', '+62 821 9894 2869') }}</p>
                    <p class="text-gray-400 text-xs mt-2 uppercase tracking-tighter">Layanan Informasi Cepat</p>
                </a>

                {{-- Email --}}
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all group">
                    <div class="w-12 h-12 bg-bmkg-sky rounded-xl flex items-center justify-center mb-4 group-hover:bg-bmkg-blue transition-colors">
                        <svg class="w-6 h-6 text-bmkg-blue group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-bmkg-navy mb-1">Email Resmi</h3>
                    <p class="text-bmkg-blue font-semibold break-all">{{ \App\Models\Setting::getValue('kontak_email', 'stamet.amahai@bmkg.go.id') }}</p>
                    <p class="text-gray-400 text-xs mt-2 uppercase tracking-tighter">Email Instansi Pemerintah</p>
                </div>
            </div>

            {{-- Address --}}
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all group">
                <div class="w-12 h-12 bg-bmkg-sky rounded-xl flex items-center justify-center mb-4 group-hover:bg-bmkg-blue transition-colors">
                    <svg class="w-6 h-6 text-bmkg-blue group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <h3 class="text-base font-bold text-bmkg-navy mb-1">Alamat Kantor</h3>
                <p class="text-gray-600 leading-relaxed">{{ \App\Models\Setting::getValue('kontak_alamat', 'BMKG Amahai, Jl. Bandara Amahai, Amahai, Kabupaten Maluku Tengah, Provinsi Maluku, Kode Pos 97516') }}</p>
            </div>

            {{-- Social Media --}}
            <div class="bg-bmkg-navy p-8 rounded-3xl text-white shadow-xl relative overflow-hidden group">
                <div class="absolute -right-4 -bottom-4 w-32 h-32 bg-bmkg-blue opacity-20 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
                <h3 class="text-xl font-bold mb-6 flex items-center gap-2 text-bmkg-lgold">
                    Media Sosial Resmi
                </h3>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ \App\Models\Setting::getValue('kontak_fb', 'https://www.facebook.com/BMKG.AMAHAI/') }}" target="_blank" class="flex items-center gap-3 bg-white/10 hover:bg-white/20 px-5 py-3 rounded-xl transition-all border border-white/5 backdrop-blur-sm group/btn">
                        <svg class="w-6 h-6 text-white group-hover/btn:text-bmkg-gold transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
                        <span class="font-semibold text-sm">Facebook</span>
                    </a>
                    <a href="{{ \App\Models\Setting::getValue('kontak_ig', 'https://www.instagram.com/stamet.amahai.bmkg/') }}" target="_blank" class="flex items-center gap-3 bg-white/10 hover:bg-white/20 px-5 py-3 rounded-xl transition-all border border-white/5 backdrop-blur-sm group/btn">
                        <svg class="w-6 h-6 text-white group-hover/btn:text-bmkg-gold transition-colors" fill="currentColor" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                        <span class="font-semibold text-sm">Instagram</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- MAP EMBED --}}
        <div class="relative h-full min-h-[300px] md:min-h-[400px] mt-6 lg:mt-0">
            <div class="absolute inset-0 bg-gray-200 rounded-3xl overflow-hidden border-4 border-white shadow-xl">
                 <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3981.670357221375!2d128.92548107572765!3d-3.346383696628286!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d6ce70438a0b0d3%3A0x6a0f0f0f0f0f0f0f!2sStasiun%20Meteorologi%20Amahai!5e0!3m2!1sid!2sid!4v1710000000000!5m2!1sid!2sid" 
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                 </iframe>
            </div>
            {{-- Floating Card --}}
            <div class="absolute bottom-4 left-4 right-4 md:bottom-6 md:left-6 md:right-6 bg-white/90 backdrop-blur-md p-4 md:p-6 rounded-2xl shadow-xl border border-white/20">
                <p class="text-bmkg-navy font-bold text-xs md:text-sm mb-1 uppercase tracking-tight">Kunjungi Kantor Kami</p>
                <div class="flex items-center gap-2 text-[10px] md:text-xs text-gray-500">
                    <svg class="w-4 h-4 text-bmkg-gold shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span class="truncate">Senin — Jumat: 08.00 - 16.00 WIT</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
