<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transparansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TransparansiController extends Controller
{
    public function index()
    {
        $transparansis = Transparansi::orderBy('year', 'desc')->get();

        return view('admin.transparansi.index', compact('transparansis'));
    }

    public function create()
    {
        return view('admin.transparansi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'custom_category' => 'required_if:category,custom|nullable|string|max:100',
            'year' => 'required|integer',
            'file_path' => 'required|mimes:pdf|max:10240', // max 10MB
        ]);

        $path = $request->file('file_path')->store('transparansi', 'public');

        $category = $request->category === 'custom' ? $request->custom_category : $request->category;

        Transparansi::create([
            'title' => $request->title,
            'category' => $category,
            'year' => $request->year,
            'file_path' => $path,
        ]);

        return redirect()->route('admin.transparansi.index')->with('success', 'Dokumen Transparansi berhasil ditambahkan.');
    }

    public function edit(Transparansi $transparansi)
    {
        return view('admin.transparansi.edit', compact('transparansi'));
    }

    public function update(Request $request, Transparansi $transparansi)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'custom_category' => 'required_if:category,custom|nullable|string|max:100',
            'year' => 'required|integer',
            'file_path' => 'nullable|mimes:pdf|max:10240',
        ]);

        $category = $request->category === 'custom' ? $request->custom_category : $request->category;

        $data = [
            'title' => $request->title,
            'category' => $category,
            'year' => $request->year,
        ];

        if ($request->hasFile('file_path')) {
            if (Storage::disk('public')->exists($transparansi->file_path)) {
                Storage::disk('public')->delete($transparansi->file_path);
            }
            $data['file_path'] = $request->file('file_path')->store('transparansi', 'public');
        }

        $transparansi->update($data);

        return redirect()->route('admin.transparansi.index')->with('success', 'Dokumen Transparansi berhasil diperbarui.');
    }

    public function destroy(Transparansi $transparansi)
    {
        if (Storage::disk('public')->exists($transparansi->file_path)) {
            Storage::disk('public')->delete($transparansi->file_path);
        }
        $transparansi->delete();

        return redirect()->route('admin.transparansi.index')->with('success', 'Dokumen Transparansi berhasil dihapus.');
    }
}
