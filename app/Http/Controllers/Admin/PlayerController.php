<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlayerController extends Controller
{
    public function index(Branch $branch)
    {
        $players = $branch->players()->orderBy('sort_order')->get();
        return view('admin.player.index', compact('branch', 'players'));
    }

    public function create(Branch $branch)
    {
        return view('admin.player.form', [
            'branch' => $branch,
            'player' => new Player(),
        ]);
    }

    public function store(Request $request, Branch $branch)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'position'       => 'nullable|string|max:100',
            'jersey_number'  => 'nullable|string|max:10',
            'photo'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'birth_date'     => 'nullable|date',
            'nationality'    => 'nullable|string|max:5',
            'sort_order'     => 'nullable|integer',
            'is_active'      => 'nullable|boolean',
        ], [
            'name.required' => 'Sporcu adı zorunludur.',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('players', 'public');
        }

        $data['branch_id'] = $branch->id;
        $data['is_active'] = $request->boolean('is_active', true);
        Player::create($data);

        return redirect()->route('admin.branch.oyuncular.index', $branch->id)
                         ->with('success', 'Sporcu eklendi.');
    }

    public function edit(Branch $branch, Player $oyuncular)
    {
        return view('admin.player.form', [
            'branch' => $branch,
            'player' => $oyuncular,
        ]);
    }

    public function update(Request $request, Branch $branch, Player $oyuncular)
    {
        $data = $request->validate([
            'name'          => 'required|string|max:255',
            'position'      => 'nullable|string|max:100',
            'jersey_number' => 'nullable|string|max:10',
            'photo'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'birth_date'    => 'nullable|date',
            'nationality'   => 'nullable|string|max:5',
            'sort_order'    => 'nullable|integer',
            'is_active'     => 'nullable|boolean',
        ]);

        if ($request->hasFile('photo')) {
            if ($oyuncular->photo) {
                Storage::disk('public')->delete($oyuncular->photo);
            }
            $data['photo'] = $request->file('photo')->store('players', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');
        $oyuncular->update($data);

        return redirect()->route('admin.branch.oyuncular.index', $branch->id)
                         ->with('success', 'Sporcu güncellendi.');
    }

    public function destroy(Branch $branch, Player $oyuncular)
    {
        if ($oyuncular->photo) {
            Storage::disk('public')->delete($oyuncular->photo);
        }
        $oyuncular->delete();

        return redirect()->route('admin.branch.oyuncular.index', $branch->id)
                         ->with('success', 'Sporcu silindi.');
    }
}