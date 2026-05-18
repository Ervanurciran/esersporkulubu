@extends('layouts.admin')
@section('title', $branch->name . ' — Sonuçlar')
@section('page_title', $branch->name . ' Maç Sonuçları')
@section('page_subtitle', 'Oynanan maçların sonuçlarını yönetin')

@section('content')

<div class="flex justify-between items-center mb-6">
    <p class="text-sm text-gray-500"><strong>{{ $results->count() }}</strong> sonuç</p>
    <a href="{{ route('admin.branch.sonuclar.create', $branch->id) }}" class="btn-primary">
        <i class="fas fa-plus mr-2"></i> Sonuç Ekle
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="th">Tarih</th>
                <th class="th">Ev Sahibi</th>
                <th class="th text-center">Skor</th>
                <th class="th">Deplasman</th>
                <th class="th">Müsabaka</th>
                <th class="th text-right">İşlem</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($results as $result)
            <tr class="hover:bg-gray-50 transition">
                <td class="td text-xs text-gray-500">
                    {{ $result->match_date->format('d.m.Y') }}
                </td>
                <td class="td font-semibold text-gray-800">{{ $result->home_team }}</td>
                <td class="td text-center">
                    <span class="inline-flex items-center space-x-1
                                 bg-gray-900 text-white font-black text-sm
                                 px-4 py-1.5 rounded-xl">
                        <span>{{ $result->home_score }}</span>
                        <span class="text-gray-500">–</span>
                        <span>{{ $result->away_score }}</span>
                    </span>
                </td>
                <td class="td font-semibold text-gray-800">{{ $result->away_team }}</td>
                <td class="td text-gray-500 text-sm">{{ $result->competition ?? '—' }}</td>
                <td class="td text-right">
                    <div class="flex items-center justify-end space-x-2">
                        <a href="{{ route('admin.branch.sonuclar.edit', [$branch->id, $result->id]) }}"
                           class="btn-icon text-blue-600 hover:bg-blue-50">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form method="POST"
                              action="{{ route('admin.branch.sonuclar.destroy', [$branch->id, $result->id]) }}"
                              onsubmit="return confirm('Silmek istediğine emin misin?')">
                            @csrf @method('DELETE')
                            <button class="btn-icon text-red-500 hover:bg-red-50">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="td text-center text-gray-400 py-12">
                    <i class="fas fa-flag-checkered text-4xl mb-3 block text-gray-200"></i>
                    Henüz sonuç girilmemiş.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection