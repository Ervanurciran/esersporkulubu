<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        return view('frontend.news.index');
    }

    public function news()
    {
        $news = News::published()
                    ->haberler()
                    ->latest()
                    ->paginate(9);

        return view('frontend.news.news', compact('news'));
    }

    public function events()
    {
        $news = News::published()
                    ->etkinlikler()
                    ->latest()
                    ->paginate(9);

        return view('frontend.news.events', compact('news'));
    }

    public function show($slug)
    {
        $news = News::where('slug', $slug)
                    ->where('is_published', true)
                    ->firstOrFail();

        return view('frontend.news.show', compact('news'));
    }

    public function all()
    {
        $news = News::published()
                    ->latest()
                    ->paginate(12);

        return view('frontend.news.all', compact('news'));
    }
}