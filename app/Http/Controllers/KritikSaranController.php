<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKritikSaranRequest;
use App\Mail\KritikSaranMail;
use App\Models\KritikSaran;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class KritikSaranController extends Controller
{
    /**
     * Show the feedback form.
     */
    public function create()
    {
        return view('pages.publik.kritik-saran');
    }

    /**
     * Store new feedback.
     * Validation is handled by StoreKritikSaranRequest (Form Request).
     * XSS sanitization is done in the Form Request passedValidation hook.
     */
    public function store(StoreKritikSaranRequest $request)
    {
        $data = $request->only([
            'nama', 'email', 'jenis', 'aspek', 'rating', 'pesan',
        ]);

        KritikSaran::create($data);

        // Kirim email secara otomatis ke Stamet Amahai
        try {
            Mail::to('stamet.amahai@bmkg.go.id')->send(new KritikSaranMail($data));
        } catch (\Exception $e) {
            // Log error if mail fails, but don't stop the user experience
            \Log::error('Gagal mengirim email KritikSaran: '.$e->getMessage());
        }

        return redirect()
            ->back()
            ->with('success', 'Terima kasih atas masukan Anda! Kritik & saran Anda sangat berarti untuk peningkatan pelayanan kami.');
    }
}
