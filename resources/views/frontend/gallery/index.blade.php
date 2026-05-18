@extends('layouts.app')
@section('title', 'Galeri — Eser Spor Kulübü')

@section('content')

<section class="py-16"
         style="background: linear-gradient(135deg, #052e16, #111827)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="text-green-400 text-xs font-bold uppercase tracking-[0.3em]">
            Anılar
        </span>
        <h1 class="text-4xl font-black text-white mt-2">Galeri</h1>
    </div>
</section>

<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($albums as $album)
            <a href="{{ route('gallery.show', $album->slug) }}"
               class="group bg-white rounded-3xl overflow-hidden shadow-sm
                      hover:shadow-xl transition-all duration-300
                      transform hover:-translate-y-1 border border-gray-100">

                <div class="relative overflow-hidden h-52">
                    @if($album->cover_image)
                    <img src="{{ asset('storage/' . $album->cover_image) }}"
                         alt="{{ $album->title }}"
                         class="w-full h-full object-cover
                                group-hover:scale-110 transition-transform duration-700">
                    @else
                    <div class="w-full h-full flex items-center justify-center"
                         style="background: linear-gradient(135deg, #064e3b, #111827)">
                        <i class="fas fa-images text-5xl text-white/10"></i>
                    </div>
                    @endif
                    <div class="absolute inset-0"
                         style="background: linear-gradient(to top, rgba(0,0,0,0.4), transparent)">
                    </div>
                    <div class="absolute bottom-4 right-4 bg-black/60 text-white
                                text-xs font-bold px-3 py-1.5 rounded-full backdrop-blur-sm">
                        <i class="fas fa-images mr-1"></i>
                        {{ $album->media_count ?? $album->media->count() }} öğe
                    </div>
                </div>

                <div class="p-5">
                    <h3 class="font-black text-gray-900 text-lg mb-1
                               group-hover:text-green-600 transition duration-200">
                        {{ $album->title }}
                    </h3>
                    @if($album->event_date)
                    <p class="text-gray-400 text-xs">
                        <i class="far fa-calendar mr-1"></i>
                        {{ $album->event_date->format('d M Y') }}
                    </p>
                    @endif
                </div>
            </a>
            @empty
            <div class="col-span-3 text-center py-20">
                <i class="fas fa-images text-6xl text-gray-200 mb-4 block"></i>
                <p class="text-gray-400">Henüz albüm eklenmemiş.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

@endsection