@extends('layouts.app')
@section('title', 'Visi & Misi Instansi | BMKG Meteorologi Amahai')
@section('meta_description', 'Menjadi badan meteorologi yang handal, cepat, tepat, akurat, dan dapat dipercaya dalam memberikan pelayanan data cuaca dan iklim di Maluku Tengah.')
@section('meta_keywords', 'visi misi bmkg, tujuan bmkg amahai, pelayanan cuaca, iklim maluku tengah, instansi pemerintah')
@section('breadcrumb')
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <a href="#" class="hover:text-bmkg-blue">Profil</a>
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <span class="text-bmkg-blue font-semibold">Visi, Misi & Tujuan</span>
@endsection
@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <div class="relative overflow-hidden bg-gradient-to-r from-bmkg-navy to-bmkg-blue rounded-2xl mb-8 text-white shadow-xl">
        <div class="absolute inset-0 z-0 pointer-events-none">
            <div class="absolute inset-0 bg-gradient-to-r from-bmkg-navy via-bmkg-navy/80 to-transparent z-10 w-[80%] md:w-[60%]"></div>
            <img src="{{ asset('assets/img/foto-kantor.png') }}" alt="Gedung BMKG" class="absolute right-0 top-0 w-full md:w-1/2 h-full object-cover opacity-30 mix-blend-luminosity grayscale">
        </div>
        <div class="relative z-10 p-8">
            <div class="flex items-center gap-3 mb-2"><div class="h-1 w-8 bg-bmkg-gold rounded-full"></div><p class="text-bmkg-lgold text-sm font-semibold uppercase tracking-wider">Profil</p></div>
            <h1 class="text-xl md:text-2xl font-black mb-2">Visi, Misi, dan Tujuan</h1>
            <p class="text-white/70">Badan Meteorologi, Klimatologi, dan Geofisika — BMKG</p>
        </div>
    </div>
    <div class="space-y-6">
        {{-- Visi --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
            <div class="mb-4">
                <h2 class="text-lg font-bold text-bmkg-navy mb-4">Visi</h2>
            </div>
            <p class="text-gray-600 text-sm mb-4">Dalam rangka mendukung pelaksanaan visi Presiden maka visi Badan Meteorologi, Klimatologi, dan Geofisika 2020-2024 dirumuskan sebagai berikut:</p>
            <p class="text-gray-700 leading-relaxed italic text-lg border-l-4 border-bmkg-gold pl-5">"BMKG yang berkelas dunia dengan spirit socioentrepreneur untuk mewujudkan Indonesia Maju yang Berdaulat, Mandiri, dan berkepribadian berlandaskan Gotong-Royong"</p>
            <p class="text-gray-600 text-sm mt-5 mb-3">Terminologi di dalam visi tersebut dapat dijelaskan sebagai berikut:</p>
            <div class="space-y-3">
                <div class="flex items-start gap-4 p-4 bg-bmkg-sky rounded-xl">
                    <div class="w-7 h-7 bg-bmkg-navy rounded-full flex items-center justify-center text-white text-xs font-bold shrink-0">1</div>
                    <div>
                        <p class="font-bold text-bmkg-navy text-sm mb-1">Kelas Dunia</p>
                        <p class="text-gray-700 text-sm leading-relaxed">BMKG dalam hal ini menjadi rujukan tingkat regional dan global. Dimana informasi BMKG menjadi rujukan masyarakat internasional, SDM BMKG berperan aktif dalam organisasi Meteorologi, Klimatologi, dan Geofisika (MKG) Internasional dan menjadi Regional Modelling Centre.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4 p-4 bg-bmkg-sky rounded-xl">
                    <div class="w-7 h-7 bg-bmkg-navy rounded-full flex items-center justify-center text-white text-xs font-bold shrink-0">2</div>
                    <div>
                        <p class="font-bold text-bmkg-navy text-sm mb-1">Socio-Entrepreneur</p>
                        <p class="text-gray-700 text-sm leading-relaxed">BMKG dalam menjalankan bisnis pelayanan MKG tidak hanya sekedar melakukan pelayanan informasi untuk publik dan berbagai sektor antara lain sektor transportasi, pariwisata, pertahanan dan keamanan, pertanian dan kehutanan, sumber daya air, energi dan pertambangan, penanggulangan bencana, namun juga memproduksi informasi premium untuk kesejahteraan masyarakat menuju penguatan kemandirian keuangan BMKG.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Misi --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
            <div class="mb-5">
                <h2 class="text-lg font-bold text-bmkg-navy mb-4">Misi</h2>
            </div>
            <p class="text-gray-600 text-sm mb-4">BMKG melaksanakan misi Presiden dan Wakil Presiden nomor 1 (Peningkatan Kualitas Manusia Indonesia), Nomor 4 (Mencapai Lingkungan Hidup yang Berkelanjutan), dan Nomor 7 (Perlindungan bagi Segenap Bangsa dan Memberikan Rasa Aman pada Seluruh Warga), dengan uraian sebagai berikut:</p>
            <div class="space-y-3">
                @foreach([
                    'Menjadikan informasi BMKG sebagai rujukan masyarakat internasional dan mewujudkan Regional Modelling Centre.',
                    'Mendorong SDM BMKG berperan aktif dalam organisasi MKG Internasional.',
                    'Mewujudkan sebagian unit layanan jasa dan informasi BMKG menjadi unit Badan Layanan Umum (BLU).',
                ] as $i => $m)
                <div class="flex items-start gap-4 p-4 bg-bmkg-sky rounded-xl">
                    <div class="w-7 h-7 bg-bmkg-navy rounded-full flex items-center justify-center text-white text-xs font-bold shrink-0">{{ $i+1 }}</div>
                    <p class="text-gray-700 text-sm leading-relaxed">{{ $m }}</p>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Tujuan --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
            <div class="mb-5">
                <h2 class="text-lg font-bold text-bmkg-navy mb-4">Tujuan</h2>
            </div>
            <p class="text-gray-600 text-sm mb-4">Tujuan strategis dalam kurun waktu 5 Tahun kedepan ini merupakan penjabaran dan implementasi dari pernyataan misi yang akan dicapai. Untuk merealisasikan visi dan misi, perlu dirumuskan tujuan strategis BMKG 2020-2024 yang dapat menggambarkan terlaksana dan tercapainya visi dan misi. Rumusan Tujuan BMKG adalah sebagai berikut:</p>
            <div class="space-y-3">
                @foreach([
                    'Menjamin terselenggaranya pelayanan informasi dan jasa meteorologi, klimatologi, kualitas udara, dan geofisika yang cepat, tepat, akurat, luas cakupan dan mudah dipahami untuk keselamatan, kesejahteraan, ketahanan dan berkelanjutan yang menjadi rujukan masyarakat internasional.',
                    'Terwujudnya ketangguhan ekonomi dan masyarakat terhadap faktor MKG.',
                    'Terwujudnya lembaga dengan tata kelola yang transparan, bersih, akuntabel dan berkualitas, serta mampu mewujudkan layanan premium menuju penguatan kemandirian keuangan BMKG.',
                ] as $i => $t)
                <div class="flex items-start gap-4 p-4 bg-bmkg-sky rounded-xl">
                    <div class="w-7 h-7 bg-bmkg-navy rounded-full flex items-center justify-center text-white text-xs font-bold shrink-0">{{ $i+1 }}</div>
                    <p class="text-gray-700 text-sm leading-relaxed">{{ $t }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
