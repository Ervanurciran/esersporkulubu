<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Coach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CoachController extends Controller
{
    public function index(Branch $branch)
    {
        $coaches = $branch->coaches()->orderBy('sort_order')->get();
        return view('admin.coach.index', compact('branch', 'coaches'));
    }

    public function create(Branch $branch)
    {
        return view('admin.coach.form', [
            'branch' => $branch,
            'coach'  => new Coach(),
        ]);
    }

    public function store(Request $request, Branch $branch)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'title'      => 'required|string|max:255',
            'photo'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'bio'        => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active'  => 'nullable|boolean',
        ], [
            'name.required'  => 'Ad soyad zorunludur.',
            'title.required' => 'Ünvan zorunludur.',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('coaches', 'public');
        }

        $data['branch_id'] = $branch->id;
        $data['is_active'] = $request->boolean('is_active', true);
        Coach::create($data);

        return redirect()->route('admin.branch.antrenorler.index', $branch->id)
                         ->with('success', 'Antrenör eklendi.');
    }

    public function edit(Branch $branch, Coach $antrenorler)
    {
        return view('admin.coach.form', [
            'branch' => $branch,
            'coach'  => $antrenorler,
        ]);
    }

    public function update(Request $request, Branch $branch, Coach $antrenorler)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'title'      => 'required|string|max:255',
            'photo'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'bio'        => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active'  => 'nullable|boolean',
        ]);

        if ($request->hasFile('photo')) {
            if ($antrenorler->photo) {
                Storage::disk('public')->delete($antrenorler->photo);
            }
            $data['photo'] = $request->file('photo')->store('coaches', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');
        $antrenorler->update($data);

        return redirect()->route('admin.branch.antrenorler.index', $branch->id)
                         ->with('success', 'Antrenör güncellendi.');
    }

    public function destroy(Branch $branch, Coach $antrenorler)
    {
        if ($antrenorler->photo) {
            Storage::disk('public')->delete($antrenorler->photo);
        }
        $antrenorler->delete();

        return redirect()->route('admin.branch.antrenorler.index', $branch->id)
                         ->with('success', 'Antrenör silindi.');
    }
}