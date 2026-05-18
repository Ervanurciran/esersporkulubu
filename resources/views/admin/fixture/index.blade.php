@extends('layouts.admin')
@section('title', $branch->name . ' — Fikstür')
@section('page_title', $branch->name . ' Fikstürü')
@section('page_subtitle', 'Maç programını yönetin')

@section('content')

<div class="flex items-center space-x-2 text-sm text-gray-400 mb-6">
    <a href="{{ route('admin.branslar.index') }}" class="hover:text-green-600">Branşlar</a>
    <i class="fas fa-chevron-right text-xs"></i>
    <span class="text-gray-900 font-semibold">{{ $branch->name }} Fikstür</span>
</div>

<div class="flex justify-between items-center mb-6">
    <p class="text-sm text-gray-500"><strong>{{ $fixtures->count() }}</strong> maç</p>
    <a href="{{ route('admin.branch.fikstur.create', $branch->id) }}" class="btn-primary">
        <i class="fas fa-plus mr-2"></i> Maç Ekle
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="th">Tarih</th>
                <th class="th">Ev Sahibi</th>
                <th class="th">Deplasman</th>
                <th class="th">Stat/Salon</th>
                <th class="th">Müsabaka</th>
                <th class="th">Durum</th>
                <th class="th text-right">İşlem</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($fixtures as $fixture)
            <tr class="hover:bg-gray-50 transition">
                <td class="td text-xs font-medium text-gray-500">
                    {{ $fixture->match_date->format('d.m.Y H:i') }}
                </td>
                <td class="td font-semibold text-gray-800">{{ $fixture->home_team }}</td>
                <td class="td font-semibold text-gray-800">{{ $fixture->away_team }}</td>
                <td class="td text-gray-500 text-sm">{{ $fixture->venue ?? '—' }}</td>
                <td class="td text-gray-500 text-sm">{{ $fixture->competition ?? '—' }}</td>
                <td class="td">
                    @if($fixture->status === 'upcoming')
                        <span class="badge-info">Yaklaşan</span>
                    @elseif($fixture->status === 'live')
                        <span class="badge-warning">Canlı</span>
                    @else
                        <span class="badge-success">Tamamlandı</span>
                    @endif
                </td>
                <td class="td text-right">
                    <div class="flex items-center justify-end space-x-2">
                        <a href="{{ route('admin.branch.fikstur.edit', [$branch->id, $fixture->id]) }}"
                           class="btn-icon text-blue-600 hover:bg-blue-50">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form method="POST"
                              action="{{ route('admin.branch.fikstur.destroy', [$branch->id, $fixture->id]) }}"
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
                <td colspan="7" class="td text-center text-gray-400 py-12">
                    <i class="fas fa-calendar text-4xl mb-3 block text-gray-200"></i>
                    Henüz maç eklenmemiş.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection