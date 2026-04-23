<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBulletinRequest;
use App\Http\Requests\Admin\UpdateBulletinRequest;
use App\Models\Bulletin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BulletinController extends Controller
{
    public function index(): View
    {
        $bulletins = Bulletin::query()->orderByDesc('year')->orderByDesc('month')->paginate(15);

        return view('admin.buletin.index', compact('bulletins'));
    }

    public function create(): View
    {
        return view('admin.buletin.create');
    }

    public function store(StoreBulletinRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['file_path'] = $request->file('file')->store('buletin', 'public');

        if ($request->hasFile('cover')) {
            $data['cover_path'] = $request->file('cover')->store('buletin/cover', 'public');
        }

        unset($data['file'], $data['cover']);

        Bulletin::query()->create($data);

        return redirect()->route('admin.buletin.index')->with('success', 'Buletin berhasil ditambahkan.');
    }

    public function edit(Bulletin $bulletin): View
    {
        return view('admin.buletin.edit', compact('bulletin'));
    }

    public function update(UpdateBulletinRequest $request, Bulletin $bulletin): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('file')) {
            if ($bulletin->file_path) {
                Storage::disk('public')->delete($bulletin->file_path);
            }
            $data['file_path'] = $request->file('file')->store('buletin', 'public');
        }

        if ($request->hasFile('cover')) {
            if ($bulletin->cover_path) {
                Storage::disk('public')->delete($bulletin->cover_path);
            }
            $data['cover_path'] = $request->file('cover')->store('buletin/cover', 'public');
        }

        unset($data['file'], $data['cover']);

        $bulletin->update($data);

        return redirect()->route('admin.buletin.index')->with('success', 'Buletin berhasil diperbarui.');
    }

    public function destroy(Bulletin $bulletin): RedirectResponse
    {
        if ($bulletin->file_path) {
            Storage::disk('public')->delete($bulletin->file_path);
        }

        if ($bulletin->cover_path) {
            Storage::disk('public')->delete($bulletin->cover_path);
        }

        $bulletin->delete();

        return redirect()->route('admin.buletin.index')->with('success', 'Buletin berhasil dihapus.');
    }
}
