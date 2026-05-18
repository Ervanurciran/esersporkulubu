<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryAlbum;
use App\Models\GalleryMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryMediaController extends Controller
{
    public function index(GalleryAlbum $album)
    {
        $media = $album->media()->orderBy('sort_order')->get();
        return view('admin.gallery.media', compact('album', 'media'));
    }

    public function store(Request $request, GalleryAlbum $album)
    {
        $request->validate([
            'files.*'    => 'required|file|mimes:jpg,jpeg,png,webp,mp4|max:51200',
            'video_url'  => 'nullable|url',
            'type'       => 'required|in:image,video',
        ]);

        if ($request->input('type') === 'video' && $request->input('video_url')) {
            GalleryMedia::create([
                'album_id'  => $album->id,
                'type'      => 'video',
                'video_url' => $request->input('video_url'),
                'title'     => $request->input('title'),
            ]);
        } elseif ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('gallery/media', 'public');
                GalleryMedia::create([
                    'album_id'  => $album->id,
                    'type'      => 'image',
                    'file_path' => $path,
                    'title'     => $request->input('title'),
                ]);
            }
        }

        return redirect()->route('admin.galeri.medya.index', $album->id)
                         ->with('success', 'Medya yüklendi.');
    }

    public function bulkUpload(Request $request, GalleryAlbum $album)
    {
        $request->validate([
            'files.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        $count = 0;
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('gallery/media', 'public');
                GalleryMedia::create([
                    'album_id'  => $album->id,
                    'type'      => 'image',
                    'file_path' => $path,
                ]);
                $count++;
            }
        }

        return redirect()->route('admin.galeri.medya.index', $album->id)
                         ->with('success', $count . ' fotoğraf yüklendi.');
    }

    public function destroy(GalleryAlbum $album, GalleryMedia $medya)
    {
        if ($medya->file_path) {
            Storage::disk('public')->delete($medya->file_path);
        }
        $medya->delete();

        return redirect()->route('admin.galeri.medya.index', $album->id)
                         ->with('success', 'Medya silindi.');
    }
}