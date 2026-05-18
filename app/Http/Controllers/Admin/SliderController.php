<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('sort_order')->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.form', ['slider' => new Slider()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'nullable|string|max:255',
            'subtitle'    => 'nullable|string|max:255',
            'media_type'  => 'required|in:image,video',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'video_path'  => 'nullable|file|mimes:mp4,webm|max:51200',
            'video_url'   => 'nullable|url',
            'button_text' => 'nullable|string|max:100',
            'button_url'  => 'nullable|string|max:255',
            'sort_order'  => 'nullable|integer',
            'is_active'   => 'nullable|boolean',
        ], [
            'media_type.required' => 'Medya türü seçiniz.',
        ]);

        // Görsel yükle
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                                     ->store('sliders', 'public');
        }

        // MP4 video yükle
        if ($request->hasFile('video_path')) {
            $data['video_path'] = $request->file('video_path')
                                          ->store('sliders/videos', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');
        Slider::create($data);

        return redirect()->route('admin.slider.index')
                         ->with('success', 'Slider eklendi.');
    }

    public function edit(Slider $slider)
    {
        return view('admin.slider.form', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $data = $request->validate([
            'title'       => 'nullable|string|max:255',
            'subtitle'    => 'nullable|string|max:255',
            'media_type'  => 'required|in:image,video',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'video_path'  => 'nullable|file|mimes:mp4,webm|max:51200',
            'video_url'   => 'nullable|url',
            'button_text' => 'nullable|string|max:100',
            'button_url'  => 'nullable|string|max:255',
            'sort_order'  => 'nullable|integer',
            'is_active'   => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($slider->image) Storage::disk('public')->delete($slider->image);
            $data['image'] = $request->file('image')->store('sliders', 'public');
        }

        if ($request->hasFile('video_path')) {
            if ($slider->video_path) Storage::disk('public')->delete($slider->video_path);
            $data['video_path'] = $request->file('video_path')
                                          ->store('sliders/videos', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');
        $slider->update($data);

        return redirect()->route('admin.slider.index')
                         ->with('success', 'Slider güncellendi.');
    }

    public function destroy(Slider $slider)
    {
        if ($slider->image)      Storage::disk('public')->delete($slider->image);
        if ($slider->video_path) Storage::disk('public')->delete($slider->video_path);
        $slider->delete();

        return redirect()->route('admin.slider.index')
                         ->with('success', 'Slider silindi.');
    }
}