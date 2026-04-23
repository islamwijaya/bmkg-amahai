<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the settings.
     */
    public function index()
    {
        $settings = Setting::whereIn('key', [
            'running_banner',
            'profil_sejarah_isi',
            'profil_sejarah_images',
            'profil_sejarah_image_captions',
            'kontak_wa',
            'kontak_email',
            'kontak_alamat',
            'kontak_fb',
            'kontak_ig',
            'promo_buletin_variations',
            'promo_buletin_is_random',
            'promo_buletin_interval_days',
            'promo_buletin_active_index',
            'promo_buletin_last_randomized',
        ])->pluck('value', 'key')->toArray();

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update the specified setting.
     */
    public function update(Request $request)
    {
        $formType = $request->input('form_type');

        if ($formType === 'banner') {
            $request->validate(['running_banner' => 'required|string']);
            Setting::updateOrCreate(['key' => 'running_banner'], ['value' => $request->running_banner]);
        } elseif ($formType === 'sejarah') {
            $request->validate([
                'profil_sejarah_isi' => 'required|string',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            ]);

            Setting::updateOrCreate(['key' => 'profil_sejarah_isi'], ['value' => $request->profil_sejarah_isi]);

            if ($request->hasFile('images')) {
                // Delete old images
                $oldImagesJson = Setting::getValue('profil_sejarah_images');
                if ($oldImagesJson) {
                    $oldImages = json_decode($oldImagesJson, true) ?? [];
                    foreach ($oldImages as $oldImage) {
                        Storage::disk('public')->delete($oldImage);
                    }
                }

                $imagePaths = [];
                foreach ($request->file('images') as $image) {
                    $imagePaths[] = $image->store('sejarah', 'public');
                }
                Setting::updateOrCreate(['key' => 'profil_sejarah_images'], ['value' => json_encode($imagePaths)]);

                $captions = $request->input('image_captions', []);
                Setting::updateOrCreate(['key' => 'profil_sejarah_image_captions'], ['value' => json_encode($captions)]);
            } else {
                if ($request->has('existing_captions')) {
                    $captions = $request->input('existing_captions');
                    Setting::updateOrCreate(['key' => 'profil_sejarah_image_captions'], ['value' => json_encode($captions)]);
                }
            }
        } elseif ($formType === 'kontak') {
            $keys = ['kontak_wa', 'kontak_email', 'kontak_alamat', 'kontak_fb', 'kontak_ig'];
            foreach ($keys as $key) {
                if ($request->has($key)) {
                    Setting::updateOrCreate(['key' => $key], ['value' => $request->input($key)]);
                }
            }
        } elseif ($formType === 'promo_buletin') {
            $request->validate([
                'promo_buletin_variations' => 'required|array',
                'promo_buletin_variations.*.attention' => 'required|string',
                'promo_buletin_variations.*.interest_desire' => 'required|string',
                'promo_buletin_variations.*.action' => 'required|string',
                'promo_buletin_is_random' => 'nullable',
                'promo_buletin_interval_days' => 'required|integer|min:1',
            ]);

            $variations = array_map(function ($item) {
                if (!isset($item['id'])) {
                    $item['id'] = uniqid();
                }
                return $item;
            }, $request->promo_buletin_variations);

            Setting::updateOrCreate(['key' => 'promo_buletin_variations'], ['value' => json_encode($variations)]);
            Setting::updateOrCreate(['key' => 'promo_buletin_is_random'], ['value' => $request->has('promo_buletin_is_random') ? '1' : '0']);
            Setting::updateOrCreate(['key' => 'promo_buletin_interval_days'], ['value' => $request->promo_buletin_interval_days]);
        }

        return redirect()->route('admin.settings.index', ['tab' => $formType])->with('success', 'Pengaturan berhasil diperbarui!');
    }
}
