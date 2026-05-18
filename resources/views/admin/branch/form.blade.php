@extends('layouts.admin')
@section('title', $branch->exists ? 'Branş Düzenle' : 'Yeni Branş')
@section('page_title', $branch->exists ? 'Branş Düzenle' : 'Yeni Branş Ekle')

@section('content')
<div class="max-w-2xl">
<div class="bg-white rounded-2xl shadow-sm p-8">

<form method="POST"
      action="{{ $branch->exists
        ? route('admin.branslar.update', $branch->id)
        : route('admin.branslar.store') }}"
      enctype="multipart/form-data">
    @csrf
    @if($branch->exists) @method('PUT') @endif

{{-- Kapak Görseli --}}
<div class="mb-6">
    <label class="form-label">Kapak Görseli</label>

    @if($branch->exists && $branch->cover_image)
    <div class="mb-3">
        <img src="{{ asset('storage/' . $branch->cover_image) }}"
             class="w-full h-36 object-cover rounded-xl border border-gray-200"
             id="preview-img">
    </div>

    {{-- Kaldır butonu --}}
    <div class="mb-3">
        <a href="{{ route('admin.branslar.cover.remove', $branch->id) }}"
           onclick="return confirm('Kapak görseli kaldırılacak. Emin misin?')"
           class="inline-flex items-center space-x-2 text-xs font-semibold
                  text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100
                  px-4 py-2 rounded-lg transition duration-200 border border-red-200">
            <i class="fas fa-trash"></i>
            <span>Kapak Görselini Kaldır</span>
        </a>
    </div>
    @else
    <div class="mb-3 hidden" id="preview-wrap">
        <img src="" class="w-full h-36 object-cover rounded-xl border border-gray-200"
             id="preview-img">
    </div>
    @endif

    <input type="file" name="cover_image" accept="image/*"
           class="form-input" onchange="previewImage(this)">
    <p class="text-xs text-gray-400 mt-1">JPG, PNG, WEBP — Max 4MB</p>
</div>

    {{-- Ad --}}
    <div class="mb-5">
        <label class="form-label">Branş Adı <span class="text-red-500">*</span></label>
        <input type="text" name="name"
               value="{{ old('name', $branch->name) }}"
               placeholder="Örn: Futbol"
               class="form-input">
        @error('name') <p class="form-error">{{ $message }}</p> @enderror
    </div>

    {{-- Slug --}}
    <div class="mb-5">
        <label class="form-label">Slug (URL)</label>
        <input type="text" name="slug"
               value="{{ old('slug', $branch->slug) }}"
               placeholder="Örn: futbol"
               class="form-input font-mono">
        @error('slug') <p class="form-error">{{ $message }}</p> @enderror
        <p class="text-xs text-gray-400 mt-1">
            Boş bırakırsanız otomatik oluşturulur.
        </p>
    </div>

    {{-- İkon --}}
    <div class="mb-5">
        <label class="form-label">İkon (Emoji)</label>
        <input type="text" name="icon"
               value="{{ old('icon', $branch->icon) }}"
               placeholder="Örn: ⚽"
               class="form-input text-2xl w-24">
    </div>

    {{-- Açıklama --}}
    <div class="mb-5">
        <label class="form-label">Açıklama</label>
        <textarea name="description" rows="3" class="form-input"
                  placeholder="Branş hakkında kısa açıklama...">{{ old('description', $branch->description) }}</textarea>
    </div>

    {{-- Sıra & Aktif --}}
    <div class="grid grid-cols-2 gap-4 mb-6">
        <div>
            <label class="form-label">Sıralama</label>
            <input type="number" name="sort_order" min="0"
                   value="{{ old('sort_order', $branch->sort_order ?? 0) }}"
                   class="form-input">
        </div>
        <div class="flex items-center pt-7">
            <input type="checkbox" name="is_active" id="is_active" value="1"
                   {{ old('is_active', $branch->is_active ?? true) ? 'checked' : '' }}
                   class="w-4 h-4 text-green-600 rounded border-gray-300">
            <label for="is_active" class="ml-2 text-sm font-medium text-gray-700">
                Aktif
            </label>
        </div>
    </div>

    <div class="flex items-center space-x-3 pt-4 border-t border-gray-100">
        <button type="submit" class="btn-primary">
            <i class="fas fa-save mr-2"></i>
            {{ $branch->exists ? 'Güncelle' : 'Kaydet' }}
        </button>
        <a href="{{ route('admin.branslar.index') }}" class="btn-secondary">
            İptal
        </a>
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