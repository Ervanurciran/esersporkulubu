@extends('layouts.app')

@section('title', $branch->name . ' — Eser Spor Kulübü')

@section('content')

{{-- HERO --}}
<section class="py-16 relative overflow-hidden"
         style="background: linear-gradient(135deg, #052e16, #111827)">

    {{-- Arka Plan Efekt --}}
    <div class="absolute right-0 top-0 w-96 h-96 rounded-full opacity-10"
         style="
            background: radial-gradient(circle, #16a34a, transparent);
            transform: translate(30%, -30%);
         ">
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        {{-- Başlık --}}
        <div class="flex items-center space-x-5 mb-10">

            <div class="w-16 h-16 rounded-2xl flex items-center justify-center
                        text-4xl bg-white/10 border border-white/20 backdrop-blur-sm">
                {{ $branch->icon }}
            </div>

            <div>
                <span class="text-green-400 text-xs font-black uppercase tracking-[0.4em]">
                    Branş
                </span>

                <h1 class="text-4xl md:text-5xl font-black text-white mt-1"
                    style="letter-spacing: -1px">
                    {{ $branch->name }}
                </h1>
            </div>

        </div>

        {{-- Sekmeler --}}
        <div class="flex flex-wrap gap-3">

            <a href="{{ route('branch.show', $branch->slug) }}"
               class="branch-tab {{ Route::currentRouteNamed('branch.show') ? 'branch-tab-active' : '' }}">
                <i class="fas fa-home text-xs mr-1.5"></i>
                Genel
            </a>

            <a href="{{ route('branch.fixture', $branch->slug) }}"
               class="branch-tab {{ Route::currentRouteNamed('branch.fixture') ? 'branch-tab-active' : '' }}">
                <i class="fas fa-calendar-alt text-xs mr-1.5"></i>
                Fikstür
            </a>

            <a href="{{ route('branch.results', $branch->slug) }}"
               class="branch-tab {{ Route::currentRouteNamed('branch.results') ? 'branch-tab-active' : '' }}">
                <i class="fas fa-flag-checkered text-xs mr-1.5"></i>
                Sonuçlar
            </a>

            <a href="{{ route('branch.standings', $branch->slug) }}"
               class="branch-tab {{ Route::currentRouteNamed('branch.standings') ? 'branch-tab-active' : '' }}">
                <i class="fas fa-table text-xs mr-1.5"></i>
                Puan Durumu
            </a>

            <a href="{{ route('branch.coaches', $branch->slug) }}"
               class="branch-tab {{ Route::currentRouteNamed('branch.coaches') ? 'branch-tab-active' : '' }}">
                <i class="fas fa-whistle text-xs mr-1.5"></i>
                Antrenörler
            </a>

        </div>

    </div>
</section>

{{-- CONTENT --}}
<section class="py-16 bg-gray-50">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Açıklama --}}
        @if($branch->description)
            <div class="max-w-3xl mb-14">
                <p class="text-gray-600 text-lg leading-relaxed">
                    {{ $branch->description }}
                </p>
            </div>
        @endif

        {{-- Sonuçlar --}}
        @if($latestResults->count())

            <div class="mb-14">

                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-black text-gray-900">
                        Son Maç Sonuçları
                    </h2>
                </div>

                <div class="space-y-4">

                    @foreach($latestResults as $result)

                        <div class="bg-white rounded-2xl px-6 py-5
                                    shadow-sm border border-gray-100
                                    hover:shadow-md transition">

                            <div class="flex items-center justify-between mb-3">

                                <span class="text-green-600 text-xs font-bold uppercase tracking-wider">
                                    {{ $result->competition }}
                                </span>

                                <span class="text-gray-400 text-xs">
                                    {{ $result->match_date->format('d.m.Y') }}
                                </span>

                            </div>

                            <div class="flex items-center">

                                <div class="flex-1 text-right pr-4">
                                    <span class="text-gray-900 font-bold">
                                        {{ $result->home_team }}
                                    </span>
                                </div>

                                <div class="bg-gray-900 text-white font-black text-lg
                                            px-5 py-2 rounded-xl min-w-[95px]
                                            text-center">
                                    {{ $result->home_score }}
                                    -
                                    {{ $result->away_score }}
                                </div>

                                <div class="flex-1 pl-4">
                                    <span class="text-gray-900 font-bold">
                                        {{ $result->away_team }}
                                    </span>
                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        @endif

        {{-- Teknik Kadro --}}
        @if($coaches->count())

            <div>

                <h2 class="text-2xl font-black text-gray-900 mb-6">
                    Teknik Kadro
                </h2>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">

                    @foreach($coaches as $coach)

                        <div class="bg-white rounded-2xl p-5 text-center
                                    shadow-sm border border-gray-100
                                    hover:shadow-md transition">

                            <div class="w-20 h-20 rounded-full overflow-hidden
                                        mx-auto mb-4 border-2 border-green-100">

                                @if($coach->photo)

                                    <img src="{{ $coach->photo_url }}"
                                         alt="{{ $coach->name }}"
                                         class="w-full h-full object-cover">

                                @else

                                    <div class="w-full h-full flex items-center justify-center
                                                bg-gradient-to-br from-green-600 to-green-800">

                                        <span class="text-white font-black text-2xl">
                                            {{ strtoupper(substr($coach->name, 0, 1)) }}
                                        </span>

                                    </div>

                                @endif

                            </div>

                            <p class="font-black text-gray-900 text-sm">
                                {{ $coach->name }}
                            </p>

                            <p class="text-green-600 text-xs font-semibold mt-1">
                                {{ $coach->title }}
                            </p>

                        </div>

                    @endforeach

                </div>

            </div>

        @endif

    </div>

</section>

@endsection

@push('styles')
<style>

.branch-tab{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    padding:11px 22px;
    border-radius:999px;
    font-size:13px;
    font-weight:700;
    color:rgba(255,255,255,.70);
    background:rgba(255,255,255,.07);
    border:1px solid rgba(255,255,255,.12);
    text-decoration:none;
    transition:all .25s ease;
    backdrop-filter:blur(8px);
}

.branch-tab:hover{
    color:#fff;
    background:rgba(255,255,255,.14);
    border-color:rgba(255,255,255,.24);
    transform:translateY(-1px);
}

.branch-tab-active{
    color:#fff !important;
    background:#16a34a !important;
    border-color:#16a34a !important;
    box-shadow:0 0 24px rgba(22,163,74,.35);
}

</style>
@endpush