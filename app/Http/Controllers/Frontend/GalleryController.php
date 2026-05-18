<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\GalleryAlbum;

class GalleryController extends Controller
{
    public function index()
    {
        $albums = GalleryAlbum::active()
                              ->withCount('media')
                              ->paginate(12);
        return view('frontend.gallery.index', compact('albums'));
    }

    public function show($slug)
    {
        $album = GalleryAlbum::where('slug', $slug)
                             ->where('is_active', true)
                             ->firstOrFail();
        $media = $album->media()->orderBy('sort_order')->get();
        return view('frontend.gallery.show', compact('album', 'media'));
    }
}