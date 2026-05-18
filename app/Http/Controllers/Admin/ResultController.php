<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Result;
use App\Models\Fixture;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index(Branch $branch)
    {
        $results = $branch->results()->orderBy('match_date', 'desc')->get();
        return view('admin.result.index', compact('branch', 'results'));
    }

    public function create(Branch $branch)
    {
        $fixtures = $branch->fixtures()
                           ->where('status', 'completed')
                           ->orderBy('match_date', 'desc')
                           ->get();
        return view('admin.result.form', [
            'branch'   => $branch,
            'result'   => new Result(),
            'fixtures' => $fixtures,
        ]);
    }

    public function store(Request $request, Branch $branch)
    {
        $data = $request->validate([
            'home_team'   => 'required|string|max:255',
            'away_team'   => 'required|string|max:255',
            'home_score'  => 'required|integer|min:0',
            'away_score'  => 'required|integer|min:0',
            'match_date'  => 'required|date',
            'competition' => 'nullable|string|max:255',
            'summary'     => 'nullable|string',
            'fixture_id'  => 'nullable|exists:fixtures,id',
        ], [
            'home_team.required'  => 'Ev sahibi takım zorunludur.',
            'away_team.required'  => 'Deplasman takımı zorunludur.',
            'home_score.required' => 'Skor zorunludur.',
            'away_score.required' => 'Skor zorunludur.',
        ]);

        $data['branch_id'] = $branch->id;
        Result::create($data);

        // Fikstür varsa tamamlandı olarak işaretle
        if (!empty($data['fixture_id'])) {
            Fixture::find($data['fixture_id'])?->update(['status' => 'completed']);
        }

        return redirect()->route('admin.branch.sonuclar.index', $branch->id)
                         ->with('success', 'Sonuç eklendi.');
    }

    public function edit(Branch $branch, Result $sonuclar)
    {
        $fixtures = $branch->fixtures()->orderBy('match_date', 'desc')->get();
        return view('admin.result.form', [
            'branch'   => $branch,
            'result'   => $sonuclar,
            'fixtures' => $fixtures,
        ]);
    }

    public function update(Request $request, Branch $branch, Result $sonuclar)
    {
        $data = $request->validate([
            'home_team'   => 'required|string|max:255',
            'away_team'   => 'required|string|max:255',
            'home_score'  => 'required|integer|min:0',
            'away_score'  => 'required|integer|min:0',
            'match_date'  => 'required|date',
            'competition' => 'nullable|string|max:255',
            'summary'     => 'nullable|string',
            'fixture_id'  => 'nullable|exists:fixtures,id',
        ]);

        $sonuclar->update($data);

        return redirect()->route('admin.branch.sonuclar.index', $branch->id)
                         ->with('success', 'Sonuç güncellendi.');
    }

    public function destroy(Branch $branch, Result $sonuclar)
    {
        $sonuclar->delete();

        return redirect()->route('admin.branch.sonuclar.index', $branch->id)
                         ->with('success', 'Sonuç silindi.');
    }
}