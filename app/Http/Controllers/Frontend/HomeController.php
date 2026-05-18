<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\Result;
use App\Models\Fixture;
use App\Models\Branch;
use App\Models\Announcements;
use App\Models\News;

class HomeController extends Controller
{
    public function index()
    {
        // Aktif sliderlar
        $sliders = Slider::active()->get();

        // Son maç sonuçları (her branştan 1 tane)
        $lastResults = Result::with('branch')
            ->orderBy('match_date', 'desc')
            ->take(3)
            ->get();

        // Yaklaşan maçlar
        $upcomingFixtures = Fixture::with('branch')
            ->upcoming()
            ->take(3)
            ->get();

        // Aktif branşlar
        $branches = Branch::active()->get();

        // Son haberler
        $latestNews = \App\Models\News::where('type', 'haber')
            ->where('is_published', true)
            ->latest()
            ->take(3)
            ->get();

        return view('frontend.home.index', compact(
            'sliders',
            'lastResults',
            'upcomingFixtures',
            'branches',
            'latestNews'
        ));
    }
}