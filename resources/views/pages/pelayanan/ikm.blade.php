@extends('layouts.app')
@section('title', 'Hasil Survei Indeks Kepuasan Masyarakat | BMKG Meteorologi Amahai')
@section('meta_description', 'Transparansi hasil Survei Indeks Kepuasan Masyarakat (IKM) atas pelayanan publik di BMKG Stasiun Meteorologi Amahai sebagai bentuk komitmen kualitas layanan.')
@section('meta_keywords', 'hasil survei ikm, indeks kepuasan masyarakat, layanan publik bmkg, transparansi bmkg amahai, kualitas pelayanan')
@section('breadcrumb')
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <a href="#" class="hover:text-bmkg-blue">Pelayanan Data</a>
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <span class="text-bmkg-blue font-semibold">Hasil Survei IKM</span>
@endsection
@section('content')
<div class="max-w-5xl mx-auto px-4 py-10">
    <div class="relative overflow-hidden bg-gradient-to-r from-bmkg-navy to-violet-700 rounded-2xl p-8 mb-8 text-white shadow-xl">
        <div class="absolute inset-0 z-0 pointer-events-none">
            <div class="absolute inset-0 bg-gradient-to-r from-bmkg-navy via-bmkg-navy/80 to-transparent z-10 w-[80%] md:w-[60%]"></div>
            <img src="{{ asset('assets/img/foto-kantor.png') }}" alt="Gedung BMKG" class="absolute right-0 top-0 w-full md:w-1/2 h-full object-cover opacity-30 mix-blend-luminosity grayscale">
        </div>
        <div class="relative z-20">
            <div class="flex items-center gap-3 mb-2"><div class="h-1 w-8 bg-bmkg-gold rounded-full"></div><p class="text-bmkg-lgold text-sm font-semibold uppercase tracking-wider">Pelayanan Data</p></div>
            <h1 class="text-3xl font-extrabold mb-2">Hasil Survei IKM</h1>
            <p class="text-white/70">Indeks Kepuasan Masyarakat — Stasiun Meteorologi Kelas III Amahai</p>
        </div>
    </div>

    {{-- Summary Score --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
        @foreach([
            ['Semester I 2024','83.50','B','Baik','blue','Jan — Jun 2024','240'],
            ['Semester II 2024','85.20','B','Baik','emerald','Jul — Des 2024','312'],
            ['Semester I 2025','87.40','A','Sangat Baik','purple','Jan — Jun 2025','198'],
        ] as $s)
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-{{ $s[4] }}-100 text-{{ $s[4] }}-700 font-extrabold text-2xl mb-3">{{ $s[2] }}</div>
            <p class="font-extrabold text-3xl text-bmkg-navy">{{ $s[1] }}</p>
            <p class="text-{{ $s[4] }}-600 font-bold text-sm mt-1">{{ $s[3] }}</p>
            <p class="text-bmkg-navy font-semibold text-sm mt-3">{{ $s[0] }}</p>
            <p class="text-gray-400 text-xs mt-1">{{ $s[5] }}</p>
            <div class="mt-2 text-xs text-gray-500">{{ $s[6] }} responden</div>
        </div>
        @endforeach
    </div>

    {{-- Detail per Unsur --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-6">
        <div class="bg-bmkg-navy px-6 py-4">
            <h2 class="text-white font-bold">Nilai per Unsur Pelayanan — Semester I 2025</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-bmkg-sky border-b border-blue-100">
                        <th class="text-left px-5 py-3 text-xs font-bold text-bmkg-navy uppercase tracking-wider">Unsur Pelayanan</th>
                        <th class="text-center px-4 py-3 text-xs font-bold text-bmkg-navy uppercase tracking-wider">Nilai Rata-rata</th>
                        <th class="text-center px-4 py-3 text-xs font-bold text-bmkg-navy uppercase tracking-wider">NRR × 0.111</th>
                        <th class="text-center px-4 py-3 text-xs font-bold text-bmkg-navy uppercase tracking-wider">Kategori</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @php
                    $unsurData = [
                        ['Persyaratan Pelayanan', 3.52, 0.391, 'Baik'],
                        ['Prosedur Pelayanan', 3.48, 0.386, 'Baik'],
                        ['Waktu Pelayanan', 3.35, 0.372, 'Baik'],
                        ['Biaya/Tarif Pelayanan', 3.60, 0.400, 'Baik'],
                        ['Produk Spesifikasi Jenis Layanan', 3.58, 0.397, 'Baik'],
                        ['Kompetensi Pelaksana', 3.72, 0.413, 'Sangat Baik'],
                        ['Perilaku Pelaksana', 3.78, 0.420, 'Sangat Baik'],
                        ['Penanganan Pengaduan', 3.40, 0.377, 'Baik'],
                        ['Sarana dan Prasarana', 3.42, 0.380, 'Baik'],
                    ];
                    @endphp
                    @foreach($unsurData as $i => $u)
                    <tr class="hover:bg-bmkg-sky/50 transition-colors">
                        <td class="px-5 py-3.5 text-gray-700 font-medium">
                            <span class="inline-block w-6 h-6 bg-bmkg-sky rounded-full text-bmkg-navy text-xs font-bold text-center leading-6 mr-2">{{ $i+1 }}</span>
                            {{ $u[0] }}
                        </td>
                        <td class="px-4 py-3.5 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <div class="w-24 h-2 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="h-full rounded-full bg-bmkg-blue" style="width: {{ ($u[1]/4)*100 }}%"></div>
                                </div>
                                <span class="font-bold text-bmkg-navy">{{ $u[1] }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3.5 text-center font-semibold text-gray-700">{{ $u[2] }}</td>
                        <td class="px-4 py-3.5 text-center">
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $u[3] === 'Sangat Baik' ? 'bg-emerald-100 text-emerald-700' : 'bg-blue-100 text-blue-700' }}">{{ $u[3] }}</span>
                        </td>
                    </tr>
                    @endforeach
                    <tr class="bg-bmkg-navy text-white">
                        <td class="px-5 py-3.5 font-bold">Nilai IKM Tertimbang</td>
                        <td class="px-4 py-3.5 text-center">—</td>
                        <td class="px-4 py-3.5 text-center font-bold text-bmkg-gold">3.536</td>
                        <td class="px-4 py-3.5 text-center"><span class="bg-bmkg-gold text-bmkg-dark text-xs font-bold px-2.5 py-1 rounded-full">87.40 — Sangat Baik</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Download --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <h3 class="font-bold text-bmkg-navy mb-4">Unduh Laporan IKM</h3>
        <div class="space-y-3">
            @foreach(['Laporan IKM Semester I 2025','Laporan IKM Semester II 2024','Laporan IKM Semester I 2024'] as $doc)
            <div class="flex items-center justify-between p-3 border border-gray-200 rounded-xl hover:border-bmkg-blue hover:bg-bmkg-sky transition-all">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700">{{ $doc }}</span>
                </div>
                <a href="#" class="flex items-center gap-1.5 text-xs font-semibold text-bmkg-blue hover:text-bmkg-navy transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Unduh PDF
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
