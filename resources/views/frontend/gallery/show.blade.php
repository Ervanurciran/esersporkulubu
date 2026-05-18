@extends('layouts.app')
@section('title', $album->title . ' — Galeri')

@section('content')

<section class="py-16"
         style="background: linear-gradient(135deg, #052e16, #111827)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('gallery.index') }}"
           class="inline-flex items-center space-x-2 text-green-400
                  hover:text-green-300 text-sm font-semibold mb-6 transition">
            <i class="fas fa-arrow-left text-xs"></i>
            <span>Tüm Albümler</span>
        </a>
        <h1 class="text-4xl font-black text-white">{{ $album->title }}</h1>
        @if($album->event_date)
        <p class="text-gray-400 mt-2">
            <i class="far fa-calendar mr-1"></i>
            {{ $album->event_date->format('d M Y') }}
        </p>
        @endif
    </div>
</section>

<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if($media->count())
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4"
             x-data="{ lightbox: null }">

            @foreach($media as $item)
            @if($item->type === 'image')
            <div class="relative overflow-hidden rounded-2xl cursor-pointer
                        aspect-square bg-gray-200 group"
                 @click="lightbox = '{{ asset('storage/' . $item->file_path) }}'">
                <img src="{{ asset('storage/' . $item->file_path) }}"
                     alt="{{ $item->title }}"
                     class="w-full h-full object-cover
                            group-hover:scale-110 transition-transform duration-500">
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20
                            transition duration-300 flex items-center justify-center">
                    <i class="fas fa-expand text-white opacity-0
                              group-hover:opacity-100 transition duration-300 text-xl"></i>
                </div>
            </div>
            @else
            <div class="relative overflow-hidden rounded-2xl aspect-square
                        bg-gray-900 flex items-center justify-center">
                <a href="{{ $item->video_url }}" target="_blank"
                   class="flex flex-col items-center space-y-2">
                    <i class="fab fa-youtube text-red-500 text-4xl"></i>
                    <span class="text-white text-xs font-semibold">Video</span>
                </a>
            </div>
            @endif
            @endforeach

            {{-- Lightbox --}}
            <div x-show="lightbox"
                 @click="lightbox = null"
                 @keydown.escape.window="lightbox = null"
                 class="fixed inset-0 z-50 flex items-center justify-center
                        bg-black/90 cursor-zoom-out"
                 style="display: none">
                <img :src="lightbox" class="max-w-5xl max-h-[90vh]
                                            object-contain rounded-2xl
                                            shadow-2xl">
                <button @click="lightbox = null"
                        class="absolute top-6 right-6 text-white hover:text-gray-300
                               transition w-10 h-10 rounded-full bg-white/10
                               flex items-center justify-center">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
        </div>
        @else
        <div class="text-center py-20">
            <i class="fas fa-images text-6xl text-gray-200 mb-4 block"></i>
            <p class="text-gray-400">Bu albümde henüz medya yok.</p>
        </div>
        @endif

    </div>
</section>

@endsection