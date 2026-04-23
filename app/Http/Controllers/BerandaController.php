<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Bulletin;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class BerandaController extends Controller
{
    public function index(): View
    {
        $wilayah = config('wilayah', []);
        $weatherCards = [];

        // Map weather icons to SVG type identifiers
        $iconMap = [
            '☀️' => 'sunny',
            '⛅' => 'partly',
            '☁️' => 'cloudy',
            '🌧️' => 'rainy',
            '⛈️' => 'heavy_rain',
            'Berawan' => 'cloudy',
            'Cerah Berawan' => 'partly',
            'Hujan Ringan' => 'rainy',
            'Hujan Sedang' => 'rainy',
            'Hujan Lebat' => 'heavy_rain',
            'Cerah' => 'sunny',
            'Udara Kabur' => 'cloudy',
            'Kabut' => 'cloudy',
            'Hujan Petir' => 'heavy_rain',
        ];

        // Retrieve the first village code of each Kecamatan
        foreach ($wilayah as $id => $kec) {
            $desaId = $kec['desa'][0]['id'] ?? null;
            if (! $desaId) {
                continue;
            }

            $cacheKey = 'cuaca_bmkg_'.$desaId;
            $data = Cache::remember($cacheKey, 360, function () use ($desaId) {
                try {
                    $response = Http::timeout(5)->get("https://api.bmkg.go.id/publik/prakiraan-cuaca?adm4={$desaId}");
                    if ($response->successful()) {
                        return $response->json();
                    }
                } catch (\Exception $e) {
                    // Log error if needed
                }

                return null;
            });

            if ($data && isset($data['data'][0]['cuaca'][0][0])) {
                $prakiraan = $data['data'][0]['cuaca'][0][0]; // Fetch current/first day, first interval
                $weatherDesc = $prakiraan['weather_desc'] ?? 'Berawan';

                // Wind Direction Translation
                $arahAngin = [
                    'N' => 'Utara', 'NNE' => 'Utara Timur Laut', 'NE' => 'Timur Laut', 'ENE' => 'Timur Timur Laut',
                    'E' => 'Timur', 'ESE' => 'Timur Tenggara', 'SE' => 'Tenggara', 'SSE' => 'Selatan Tenggara',
                    'S' => 'Selatan', 'SSW' => 'Selatan Barat Daya', 'SW' => 'Barat Daya', 'WSW' => 'Barat Barat Daya',
                    'W' => 'Barat', 'WNW' => 'Barat Barat Laut', 'NW' => 'Barat Laut', 'NNW' => 'Utara Barat Laut',
                    'C' => 'Tenang', 'VARIABLE' => 'Berubah-ubah',
                ];
                $wdRaw = strtoupper($prakiraan['wd'] ?? '');
                $wdTranslasi = $arahAngin[$wdRaw] ?? ($wdRaw ?: 'Bervariasi');

                $weatherCards[] = [
                    'id' => $id,
                    'kecamatan' => str_replace('Kecamatan ', '', $kec['nama']),
                    'cuaca' => $weatherDesc,
                    'suhu_min' => (int) ($prakiraan['t'] ?? 0) - 2,
                    'suhu_max' => (int) ($prakiraan['t'] ?? 0) + 2,
                    'kelembaban' => (int) ($prakiraan['hu'] ?? 0),
                    'angin' => $wdTranslasi,
                    'kec_angin' => (int) ($prakiraan['ws'] ?? 0),
                    'icon' => $iconMap[$weatherDesc] ?? 'cloudy',
                ];
            } else {
                // Fallback for this kecamatan if API fails
                $weatherCards[] = [
                    'id' => $id,
                    'kecamatan' => str_replace('Kecamatan ', '', $kec['nama']),
                    'cuaca' => 'Berawan',
                    'suhu_min' => 24,
                    'suhu_max' => 32,
                    'kelembaban' => 78,
                    'angin' => 'Barat',
                    'kec_angin' => 15,
                    'icon' => 'cloudy',
                ];
            }
        }

        // If config is completely empty, provide an empty array to avoid showing placeholder data
        if (empty($weatherCards)) {
            $weatherCards = [];
        }

        $latestNews = Berita::published()->take(6)->get();

        // Promo Buletin Logic
        $promoBuletinSettings = Setting::whereIn('key', [
            'promo_buletin_variations',
            'promo_buletin_is_random',
            'promo_buletin_interval_days',
            'promo_buletin_active_index',
            'promo_buletin_last_randomized',
        ])->pluck('value', 'key');

        $variations = isset($promoBuletinSettings['promo_buletin_variations']) 
            ? json_decode($promoBuletinSettings['promo_buletin_variations'], true) 
            : [];
            
        $activeAida = null;
        if (count($variations) > 0) {
            $isRandom = $promoBuletinSettings['promo_buletin_is_random'] ?? '0';
            $intervalDays = (int)($promoBuletinSettings['promo_buletin_interval_days'] ?? 7);
            $activeIndex = (int)($promoBuletinSettings['promo_buletin_active_index'] ?? 0);
            
            // Safe parse date, defaults to far past if invalid.
            try {
                $lastRandomized = \Carbon\Carbon::parse($promoBuletinSettings['promo_buletin_last_randomized'] ?? now()->subDays($intervalDays + 1));
            } catch (\Exception $e) {
                $lastRandomized = now()->subDays($intervalDays + 1);
            }

            // Check if we need to randomize
            if ($isRandom === '1' && now()->startOfDay()->diffInDays($lastRandomized->startOfDay()) >= $intervalDays && count($variations) > 1) {
                $newIndex = $activeIndex;
                while ($newIndex === $activeIndex) {
                    $newIndex = array_rand($variations);
                }
                $activeIndex = $newIndex;
                Setting::updateOrCreate(['key' => 'promo_buletin_active_index'], ['value' => $activeIndex]);
                Setting::updateOrCreate(['key' => 'promo_buletin_last_randomized'], ['value' => now()->toDateTimeString()]);
            }
            
            $activeAida = $variations[$activeIndex] ?? $variations[0];
        } else {
            // Default placeholder if totally empty
            $activeAida = [
                'attention' => 'Platform Informasi Cuaca Terpercaya',
                'interest_desire' => 'Silahkan atur variasi teks melalui panel admin untuk mengubah teks promo otomatis.',
                'action' => 'Lihat Semua Buletin'
            ];
        }

        $promoBulletins = Bulletin::latestEdition()->take(5)->get();

        return view('pages.beranda', compact('weatherCards', 'latestNews', 'activeAida', 'promoBulletins'));
    }
}
