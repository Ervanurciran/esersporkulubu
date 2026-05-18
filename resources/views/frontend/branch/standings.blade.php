@extends('layouts.app')
@section('title', $branch->name . ' Puan Durumu — Eser Spor')

@section('content')

<section class="py-16" style="background: linear-gradient(135deg, #052e16, #111827)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center space-x-4 mb-8">
            <span class="text-4xl">{{ $branch->icon }}</span>
            <div>
                <span class="text-green-400 text-xs font-bold uppercase tracking-[0.3em]">{{ $branch->name }}</span>
                <h1 class="text-4xl font-black text-white mt-1">Puan Durumu</h1>
            </div>
        </div>
        <div class="flex flex-wrap gap-2">
    <a href="{{ route('branch.show', $branch->slug) }}" class="branch-tab">
        <i class="fas fa-home text-xs mr-1.5"></i>Genel
    </a>
    <a href="{{ route('branch.fixture', $branch->slug) }}" class="branch-tab">
        <i class="fas fa-calendar-alt text-xs mr-1.5"></i>Fikstür
    </a>
    <a href="{{ route('branch.results', $branch->slug) }}" class="branch-tab">
        <i class="fas fa-flag-checkered text-xs mr-1.5"></i>Sonuçlar
    </a>
    <a href="{{ route('branch.standings', $branch->slug) }}" class="branch-tab branch-tab-active">
        <i class="fas fa-table text-xs mr-1.5"></i>Puan Durumu
    </a>
    <a href="{{ route('branch.coaches', $branch->slug) }}" class="branch-tab">
        <i class="fas fa-whistle text-xs mr-1.5"></i>Antrenörler
    </a>
</div>
</section>

<section class="py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        @forelse($standings as $i => $row)
        @if($i === 0)
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
            <table class="w-full">
                <thead style="background: linear-gradient(135deg, #052e16, #111827)">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-400">#</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-400">Takım</th>
                        <th class="px-4 py-3 text-center text-xs font-bold text-gray-400">O</th>
                        <th class="px-4 py-3 text-center text-xs font-bold text-gray-400">G</th>
                        <th class="px-4 py-3 text-center text-xs font-bold text-gray-400">B</th>
                        <th class="px-4 py-3 text-center text-xs font-bold text-gray-400">M</th>
                        <th class="px-4 py-3 text-center text-xs font-bold text-gray-400">Av</th>
                        <th class="px-4 py-3 text-center text-xs font-bold text-green-400">P</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
        @endif

                    <tr class="{{ $i === 0 ? 'bg-green-50' : 'hover:bg-gray-50' }} transition">
                        <td class="px-4 py-3 text-center font-black text-gray-400 text-sm">
                            {{ $i + 1 }}
                        </td>
                        <td class="px-4 py-3 font-bold text-gray-900">{{ $row->team_name }}</td>
                        <td class="px-4 py-3 text-center text-sm text-gray-600">{{ $row->played }}</td>
                        <td class="px-4 py-3 text-center text-sm font-semibold text-green-600">{{ $row->won }}</td>
                        <td class="px-4 py-3 text-center text-sm text-gray-500">{{ $row->drawn }}</td>
                        <td class="px-4 py-3 text-center text-sm font-semibold text-red-500">{{ $row->lost }}</td>
                        <td class="px-4 py-3 text-center text-sm text-gray-500">
                            {{ $row->goal_diff >= 0 ? '+' : '' }}{{ $row->goal_diff }}
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span class="font-black text-xl text-gray-900">{{ $row->points }}</span>
                        </td>
                    </tr>

        @if($loop->last)
                </tbody>
            </table>
        </div>
        @endif

        @empty
        <div class="text-center py-20">
            <i class="fas fa-table text-6xl text-gray-200 mb-4 block"></i>
            <p class="text-gray-400">Henüz puan durumu girilmemiş.</p>
        </div>
        @endforelse

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