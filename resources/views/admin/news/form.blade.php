@extends('layouts.admin')
@section('title', $news->exists ? 'Düzenle' : 'Yeni Ekle')
@section('page_title', $news->exists ? 'İçerik Düzenle' : 'Yeni İçerik Ekle')
@section('page_subtitle', 'İçerik detaylarını yönetin')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-2xl shadow-sm p-8">

        <form method="POST" 
              action="{{ $news->exists 
                ? route('admin.news.update', $news->id) 
                : route('admin.news.store') }}" 
              enctype="multipart/form-data">
            @csrf
            @if($news->exists) @method('PUT') @endif

            {{-- Tür Bilgisini Otomatik Gönderen Gizli Alan --}}
            <input type="hidden" name="type" value="{{ request()->get('type', $news->type ?? 'haber') }}">

            {{-- Kapak Görseli --}}
            <div class="mb-6">
                <label class="form-label font-semibold text-gray-700">Kapak Görseli</label>
                @if($news->exists && $news->cover_image)
                <div class="mb-3">
                    <img src="{{ $news->cover_image_url }}" 
                         class="w-full h-48 object-cover rounded-xl border border-gray-200" 
                         id="preview-img">
                </div>
                @else
                <div class="mb-3 hidden" id="preview-wrap">
                    <img src="" class="w-full h-48 object-cover rounded-xl border border-gray-200" 
                         id="preview-img">
                </div>
                @endif
                <input type="file" name="cover_image" accept="image/*" 
                       class="form-input" onchange="previewImage(this)">
                <p class="text-xs text-gray-400 mt-1">JPG, PNG, WEBP — Max 4MB</p>
            </div>

            {{-- Başlık --}}
            <div class="mb-5">
                <label class="form-label font-semibold text-gray-700">Başlık <span class="text-red-500">*</span></label>
                <input type="text" name="title" 
                       value="{{ old('title', $news->title) }}" 
                       placeholder="Başlık yazın..." 
                       class="form-input">
                @error('title') <p class="form-error text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Yayın Tarihi --}}
            <div class="mb-5">
                <label class="form-label font-semibold text-gray-700">Yayın Tarihi</label>
                <input type="datetime-local" name="published_at" 
                       value="{{ old('published_at', $news->published_at?->format('Y-m-d\TH:i')) }}" 
                       class="form-input">
            </div>

            {{-- Kısa Açıklama --}}
            <div class="mb-5">
                <label class="form-label font-semibold text-gray-700">Kısa Açıklama (Özet)</label>
                <textarea name="excerpt" rows="2" class="form-input" 
                          placeholder="Liste sayfasında görünecek kısa açıklama...">{{ old('excerpt', $news->excerpt) }}</textarea>
                @error('excerpt') <p class="form-error text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- İçerik --}}
            <div class="mb-6">
                <label class="form-label font-semibold text-gray-700">Detaylı İçerik <span class="text-red-500">*</span></label>
                <textarea name="content" id="content" rows="15" 
                          class="form-input">{{ old('content', $news->content) }}</textarea>
                @error('content') <p class="form-error text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Yayın Durumu --}}
            <div class="flex items-center mb-6 p-4 bg-gray-50 rounded-xl border border-gray-100">
                <div class="flex items-center h-5">
                    <input type="checkbox" name="is_published" id="is_published" 
                           value="1" 
                           {{ old('is_published', $news->is_published) ? 'checked' : '' }}
                           class="w-5 h-5 text-green-600 rounded border-gray-300 focus:ring-green-500">
                </div>
                <div class="ml-3 text-sm">
                    <label for="is_published" class="font-bold text-gray-700">Hemen Yayınla</label>
                    <p class="text-gray-500">İşaretlenmezse içerik "Taslak" olarak kaydedilir.</p>
                </div>
            </div>

            {{-- Butonlar --}}
            <div class="flex items-center justify-between space-x-3 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.news.index') }}" class="text-gray-500 hover:text-gray-700 font-medium">
                    <i class="fas fa-arrow-left mr-1"></i> Vazgeç ve Dön
                </a>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-xl font-bold transition flex items-center shadow-lg shadow-green-100">
                    <i class="fas fa-save mr-2"></i>
                    {{ $news->exists ? 'Değişiklikleri Kaydet' : 'Kaydet ve Yayınla' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css">
<style>
    .form-input {
        width: 100%;
        border-radius: 0.75rem;
        border: 1px solid #e5e7eb;
        padding: 0.75rem 1rem;
        margin-top: 0.25rem;
    }
    .form-input:focus {
        outline: none;
        border-color: #10b981;
        box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.1);
    }
    .form-label {
        display: block;
        font-size: 0.875rem;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>
<script>
    // Markdown Editör
    const easyMDE = new EasyMDE({
        element: document.getElementById('content'),
        spellChecker: false,
        toolbar: [
            'bold', 'italic', 'heading', '|', 
            'quote', 'unordered-list', 'ordered-list', '|', 
            'link', 'image', '|', 
            'preview', 'side-by-side', 'fullscreen'
        ],
        placeholder: 'İçeriği buraya yazın...',
    });

    // Görsel Önizleme
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