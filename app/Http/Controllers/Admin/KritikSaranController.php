<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KritikSaran;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class KritikSaranController extends Controller
{
    /**
     * Display a listing of kritik & saran.
     */
    public function index(): View
    {
        $feedbacks = KritikSaran::query()
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('admin.kritik-saran.index', compact('feedbacks'));
    }

    /**
     * Remove the specified kritik & saran from storage.
     */
    public function destroy(KritikSaran $kritikSaran): RedirectResponse
    {
        $kritikSaran->delete();

        return redirect()
            ->route('admin.kritik-saran.index')
            ->with('success', 'Kritik atau saran berhasil dihapus.');
    }
}
