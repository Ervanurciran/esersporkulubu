@extends('layouts.app')
@section('title', 'Tarihçe — Eser Spor Kulübü')

@section('content')

{{-- Sayfa Başlığı --}}
<section class="py-16 relative overflow-hidden"
         style="background: linear-gradient(135deg, #052e16, #111827)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <span class="text-green-400 text-xs font-bold uppercase tracking-[0.3em]">
            Hakkımızda
        </span>
        <h1 class="text-4xl font-black text-white mt-2" style="letter-spacing:-1px">
            Tarihçe
        </h1>
    </div>
</section>

{{-- İçerik --}}
<section class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        @if($page && $page->content)
            <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
                {!! nl2br(e($page->content)) !!}
            </div>
        @else
            <div class="text-center py-20">
                <i class="fas fa-history text-6xl text-gray-200 mb-4 block"></i>
                <p class="text-gray-400">Henüz tarihçe bilgisi eklenmemiş.</p>
            </div>
        @endif

    </div>
</section>

@endsection