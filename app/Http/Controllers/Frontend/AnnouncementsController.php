<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementsController extends Controller
{
    /**
     * Tüm duyuruların listelendiği ana sayfa.
     */
    public function index()
    {
        // Değişken adı çoğul yapıldı, Blade dosyası ile tam uyumlu hale getirildi.
        $announcements = Announcement::where('is_published', true)->latest()->paginate(9);

        return view('frontend.announcement.index', compact('announcements'));
    }

    /**
     * Haberler kategorisindeki duyuruları listeler.
     */
    public function news()
    {
        // View içerisinde hata almamak için burada da çoğul değişken kullanıyoruz.
        $announcements = Announcement::where('is_published', true)
                                     ->where('type', 'haber')
                                     ->latest()
                                     ->paginate(9);

        return view('frontend.announcement.news', compact('announcements'));
    }

    /**
     * Etkinlikler kategorisindeki duyuruları listeler.
     */
    public function events()
    {
        $announcements = Announcement::where('is_published', true)
                                     ->where('type', 'etkinlik')
                                     ->latest()
                                     ->paginate(9);

        return view('frontend.announcement.events', compact('announcements'));
    }

    /**
     * Tek bir duyurunun detay sayfası.
     */
    public function show($slug)
    {
        $announcement = Announcement::where('slug', $slug)
                                    ->where('is_published', true)
                                    ->firstOrFail();

        return view('frontend.announcement.show', compact('announcement'));
    }
}