@extends('layouts.admin')

@section('title', $slider->exists ? 'Slider Düzenle' : 'Yeni Slider')
@section('page_title', $slider->exists ? 'Slider Düzenle' : 'Yeni Slider Ekle')
@section('page_subtitle', 'Ana sayfa slider görseli veya videosu')

@section('content')
<div class="max-w-2xl">
<div class="bg-white rounded-2xl shadow-sm p-8">

<form method="POST"
      action="{{ $slider->exists
        ? route('admin.slider.update', $slider->id)
        : route('admin.slider.store') }}"
      enctype="multipart/form-data"
      x-data="{ mediaType: '{{ old('media_type', $slider->media_type ?? 'image') }}' }">
    @csrf
    @if($slider->exists) @method('PUT') @endif

    {{-- Medya Türü Seçimi --}}
    <div class="mb-6">
        <label class="form-label">
            Medya Türü <span class="text-red-500">*</span>
        </label>
        <div class="grid grid-cols-2 gap-3">
            <label class="relative cursor-pointer">
                <input type="radio" name="media_type" value="image"
                       x-model="mediaType"
                       class="sr-only">
                <div :class="mediaType === 'image'
                             ? 'border-green-500 bg-green-50 text-green-700'
                             : 'border-gray-200 text-gray-500'"
                     class="border-2 rounded-xl p-4 text-center transition duration-200">
                    <i class="fas fa-image text-2xl mb-2 block"></i>
                    <span class="text-sm font-bold">Fotoğraf</span>
                </div>
            </label>
            <label class="relative cursor-pointer">
                <input type="radio" name="media_type" value="video"
                       x-model="mediaType"
                       class="sr-only">
                <div :class="mediaType === 'video'
                             ? 'border-green-500 bg-green-50 text-green-700'
                             : 'border-gray-200 text-gray-500'"
                     class="border-2 rounded-xl p-4 text-center transition duration-200">
                    <i class="fas fa-video text-2xl mb-2 block"></i>
                    <span class="text-sm font-bold">Video</span>
                </div>
            </label>
        </div>
    </div>

    {{-- FOTOĞRAF ALANI --}}
    <div x-show="mediaType === 'image'" class="mb-6">
        <label class="form-label">Fotoğraf</label>

        @if($slider->exists && $slider->image)
        <div class="mb-3">
            <img src="{{ $slider->image_url }}"
                 class="w-full h-40 object-cover rounded-xl border border-gray-200"
                 id="preview-img">
        </div>
        @else
        <div class="mb-3 hidden" id="preview-wrap">
            <img src="" class="w-full h-40 object-cover rounded-xl border border-gray-200"
                 id="preview-img">
        </div>
        @endif

        <input type="file" name="image" accept="image/*"
               class="form-input" onchange="previewImage(this)">
        <p class="text-xs text-gray-400 mt-1">
            JPG, PNG, WEBP — Max 4MB. Önerilen: 1920x900px
        </p>
    </div>

    {{-- VİDEO ALANI --}}
    <div x-show="mediaType === 'video'" class="mb-6 space-y-4">

        {{-- MP4 Yükle --}}
        <div>
            <label class="form-label">
                MP4 Video Yükle
            </label>
            @if($slider->exists && $slider->video_path)
            <div class="mb-3 p-3 bg-gray-50 rounded-xl border border-gray-200
                        flex items-center space-x-3">
                <i class="fas fa-file-video text-green-600 text-xl"></i>
                <span class="text-sm text-gray-600 font-medium">
                    Mevcut video yüklü
                </span>
                <a href="{{ $slider->video_path_url }}" target="_blank"
                   class="text-xs text-green-600 hover:text-green-700 font-semibold">
                    Görüntüle
                </a>
            </div>
            @endif
            <input type="file" name="video_path" accept="video/mp4,video/webm"
                   class="form-input">
            <p class="text-xs text-gray-400 mt-1">MP4, WEBM — Max 50MB</p>
        </div>

        {{-- Ayraç --}}
        <div class="flex items-center space-x-3">
            <div class="flex-1 h-px bg-gray-200"></div>
            <span class="text-xs text-gray-400 font-bold uppercase tracking-wider">
                veya
            </span>
            <div class="flex-1 h-px bg-gray-200"></div>
        </div>

        {{-- YouTube/Vimeo URL --}}
        <div>
            <label class="form-label">YouTube / Vimeo Linki</label>
            <input type="url" name="video_url"
                   value="{{ old('video_url', $slider->video_url) }}"
                   placeholder="https://youtube.com/watch?v=..."
                   class="form-input">
            <p class="text-xs text-gray-400 mt-1">
                YouTube veya Vimeo video linki yapıştırın.
            </p>

            {{-- Mevcut YouTube önizleme --}}
            @if($slider->exists && $slider->video_url && $slider->youtube_embed)
            <div class="mt-3 rounded-xl overflow-hidden border border-gray-200"
                 style="height: 200px">
                <iframe src="{{ $slider->youtube_embed }}"
                        class="w-full h-full"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                </iframe>
            </div>
            @endif
        </div>
    </div>

    {{-- Başlık --}}
    <div class="mb-5">
        <label class="form-label">Başlık</label>
        <input type="text" name="title"
               value="{{ old('title', $slider->title) }}"
               placeholder="Örn: Şampiyonluk Yolunda"
               class="form-input">
    </div>

    {{-- Alt Başlık --}}
    <div class="mb-5">
        <label class="form-label">Alt Başlık / Etiket</label>
        <input type="text" name="subtitle"
               value="{{ old('subtitle', $slider->subtitle) }}"
               placeholder="Örn: Sezon 2024-2025"
               class="form-input">
    </div>

    {{-- Buton --}}
    <div class="grid grid-cols-2 gap-4 mb-5">
        <div>
            <label class="form-label">Buton Metni</label>
            <input type="text" name="button_text"
                   value="{{ old('button_text', $slider->button_text) }}"
                   placeholder="Örn: Daha Fazla"
                   class="form-input">
        </div>
        <div>
            <label class="form-label">Buton Linki</label>
            <input type="text" name="button_url"
                   value="{{ old('button_url', $slider->button_url) }}"
                   placeholder="Örn: /branslar/futbol"
                   class="form-input">
        </div>
    </div>

    {{-- Sıra & Aktif --}}
    <div class="grid grid-cols-2 gap-4 mb-6">
        <div>
            <label class="form-label">Sıralama</label>
            <input type="number" name="sort_order"
                   value="{{ old('sort_order', $slider->sort_order ?? 0) }}"
                   min="0" class="form-input">
        </div>
        <div class="flex items-center pt-7">
            <input type="checkbox" name="is_active" id="is_active"
                   value="1"
                   {{ old('is_active', $slider->is_active ?? true) ? 'checked' : '' }}
                   class="w-4 h-4 text-green-600 rounded border-gray-300">
            <label for="is_active" class="ml-2 text-sm font-medium text-gray-700">
                Aktif
            </label>
        </div>
    </div>

    {{-- Butonlar --}}
    <div class="flex items-center space-x-3 pt-2 border-t border-gray-100">
        <button type="submit" class="btn-primary">
            <i class="fas fa-save mr-2"></i>
            {{ $slider->exists ? 'Güncelle' : 'Kaydet' }}
        </button>
        <a href="{{ route('admin.slider.index') }}" class="btn-secondary">
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