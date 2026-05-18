@extends('layouts.admin')
@section('title', $result->exists ? 'Sonuç Düzenle' : 'Sonuç Ekle')
@section('page_title', $result->exists ? 'Sonuç Düzenle' : 'Sonuç Ekle')
@section('page_subtitle', $branch->name . ' maç sonucu')

@section('content')
<div class="max-w-2xl">
<div class="bg-white rounded-2xl shadow-sm p-8">

<form method="POST"
      action="{{ $result->exists
        ? route('admin.branch.sonuclar.update', [$branch->id, $result->id])
        : route('admin.branch.sonuclar.store', $branch->id) }}">
    @csrf
    @if($result->exists) @method('PUT') @endif

    {{-- Fikstürden seç --}}
    @if($fixtures->count())
    <div class="mb-5 p-4 bg-blue-50 rounded-xl border border-blue-100">
        <label class="form-label text-blue-700">Fikstürden Seç (opsiyonel)</label>
        <select name="fixture_id" class="form-input" id="fixture-select"
                onchange="fillFromFixture(this)">
            <option value="">Manuel giriş yapacağım</option>
            @foreach($fixtures as $f)
            <option value="{{ $f->id }}"
                    data-home="{{ $f->home_team }}"
                    data-away="{{ $f->away_team }}"
                    data-date="{{ $f->match_date->format('Y-m-d\TH:i') }}"
                    data-competition="{{ $f->competition }}"
                    {{ old('fixture_id', $result->fixture_id) == $f->id ? 'selected' : '' }}>
                {{ $f->home_team }} vs {{ $f->away_team }} —
                {{ $f->match_date->format('d.m.Y') }}
            </option>
            @endforeach
        </select>
    </div>
    @endif

    <div class="grid grid-cols-2 gap-4 mb-5">
        <div>
            <label class="form-label">Ev Sahibi <span class="text-red-500">*</span></label>
            <input type="text" name="home_team" id="home_team"
                   value="{{ old('home_team', $result->home_team) }}"
                   class="form-input">
            @error('home_team') <p class="form-error">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="form-label">Deplasman <span class="text-red-500">*</span></label>
            <input type="text" name="away_team" id="away_team"
                   value="{{ old('away_team', $result->away_team) }}"
                   class="form-input">
        </div>
    </div>

    {{-- Skor --}}
    <div class="grid grid-cols-2 gap-4 mb-5">
        <div>
            <label class="form-label">Ev Sahibi Skoru <span class="text-red-500">*</span></label>
            <input type="number" name="home_score" min="0"
                   value="{{ old('home_score', $result->home_score ?? 0) }}"
                   class="form-input text-center text-2xl font-black">
            @error('home_score') <p class="form-error">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="form-label">Deplasman Skoru <span class="text-red-500">*</span></label>
            <input type="number" name="away_score" min="0"
                   value="{{ old('away_score', $result->away_score ?? 0) }}"
                   class="form-input text-center text-2xl font-black">
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4 mb-5">
        <div>
            <label class="form-label">Maç Tarihi <span class="text-red-500">*</span></label>
            <input type="datetime-local" name="match_date" id="match_date"
                   value="{{ old('match_date', $result->exists ? $result->match_date->format('Y-m-d\TH:i') : '') }}"
                   class="form-input">
        </div>
        <div>
            <label class="form-label">Müsabaka</label>
            <input type="text" name="competition" id="competition"
                   value="{{ old('competition', $result->competition) }}"
                   class="form-input">
        </div>
    </div>

    <div class="mb-6">
        <label class="form-label">Maç Özeti</label>
        <textarea name="summary" rows="3" class="form-input"
                  placeholder="Kısa maç özeti...">{{ old('summary', $result->summary) }}</textarea>
    </div>

    <div class="flex items-center space-x-3 pt-4 border-t border-gray-100">
        <button type="submit" class="btn-primary">
            <i class="fas fa-save mr-2"></i>
            {{ $result->exists ? 'Güncelle' : 'Kaydet' }}
        </button>
        <a href="{{ route('admin.branch.sonuclar.index', $branch->id) }}"
           class="btn-secondary">İptal</a>
    </div>
</form>
</div>
</div>
@endsection

@push('scripts')
<script>
function fillFromFixture(select) {
    const opt = select.options[select.selectedIndex];
    if (!opt.value) return;
    document.getElementById('home_team').value    = opt.dataset.home;
    document.getElementById('away_team').value    = opt.dataset.away;
    document.getElementById('match_date').value   = opt.dataset.date;
    document.getElementById('competition').value  = opt.dataset.competition;
}
</script>
@endpush