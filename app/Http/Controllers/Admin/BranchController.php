<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::withCount(['coaches', 'players', 'fixtures', 'results'])
                          ->orderBy('sort_order')
                          ->get();
        return view('admin.branch.index', compact('branches'));
    }

    public function create()
    {
        return view('admin.branch.form', ['branch' => new Branch()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'slug'        => 'nullable|string|max:255|unique:branches,slug',
            'icon'        => 'nullable|string|max:10',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'is_active'   => 'nullable|boolean',
            'sort_order'  => 'nullable|integer',
        ], [
            'name.required' => 'Branş adı zorunludur.',
            'slug.unique'   => 'Bu slug zaten kullanılıyor.',
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')
                                           ->store('branches', 'public');
        }

        $data['is_active'] = $request->boolean('is_active', true);
        Branch::create($data);

        return redirect()->route('admin.branslar.index')
                         ->with('success', 'Branş başarıyla eklendi.');
    }

    public function edit(Branch $branslar)
    {
        return view('admin.branch.form', ['branch' => $branslar]);
    }

    public function update(Request $request, Branch $branslar)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'slug'        => 'nullable|string|max:255|unique:branches,slug,' . $branslar->id,
            'icon'        => 'nullable|string|max:10',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'is_active'   => 'nullable|boolean',
            'sort_order'  => 'nullable|integer',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($branslar->cover_image) {
                Storage::disk('public')->delete($branslar->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')
                                           ->store('branches', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');
        $branslar->update($data);

        return redirect()->route('admin.branslar.index')
                         ->with('success', 'Branş güncellendi.');
    }

    public function destroy(Branch $branslar)
    {
        if ($branslar->cover_image) {
            Storage::disk('public')->delete($branslar->cover_image);
        }
        $branslar->delete();

        return redirect()->route('admin.branslar.index')
                         ->with('success', 'Branş silindi.');
    }
}