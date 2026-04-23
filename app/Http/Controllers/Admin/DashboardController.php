<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SatelitController;
use App\Models\Berita;
use App\Models\Bulletin;
use App\Models\Pegawai;
use App\Models\Visitor;
use Carbon\Carbon;
use App\Models\KritikSaran;
use App\Models\Pengaduan;
use App\Models\Transparansi;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    public function index(): View
    {
        $today = Carbon::today();

        // 1. Total pengunjung unik bulan ini
        $viewsBulanIni = (int) Visitor::query()
            ->whereMonth('date', $today->month)
            ->whereYear('date', $today->year)
            ->count();

        // Total pengunjung unik bulan lalu untuk persentase
        $viewsBulanLalu = (int) Visitor::query()
            ->whereMonth('date', $today->copy()->subMonth()->month)
            ->whereYear('date', $today->copy()->subMonth()->year)
            ->count();

        $viewsPercent = $viewsBulanLalu > 0 ? round((($viewsBulanIni - $viewsBulanLalu) / $viewsBulanLalu) * 100) : ($viewsBulanIni > 0 ? 100 : 0);

        // 2. Data Mingguan — jumlah pengunjung unik per hari (Senin-Minggu)
        $startOfWeek = $today->copy()->startOfWeek();
        $endOfWeek = $today->copy()->endOfWeek();

        $isSqlite = DB::getDriverName() === 'sqlite';
        $dateFunc = $isSqlite ? 'date(date)' : 'DATE(date)';

        $mingguanData = Visitor::query()
            ->whereBetween('date', [$startOfWeek->toDateString(), $endOfWeek->toDateString()])
            ->selectRaw("$dateFunc as date, COUNT(*) as total")
            ->groupBy('date')
            ->pluck('total', 'date');

        $mingguan = [];
        for ($i = 0; $i < 7; $i++) {
            $currentDay = $startOfWeek->copy()->addDays($i)->toDateString();
            $mingguan[] = (int) ($mingguanData[$currentDay] ?? 0);
        }

        // 3. Data Bulanan — pengunjung unik per hari
        $daysInMonth = $today->daysInMonth;
        $startOfMonth = $today->copy()->startOfMonth();
        $endOfMonth = $today->copy()->endOfMonth();
        $bulananData = Visitor::query()
            ->whereBetween('date', [$startOfMonth->toDateString(), $endOfMonth->toDateString()])
            ->selectRaw("$dateFunc as date, COUNT(*) as total")
            ->groupBy('date')
            ->pluck('total', 'date');

        $bulanan = [];
        for ($i = 0; $i < $daysInMonth; $i++) {
            $currentDay = $startOfMonth->copy()->addDays($i)->toDateString();
            $bulanan[] = (int) ($bulananData[$currentDay] ?? 0);
        }

        // 4. Data Tahunan — pengunjung unik per bulan
        $monthFunc = $isSqlite ? "strftime('%m', date)" : 'MONTH(date)';

        $tahunanData = Visitor::query()
            ->whereYear('date', $today->year)
            ->selectRaw("CAST($monthFunc AS UNSIGNED) as month, COUNT(*) as total")
            ->groupBy('month')
            ->pluck('total', 'month');

        $tahunan = [];
        for ($i = 1; $i <= 12; $i++) {
            $tahunan[] = (int) ($tahunanData[$i] ?? 0);
        }

        // 5. Satelit Last Update
        $lastSatelitUpdate = 'Belum pernah';
        if (Storage::disk('public')->exists('satelit/last_updated.json')) {
            $data = json_decode(Storage::disk('public')->get('satelit/last_updated.json'), true);
            $lastSatelitUpdate = $data['formatted'] ?? 'Belum pernah';
        }

        // 6. Publikasi Konten (3 bulan terakhir) - Informasi (Berita) vs Buletin
        $bulanStats = [];
        for ($i = 2; $i >= 0; $i--) {
            $monthDate = $today->copy()->subMonths($i);
            $bulanStats[] = [
                'bulan' => $monthDate->translatedFormat('M'),
                'informasi' => Berita::whereMonth('created_at', $monthDate->month)
                    ->whereYear('created_at', $monthDate->year)
                    ->count(),
                'buletin' => Bulletin::whereMonth('created_at', $monthDate->month)
                    ->whereYear('created_at', $monthDate->year)
                    ->count(),
            ];
        }

        // 7. Riwayat Aktivitas (Terbaru) - Gabungan dari beberapa model
        $recentActivities = collect();

        // Ambil dari Berita
        Berita::latest('updated_at')->take(3)->get()->each(function ($item) use ($recentActivities) {
            $recentActivities->push([
                'waktu' => $item->updated_at->format('d M, H:i'),
                'admin' => 'Admin Amahai',
                'aksi' => $item->created_at == $item->updated_at ? 'Ditambah' : 'Diedit',
                'aksi_color' => $item->created_at == $item->updated_at ? 'green' : 'blue',
                'modul' => 'Informasi',
                'ket' => ($item->created_at == $item->updated_at ? 'Menambahkan berita baru: ' : 'Mengubah berita: ') . '"' . Str::limit($item->title, 40) . '"',
            ]);
        });

        // Ambil dari Bulletin
        Bulletin::latest('updated_at')->take(2)->get()->each(function ($item) use ($recentActivities) {
            $recentActivities->push([
                'waktu' => $item->updated_at->format('d M, H:i'),
                'admin' => 'Admin Amahai',
                'aksi' => $item->created_at == $item->updated_at ? 'Ditambah' : 'Diedit',
                'aksi_color' => $item->created_at == $item->updated_at ? 'green' : 'blue',
                'modul' => 'Buletin',
                'ket' => ($item->created_at == $item->updated_at ? 'Mengunggah Buletin: ' : 'Memperbarui Buletin: ') . '"' . Str::limit($item->title, 40) . '"',
            ]);
        });

        // Ambil dari Pegawai
        Pegawai::latest('updated_at')->take(2)->get()->each(function ($item) use ($recentActivities) {
            $recentActivities->push([
                'waktu' => $item->updated_at->format('d M, H:i'),
                'admin' => 'Admin Amahai',
                'aksi' => $item->created_at == $item->updated_at ? 'Ditambah' : 'Diedit',
                'aksi_color' => $item->created_at == $item->updated_at ? 'green' : 'blue',
                'modul' => 'Pegawai',
                'ket' => ($item->created_at == $item->updated_at ? 'Menambahkan data pegawai: ' : 'Memperbarui data pegawai: ') . '"' . $item->nama . '"',
            ]);
        });

        $recentActivities = $recentActivities->sortByDesc('waktu')->take(5);

        return view('admin.dashboard', [
            'totalBerita' => Berita::query()->count(),
            'totalBulletin' => Bulletin::query()->count(),
            'totalPegawai' => Pegawai::query()->count(),
            'totalKritikSaran' => KritikSaran::query()->count(),
            'totalPengaduan' => Pengaduan::query()->count(),
            'latestBerita' => Berita::query()->orderByDesc('created_at')->limit(5)->get(),
            'viewsBulanIni' => $viewsBulanIni,
            'viewsPercent' => $viewsPercent,
            'lastSatelitUpdate' => $lastSatelitUpdate,
            'visitorChartData' => [
                'mingguan' => $mingguan,
                'bulanan' => $bulanan,
                'tahunan' => $tahunan,
            ],
            'bulanStats' => $bulanStats,
            'recentActivities' => $recentActivities,
        ]);
    }

    public function syncSatelit(SatelitController $controller): RedirectResponse
    {
        $result = $controller->fetchLatestImages();

        if ($result['success']) {
            return back()->with('success', $result['message']);
        }

        return back()->with('error', $result['message']);
    }
}
