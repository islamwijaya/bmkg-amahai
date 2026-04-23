<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKritikSaranRequest extends FormRequest
{
    /**
     * All users (public) are authorized to submit feedback.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules for kritik & saran submission.
     */
    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'jenis' => ['required', 'string', 'in:kritik,saran'],
            'aspek' => ['required', 'string', 'in:Akurasi Informasi Cuaca,Kecepatan Penyampaian Informasi,Kemudahan Akses Layanan,Keramahan Petugas,Website & Media Sosial,Prosedur Pelayanan Data,Tarif Layanan,Lainnya'],
            'rating' => ['required', 'integer', 'between:1,5'],
            'pesan' => ['required', 'string', 'min:20', 'max:2000'],
        ];
    }

    /**
     * Custom error messages in Indonesian.
     */
    public function messages(): array
    {
        return [
            'jenis.required' => 'Pilih jenis masukan (Kritik atau Saran).',
            'jenis.in' => 'Jenis masukan tidak valid.',
            'aspek.required' => 'Pilih aspek yang dinilai.',
            'aspek.in' => 'Aspek yang dipilih tidak valid.',
            'rating.required' => 'Berikan penilaian bintang.',
            'rating.between' => 'Penilaian harus antara 1-5 bintang.',
            'pesan.required' => 'Isi kritik/saran wajib diisi.',
            'pesan.min' => 'Minimal 20 karakter.',
            'pesan.max' => 'Maksimal 2000 karakter.',
            'nama.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
        ];
    }

    /**
     * Sanitize inputs after validation passes to prevent XSS.
     */
    protected function passedValidation(): void
    {
        $sanitized = [];

        if ($this->nama) {
            $sanitized['nama'] = strip_tags(htmlspecialchars($this->nama, ENT_QUOTES, 'UTF-8'));
        }

        $sanitized['pesan'] = strip_tags(htmlspecialchars($this->pesan, ENT_QUOTES, 'UTF-8'));

        $this->merge($sanitized);
    }
}
