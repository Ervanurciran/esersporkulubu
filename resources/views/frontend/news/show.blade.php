@extends('layouts.app')
@section('title', $news->title . ' — Eser Spor')

@section('content')

<section class="relative py-24 overflow-hidden"
         style="background: linear-gradient(135deg, #052e16, #111827)">
    @if($news->cover_image)
    <div class="absolute inset-0 bg-cover bg-center opacity-20"
         style="background-image: url('{{ $news->cover_image_url }}')">
    </div>
    @endif
    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="inline-block text-white text-[10px] font-black
                     px-3 py-1.5 rounded-full uppercase tracking-wider mb-4
                     {{ $news->type === 'haber' ? 'bg-green-600' : 'bg-purple-600' }}">
            {{ ucfirst($news->type) }}
        </span>
        <h1 class="text-4xl md:text-5xl font-black text-white leading-tight"
            style="letter-spacing: -1px">
            {{ $news->title }}
        </h1>
        <p class="text-gray-400 mt-4">
            <i class="far fa-calendar mr-2"></i>
            {{ $news->published_at?->format('d M Y') }}
        </p>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
            {!! nl2br(e($news->content)) !!}
        </div>
        <div class="mt-12 pt-8 border-t border-gray-100">
            <a href="{{ url()->previous() }}"
               class="inline-flex items-center space-x-2
                      text-gray-600 hover:text-green-600
                      font-bold transition duration-200">
                <i class="fas fa-arrow-left text-sm"></i>
                <span>Geri Dön</span>
            </a>
        </div>
    </div>
</section>

@endsection