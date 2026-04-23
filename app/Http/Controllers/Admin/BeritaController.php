<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBeritaRequest;
use App\Http\Requests\Admin\UpdateBeritaRequest;
use App\Models\Berita;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BeritaController extends Controller
{
    public function index(): View
    {
        $beritas = Berita::query()->orderByDesc('created_at')->paginate(15);

        return view('admin.berita.index', compact('beritas'));
    }

    public function create(): View
    {
        return view('admin.berita.create');
    }

    public function store(StoreBeritaRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = Berita::generateSlug($data['title']);
        $data['is_published'] = $request->boolean('is_published');
        if (empty($data['published_by'])) {
            $data['published_by'] = 'Admin (BMKG Amahai)';
        }

        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('berita', 'public');
            }
            $data['images'] = $imagePaths;
            $data['image_captions'] = $request->input('image_captions', []);
        }

        Berita::query()->create($data);

        return redirect()->route('admin.informasi.index')->with('success', 'Informasi berhasil ditambahkan.');
    }

    public function edit(Berita $berita): View
    {
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(UpdateBeritaRequest $request, Berita $berita): RedirectResponse
    {
        $data = $request->validated();
        $data['is_published'] = $request->boolean('is_published');
        if (empty($data['published_by'])) {
            $data['published_by'] = 'Admin (BMKG Amahai)';
        }

        if ($request->hasFile('images')) {
            // delete old images
            if (!empty($berita->images)) {
                foreach ($berita->images as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
            if ($berita->thumbnail) {
                Storage::disk('public')->delete($berita->thumbnail);
                $data['thumbnail'] = null;
            }

            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('berita', 'public');
            }
            $data['images'] = $imagePaths;
            $data['image_captions'] = $request->input('image_captions', []);
        } else {
            // keep existing images and update their captions
            if ($request->has('existing_captions')) {
                $data['image_captions'] = $request->input('existing_captions');
            }
        }

        if (! isset($data['published_at']) && $data['is_published'] && ! $berita->published_at) {
            $data['published_at'] = now();
        }

        $berita->update($data);

        return redirect()->route('admin.informasi.index')->with('success', 'Informasi berhasil diperbarui.');
    }

    public function destroy(Berita $berita): RedirectResponse
    {
        if (!empty($berita->images)) {
            foreach ($berita->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }
        if ($berita->thumbnail) {
            Storage::disk('public')->delete($berita->thumbnail);
        }

        $berita->delete();

        return redirect()->route('admin.informasi.index')->with('success', 'Informasi berhasil dihapus.');
    }
}
