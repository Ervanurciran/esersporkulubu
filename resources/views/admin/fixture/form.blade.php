@extends('layouts.admin')
@section('title', $fixture->exists ? 'Maç Düzenle' : 'Maç Ekle')
@section('page_title', $fixture->exists ? 'Maç Düzenle' : 'Maç Ekle')
@section('page_subtitle', $branch->name . ' fikstürü')

@section('content')
<div class="max-w-2xl">
<div class="bg-white rounded-2xl shadow-sm p-8">

<form method="POST"
      action="{{ $fixture->exists
        ? route('admin.branch.fikstur.update', [$branch->id, $fixture->id])
        : route('admin.branch.fikstur.store', $branch->id) }}">
    @csrf
    @if($fixture->exists) @method('PUT') @endif

    <div class="grid grid-cols-2 gap-4 mb-5">
        <div>
            <label class="form-label">Ev Sahibi <span class="text-red-500">*</span></label>
            <input type="text" name="home_team"
                   value="{{ old('home_team', $fixture->home_team) }}"
                   placeholder="Eser Spor" class="form-input">
            @error('home_team') <p class="form-error">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="form-label">Deplasman <span class="text-red-500">*</span></label>
            <input type="text" name="away_team"
                   value="{{ old('away_team', $fixture->away_team) }}"
                   placeholder="Rakip Takım" class="form-input">
            @error('away_team') <p class="form-error">{{ $message }}</p> @enderror
        </div>
    </div>

    <div class="mb-5">
        <label class="form-label">Maç Tarihi & Saati <span class="text-red-500">*</span></label>
        <input type="datetime-local" name="match_date"
               value="{{ old('match_date', $fixture->exists ? $fixture->match_date->format('Y-m-d\TH:i') : '') }}"
               class="form-input">
        @error('match_date') <p class="form-error">{{ $message }}</p> @enderror
    </div>

    <div class="grid grid-cols-2 gap-4 mb-5">
        <div>
            <label class="form-label">Stat / Salon</label>
            <input type="text" name="venue"
                   value="{{ old('venue', $fixture->venue) }}"
                   class="form-input">
        </div>
        <div>
            <label class="form-label">Müsabaka / Lig</label>
            <input type="text" name="competition"
                   value="{{ old('competition', $fixture->competition) }}"
                   class="form-input">
        </div>
    </div>

    <div class="mb-6">
        <label class="form-label">Durum</label>
        <select name="status" class="form-input">
            <option value="upcoming" {{ old('status', $fixture->status) === 'upcoming' ? 'selected' : '' }}>
                Yaklaşan
            </option>
            <option value="live" {{ old('status', $fixture->status) === 'live' ? 'selected' : '' }}>
                Canlı
            </option>
            <option value="completed" {{ old('status', $fixture->status) === 'completed' ? 'selected' : '' }}>
                Tamamlandı
            </option>
        </select>
    </div>

    <div class="flex items-center space-x-3 pt-4 border-t border-gray-100">
        <button type="submit" class="btn-primary">
            <i class="fas fa-save mr-2"></i>
            {{ $fixture->exists ? 'Güncelle' : 'Kaydet' }}
        </button>
        <a href="{{ route('admin.branch.fikstur.index', $branch->id) }}"
           class="btn-secondary">İptal</a>
    </div>
</form>
</div>
</div>
@endsection