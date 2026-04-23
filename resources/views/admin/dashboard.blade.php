@extends('layouts.admin')

@section('title', 'Dashboard Admin BMKG Amahai')

@push('styles')
    <style>
        .stat-card {
            transition: all 0.25s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
        }

        /* SVG Line Chart */
        .chart-line {
            fill: none;
            stroke: #0057A8;
            stroke-width: 2.5;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .chart-area {
            fill: url(#blueGradient);
            opacity: 0.15;
        }

        .chart-dot {
            fill: #0057A8;
            stroke: white;
            stroke-width: 2;
        }

        /* Animated progress bars */
        @keyframes grow {
            from {
                width: 0;
            }

            to {
                width: var(--target-w);
            }
        }

        .bar-fill {
            animation: grow 1s ease forwards;
        }
    </style>
@endpush

@section('content')

    {{-- ═══════════════════════════════════════════════ --}}
    {{-- HEADER ACTIONS --}}
    {{-- ═══════════════════════════════════════════════ --}}
    <div
        class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6 bg-white p-4 rounded-xl shadow-sm border border-gray-100">
        <div>
            <h2 class="text-gray-800 font-bold text-sm">Status Sinkronisasi Data</h2>
            <div class="flex items-center gap-2 mt-1">
                <span
                    class="w-2 h-2 rounded-full {{ $lastSatelitUpdate !== 'Belum pernah' ? 'bg-emerald-500' : 'bg-red-500' }}"></span>
                <p class="text-xs text-gray-500 font-medium">Satelit: Terakhir diperbarui pada <span
                        class="text-bmkg-blue font-bold">{{ $lastSatelitUpdate }}</span></p>
            </div>
        </div>
        <form action="{{ route('admin.sync-satelit') }}" method="POST" x-data="{ loading: false }" @submit="loading = true">
            @csrf
            <button type="submit"
                class="flex items-center gap-2 px-4 py-2 bg-bmkg-navy text-white text-xs font-bold rounded-lg hover:bg-bmkg-blue transition-all disabled:opacity-50 disabled:cursor-not-allowed w-full md:w-auto justify-center"
                :disabled="loading">
                <svg class="w-4 h-4" :class="loading ? 'animate-spin' : ''" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                <span x-text="loading ? 'Menyinkronkan...' : 'Sinkronkan Citra Satelit'"></span>
            </button>
        </form>
    </div>

    {{-- ═══════════════════════════════════════════════ --}}
    {{-- SECTION 1 — SUMMARY CARDS --}}
    {{-- ═══════════════════════════════════════════════ --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-7">

        {{-- Informasi --}}
        <a href="{{ route('admin.informasi.index') }}"
            class="stat-card bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div class="min-w-0">
                <p class="text-2xl font-extrabold text-gray-800">{{ $totalBerita }}</p>
                <p class="text-xs text-gray-500 font-medium mt-0.5">Total Informasi</p>
            </div>
        </a>

        {{-- Buletin --}}
        <a href="{{ route('admin.buletin.index') }}"
            class="stat-card bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-violet-50 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
            <div class="min-w-0">
                <p class="text-2xl font-extrabold text-gray-800">{{ $totalBulletin }}</p>
                <p class="text-xs text-gray-500 font-medium mt-0.5">Total Buletin</p>
            </div>
        </a>

        {{-- Pegawai --}}
        <a href="{{ route('admin.pegawai.index') }}"
            class="stat-card bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-orange-50 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <div class="min-w-0">
                <p class="text-2xl font-extrabold text-gray-800">{{ $totalPegawai }}</p>
                <p class="text-xs text-gray-500 font-medium mt-0.5">Total Pegawai (SDM)</p>
            </div>
        </a>

        {{-- Views Bulan Ini — highlighted --}}
        <div
            class="stat-card bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl shadow-sm border border-emerald-400/30 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </div>
            <div class="min-w-0">
                <p class="text-2xl font-extrabold text-white">{{ number_format($viewsBulanIni, 0, ',', '.') }}</p>
                <p class="text-xs text-emerald-100 font-medium mt-0.5">Views Bulan Ini</p>
                <div class="flex items-center gap-1 mt-1">
                    @if($viewsPercent >= 0)
                        <svg class="w-3 h-3 text-emerald-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        <span class="text-[10px] font-bold text-emerald-100">+{{ $viewsPercent }}% dari bulan lalu</span>
                    @else
                        <svg class="w-3 h-3 text-red-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                        <span class="text-[10px] font-bold text-red-100">{{ $viewsPercent }}% dari bulan lalu</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════ --}}
    {{-- SECTION 2 — CHARTS --}}
    {{-- ═══════════════════════════════════════════════ --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-7">

        {{-- Line Chart — Statistik Pengunjung (2/3 width) --}}
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 p-6" x-data="visitorChart()"
            x-init="initChart()">

            {{-- Header --}}
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6 gap-4">
                <div>
                    <h2 class="font-bold text-gray-800 text-base">Statistik Pengunjung Website</h2>
                    <p class="text-xs text-gray-400 mt-0.5"
                        x-text="activeTab === 'mingguan' ? 'Jumlah pengunjung 7 hari terakhir' : (activeTab === 'bulanan' ? 'Jumlah pengunjung 30 hari terakhir' : 'Jumlah pengunjung 12 bulan terakhir')">
                    </p>
                </div>
                <div class="flex bg-gray-50 p-1 rounded-lg border border-gray-100 shrink-0">
                    <template x-for="tab in ['Mingguan', 'Bulanan', 'Tahunan']" :key="tab">
                        <button @click="switchTab(tab.toLowerCase())"
                            :class="activeTab === tab.toLowerCase() ? 'bg-white text-blue-600 shadow-sm' : 'text-gray-500 hover:text-gray-700'"
                            class="px-3 py-1.5 text-[10px] font-bold rounded-md transition-all duration-200" x-text="tab">
                        </button>
                    </template>
                </div>
            </div>

            {{-- Chart.js Canvas --}}
            <div class="relative" style="height: 260px;">
                <canvas id="visitorLineChart"></canvas>
            </div>
        </div>

        {{-- Bar Chart — Publikasi Konten Bulanan (1/3 width) --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="mb-5">
                <h2 class="font-bold text-gray-800 text-base">Publikasi Konten</h2>
                <p class="text-xs text-gray-400 mt-0.5">Informasi & Buletin — 3 bulan terakhir</p>
            </div>

            @php
                // Calculate max value for scaling the bars, minimum 10
                $maxVal = collect($bulanStats)->flatMap(fn($item) => [$item['informasi'], $item['buletin']])->max() ?: 10;
                if ($maxVal < 10)
                    $maxVal = 10;
            @endphp

            <div class="space-y-5">
                @forelse($bulanStats as $data)
                    <div>
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">{{ $data['bulan'] }}</p>
                        <div class="space-y-1.5">
                            {{-- Informasi bar --}}
                            <div class="flex items-center gap-2">
                                <span class="text-[10px] text-blue-500 font-semibold w-14 shrink-0">Informasi</span>
                                <div class="flex-1 bg-gray-100 rounded-full h-2 overflow-hidden">
                                    <div class="bg-blue-500 h-2 rounded-full bar-fill"
                                        style="--target-w: {{ ($data['informasi'] / $maxVal * 100) }}%; width: {{ ($data['informasi'] / $maxVal * 100) }}%;">
                                    </div>
                                </div>
                                <span class="text-[10px] font-bold text-gray-600 w-4 text-right">{{ $data['informasi'] }}</span>
                            </div>
                            {{-- Buletin bar --}}
                            <div class="flex items-center gap-2">
                                <span class="text-[10px] text-violet-500 font-semibold w-14 shrink-0">Buletin</span>
                                <div class="flex-1 bg-gray-100 rounded-full h-2 overflow-hidden">
                                    <div class="bg-violet-500 h-2 rounded-full bar-fill"
                                        style="--target-w: {{ ($data['buletin'] / $maxVal * 100) }}%; width: {{ ($data['buletin'] / $maxVal * 100) }}%;">
                                    </div>
                                </div>
                                <span class="text-[10px] font-bold text-gray-600 w-4 text-right">{{ $data['buletin'] }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-10">
                        <p class="text-xs text-gray-400 font-medium italic">Tidak ada data publikasi</p>
                    </div>
                @endforelse
            </div>

            {{-- Legend --}}
            <div class="flex items-center gap-4 mt-5 pt-4 border-t border-gray-100">
                <div class="flex items-center gap-1.5"><span
                        class="w-2.5 h-2.5 rounded-full bg-blue-500 shrink-0"></span><span
                        class="text-[10px] text-gray-500 font-medium">Informasi</span></div>
                <div class="flex items-center gap-1.5"><span
                        class="w-2.5 h-2.5 rounded-full bg-violet-500 shrink-0"></span><span
                        class="text-[10px] text-gray-500 font-medium">Buletin</span></div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════ --}}
    {{-- SECTION 3 — AUDIT LOG --}}
    {{-- ═══════════════════════════════════════════════ --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <div>
                <h2 class="font-bold text-gray-800 text-base">Riwayat Aktivitas & Perubahan</h2>
                <p class="text-xs text-gray-400 mt-0.5">Audit log aktivitas admin terkini</p>
            </div>
            <div class="flex items-center gap-2">
                <span
                    class="inline-flex items-center gap-1 text-[10px] font-semibold text-gray-400 bg-gray-50 border border-gray-200 px-2.5 py-1 rounded-full">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    Live Log
                </span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-[10px] font-bold uppercase tracking-wider text-gray-400">Waktu
                        </th>
                        <th class="px-6 py-3 text-left text-[10px] font-bold uppercase tracking-wider text-gray-400">Admin
                        </th>
                        <th class="px-6 py-3 text-left text-[10px] font-bold uppercase tracking-wider text-gray-400">Aksi
                        </th>
                        <th class="px-6 py-3 text-left text-[10px] font-bold uppercase tracking-wider text-gray-400">Modul
                        </th>
                        <th class="px-6 py-3 text-left text-[10px] font-bold uppercase tracking-wider text-gray-400">
                            Keterangan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @php
                        $badgeClass = ['blue' => 'bg-blue-50 text-blue-700 ring-1 ring-blue-200', 'green' => 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200', 'red' => 'bg-red-50 text-red-700 ring-1 ring-red-200'];
                        $modulIcon = ['Informasi' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'Buletin' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253', 'Pegawai' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'];
                    @endphp
                    @forelse($recentActivities as $log)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-3.5 text-xs text-gray-400 font-medium whitespace-nowrap">{{ $log['waktu'] }}</td>
                            <td class="px-6 py-3.5">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-bmkg-navy flex items-center justify-center shrink-0">
                                        <span class="text-white text-[9px] font-bold">AA</span>
                                    </div>
                                    <span class="text-xs font-semibold text-gray-700">{{ $log['admin'] }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-3.5">
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold {{ $badgeClass[$log['aksi_color']] }}">
                                    {{ $log['aksi'] }}
                                </span>
                            </td>
                            <td class="px-6 py-3.5">
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-gray-400 shrink-0" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="{{ $modulIcon[$log['modul']] ?? '' }}" />
                                    </svg>
                                    <span class="text-xs font-medium text-gray-600">{{ $log['modul'] }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-3.5 text-xs text-gray-500 max-w-xs truncate">{{ $log['ket'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-xs text-gray-400 italic">Belum ada aktivitas
                                tercatat</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Footer with link to latest articles --}}
        <div class="px-6 py-3 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
            <p class="text-xs text-gray-400">Menampilkan 5 aktivitas terbaru</p>
            <a href="{{ route('admin.informasi.index') }}"
                class="text-xs font-semibold text-bmkg-blue hover:text-bmkg-navy transition-colors flex items-center gap-1">
                Lihat semua informasi
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        // ─── Dataset (from PHP Controller) ─────────────────────────────────────
        const realVisitorData = @json($visitorChartData ?? []);

        const VISITOR_DATASETS = (function () {
            const daysInMonth = {{ now()->daysInMonth }};
            return {
                mingguan: {
                    labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                    data: realVisitorData.mingguan || [0, 0, 0, 0, 0, 0, 0]
                },
                bulanan: {
                    labels: Array.from({ length: daysInMonth }, (_, i) => String(i + 1)),
                    data: realVisitorData.bulanan || Array.from({ length: daysInMonth }, () => 0)
                },
                tahunan: {
                    labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                    data: realVisitorData.tahunan || [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                }
            };
        })();

        // ─── Crosshair Plugin ─────────────────────────────────────────────────────
        const crosshairPlugin = {
            id: 'crosshair',
            afterDraw(chart) {
                if (!chart.tooltip._active || !chart.tooltip._active.length) { return; }
                const ctx = chart.ctx;
                const x = chart.tooltip._active[0].element.x;
                const yTop = chart.scales.y.top;
                const yBot = chart.scales.y.bottom;
                ctx.save();
                ctx.beginPath();
                ctx.setLineDash([5, 4]);
                ctx.lineWidth = 1.2;
                ctx.strokeStyle = '#94a3b8';
                ctx.moveTo(x, yTop);
                ctx.lineTo(x, yBot);
                ctx.stroke();
                ctx.restore();
            }
        };

        // ─── Global chart reference ───────────────────────────────────────────────
        let _visitorChartInst = null;
        let _activeVisitorTab = 'bulanan';

        function buildVisitorChart(tab) {
            _activeVisitorTab = tab;
            const canvas = document.getElementById('visitorLineChart');
            if (!canvas) { return; }

            // Destroy existing instance before recreating (needed to redraw gradient)
            if (_visitorChartInst) {
                _visitorChartInst.destroy();
                _visitorChartInst = null;
            }

            const ctx = canvas.getContext('2d');
            const gradient = ctx.createLinearGradient(0, 0, 0, 260);
            gradient.addColorStop(0, 'rgba(59,130,246,0.20)');
            gradient.addColorStop(1, 'rgba(59,130,246,0.00)');

            const ds = VISITOR_DATASETS[tab];

            _visitorChartInst = new Chart(ctx, {
                type: 'line',
                plugins: [crosshairPlugin],
                data: {
                    labels: ds.labels,
                    datasets: [{
                        label: 'Pengunjung',
                        data: ds.data,
                        borderColor: '#3b82f6',
                        borderWidth: 2,
                        backgroundColor: gradient,
                        fill: true,
                        tension: 0.35,
                        pointRadius: 3,
                        pointHoverRadius: 6,
                        pointBackgroundColor: '#3b82f6',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointHoverBackgroundColor: '#1d4ed8',
                        pointHoverBorderColor: '#ffffff',
                        pointHoverBorderWidth: 2.5,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: { duration: 400 },
                    interaction: { mode: 'index', intersect: false },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            enabled: true,
                            backgroundColor: 'rgba(23,37,84,0.95)', // biru tua gelap
                            titleColor: '#ffffff', // putih
                            bodyColor: '#f1f5f9',
                            titleFont: { size: 11, weight: '600', family: 'inherit' },
                            bodyFont: { size: 13, weight: '700', family: 'inherit' },
                            padding: { x: 14, y: 10 },
                            cornerRadius: 10,
                            displayColors: false,
                            borderColor: 'rgba(148,163,184,0.20)',
                            borderWidth: 1,
                            callbacks: {
                                title(items) {
                                    const lbl = items[0].label;
                                    if (_activeVisitorTab === 'bulanan') { return 'Tanggal ' + lbl; }
                                    if (_activeVisitorTab === 'tahunan') { return lbl; }
                                    return lbl;   // mingguan
                                },
                                label(item) {
                                    return '  ' + item.parsed.y.toLocaleString('id-ID') + ' pengunjung';
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false },
                            border: { color: '#e2e8f0' },
                            ticks: {
                                color: '#64748b',
                                font: { size: 11 },
                                maxRotation: 0,
                                autoSkip: true,
                                // Show all labels; Chart.js decides spacing automatically
                                maxTicksLimit: ds.labels.length
                            }
                        },
                        y: {
                            position: 'left',
                            grid: { color: '#f1f5f9', lineWidth: 1 },
                            border: { display: false },
                            ticks: {
                                color: '#94a3b8',
                                font: { size: 11 },
                                maxTicksLimit: 6,
                                callback(val) {
                                    return val >= 1000
                                        ? (val / 1000).toFixed(val % 1000 === 0 ? 0 : 1) + ' rb'
                                        : val;
                                }
                            }
                        }
                    }
                }
            });
        }

        // ─── Alpine component ─────────────────────────────────────────────────────
        function visitorChart() {
            return {
                activeTab: 'bulanan',

                initChart() {
                    // Poll until Chart.js is available (CDN may still be loading)
                    if (typeof Chart === 'undefined') {
                        setTimeout(() => this.initChart(), 80);
                        return;
                    }
                    buildVisitorChart(this.activeTab);
                },

                switchTab(tab) {
                    this.activeTab = tab;
                    buildVisitorChart(tab);
                }
            };
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"
        onload="if(typeof buildVisitorChart==='function'&&document.getElementById('visitorLineChart'))buildVisitorChart('bulanan');">
        </script>
@endpush