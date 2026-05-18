@extends('layouts.admin')
@section('title', $album->title . ' — Medyalar')
@section('page_title', $album->title)
@section('page_subtitle', 'Fotoğraf ve video yönetimi')

@section('content')

{{-- Breadcrumb --}}
<div class="flex items-center space-x-2 text-sm text-gray-400 mb-6">
    <a href="{{ route('admin.galeri.index') }}" class="hover:text-green-600">Galeri</a>
    <i class="fas fa-chevron-right text-xs"></i>
    <span class="text-gray-900 font-semibold">{{ $album->title }}</span>
</div>

{{-- Toplu Yükleme --}}
<div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
    <h3 class="font-bold text-gray-800 mb-4 flex items-center">
        <i class="fas fa-cloud-upload-alt text-green-500 mr-2"></i>
        Toplu Fotoğraf Yükle
    </h3>
    <form method="POST"
          action="{{ route('admin.galeri.medya.bulk', $album->id) }}"
          enctype="multipart/form-data">
        @csrf
        <div class="flex items-center space-x-4">
            <input type="file" name="files[]" multiple
                   accept="image/*" class="form-input flex-1"
                   id="bulk-upload">
            <button type="submit" class="btn-primary flex-shrink-0">
                <i class="fas fa-upload mr-2"></i> Yükle
            </button>
        </div>
        <p class="text-xs text-gray-400 mt-2">
            Birden fazla fotoğraf seçebilirsiniz. JPG, PNG, WEBP — Max 10MB/adet
        </p>
    </form>
</div>

{{-- Video Ekle --}}
<div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
    <h3 class="font-bold text-gray-800 mb-4 flex items-center">
        <i class="fab fa-youtube text-red-500 mr-2"></i>
        Video Ekle (YouTube / Vimeo)
    </h3>
    <form method="POST"
          action="{{ route('admin.galeri.medya.store', $album->id) }}"
          enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="type" value="video">
        <div class="flex items-center space-x-4">
            <input type="url" name="video_url"
                   placeholder="https://youtube.com/watch?v=..."
                   class="form-input flex-1">
            <button type="submit" class="btn-primary flex-shrink-0">
                <i class="fas fa-plus mr-2"></i> Ekle
            </button>
        </div>
    </form>
</div>

{{-- Medya Grid --}}
<div class="bg-white rounded-2xl shadow-sm p-6">
    <div class="flex items-center justify-between mb-5">
        <h3 class="font-bold text-gray-800">
            Medyalar
            <span class="text-gray-400 font-normal text-sm ml-2">
                ({{ $media->count() }} öğe)
            </span>
        </h3>
    </div>

    @if($media->count())
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
        @foreach($media as $item)
        <div class="relative group rounded-xl overflow-hidden bg-gray-100 aspect-square">

            @if($item->type === 'image')
            <img src="{{ asset('storage/' . $item->file_path) }}"
                 class="w-full h-full object-cover">
            @else
            <div class="w-full h-full flex items-center justify-center bg-gray-900">
                <i class="fab fa-youtube text-red-500 text-4xl"></i>
            </div>
            @endif

            {{-- Üzerine gelince sil butonu --}}
            <div class="absolute inset-0 bg-black/50 opacity-0
                        group-hover:opacity-100 transition duration-200
                        flex items-center justify-center">
                <form method="POST"
                      action="{{ route('admin.galeri.medya.destroy', [$album->id, $item->id]) }}"
                      onsubmit="return confirm('Bu medyayı silmek istediğine emin misin?')">
                    @csrf @method('DELETE')
                    <button class="bg-red-600 hover:bg-red-700 text-white
                                   w-10 h-10 rounded-full flex items-center
                                   justify-center transition duration-200">
                        <i class="fas fa-trash text-sm"></i>
                    </button>
                </form>
            </div>

            {{-- Tür rozeti --}}
            <div class="absolute top-2 left-2">
                @if($item->type === 'video')
                <span class="bg-red-500 text-white text-[9px] font-bold
                             px-2 py-0.5 rounded-full">VIDEO</span>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-16">
        <i class="fas fa-images text-5xl text-gray-200 mb-4 block"></i>
        <p class="text-gray-400 text-sm">
            Henüz medya yüklenmemiş. Yukarıdan fotoğraf veya video ekleyin.
        </p>
    </div>
    @endif
</div>

@endsection