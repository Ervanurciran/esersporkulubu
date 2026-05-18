<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Haberleri veya etkinlikleri listeler.
     */
    public function index(Request $request)
    {
        $query = News::latest();

        // Filtreleme kontrolü
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $news = $query->paginate(15);
        
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.form', [
            'news' => new News()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'type'         => 'required|in:haber,etkinlik',
            'excerpt'      => 'nullable|string|max:500',
            'content'      => 'required|string',
            'cover_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'is_published' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('news', 'public');
        }

        $data['slug']         = Str::slug($data['title']);
        $data['is_published'] = $request->boolean('is_published');

        if ($data['is_published'] && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        News::create($data);

        return redirect()->route('admin.news.index', ['type' => $request->type])
                         ->with('success', 'İçerik başarıyla eklendi.');
    }

    /**
     * Düzenleme Formu
     * ÖNEMLİ: Rota Model Binding için parametre adının rotadakiyle aynı (news) olması gerekir.
     */
    public function edit($id) 
    {
        $news = News::findOrFail($id);
        return view('admin.news.form', compact('news'));
    }

    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);
        
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'type'         => 'required|in:haber,etkinlik',
            'excerpt'      => 'nullable|string|max:500',
            'content'      => 'required|string',
            'cover_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'is_published' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($news->cover_image) {
                Storage::disk('public')->delete($news->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('news', 'public');
        }

        $data['is_published'] = $request->boolean('is_published');

        if ($data['is_published'] && empty($data['published_at']) && !$news->published_at) {
            $data['published_at'] = now();
        }

        $news->update($data);

        return redirect()->route('admin.news.index', ['type' => $news->type])
                         ->with('success', 'İçerik başarıyla güncellendi.');
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        
        if ($news->cover_image) {
            Storage::disk('public')->delete($news->cover_image);
        }
        $news->delete();

        return redirect()->back()->with('success', 'İçerik silindi.');
    }
    public function haberler()
{
    $news = News::where('type', 'haber')->latest()->paginate(10);

    return view('admin.news.haberler', compact('news'));
}

public function etkinlikler()
{
    $news = News::where('type', 'etkinlik')->latest()->paginate(10);

    return view('admin.news.etkinlikler', compact('news'));
}
}