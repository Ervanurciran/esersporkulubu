<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BoardMember;
use App\Models\Page;

class CorporateController extends Controller
{
    public function index()
    {
        return redirect()->route('corporate.president');
    }

    public function president()
    {
        $baskan = BoardMember::baskan()->active()->first();
        return view('frontend.corporate.president', compact('baskan'));
    }

    public function board()
    {
        $members = BoardMember::yonetimKurulu()->active()->get();
        return view('frontend.corporate.board', compact('members'));
    }

    public function audit()
    {
        $members = BoardMember::denetimKurulu()->active()->get();
        return view('frontend.corporate.audit', compact('members'));
    }

    public function statute()
    {
        $page = Page::getByKey('tuzuk');
        return view('frontend.corporate.statute', compact('page'));
    }
}