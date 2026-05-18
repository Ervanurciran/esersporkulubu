@extends('layouts.admin')
@section('title', $standing->exists ? 'Puan Durumu Düzenle' : 'Takım Ekle')
@section('page_title', $standing->exists ? 'Puan Durumu Düzenle' : 'Puan Durumuna Takım Ekle')
@section('page_subtitle', $branch->name . ' puan tablosu')

@section('content')
<div class="max-w-2xl">
<div class="bg-white rounded-2xl shadow-sm p-8">

<form method="POST"
      action="{{ $standing->exists
        ? route('admin.branch.puan-durumu.update', [$branch->id, $standing->id])
        : route('admin.branch.puan-durumu.store', $branch->id) }}">
    @csrf
    @if($standing->exists) @method('PUT') @endif

    <div class="grid grid-cols-2 gap-4 mb-5">
        <div>
            <label class="form-label">Takım Adı <span class="text-red-500">*</span></label>
            <input type="text" name="team_name"
                   value="{{ old('team_name', $standing->team_name) }}"
                   class="form-input">
            @error('team_name') <p class="form-error">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="form-label">Sezon <span class="text-red-500">*</span></label>
            <input type="text" name="season"
                   value="{{ old('season', $standing->season ?? '2024-2025') }}"
                   placeholder="2024-2025" class="form-input">
        </div>
    </div>

    <div class="mb-5">
        <label class="form-label">Müsabaka / Lig</label>
        <input type="text" name="competition"
               value="{{ old('competition', $standing->competition) }}"
               class="form-input">
    </div>

    {{-- İstatistikler --}}
    <div class="grid grid-cols-3 gap-4 mb-5">
        <div>
            <label class="form-label text-center block">Oynadı (O)</label>
            <input type="number" name="played" min="0"
                   value="{{ old('played', $standing->played ?? 0) }}"
                   class="form-input text-center font-bold">
        </div>
        <div>
            <label class="form-label text-center block">Kazandı (G)</label>
            <input type="number" name="won" min="0"
                   value="{{ old('won', $standing->won ?? 0) }}"
                   class="form-input text-center font-bold text-green-600">
        </div>
        <div>
            <label class="form-label text-center block">Berabere (B)</label>
            <input type="number" name="drawn" min="0"
                   value="{{ old('drawn', $standing->drawn ?? 0) }}"
                   class="form-input text-center font-bold">
        </div>
    </div>

    <div class="grid grid-cols-3 gap-4 mb-5">
        <div>
            <label class="form-label text-center block">Kaybetti (M)</label>
            <input type="number" name="lost" min="0"
                   value="{{ old('lost', $standing->lost ?? 0) }}"
                   class="form-input text-center font-bold text-red-500">
        </div>
        <div>
            <label class="form-label text-center block">Attığı (A)</label>
            <input type="number" name="goals_for" min="0"
                   value="{{ old('goals_for', $standing->goals_for ?? 0) }}"
                   class="form-input text-center font-bold">
        </div>
        <div>
            <label class="form-label text-center block">Yediği (Y)</label>
            <input type="number" name="goals_against" min="0"
                   value="{{ old('goals_against', $standing->goals_against ?? 0) }}"
                   class="form-input text-center font-bold">
        </div>
    </div>

    <div class="mb-6">
        <label class="form-label text-center block">Puan (P)</label>
        <input type="number" name="points" min="0"
               value="{{ old('points', $standing->points ?? 0) }}"
               class="form-input text-center font-black text-2xl text-green-600">
    </div>

    <div class="flex items-center space-x-3 pt-4 border-t border-gray-100">
        <button type="submit" class="btn-primary">
            <i class="fas fa-save mr-2"></i>
            {{ $standing->exists ? 'Güncelle' : 'Kaydet' }}
        </button>
        <a href="{{ route('admin.branch.puan-durumu.index', $branch->id) }}"
           class="btn-secondary">İptal</a>
    </div>
</form>
</div>
</div>
@endsection