@extends('layouts.admin')
@section('title', 'İletişim Mesajları')
@section('page_title', 'İletişim Mesajları')
@section('page_subtitle', 'Gelen mesajları yönetin')

@section('content')

{{-- Özet --}}
<div class="grid grid-cols-2 gap-4 mb-6">
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100
                flex items-center space-x-4">
        <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
            <i class="fas fa-envelope text-red-500 text-xl"></i>
        </div>
        <div>
            <p class="text-2xl font-black text-gray-900">{{ $unreadCount }}</p>
            <p class="text-xs text-gray-400 font-medium">Okunmamış Mesaj</p>
        </div>
    </div>
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100
                flex items-center space-x-4">
        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
            <i class="fas fa-envelope-open text-green-500 text-xl"></i>
        </div>
        <div>
            <p class="text-2xl font-black text-gray-900">{{ $contacts->total() }}</p>
            <p class="text-xs text-gray-400 font-medium">Toplam Mesaj</p>
        </div>
    </div>
</div>

{{-- Tablo --}}
<div class="bg-white rounded-2xl shadow-sm overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="th">Gönderen</th>
                <th class="th">Konu</th>
                <th class="th">Tarih</th>
                <th class="th">Durum</th>
                <th class="th text-right">İşlem</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($contacts as $contact)
            <tr class="hover:bg-gray-50 transition
                       {{ !$contact->is_read ? 'bg-blue-50/30' : '' }}">
                <td class="td">
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-full bg-green-100
                                    flex items-center justify-center flex-shrink-0">
                            <span class="text-green-700 font-black text-sm">
                                {{ strtoupper(substr($contact->name, 0, 1)) }}
                            </span>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800 text-sm
                                      {{ !$contact->is_read ? 'font-black' : '' }}">
                                {{ $contact->name }}
                            </p>
                            <p class="text-gray-400 text-xs">{{ $contact->email }}</p>
                        </div>
                    </div>
                </td>
                <td class="td text-sm text-gray-600">
                    {{ Str::limit($contact->subject, 40) }}
                </td>
                <td class="td text-xs text-gray-400">
                    {{ $contact->created_at->format('d.m.Y H:i') }}
                </td>
                <td class="td">
                    @if($contact->is_read)
                    <span class="badge-success">Okundu</span>
                    @else
                    <span class="badge-danger">Okunmadı</span>
                    @endif
                </td>
                <td class="td text-right">
                    <div class="flex items-center justify-end space-x-2">
                        <a href="{{ route('admin.contact.show', $contact->id) }}"
                           class="btn-icon text-green-600 hover:bg-green-50">
                            <i class="fas fa-eye"></i>
                        </a>
                        <form method="POST"
                              action="{{ route('admin.contact.destroy', $contact->id) }}"
                              onsubmit="return confirm('Mesajı silmek istediğine emin misin?')">
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
                <td colspan="5" class="td text-center py-12 text-gray-400">
                    <i class="fas fa-inbox text-4xl mb-3 block text-gray-200"></i>
                    Henüz mesaj gelmemiş.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($contacts->hasPages())
<div class="mt-6">{{ $contacts->links() }}</div>
@endif

@endsection