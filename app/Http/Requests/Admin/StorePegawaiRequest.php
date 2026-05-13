<?php

namespace App\Http\Requests\Admin;

use App\Enums\SubUnit;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePegawaiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:255'],
            'nip' => ['required', 'string', 'max:18', 'unique:pegawais,nip'],
            'jabatan' => ['required', 'string', 'max:100'],
            'sub_unit' => ['required', Rule::enum(SubUnit::class)],
            'is_ketua_tim' => ['required', 'boolean'],
            'pendidikan' => ['required', 'string', 'max:100'],
            'golongan' => ['required', 'string', 'max:10'],
            'urutan' => ['required', 'integer', 'min:0'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nama.required' => 'Nama pegawai wajib diisi.',
            'nip.required' => 'NIP wajib diisi.',
            'nip.unique' => 'NIP sudah terdaftar.',
            'jabatan.required' => 'Jabatan wajib dipilih.',
            'jabatan.in' => 'Jabatan yang dipilih tidak valid.',
            'sub_unit.required' => 'Tim kerja wajib dipilih.',
            'sub_unit.enum' => 'Tim kerja yang dipilih tidak valid.',
            'pendidikan.required' => 'Pendidikan wajib diisi.',
            'golongan.required' => 'Golongan wajib diisi.',
            'urutan.required' => 'Urutan tampil wajib diisi.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format foto harus jpg atau png.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
        ];
    }
}
