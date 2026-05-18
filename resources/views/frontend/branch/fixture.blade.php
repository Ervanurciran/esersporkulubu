@extends('layouts.app')
@section('title', $branch->name . ' Fikstür — Eser Spor')

@section('content')

<section class="py-16"
         style="background: linear-gradient(135deg, #052e16, #111827)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center space-x-4 mb-8">
            <span class="text-4xl">{{ $branch->icon }}</span>
            <div>
                <span class="text-green-400 text-xs font-bold uppercase tracking-[0.3em]">
                    {{ $branch->name }}
                </span>
                <h1 class="text-4xl font-black text-white mt-1">Fikstür</h1>
            </div>
        </div>
        <div class="flex flex-wrap gap-2">
    <a href="{{ route('branch.show', $branch->slug) }}" class="branch-tab">
        <i class="fas fa-home text-xs mr-1.5"></i>Genel
    </a>
    <a href="{{ route('branch.fixture', $branch->slug) }}" class="branch-tab branch-tab-active">
        <i class="fas fa-calendar-alt text-xs mr-1.5"></i>Fikstür
    </a>
    <a href="{{ route('branch.results', $branch->slug) }}" class="branch-tab">
        <i class="fas fa-flag-checkered text-xs mr-1.5"></i>Sonuçlar
    </a>
    <a href="{{ route('branch.standings', $branch->slug) }}" class="branch-tab">
        <i class="fas fa-table text-xs mr-1.5"></i>Puan Durumu
    </a>
    <a href="{{ route('branch.coaches', $branch->slug) }}" class="branch-tab">
        <i class="fas fa-whistle text-xs mr-1.5"></i>Antrenörler
    </a>
</div>
</section>

<section class="py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="space-y-4">
            @forelse($fixtures as $fixture)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="flex items-center justify-between px-6 py-3
                            border-b border-gray-50 bg-gray-50">
                    <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">
                        {{ $fixture->competition }}
                    </span>
                    <div class="flex items-center space-x-3">
                        <span class="text-xs text-gray-400">
                            {{ $fixture->match_date->format('d M Y · H:i') }}
                        </span>
                        @if($fixture->status === 'live')
                        <span class="bg-red-500 text-white text-[10px] font-black
                                     px-2 py-0.5 rounded-full animate-pulse">
                            CANLI
                        </span>
                        @elseif($fixture->status === 'completed')
                        <span class="badge-success text-[10px]">Tamamlandı</span>
                        @else
                        <span class="badge-info text-[10px]">Yaklaşan</span>
                        @endif
                    </div>
                </div>
                <div class="flex items-center px-6 py-5">
                    <span class="text-gray-900 font-bold flex-1 text-right pr-6">
                        {{ $fixture->home_team }}
                    </span>
                    <div class="bg-gray-900 text-gray-400 font-black text-sm
                                px-6 py-3 rounded-xl tracking-widest">
                        VS
                    </div>
                    <span class="text-gray-900 font-bold flex-1 pl-6">
                        {{ $fixture->away_team }}
                    </span>
                </div>
                @if($fixture->venue)
                <div class="px-6 pb-4 text-center">
                    <span class="text-gray-400 text-xs">
                        <i class="fas fa-map-marker-alt text-red-400 mr-1"></i>
                        {{ $fixture->venue }}
                    </span>
                </div>
                @endif
            </div>
            @empty
            <div class="text-center py-20">
                <i class="fas fa-calendar text-6xl text-gray-200 mb-4 block"></i>
                <p class="text-gray-400">Henüz fikstür girilmemiş.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
.branch-tab {
    display: inline-flex;
    align-items: center;
    padding: 10px 20px;
    border-radius: 50px;
    font-size: 13px;
    font-weight: 700;
    color: rgba(255,255,255,0.65);
    background: rgba(255,255,255,0.07);
    border: 1px solid rgba(255,255,255,0.12);
    transition: all 0.2s;
    text-decoration: none;
}
.branch-tab:hover {
    color: #fff;
    background: rgba(255,255,255,0.15);
    border-color: rgba(255,255,255,0.25);
}
.branch-tab-active {
    color: #fff !important;
    background: #16a34a !important;
    border-color: #16a34a !important;
    box-shadow: 0 0 20px rgba(22,163,74,0.4);
}
</style>
@endpush