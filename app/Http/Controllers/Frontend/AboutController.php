<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;

class AboutController extends Controller
{
    public function index()
    {
        return view('frontend.about.index');
    }

    public function history()
    {
        $page = Page::getByKey('tarihce');
        return view('frontend.about.history', compact('page'));
    }

    public function mission()
    {
        $page = Page::getByKey('misyon-vizyon');
        return view('frontend.about.mission', compact('page'));
    }
}