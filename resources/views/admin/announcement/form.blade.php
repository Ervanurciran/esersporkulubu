@extends('layouts.admin')

@section('title', $announcement->exists ? 'Duyuru Düzenle' : 'Yeni Duyuru')
@section('page_title', $announcement->exists ? 'Duyuru Düzenle' : 'Yeni Duyuru Ekle')
@section('page_subtitle', 'Haber veya etkinlik ekleyin')

@section('content')
<div class="max-w-2xl">
<div class="bg-white rounded-2xl shadow-sm p-8">

<form method="POST"
      action="{{ $announcement->exists
        ? route('admin.announcement.update', $announcement->id)
        : route('admin.announcement.store') }}"
      enctype="multipart/form-data">
    @csrf
    @if($announcement->exists) @method('PUT') @endif

    {{-- Kapak Görseli --}}
    <div class="mb-6">
        <label class="form-label">Kapak Görseli</label>

        @if($announcement->exists && $announcement->cover_image)
        <div class="mb-3">
            <img src="{{ asset('storage/' . $announcement->cover_image) }}"
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
        <p class="text-xs text-gray-400 mt-1">
            JPG, PNG, WEBP — Max 4MB. Önerilen: 1200x630px
        </p>
    </div>

    {{-- Başlık --}}
    <div class="mb-5">
        <label class="form-label">Başlık <span class="text-red-500">*</span></label>
        <input type="text" name="title"
               value="{{ old('title', $announcement->title) }}"
               placeholder="Duyuru başlığı..."
               class="form-input">
        @error('title') <p class="form-error">{{ $message }}</p> @enderror
    </div>

    {{-- Tür & Yayın Tarihi --}}
    <div class="grid grid-cols-2 gap-4 mb-5">
        <div>
            <label class="form-label">Tür <span class="text-red-500">*</span></label>
            <select name="type" class="form-input">
                <option value="haber"
                    {{ old('type', $announcement->type) === 'haber' ? 'selected' : '' }}>
                    Haber
                </option>
                <option value="etkinlik"
                    {{ old('type', $announcement->type) === 'etkinlik' ? 'selected' : '' }}>
                    Etkinlik
                </option>
            </select>
        </div>
        <div>
            <label class="form-label">Yayın Tarihi</label>
            <input type="datetime-local" name="published_at"
                   value="{{ old('published_at', $announcement->published_at
                       ? \Carbon\Carbon::parse($announcement->published_at)->format('Y-m-d\TH:i')
                       : '') }}"
                   class="form-input">
        </div>
    </div>

    {{-- Kısa Açıklama --}}
    <div class="mb-5">
        <label class="form-label">Kısa Açıklama</label>
        <textarea name="excerpt" rows="2" class="form-input"
                  placeholder="Liste sayfasında görünecek kısa açıklama...">{{ old('excerpt', $announcement->excerpt) }}</textarea>
        @error('excerpt') <p class="form-error">{{ $message }}</p> @enderror
    </div>

    {{-- İçerik --}}
    <div class="mb-6">
        <label class="form-label">İçerik <span class="text-red-500">*</span></label>
        <textarea name="content" id="content" rows="15"
                  class="form-input">{{ old('content', $announcement->content) }}</textarea>
        @error('content') <p class="form-error">{{ $message }}</p> @enderror
    </div>

    {{-- Sıra & Aktif --}}
    <div class="grid grid-cols-2 gap-4 mb-6">
        <div class="flex items-center pt-2">
            <input type="checkbox" name="is_published" id="is_published"
                   value="1"
                   {{ old('is_published', $announcement->is_published ?? true) ? 'checked' : '' }}
                   class="w-4 h-4 text-green-600 rounded border-gray-300">
            <label for="is_published" class="ml-2 text-sm font-medium text-gray-700">
                Aktif
            </label>
        </div>
    </div>

    {{-- Butonlar --}}
    <div class="flex items-center space-x-3 pt-2 border-t border-gray-100">
        <button type="submit" class="btn-primary">
            <i class="fas fa-save mr-2"></i>
            {{ $announcement->exists ? 'Güncelle' : 'Kaydet' }}
        </button>
        <a href="{{ route('admin.announcement.index') }}" class="btn-secondary">
            İptal
        </a>
    </div>

</form>
</div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>
<script>
    var easyMDE = new EasyMDE({
        element: document.getElementById('content'),
        spellChecker: false,
        toolbar: [
            'bold', 'italic', 'heading', '|',
            'quote', 'unordered-list', 'ordered-list', '|',
            'link', 'image', '|',
            'preview', 'side-by-side', 'fullscreen', '|',
            'guide'
        ],
        placeholder: 'İçeriği buraya yazın...',
    });

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