<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePengaduanRequest extends FormRequest
{
    /**
     * All users (public) are authorized to submit complaints.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules for pengaduan submission.
     */
    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'digits:16'],
            'email' => ['required', 'email', 'max:255'],
            'telepon' => ['required', 'string', 'regex:/^08\d{8,12}$/'],
            'kategori' => ['required', 'string', 'in:Kualitas Pelayanan,Ketepatan Informasi Cuaca,Pelayanan Data Meteorologi,Perilaku Petugas,Fasilitas & Sarana,Lainnya'],
            'judul' => ['required', 'string', 'max:255'],
            'isi' => ['required', 'string', 'min:30', 'max:1000'],
            'konfirmasi' => ['required', 'accepted'],
        ];
    }

    /**
     * Custom error messages in Indonesian.
     */
    public function messages(): array
    {
        return [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus 16 digit angka.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'telepon.required' => 'No. telepon wajib diisi.',
            'telepon.regex' => 'Format tidak valid (mulai 08, 10-14 digit).',
            'kategori.required' => 'Pilih kategori pengaduan.',
            'kategori.in' => 'Kategori pengaduan tidak valid.',
            'judul.required' => 'Judul pengaduan wajib diisi.',
            'isi.required' => 'Isi pengaduan wajib diisi.',
            'isi.min' => 'Isi pengaduan minimal 30 karakter.',
            'isi.max' => 'Isi pengaduan maksimal 1000 karakter.',
            'konfirmasi.required' => 'Anda harus menyetujui pernyataan di atas.',
            'konfirmasi.accepted' => 'Anda harus menyetujui pernyataan di atas.',
        ];
    }

    /**
     * Sanitize inputs after validation passes to prevent XSS.
     */
    protected function passedValidation(): void
    {
        $this->merge([
            'nama' => strip_tags(htmlspecialchars($this->nama, ENT_QUOTES, 'UTF-8')),
            'judul' => strip_tags(htmlspecialchars($this->judul, ENT_QUOTES, 'UTF-8')),
            'isi' => strip_tags(htmlspecialchars($this->isi, ENT_QUOTES, 'UTF-8')),
        ]);
    }
}
