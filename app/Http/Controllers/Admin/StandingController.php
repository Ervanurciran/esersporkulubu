<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Standing;
use Illuminate\Http\Request;

class StandingController extends Controller
{
    public function index(Branch $branch)
    {
        $standings = $branch->standings()->ordered()->get();
        return view('admin.standing.index', compact('branch', 'standings'));
    }

    public function create(Branch $branch)
    {
        return view('admin.standing.form', [
            'branch'   => $branch,
            'standing' => new Standing(),
        ]);
    }

    public function store(Request $request, Branch $branch)
    {
        $data = $request->validate([
            'team_name'      => 'required|string|max:255',
            'season'         => 'required|string|max:20',
            'competition'    => 'nullable|string|max:255',
            'played'         => 'required|integer|min:0',
            'won'            => 'required|integer|min:0',
            'drawn'          => 'required|integer|min:0',
            'lost'           => 'required|integer|min:0',
            'goals_for'      => 'required|integer|min:0',
            'goals_against'  => 'required|integer|min:0',
            'points'         => 'required|integer|min:0',
            'sort_order'     => 'nullable|integer',
        ], [
            'team_name.required' => 'Takım adı zorunludur.',
            'season.required'    => 'Sezon zorunludur.',
        ]);

        $data['branch_id'] = $branch->id;
        Standing::create($data);

        return redirect()->route('admin.branch.puan-durumu.index', $branch->id)
                         ->with('success', 'Puan durumu eklendi.');
    }

    public function edit(Branch $branch, Standing $puanDurumu)
    {
        return view('admin.standing.form', [
            'branch'   => $branch,
            'standing' => $puanDurumu,
        ]);
    }

    public function update(Request $request, Branch $branch, Standing $puanDurumu)
    {
        $data = $request->validate([
            'team_name'     => 'required|string|max:255',
            'season'        => 'required|string|max:20',
            'competition'   => 'nullable|string|max:255',
            'played'        => 'required|integer|min:0',
            'won'           => 'required|integer|min:0',
            'drawn'         => 'required|integer|min:0',
            'lost'          => 'required|integer|min:0',
            'goals_for'     => 'required|integer|min:0',
            'goals_against' => 'required|integer|min:0',
            'points'        => 'required|integer|min:0',
            'sort_order'    => 'nullable|integer',
        ]);

        $puanDurumu->update($data);

        return redirect()->route('admin.branch.puan-durumu.index', $branch->id)
                         ->with('success', 'Puan durumu güncellendi.');
    }

    public function destroy(Branch $branch, Standing $puanDurumu)
    {
        $puanDurumu->delete();

        return redirect()->route('admin.branch.puan-durumu.index', $branch->id)
                         ->with('success', 'Kayıt silindi.');
    }
}