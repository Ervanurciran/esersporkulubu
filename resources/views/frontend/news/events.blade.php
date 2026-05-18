@extends('layouts.app')
@section('title', 'Etkinlikler — Eser Spor Kulübü')

@section('content')

<section class="py-16"
         style="background: linear-gradient(135deg, #052e16, #111827)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="text-green-400 text-xs font-bold uppercase tracking-[0.3em]">
            Haberler
        </span>
        <h1 class="text-4xl font-black text-white mt-2">Etkinlikler</h1>
    </div>
</section>

<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($news as $event)
                @include('frontend.news._card', ['item' => $event])
            @empty
            <div class="col-span-3 text-center py-20">
                <i class="fas fa-calendar text-6xl text-gray-200 mb-4 block"></i>
                <p class="text-gray-400">Henüz etkinlik eklenmemiş.</p>
            </div>
            @endforelse
        </div>
        @if($news->hasPages())
        <div class="mt-10">{{ $news->links() }}</div>
        @endif
    </div>
</section>

@endsection