@extends('layouts.admin')
@section('title', $page->title . ' Düzenle')
@section('page_title', $page->title . ' Düzenle')
@section('page_subtitle', 'İçeriği güncelleyin')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-2xl shadow-sm p-8">

        <form method="POST"
              action="{{ $page->key === 'tarihce'
                ? route('admin.about.history.update')
                : route('admin.about.mission.update') }}">
            @csrf @method('PUT')

            <div class="mb-6">
                <label class="form-label">İçerik</label>
                <textarea name="content" id="content" rows="18"
                          class="form-input font-mono text-sm"
                          placeholder="İçeriği buraya yazın...">{{ old('content', $page->content) }}</textarea>
                @error('content')
                <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center space-x-3 pt-4 border-t border-gray-100">
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save mr-2"></i> Kaydet
                </button>
                <a href="{{ route('admin.about.index') }}" class="btn-secondary">
                    Geri Dön
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
    const easyMDE = new EasyMDE({
        element: document.getElementById('content'),
        spellChecker: false,
        autosave: { enabled: true, uniqueId: 'about-{{ $page->key }}' },
        toolbar: [
            'bold', 'italic', 'heading', '|',
            'quote', 'unordered-list', 'ordered-list', '|',
            'link', '|', 'preview', 'side-by-side', 'fullscreen', '|',
            'guide'
        ],
        placeholder: 'İçeriği buraya yazın...',
    });
</script>
@endpush