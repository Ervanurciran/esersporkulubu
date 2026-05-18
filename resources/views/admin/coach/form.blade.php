@extends('layouts.admin')
@section('title', $coach->exists ? 'Antrenör Düzenle' : 'Antrenör Ekle')
@section('page_title', $coach->exists ? 'Antrenör Düzenle' : 'Antrenör Ekle')
@section('page_subtitle', $branch->name . ' branşı')

@section('content')
<div class="max-w-2xl">
<div class="bg-white rounded-2xl shadow-sm p-8">

<form method="POST"
      action="{{ $coach->exists
        ? route('admin.branch.antrenorler.update', [$branch->id, $coach->id])
        : route('admin.branch.antrenorler.store', $branch->id) }}"
      enctype="multipart/form-data">
    @csrf
    @if($coach->exists) @method('PUT') @endif

    {{-- Fotoğraf --}}
    <div class="mb-6">
        <label class="form-label">Fotoğraf</label>
        @if($coach->exists && $coach->photo)
        <div class="mb-3">
            <img src="{{ $coach->photo_url }}"
                 class="w-24 h-24 object-cover rounded-2xl border border-gray-200"
                 id="preview-img">
        </div>
        @else
        <div class="mb-3 hidden" id="preview-wrap">
            <img src="" class="w-24 h-24 object-cover rounded-2xl"
                 id="preview-img">
        </div>
        @endif
        <input type="file" name="photo" accept="image/*"
               class="form-input" onchange="previewImage(this)">
    </div>

    <div class="mb-5">
        <label class="form-label">Ad Soyad <span class="text-red-500">*</span></label>
        <input type="text" name="name"
               value="{{ old('name', $coach->name) }}"
               class="form-input">
        @error('name') <p class="form-error">{{ $message }}</p> @enderror
    </div>

    <div class="mb-5">
        <label class="form-label">Ünvan <span class="text-red-500">*</span></label>
        <input type="text" name="title"
               value="{{ old('title', $coach->title) }}"
               placeholder="Örn: Baş Antrenör"
               class="form-input">
        @error('title') <p class="form-error">{{ $message }}</p> @enderror
    </div>

    <div class="mb-5">
        <label class="form-label">Biyografi</label>
        <textarea name="bio" rows="4" class="form-input">{{ old('bio', $coach->bio) }}</textarea>
    </div>

    <div class="grid grid-cols-2 gap-4 mb-6">
        <div>
            <label class="form-label">Sıralama</label>
            <input type="number" name="sort_order" min="0"
                   value="{{ old('sort_order', $coach->sort_order ?? 0) }}"
                   class="form-input">
        </div>
        <div class="flex items-center pt-7">
            <input type="checkbox" name="is_active" id="is_active" value="1"
                   {{ old('is_active', $coach->is_active ?? true) ? 'checked' : '' }}
                   class="w-4 h-4 text-green-600 rounded border-gray-300">
            <label for="is_active" class="ml-2 text-sm font-medium text-gray-700">
                Aktif
            </label>
        </div>
    </div>

    <div class="flex items-center space-x-3 pt-4 border-t border-gray-100">
        <button type="submit" class="btn-primary">
            <i class="fas fa-save mr-2"></i>
            {{ $coach->exists ? 'Güncelle' : 'Kaydet' }}
        </button>
        <a href="{{ route('admin.branch.antrenorler.index', $branch->id) }}"
           class="btn-secondary">İptal</a>
    </div>
</form>
</div>
</div>
@endsection

@push('scripts')
<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.getElementById('preview-img');
            const wrap = document.getElementById('preview-wrap');
            img.src = e.target.result;
            if (wrap) wrap.classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush