<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        return view('admin.about.index');
    }

    public function editHistory()
    {
        $page = Page::firstOrCreate(
            ['page_key' => 'tarihce'],
            ['title' => 'Tarihçe', 'content' => '']
        );
        return view('admin.about.edit', compact('page'));
    }

    public function updateHistory(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ], [
            'content.required' => 'İçerik alanı boş bırakılamaz.',
        ]);

        Page::updateOrCreate(
            ['page_key' => 'tarihce'],
            ['title' => 'Tarihçe', 'content' => $request->content]
        );

        return redirect()->route('admin.about.history.edit')
                         ->with('success', 'Tarihçe güncellendi.');
    }

    public function editMission()
    {
        $page = Page::firstOrCreate(
            ['page_key' => 'misyon-vizyon'],
            ['title' => 'Misyon & Vizyon', 'content' => '']
        );
        return view('admin.about.edit', compact('page'));
    }

    public function updateMission(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        Page::updateOrCreate(
            ['page_key' => 'misyon-vizyon'],
            ['title' => 'Misyon & Vizyon', 'content' => $request->content]
        );

        return redirect()->route('admin.about.mission.edit')
                         ->with('success', 'Misyon & Vizyon güncellendi.');
    }
}