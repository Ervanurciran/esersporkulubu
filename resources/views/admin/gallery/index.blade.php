@extends('layouts.admin')
@section('title', 'Galeri')
@section('page_title', 'Galeri Yönetimi')
@section('page_subtitle', 'Fotoğraf ve video albümlerini yönetin')

@section('content')

<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-500">
        Toplam <strong>{{ $albums->total() }}</strong> albüm
    </p>
    <a href="{{ route('admin.galeri.create') }}" class="btn-primary">
        <i class="fas fa-plus mr-2"></i> Yeni Albüm
    </a>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
    @forelse($albums as $album)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden
                hover:shadow-md transition duration-200">

        {{-- Kapak --}}
        <div class="relative h-40 bg-gray-100">
            @if($album->cover_image)
            <img src="{{ asset('storage/' . $album->cover_image) }}"
                 class="w-full h-full object-cover">
            @else
            <div class="w-full h-full flex items-center justify-center"
                 style="background: linear-gradient(135deg, #052e16, #111827)">
                <i class="fas fa-images text-3xl text-white/20"></i>
            </div>
            @endif

            {{-- Medya sayısı --}}
            <div class="absolute top-3 right-3 bg-black/60 text-white text-xs
                        font-bold px-2.5 py-1 rounded-full backdrop-blur-sm">
                <i class="fas fa-photo-video mr-1"></i>
                {{ $album->media_count }}
            </div>

            {{-- Durum --}}
            <div class="absolute top-3 left-3">
                @if($album->is_active)
                <span class="badge-success text-[10px]">Aktif</span>
                @else
                <span class="badge-danger text-[10px]">Pasif</span>
                @endif
            </div>
        </div>

        {{-- Bilgi --}}
        <div class="p-4">
            <h3 class="font-bold text-gray-900 text-sm truncate mb-1">
                {{ $album->title }}
            </h3>
            @if($album->event_date)
            <p class="text-gray-400 text-xs mb-3">
                <i class="far fa-calendar mr-1"></i>
                {{ $album->event_date->format('d.m.Y') }}
            </p>
            @endif

            <div class="flex items-center space-x-2">
                <a href="{{ route('admin.galeri.medya.index', $album->id) }}"
                   class="flex-1 text-center text-xs font-semibold text-green-600
                          bg-green-50 hover:bg-green-100 py-2 rounded-lg transition">
                    <i class="fas fa-images mr-1"></i> Medyalar
                </a>
                <a href="{{ route('admin.galeri.edit', $album->id) }}"
                   class="btn-icon text-blue-600 hover:bg-blue-50">
                    <i class="fas fa-edit text-sm"></i>
                </a>
                <form method="POST"
                      action="{{ route('admin.galeri.destroy', $album->id) }}"
                      onsubmit="return confirm('Albüm ve tüm medyalar silinecek!')">
                    @csrf @method('DELETE')
                    <button class="btn-icon text-red-500 hover:bg-red-50">
                        <i class="fas fa-trash text-sm"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-4 bg-white rounded-2xl p-16 text-center
                border border-dashed border-gray-200">
        <i class="fas fa-images text-5xl text-gray-200 mb-4 block"></i>
        <p class="text-gray-400 mb-4">Henüz albüm eklenmemiş.</p>
        <a href="{{ route('admin.galeri.create') }}" class="btn-primary">
            <i class="fas fa-plus mr-2"></i> Albüm Ekle
        </a>
    </div>
    @endforelse
</div>

@if($albums->hasPages())
<div class="mt-6">{{ $albums->links() }}</div>
@endif

@endsection