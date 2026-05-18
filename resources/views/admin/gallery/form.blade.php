@extends('layouts.admin')
@section('title', isset($galeri) ? 'Albüm Düzenle' : 'Yeni Albüm')
@section('page_title', isset($galeri) ? 'Albüm Düzenle' : 'Yeni Albüm Oluştur')
@section('page_subtitle', 'Galeri albümü')

@section('content')
<div class="max-w-2xl">
<div class="bg-white rounded-2xl shadow-sm p-8">

@php $album = $galeri ?? new \App\Models\GalleryAlbum(); @endphp

<form method="POST"
      action="{{ $album->exists
        ? route('admin.galeri.update', $album->id)
        : route('admin.galeri.store') }}"
      enctype="multipart/form-data">
    @csrf
    @if($album->exists) @method('PUT') @endif

    {{-- Kapak --}}
    <div class="mb-6">
        <label class="form-label">Kapak Görseli</label>
        @if($album->exists && $album->cover_image)
        <div class="mb-3">
            <img src="{{ asset('storage/' . $album->cover_image) }}"
                 class="w-full h-40 object-cover rounded-xl border border-gray-200"
                 id="preview-img">
        </div>
        @else
        <div class="mb-3 hidden" id="preview-wrap">
            <img src="" class="w-full h-40 object-cover rounded-xl border border-gray-200"
                 id="preview-img">
        </div>
        @endif
        <input type="file" name="cover_image" accept="image/*"
               class="form-input" onchange="previewImage(this)">
    </div>

    {{-- Başlık --}}
    <div class="mb-5">
        <label class="form-label">Albüm Adı <span class="text-red-500">*</span></label>
        <input type="text" name="title"
               value="{{ old('title', $album->title) }}"
               placeholder="Örn: 2024 Şampiyonluk Kupası"
               class="form-input">
        @error('title') <p class="form-error">{{ $message }}</p> @enderror
    </div>

    {{-- Açıklama --}}
    <div class="mb-5">
        <label class="form-label">Açıklama</label>
        <textarea name="description" rows="3" class="form-input"
                  placeholder="Albüm hakkında kısa açıklama...">{{ old('description', $album->description) }}</textarea>
    </div>

    {{-- Etkinlik Tarihi & Aktif --}}
    <div class="grid grid-cols-2 gap-4 mb-6">
        <div>
            <label class="form-label">Etkinlik Tarihi</label>
            <input type="date" name="event_date"
                   value="{{ old('event_date', $album->event_date?->format('Y-m-d')) }}"
                   class="form-input">
        </div>
        <div class="flex items-center pt-7">
            <input type="checkbox" name="is_active" id="is_active"
                   value="1"
                   {{ old('is_active', $album->is_active ?? true) ? 'checked' : '' }}
                   class="w-4 h-4 text-green-600 rounded border-gray-300">
            <label for="is_active" class="ml-2 text-sm font-medium text-gray-700">
                Aktif
            </label>
        </div>
    </div>

    <div class="flex items-center space-x-3 pt-4 border-t border-gray-100">
        <button type="submit" class="btn-primary">
            <i class="fas fa-save mr-2"></i>
            {{ $album->exists ? 'Güncelle' : 'Oluştur' }}
        </button>
        @if($album->exists)
        <a href="{{ route('admin.galeri.medya.index', $album->id) }}"
           class="btn-secondary">
            <i class="fas fa-images mr-2"></i> Medyaları Yönet
        </a>
        @endif
        <a href="{{ route('admin.galeri.index') }}" class="btn-secondary">İptal</a>
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
            const img  = document.getElementById('preview-img');
            const wrap = document.getElementById('preview-wrap');
            img.src = e.target.result;
            if (wrap) wrap.classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush