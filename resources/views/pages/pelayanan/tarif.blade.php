@extends('layouts.app')
@section('title', 'Jenis & Tarif Layanan PNBP | BMKG Meteorologi Amahai')
@section('meta_description', 'Daftar jenis dan tarif Penerimaan Negara Bukan Pajak (PNBP) untuk layanan meteorologi, klimatologi, dan geofisika sesuai PP No 47 Tahun 2018.')
@section('meta_keywords', 'tarif data bmkg, pnbp bmkg, biaya layanan meteorologi, pp 47 tahun 2018, harga info cuaca')
@section('breadcrumb')
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <a href="#" class="hover:text-bmkg-blue text-gray-500">Pelayanan Data</a>
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <span class="text-bmkg-blue font-semibold">Tarif Layanan</span>
@endsection

@section('content')
<div class="max-w-6xl mx-auto px-4 py-12">
    {{-- Hero Section --}}
    <div class="relative overflow-hidden bg-gradient-to-br from-bmkg-navy via-bmkg-blue to-blue-600 rounded-3xl p-10 mb-12 text-white shadow-2xl">
        <div class="absolute inset-0 z-0 pointer-events-none">
            <div class="absolute inset-0 bg-gradient-to-r from-bmkg-navy via-bmkg-navy/80 to-transparent z-10 w-[80%] md:w-[60%]"></div>
            <img src="{{ asset('assets/img/foto-kantor.png') }}" alt="Gedung BMKG" class="absolute right-0 top-0 w-full md:w-1/2 h-full object-cover opacity-30 mix-blend-luminosity grayscale">
        </div>
        <div class="relative z-20">
            <div class="flex items-center gap-3 mb-4">
                <div class="h-1 w-12 bg-bmkg-gold rounded-full"></div>
                <p class="text-bmkg-lgold text-sm font-bold uppercase tracking-[0.2em]">PNBP BMKG</p>
            </div>
            <h1 class="text-xl md:text-2xl font-black mb-4 leading-tight">Jenis dan Tarif Layanan</h1>
            <p class="text-white/80 text-lg max-w-2xl leading-relaxed">
                Berdasarkan Peraturan Pemerintah Nomor 47 Tahun 2018 tentang Jenis dan Tarif atas Jenis Penerimaan Negara Bukan Pajak yang berlaku pada Badan Meteorologi, Klimatologi, dan Geofisika.
            </p>
        </div>
    </div>

    {{-- Alert Info --}}
    <div class="bg-blue-50 border-l-4 border-bmkg-blue rounded-r-xl p-5 mb-10 flex items-start gap-4 shadow-sm">
        <div class="bg-bmkg-blue/10 p-2 rounded-lg">
            <svg class="w-6 h-6 text-bmkg-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div>
            <p class="text-bmkg-navy font-bold mb-1">Informasi Pembayaran</p>
            <p class="text-gray-600 text-sm leading-relaxed">Seluruh tarif di bawah ini merupakan Penerimaan Negara Bukan Pajak (PNBP) yang disetorkan langsung ke Kas Negara. Pembayaran resmi hanya dilakukan melalui kode billing atau transfer ke rekening resmi pemerintah yang ditunjuk.</p>
        </div>
    </div>

    {{-- Main Content Grid --}}
    <div class="space-y-12">
        
        {{-- I. INFORMASI MKG --}}
        <section>
            <div class="flex items-center gap-4 mb-6">
                <div class="bg-bmkg-navy text-white w-10 h-10 rounded-xl flex items-center justify-center font-bold shadow-lg">I</div>
                <h2 class="text-lg font-bold text-bmkg-navy">Informasi Meteorologi, Klimatologi, dan Geofisika</h2>
            </div>
            
            <div class="grid md:grid-cols-1 gap-8">
                {{-- A. Informasi Khusus --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-xl overflow-hidden">
                    <div class="bg-gray-50 border-b border-gray-100 px-6 py-4">
                        <h3 class="text-base font-bold text-bmkg-navy">A. Informasi Khusus MKG</h3>
                    </div>
                    @include('pages.pelayanan.partials.tarif-table', ['data' => [
                        ['Informasi Cuaca untuk Penerbangan', 'per route unit', '4% dari biaya navigasi'],
                        ['Informasi Cuaca untuk Pelayaran', 'per route per hari', 'Rp 250.000,00'],
                        ['Informasi Cuaca untuk Pelabuhan', 'per lokasi per hari', 'Rp 225.000,00'],
                        ['Informasi Cuaca untuk Pengeboran Lepas Pantai', 'per dokumen/hari', 'Rp 330.000,00'],
                        ['Analisis dan Prakiraan Hujan Bulanan', 'per buku', 'Rp 65.000,00'],
                        ['Prakiraan Musim (Kemarau/Hujan)', 'per buku', 'Rp 230.000,00'],
                        ['Atlas Kesesuaian Agroklimat', 'per buku', 'Rp 470.000,00'],
                        ['Atlas Normal/Windrose/Curah Hujan (Periode 30 Tahun)', 'per buku', 'Rp 1.500.000,00'],
                        ['Peta Kegempaan / Percepatan Tanah', 'per provinsi/tahun', 'Rp 250.000,00'],
                        ['Informasi Meteorologi (Klaim Asuransi)', 'per lokasi per hari', 'Rp 175.000,00'],
                        ['Informasi Geofisika (Klaim Asuransi)', 'per lokasi per hari', 'Rp 185.000,00'],
                    ]])
                </div>

                {{-- B. Sesuai Permintaan --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-xl overflow-hidden mt-6">
                    <div class="bg-gray-50 border-b border-gray-100 px-6 py-4">
                        <h3 class="text-base font-bold text-bmkg-navy">B. Informasi MKG Sesuai Permintaan</h3>
                    </div>
                    @include('pages.pelayanan.partials.tarif-table', ['data' => [
                        ['Cuaca Khusus Kegiatan Olahraga / Komersial Outdoor', 'per lokasi per hari', 'Rp 100.000,00'],
                        ['Informasi Radar Cuaca (per 10 menit)', 'per data per lokasi', 'Rp 70.000,00'],
                        ['Informasi Iklim Maritim (Peta Spasial)', 'per peta per bulan', 'Rp 300.000,00'],
                        ['Informasi Tabular dan Grafik Maritim', 'per tabel per bulan', 'Rp 350.000,00'],
                        ['Atlas Potensi Rawan Banjir', 'per atlas', 'Rp 350.000,00'],
                        ['Atlas Kerentanan Perubahan Iklim', 'per atlas', 'Rp 450.000,00'],
                        ['Atlas Potensi Energi (Matahari/Angin)', 'per atlas', 'Rp 300.000,00'],
                        ['Publikasi Perubahan Iklim & Kualitas Udara', 'per buku', 'Rp 100.000,00'],
                    ]])
                </div>
            </div>
        </section>

        {{-- II & III: Konsultasi & Kalibrasi --}}
        <div class="grid md:grid-cols-2 gap-12">
            <section>
                <div class="flex items-center gap-4 mb-6">
                    <div class="bg-bmkg-navy text-white w-10 h-10 rounded-xl flex items-center justify-center font-bold shadow-lg">II</div>
                    <h2 class="text-lg font-bold text-bmkg-navy">Jasa Konsultasi</h2>
                </div>
                <div class="bg-white rounded-2xl border border-gray-100 shadow-xl overflow-hidden">
                    @include('pages.pelayanan.partials.tarif-table', ['data' => [
                        ['Meteorologi (Proyek/Penelitian)', 'per lokasi', 'Rp 3.750.000,00'],
                        ['Klimatologi (Analisis Iklim)', 'per lokasi', 'Rp 9.500.000,00'],
                        ['Geofisika (Proyek Komersial)', 'per lokasi', 'Rp 12.300.000,00'],
                    ]])
                </div>
            </section>

            <section>
                <div class="flex items-center gap-4 mb-6">
                    <div class="bg-bmkg-navy text-white w-10 h-10 rounded-xl flex items-center justify-center font-bold shadow-lg">III</div>
                    <h2 class="text-lg font-bold text-bmkg-navy">Jasa Kalibrasi</h2>
                </div>
                <div class="bg-white rounded-2xl border border-gray-100 shadow-xl overflow-hidden">
                    @include('pages.pelayanan.partials.tarif-table', ['data' => [
                        ['Barometer Aneroid / Air Raksa', 'per unit', 'Rp 400.000,00'],
                        ['Thermometer (Seluruh Jenis)', 'per unit', 'Rp 285.000,00'],
                        ['Automatic Weather Station (AWS)', 'per unit', 'Rp 3.040.000,00'],
                        ['pH Meter / Conductivity Meter', 'per unit', 'Rp 50.000,00'],
                    ]])
                </div>
            </section>
        </div>

        {{-- IV: Pendidikan & Pelatihan --}}
        <section>
            <div class="flex items-center gap-4 mb-6">
                <div class="bg-bmkg-navy text-white w-10 h-10 rounded-xl flex items-center justify-center font-bold shadow-lg">IV</div>
                <h2 class="text-lg font-bold text-bmkg-navy">Jasa Pendidikan & Pelatihan</h2>
            </div>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-xl overflow-hidden">
                @include('pages.pelayanan.partials.tarif-table', ['data' => [
                    ['Sertifikasi Pengamat Meteorologi (Kelas I/II/III)', 'per orang', 'Rp 3.500.000,00'],
                    ['Pelatihan Singkat (Workshop) Bidang MKG', 'per orang per hari', 'Rp 500.000,00'],
                    ['Kunjungan Edukasi (Instansi/Umum)', 'per grup (max 30)', 'Gratis / Sesuai Sarpas'],
                ]])
            </div>
        </section>

        {{-- V & VII: Sewa Alat & Fasilitas --}}
        <div class="grid md:grid-cols-2 gap-12">
            <section>
                <div class="flex items-center gap-4 mb-6">
                    <div class="bg-bmkg-navy text-white w-10 h-10 rounded-xl flex items-center justify-center font-bold shadow-lg">V</div>
                    <h2 class="text-lg font-bold text-bmkg-navy">Sewa Peralatan</h2>
                </div>
                <div class="bg-white rounded-2xl border border-gray-100 shadow-xl overflow-hidden">
                    @include('pages.pelayanan.partials.tarif-table', ['data' => [
                        ['Portable Weather Station (PWS)', 'per minggu', 'Rp 150.000,00'],
                        ['Barometer / Anemometer Digital', 'per minggu', 'Rp 60.000,00'],
                        ['Gravimeter', 'per hari', 'Rp 600.000,00'],
                    ]])
                </div>
            </section>

            <section>
                <div class="flex items-center gap-4 mb-6">
                    <div class="bg-bmkg-navy text-white w-10 h-10 rounded-xl flex items-center justify-center font-bold shadow-lg">VI</div>
                    <h2 class="text-lg font-bold text-bmkg-navy">Sewa Sarana & Prasarana</h2>
                </div>
                <div class="bg-white rounded-2xl border border-gray-100 shadow-xl overflow-hidden">
                    @include('pages.pelayanan.partials.tarif-table', ['data' => [
                        ['Ruang Aula / Sinema', 'per 8 jam', 'Rp 1.500.000,00'],
                        ['Ruang Kelas / Komputer', 'per 8 jam', 'Rp 400.000,00'],
                        ['Kamar Asrama', 'per orang/hari', 'Rp 225.000,00'],
                    ]])
                </div>
            </section>
        </div>

        {{-- TARIF RP 0,- --}}
        <section class="bg-emerald-50 border-2 border-emerald-100 rounded-3xl p-8 shadow-inner shadow-emerald-200/50">
            <div class="mb-8">
                <h2 class="text-xl md:text-2xl font-black text-emerald-900 leading-tight">Tarif Rp. 0,00 (Gratis)</h2>
                <p class="text-emerald-700/80 font-medium">Layanan bebas biaya untuk kriteria tertentu sesuai peraturan yang berlaku.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                $zeroTarifs = [
                    ['title' => 'Pendidikan', 'desc' => 'Kegiatan pendidikan & penelitian non-komersial'],
                    ['title' => 'Pemerintah', 'desc' => 'Tugas kenegaraan atau penyelenggaraan pemerintahan'],
                    ['title' => 'Bencana', 'desc' => 'Penanggulangan bencana alam & keadaan darurat'],
                    ['title' => 'Sosial', 'desc' => 'Kegiatan keagamaan & kemanusiaan'],
                ];
                @endphp

                @foreach($zeroTarifs as $item)
                <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-5 border border-white hover:bg-white transition-all shadow-sm">
                    <h3 class="text-base font-bold text-emerald-900 mb-1">{{ $item['title'] }}</h3>
                    <p class="text-emerald-800/70 text-sm leading-relaxed">{{ $item['desc'] }}</p>
                </div>
                @endforeach
            </div>
            
            <div class="mt-8 bg-emerald-600/5 rounded-xl p-4 text-emerald-900 text-xs font-semibold">
                Pemberian tarif Rp 0,00 wajib melampirkan surat permohonan dan surat pernyataan dari instansi berwenang.
            </div>
        </section>

    </div>

    {{-- Footer Note --}}
    <div class="mt-16 text-center text-gray-400 text-sm">
        <p>© {{ date('Y') }} Stasiun Meteorologi Kelas III Amahai — Badan Meteorologi, Klimatologi, dan Geofisika</p>
    </div>
</div>
@endsection
