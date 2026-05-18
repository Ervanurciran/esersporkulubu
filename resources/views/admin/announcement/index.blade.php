@extends('layouts.admin')
@section('title', 'Duyurular')
@section('page_title', 'Duyuru Yönetimi')
@section('page_subtitle', 'Haberler ve etkinlikleri yönetin')

@section('content')

<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-500">
        Toplam <strong>{{ $announcements->total() }}</strong> duyuru
    </p>
    
    <a href="{{ route('admin.announcement.create') }}" class="btn-primary">
    <i class="fas fa-plus mr-2"></i> Yeni Duyuru
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="th">Görsel</th>
                <th class="th">Başlık</th>
                <th class="th">Tür</th>
                <th class="th">Durum</th>
                <th class="th">Tarih</th>
                <th class="th text-right">İşlem</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($announcements as $item)
            <tr class="hover:bg-gray-50 transition">
                <td class="td">
                    <div class="w-16 h-10 rounded-lg overflow-hidden bg-gray-100">
                        @if($item->cover_image)
                        <img src="{{ asset('storage/' . $item->cover_image) }}"
                             class="w-full h-full object-cover">
                        @else
                        <div class="w-full h-full flex items-center justify-center">
                            <i class="fas fa-newspaper text-gray-300 text-sm"></i>
                        </div>
                        @endif
                    </div>
                </td>
                <td class="td">
                    <p class="font-semibold text-gray-800 text-sm">
                        {{ Str::limit($item->title, 50) }}
                    </p>
                    @if($item->excerpt)
                    <p class="text-gray-400 text-xs mt-0.5">
                        {{ Str::limit($item->excerpt, 60) }}
                    </p>
                    @endif
                </td>
                <td class="td">
                    @if($item->type === 'haber')
                    <span class="badge-info text-blue-600 bg-blue-50 px-2 py-1 rounded text-xs">Haber</span>
                    @else
                    <span class="badge-warning text-yellow-600 bg-yellow-50 px-2 py-1 rounded text-xs">Etkinlik</span>
                    @endif
                </td>
                <td class="td">
                    @if($item->is_published)
                    <span class="badge-success text-green-600 bg-green-50 px-2 py-1 rounded text-xs">Yayında</span>
                    @else
                    <span class="badge-danger text-red-600 bg-red-50 px-2 py-1 rounded text-xs">Taslak</span>
                    @endif
                </td>
                <td class="td text-gray-500 text-xs">
                    {{ $item->published_at ? \Carbon\Carbon::parse($item->published_at)->format('d.m.Y') : '—' }}
                </td>
                <td class="td text-right">
                    <div class="flex items-center justify-end space-x-2">
                        <a href="{{ route('admin.announcement.edit', $item->id) }}"
                           class="btn-icon text-blue-600 hover:bg-blue-50">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form method="POST"
                              action="{{ route('admin.announcement.destroy', $item->id) }}"
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
                <td colspan="6" class="td text-center py-12 text-gray-400">
                    <i class="fas fa-bullhorn text-4xl mb-3 block text-gray-200"></i>
                    Henüz duyuru eklenmemiş.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- SAYFALAMA - HATA DÜZELTİLDİ: $-announcement yerine $announcements --}}
@if($announcements->hasPages())
<div class="mt-6">
    {{ $announcements->links() }}
</div>
@endif

@endsection