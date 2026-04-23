<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePegawaiRequest;
use App\Http\Requests\Admin\UpdatePegawaiRequest;
use App\Models\Pegawai;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminPegawaiController extends Controller
{
    public function index(): View
    {
        $pegawais = Pegawai::query()->ordered()->paginate(20);

        return view('admin.pegawai.index', compact('pegawais'));
    }

    public function create(): View
    {
        return view('admin.pegawai.create');
    }

    public function store(StorePegawaiRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('pegawai', 'public');
        }

        Pegawai::query()->create($data);

        return redirect()->route('admin.pegawai.index')->with('success', 'Pegawai berhasil ditambahkan.');
    }

    public function edit(Pegawai $pegawai): View
    {
        return view('admin.pegawai.edit', compact('pegawai'));
    }

    public function update(UpdatePegawaiRequest $request, Pegawai $pegawai): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            if ($pegawai->foto) {
                Storage::disk('public')->delete($pegawai->foto);
            }
            $data['foto'] = $request->file('foto')->store('pegawai', 'public');
        }

        $pegawai->update($data);

        return redirect()->route('admin.pegawai.index')->with('success', 'Data pegawai berhasil diperbarui.');
    }

    public function destroy(Pegawai $pegawai): RedirectResponse
    {
        if ($pegawai->foto) {
            Storage::disk('public')->delete($pegawai->foto);
        }

        $pegawai->delete();

        return redirect()->route('admin.pegawai.index')->with('success', 'Pegawai berhasil dihapus.');
    }
}
