<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Fixture;
use Illuminate\Http\Request;

class FixtureController extends Controller
{
    public function index(Branch $branch)
    {
        $fixtures = $branch->fixtures()->orderBy('match_date', 'desc')->get();
        return view('admin.fixture.index', compact('branch', 'fixtures'));
    }

    public function create(Branch $branch)
    {
        return view('admin.fixture.form', [
            'branch'  => $branch,
            'fixture' => new Fixture(),
        ]);
    }

    public function store(Request $request, Branch $branch)
    {
        $data = $request->validate([
            'home_team'   => 'required|string|max:255',
            'away_team'   => 'required|string|max:255',
            'match_date'  => 'required|date',
            'venue'       => 'nullable|string|max:255',
            'competition' => 'nullable|string|max:255',
            'status'      => 'required|in:upcoming,live,completed',
        ], [
            'home_team.required'  => 'Ev sahibi takım zorunludur.',
            'away_team.required'  => 'Deplasman takımı zorunludur.',
            'match_date.required' => 'Maç tarihi zorunludur.',
        ]);

        $data['branch_id'] = $branch->id;
        Fixture::create($data);

        return redirect()->route('admin.branch.fikstur.index', $branch->id)
                         ->with('success', 'Fikstür eklendi.');
    }

    public function edit(Branch $branch, Fixture $fikstur)
    {
        return view('admin.fixture.form', [
            'branch'  => $branch,
            'fixture' => $fikstur,
        ]);
    }

    public function update(Request $request, Branch $branch, Fixture $fikstur)
    {
        $data = $request->validate([
            'home_team'   => 'required|string|max:255',
            'away_team'   => 'required|string|max:255',
            'match_date'  => 'required|date',
            'venue'       => 'nullable|string|max:255',
            'competition' => 'nullable|string|max:255',
            'status'      => 'required|in:upcoming,live,completed',
        ]);

        $fikstur->update($data);

        return redirect()->route('admin.branch.fikstur.index', $branch->id)
                         ->with('success', 'Fikstür güncellendi.');
    }

    public function destroy(Branch $branch, Fixture $fikstur)
    {
        $fikstur->delete();

        return redirect()->route('admin.branch.fikstur.index', $branch->id)
                         ->with('success', 'Fikstür silindi.');
    }
}