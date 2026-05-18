<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AnnouncementsController extends Controller
{
    public function index()
    {
        $announcements = Announcement::latest()->paginate(15);
        return view('admin.announcement.index', compact('announcements'));
    }

    public function create()
    {
        return view('admin.announcement.form', [
            'announcement' => new Announcement()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'excerpt'      => 'nullable|string|max:500',
            'content'      => 'required|string',
            'cover_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'is_published' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ], [
            'title.required'   => 'Başlık zorunludur.',
            'content.required' => 'İçerik zorunludur.',
        ]);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')
                                            ->store('announcements', 'public');
        }

        $slug = Str::slug($data['title']);
        $originalSlug = $slug;
        $count = 1;
        while (Announcement::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }
        $data['slug'] = $slug;

        $data['is_published'] = $request->boolean('is_published');

        if ($data['is_published'] && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        Announcement::create($data);

        return redirect()->route('admin.announcement.index')
                         ->with('success', 'Duyuru eklendi.');
    }

    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('admin.announcement.form', compact('announcement'));
    }

    public function update(Request $request, $id)
    {
        $announcement = Announcement::findOrFail($id);

        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'excerpt'      => 'nullable|string|max:500',
            'content'      => 'required|string',
            'cover_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'is_published' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ], [
            'title.required'   => 'Başlık zorunludur.',
            'content.required' => 'İçerik zorunludur.',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($announcement->cover_image) {
                Storage::disk('public')->delete($announcement->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')
                                            ->store('announcements', 'public');
        }

        if ($announcement->title !== $data['title']) {
            $slug = Str::slug($data['title']);
            $originalSlug = $slug;
            $count = 1;
            while (Announcement::where('slug', $slug)->where('id', '!=', $announcement->id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
            $data['slug'] = $slug;
        }

        $data['is_published'] = $request->boolean('is_published');

        if ($data['is_published'] && empty($data['published_at']) && !$announcement->published_at) {
            $data['published_at'] = now();
        }

        $announcement->update($data);

        return redirect()->route('admin.announcement.index')
                         ->with('success', 'Duyuru güncellendi.');
    }

    public function destroy($id)
    {
        $announcement = Announcement::findOrFail($id);

        if ($announcement->cover_image) {
            Storage::disk('public')->delete($announcement->cover_image);
        }
        $announcement->delete();

        return redirect()->route('admin.announcement.index')
                         ->with('success', 'Duyuru silindi.');
    }
}