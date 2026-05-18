<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Fixture;
use App\Models\Result;
use App\Models\Standing;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::active()->get();
        return view('frontend.branch.index', compact('branches'));
    }

    public function show($slug)
    {
        $branch  = Branch::where('slug', $slug)->firstOrFail();
        $coaches = $branch->coaches()->active()->get();
        $players = $branch->players()->active()->get();

        $latestResults  = $branch->results()
                                 ->orderBy('match_date', 'desc')
                                 ->take(5)->get();

        $upcomingFixtures = $branch->fixtures()
                                   ->upcoming()
                                   ->take(5)->get();

        return view('frontend.branch.show', compact(
            'branch', 'coaches', 'players',
            'latestResults', 'upcomingFixtures'
        ));
    }

    public function fixture($slug)
    {
        $branch   = Branch::where('slug', $slug)->firstOrFail();
        $fixtures = $branch->fixtures()
                           ->orderBy('match_date', 'desc')
                           ->get();
        return view('frontend.branch.fixture', compact('branch', 'fixtures'));
    }

    public function results($slug)
    {
        $branch  = Branch::where('slug', $slug)->firstOrFail();
        $results = $branch->results()
                          ->orderBy('match_date', 'desc')
                          ->get();
        return view('frontend.branch.results', compact('branch', 'results'));
    }

    public function standings($slug)
    {
        $branch    = Branch::where('slug', $slug)->firstOrFail();
        $standings = $branch->standings()->ordered()->get();
        return view('frontend.branch.standings', compact('branch', 'standings'));
    }

    public function coaches($slug)
    {
        $branch  = Branch::where('slug', $slug)->firstOrFail();
        $coaches = $branch->coaches()->active()->get();
        return view('frontend.branch.coaches', compact('branch', 'coaches'));
    }
}