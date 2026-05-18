<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryAlbum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryAlbumController extends Controller
{
    public function index()
    {
        $albums = GalleryAlbum::withCount('media')
                              ->orderBy('event_date', 'desc')
                              ->paginate(12);
        return view('admin.gallery.index', compact('albums'));
    }

    public function create()
    {
        return view('admin.gallery.form', [
            'album' => new GalleryAlbum()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'event_date'  => 'nullable|date',
            'is_active'   => 'nullable|boolean',
        ], [
            'title.required' => 'Albüm adı zorunludur.',
        ]);

        $data['slug']      = Str::slug($data['title']);
        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')
                                           ->store('gallery/covers', 'public');
        }

        GalleryAlbum::create($data);

        return redirect()->route('admin.galeri.index')
                         ->with('success', 'Albüm oluşturuldu.');
    }

    public function edit(GalleryAlbum $galeri)
    {
        $media = $galeri->media()->orderBy('sort_order')->get();
        return view('admin.gallery.form', compact('galeri', 'media'));
    }

    public function update(Request $request, GalleryAlbum $galeri)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'event_date'  => 'nullable|date',
            'is_active'   => 'nullable|boolean',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($galeri->cover_image) {
                Storage::disk('public')->delete($galeri->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')
                                           ->store('gallery/covers', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');
        $galeri->update($data);

        return redirect()->route('admin.galeri.index')
                         ->with('success', 'Albüm güncellendi.');
    }

    public function destroy(GalleryAlbum $galeri)
    {
        foreach ($galeri->media as $media) {
            if ($media->file_path) {
                Storage::disk('public')->delete($media->file_path);
            }
            if ($media->thumbnail) {
                Storage::disk('public')->delete($media->thumbnail);
            }
            $media->delete();
        }

        if ($galeri->cover_image) {
            Storage::disk('public')->delete($galeri->cover_image);
        }

        $galeri->delete();

        return redirect()->route('admin.galeri.index')
                         ->with('success', 'Albüm ve tüm medyalar silindi.');
    }
}