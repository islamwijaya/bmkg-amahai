<?php

namespace App\Http\Controllers;

use App\Models\Transparansi;

class TransparansiController extends Controller
{
    public function index()
    {
        $rencana = Transparansi::where('category', 'rencana')->orderBy('year', 'asc')->get();
        $laporan = Transparansi::where('category', 'laporan')->orderBy('year', 'asc')->get();
        $perjanjian = Transparansi::where('category', 'perjanjian')->orderBy('year', 'asc')->get();

        return view('pages.publik.transparansi', compact('rencana', 'laporan', 'perjanjian'));
    }
}
