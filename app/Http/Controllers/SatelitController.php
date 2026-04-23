<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SatelitController extends Controller
{
    public function fetchLatestImages(): array
    {
        $products = [
            'eh' => [
                'name' => 'Himawari-9 IR Enhanced',
                'base_url' => 'https://inderaja.bmkg.go.id/IMAGE/HIMA/H08_EH_', // Stick to H08 as it is actually working on BMKG server as an alias
                'regions' => ['Indonesia', 'Region4', 'Maluku'],
                'prefix' => 'hima_eh_',
            ],
            'rp' => [
                'name' => 'Himawari-9 Rainfall Potential',
                'base_url' => 'https://inderaja.bmkg.go.id/IMAGE/HIMA/H08_RP_',
                'regions' => ['Indonesia', 'Region4', 'Maluku'],
                'prefix' => 'hima_rp_',
            ],
            'gsmap' => [
                'name' => 'GSMaP HTH',
                'base_url' => 'https://inderaja.bmkg.go.id/IMAGE/GSMAP/GSMaP_HTH.png',
                'regions' => ['Indonesia'],
                'prefix' => 'gsmap_hth_',
            ],
        ];

        $successCount = 0;
        $failCount = 0;
        $errors = [];

        foreach ($products as $key => $product) {
            foreach ($product['regions'] as $region) {
                try {
                    $url = ($key === 'gsmap') ? $product['base_url'] : $product['base_url'].$region.'.png';
                    $filename = $product['prefix'].strtolower($region).'.png';

                    $response = Http::timeout(30)->get($url);

                    if ($response->successful() && strlen($response->body()) > 5000) { // Check size to avoid downloading error pages
                        Storage::disk('public')->put('satelit/'.$filename, $response->body());
                        $successCount++;
                    } else {
                        $reason = $response->successful() ? 'File too small (possibly corrupted)' : 'HTTP Status '.$response->status();
                        Log::warning("Satelit fetch failed for {$product['name']} - {$region}: {$reason}");
                        $errors[] = "{$product['name']} ($region): $reason";
                        $failCount++;
                    }
                } catch (\Exception $e) {
                    Log::error("Satelit fetch error for {$product['name']} - {$region}: ".$e->getMessage());
                    $errors[] = "{$product['name']} ($region): ".$e->getMessage();
                    $failCount++;
                }
            }
        }

        if ($successCount > 0) {
            Storage::disk('public')->put('satelit/last_updated.json', json_encode([
                'timestamp' => now()->toISOString(),
                'formatted' => now()->timezone('Asia/Jayapura')->format('d M Y, H:i').' WIT',
            ], JSON_PRETTY_PRINT));

            return [
                'success' => true,
                'message' => "Berhasil sinkronisasi $successCount gambar. ".($failCount > 0 ? "$failCount gagal." : ''),
                'errors' => $errors,
            ];
        }

        return [
            'success' => false,
            'message' => 'Gagal mengambil data dari server BMKG.',
            'errors' => $errors,
        ];
    }

    public function syncPublic(): \Illuminate\Http\JsonResponse
    {
        $result = $this->fetchLatestImages();

        $lastUpdated = '-';
        if ($result['success']) {
            $data = json_decode(Storage::disk('public')->get('satelit/last_updated.json'), true);
            $lastUpdated = $data['formatted'] ?? '-';
        }

        return response()->json([
            'success' => $result['success'],
            'message' => $result['message'],
            'last_updated' => $lastUpdated,
        ]);
    }
}
