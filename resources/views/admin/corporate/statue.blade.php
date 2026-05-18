@extends('layouts.admin')
@section('title', 'Tüzük Yönetimi')
@section('page_title', 'Tüzük Yönetimi')
@section('page_subtitle', 'PDF yükleme ve içerik güncelleme')

@section('content')
<div class="max-w-2xl">
<div class="bg-white rounded-2xl shadow-sm p-8">

    {{-- Mevcut PDF --}}
    @if($page->file_path)
    <div class="mb-6 flex items-center space-x-4 p-4 bg-red-50
                border border-red-100 rounded-xl">
        <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center
                    justify-center flex-shrink-0">
            <i class="fas fa-file-pdf text-red-600"></i>
        </div>
        <div class="flex-1">
            <p class="font-semibold text-gray-800 text-sm">Mevcut PDF</p>
            <p class="text-gray-400 text-xs">Yeni PDF yüklerseniz eskisi silinir.</p>
        </div>
        <a href="{{ $page->file_url }}" target="_blank"
           class="text-xs font-semibold text-red-600 hover:text-red-700
                  flex items-center space-x-1">
            <i class="fas fa-eye"></i>
            <span>Görüntüle</span>
        </a>
    </div>
    @endif

    <form method="POST"
          action="{{ route('admin.corporate.statute.update') }}"
          enctype="multipart/form-data">
        @csrf @method('PUT')

        {{-- PDF Yükle --}}
        <div class="mb-6">
            <label class="form-label">PDF Dosyası</label>
            <input type="file" name="file_path" accept=".pdf" class="form-input">
            @error('file_path') <p class="form-error">{{ $message }}</p> @enderror
            <p class="text-xs text-gray-400 mt-1">Sadece PDF — Max 10MB</p>
        </div>

        {{-- İçerik --}}
        <div class="mb-6">
            <label class="form-label">Açıklama / Özet</label>
            <textarea name="content" rows="6" class="form-input"
                      placeholder="Tüzük hakkında kısa açıklama...">{{ old('content', $page->content) }}</textarea>
        </div>

        <div class="flex items-center space-x-3 pt-4 border-t border-gray-100">
            <button type="submit" class="btn-primary">
                <i class="fas fa-save mr-2"></i> Kaydet
            </button>
            <a href="{{ route('admin.corporate.index') }}" class="btn-secondary">
                Geri Dön
            </a>
        </div>
    </form>
</div>
</div>
@endsection