<?php

namespace App\Http\Controllers;

use App\Models\Bulletin;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BulletinController extends Controller
{
    public function index(Request $request): View
    {
        $years = Bulletin::query()
            ->select('year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year');

        $selectedYear = $request->integer('tahun', $years->first());
        $selectedMonth = $request->integer('bulan');

        $query = Bulletin::query()->latestEdition();

        if ($selectedYear) {
            $query->where('year', $selectedYear);
        }

        if ($selectedMonth) {
            $query->where('month', $selectedMonth);
        }

        $bulletins = $query->get();
        $selectedId = $request->integer('active');
        $activeBulletin = $selectedId 
            ? $bulletins->firstWhere('id', $selectedId) 
            : $bulletins->first();

        // Fallback in case the selected ID is no longer in the filtered set
        if (!$activeBulletin) {
            $activeBulletin = $bulletins->first();
        }

        return view('pages.publik.buletin', compact('bulletins', 'activeBulletin', 'years', 'selectedYear', 'selectedMonth'));
    }
}
