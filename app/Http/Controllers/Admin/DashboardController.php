<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Coach;
use App\Models\Player;
use App\Models\News;
use App\Models\Announcement;
use App\Models\Contact;
use App\Models\GalleryAlbum;
use App\Models\Fixture;
use App\Models\Result;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'branches'      => Branch::count(),
            'players'       => Player::count(),
            'coaches'       => Coach::count(),
            'news' => News::count(),
            'announcement' => Announcement::count(),
            'albums'        => GalleryAlbum::count(),
            'unread'        => Contact::unread()->count(),
            'fixtures'      => Fixture::where('status', 'upcoming')->count(),
            'results'       => Result::count(),
        ];

        $recentContacts = Contact::latest()->take(5)->get();
        $recentNews     = News::latest()->take(5)->get();

        return view('admin.dashboard.index', compact(
            'stats',
            'recentContacts',
            'recentNews'
        ));
    }
}