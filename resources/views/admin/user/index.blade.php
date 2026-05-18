@extends('layouts.admin')
@section('title', 'Kullanıcılar')
@section('page_title', 'Kullanıcı Yönetimi')
@section('page_subtitle', 'Admin kullanıcılarını yönetin')

@section('content')

<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-500">
        Toplam <strong>{{ $users->count() }}</strong> kullanıcı
    </p>
    <a href="{{ route('admin.kullanicilar.create') }}" class="btn-primary">
        <i class="fas fa-plus mr-2"></i> Yeni Kullanıcı
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="th">Kullanıcı</th>
                <th class="th">E-posta</th>
                <th class="th">Kayıt Tarihi</th>
                <th class="th text-right">İşlem</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($users as $user)
            <tr class="hover:bg-gray-50 transition">
                <td class="td">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-xl bg-green-600
                                    flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-black">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </span>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">
                                {{ $user->name }}
                            </p>
                            @if($user->id === auth()->id())
                            <span class="text-[10px] text-green-600 font-bold">
                                (Aktif Hesap)
                            </span>
                            @endif
                        </div>
                    </div>
                </td>
                <td class="td text-sm text-gray-600">{{ $user->email }}</td>
                <td class="td text-xs text-gray-400">
                    {{ $user->created_at->format('d.m.Y') }}
                </td>
                <td class="td text-right">
                    <div class="flex items-center justify-end space-x-2">
                        <a href="{{ route('admin.kullanicilar.edit', $user->id) }}"
                           class="btn-icon text-blue-600 hover:bg-blue-50">
                            <i class="fas fa-edit"></i>
                        </a>
                        @if($user->id !== auth()->id())
                        <form method="POST"
                              action="{{ route('admin.kullanicilar.destroy', $user->id) }}"
                              onsubmit="return confirm('Bu kullanıcıyı silmek istediğine emin misin?')">
                            @csrf @method('DELETE')
                            <button class="btn-icon text-red-500 hover:bg-red-50">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="td text-center py-12 text-gray-400">
                    Kullanıcı bulunamadı.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection