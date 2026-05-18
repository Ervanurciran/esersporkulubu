@extends('layouts.admin')
@section('title', $branch->name . ' — Puan Durumu')
@section('page_title', $branch->name . ' Puan Durumu')
@section('page_subtitle', 'Lig puan tablosunu yönetin')

@section('content')

<div class="flex justify-between items-center mb-6">
    <p class="text-sm text-gray-500"><strong>{{ $standings->count() }}</strong> takım</p>
    <a href="{{ route('admin.branch.puan-durumu.create', $branch->id) }}" class="btn-primary">
        <i class="fas fa-plus mr-2"></i> Takım Ekle
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="th">#</th>
                <th class="th">Takım</th>
                <th class="th text-center">O</th>
                <th class="th text-center">G</th>
                <th class="th text-center">B</th>
                <th class="th text-center">M</th>
                <th class="th text-center">A</th>
                <th class="th text-center">Y</th>
                <th class="th text-center">Av</th>
                <th class="th text-center font-black text-green-600">P</th>
                <th class="th text-right">İşlem</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($standings as $i => $row)
            <tr class="hover:bg-gray-50 transition
                       {{ $i === 0 ? 'bg-green-50' : '' }}">
                <td class="td text-center font-black text-gray-500">
                    {{ $i + 1 }}
                </td>
                <td class="td font-bold text-gray-800">{{ $row->team_name }}</td>
                <td class="td text-center text-gray-600">{{ $row->played }}</td>
                <td class="td text-center text-green-600 font-semibold">{{ $row->won }}</td>
                <td class="td text-center text-gray-500">{{ $row->drawn }}</td>
                <td class="td text-center text-red-500 font-semibold">{{ $row->lost }}</td>
                <td class="td text-center text-gray-600">{{ $row->goals_for }}</td>
                <td class="td text-center text-gray-600">{{ $row->goals_against }}</td>
                <td class="td text-center text-gray-600">
                    {{ $row->goal_diff >= 0 ? '+' : '' }}{{ $row->goal_diff }}
                </td>
                <td class="td text-center">
                    <span class="font-black text-lg text-gray-900">{{ $row->points }}</span>
                </td>
                <td class="td text-right">
                    <div class="flex items-center justify-end space-x-2">
                        <a href="{{ route('admin.branch.puan-durumu.edit', [$branch->id, $row->id]) }}"
                           class="btn-icon text-blue-600 hover:bg-blue-50">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form method="POST"
                              action="{{ route('admin.branch.puan-durumu.destroy', [$branch->id, $row->id]) }}"
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
                <td colspan="11" class="td text-center text-gray-400 py-12">
                    <i class="fas fa-table text-4xl mb-3 block text-gray-200"></i>
                    Henüz puan durumu girilmemiş.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection