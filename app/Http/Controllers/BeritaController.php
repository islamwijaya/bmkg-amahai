<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\View\View;

class BeritaController extends Controller
{
    public function index(): View
    {
        $beritas = Berita::query()->published()->paginate(9);

        return view('pages.publik.berita', compact('beritas'));
    }

    public function show(Berita $berita): View
    {
        abort_unless($berita->is_published, 404);

        $related = Berita::query()
            ->published()
            ->where('id', '!=', $berita->id)
            ->limit(3)
            ->get();

        return view('pages.publik.berita-detail', compact('berita', 'related'));
    }
}
