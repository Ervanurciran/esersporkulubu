@extends('layouts.app')
@section('title', 'Duyurular — Eser Spor Kulübü')

@section('content')

{{-- Galeri Sayfasındaki Modern Gradyanlı Başlık Yapısı --}}
<section class="py-16" 
         style="background: linear-gradient(135deg, #052e16, #111827)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="text-green-400 text-xs font-bold uppercase tracking-[0.3em]">
            Eser Spor'dan
        </span>
        <h1 class="text-4xl font-black text-white mt-2">Duyurular</h1>
    </div>
</section>

{{-- Duyuru Kartları Alanı --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            
            {{-- HATA DÜZELTİLDİ: $announcements (çoğul) olarak güncellendi --}}
            @forelse($announcements as $item)
                <article class="group bg-white rounded-3xl overflow-hidden shadow-sm 
                               hover:shadow-xl transition-all duration-300 
                               transform hover:-translate-y-1 border border-gray-100">
                    
                    <div class="p-8">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="bg-green-100 text-green-700 text-[10px] font-bold px-3 py-1 rounded-full uppercase">
                                Duyuru
                            </span>
                            <p class="text-gray-400 text-xs">
                                <i class="far fa-calendar mr-1"></i>
                                {{ $item->published_at }}
                            </p>
                        </div>
                        
                        <h3 class="font-black text-gray-900 text-xl mb-3 
                                   group-hover:text-green-600 transition duration-200 line-clamp-2">
                            {{ $item->title }}
                        </h3>
                        
                        <p class="text-gray-500 text-sm leading-relaxed mb-6 line-clamp-3">
                            {{ $item->excerpt ?? Str::limit(strip_tags($item->content), 120) }}
                        </p>

                        <a href="{{ route('announcement.show', $item->slug) }}" 
                           class="inline-flex items-center font-bold text-sm text-green-600 group/link">
                            DETAYLI OKU 
                            <i class="fas fa-arrow-right ml-2 transform group-hover/link:translate-x-2 transition-transform"></i>
                        </a>
                    </div>
                </article>
            @empty
                {{-- Boş durum tasarımı --}}
                <div class="col-span-1 sm:col-span-2 lg:col-span-3 text-center py-20">
                    <i class="fas fa-bullhorn text-6xl text-gray-200 mb-4 block"></i>
                    <p class="text-gray-400">Henüz yayınlanmış bir duyuru bulunamadı.</p>
                </div>
            @endforelse

        </div>

        @if($announcements->hasPages())
            <div class="mt-12 flex justify-center">
                {{ $announcements->links() }}
            </div>
        @endif
    </div>
</section>

@endsection