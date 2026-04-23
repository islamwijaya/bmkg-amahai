<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBulletinRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'edition' => ['required', 'string', 'max:100'],
            'year' => ['required', 'integer', 'min:2000', 'max:2099'],
            'month' => ['required', 'integer', 'min:1', 'max:12'],
            'description' => ['nullable', 'string', 'max:500'],
            'file' => ['nullable', 'file', 'mimes:pdf,pub', 'max:10240'],
            'cover' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul buletin wajib diisi.',
            'edition.required' => 'Edisi buletin wajib diisi.',
            'year.required' => 'Tahun wajib diisi.',
            'month.required' => 'Bulan wajib diisi.',
            'file.mimes' => 'File harus berformat PDF atau PUB.',
            'file.max' => 'Ukuran file dokumen maksimal 10MB.',
            'cover.image' => 'Cover harus berupa gambar.',
            'cover.max' => 'Ukuran cover maksimal 2MB.',
        ];
    }
}
