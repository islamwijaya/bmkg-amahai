<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePengaduanRequest;
use App\Mail\PengaduanMail;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PengaduanController extends Controller
{
    /**
     * Show the complaint form.
     */
    public function create()
    {
        return view('pages.publik.pengaduan');
    }

    /**
     * Store a new complaint.
     * Validation is handled by StorePengaduanRequest (Form Request).
     * XSS sanitization is done in the Form Request passedValidation hook.
     */
    public function store(StorePengaduanRequest $request)
    {
        $pengaduan = Pengaduan::create($request->only([
            'nama', 'nik', 'email', 'telepon', 'kategori', 'judul', 'isi',
        ]));

        // Kirim email secara otomatis ke Stamet Amahai
        try {
            Mail::to('stamet.amahai@bmkg.go.id')->send(new PengaduanMail($pengaduan));
        } catch (\Exception $e) {
            // Log error if mail fails
            \Log::error('Gagal mengirim email Pengaduan: '.$e->getMessage());
        }

        return redirect()
            ->back()
            ->with('success', 'Pengaduan berhasil dikirim. Kami akan merespons dalam 5 hari kerja.')
            ->with('tiket', $pengaduan->nomor_tiket);
    }
}
