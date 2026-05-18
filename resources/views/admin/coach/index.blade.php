@extends('layouts.admin')
@section('title', $branch->name . ' — Antrenörler')
@section('page_title', $branch->name . ' Antrenörleri')
@section('page_subtitle', 'Antrenör kadrosunu yönetin')

@section('content')

{{-- Breadcrumb --}}
<div class="flex items-center space-x-2 text-sm text-gray-400 mb-6">
    <a href="{{ route('admin.branslar.index') }}"
       class="hover:text-green-600 transition">Branşlar</a>
    <i class="fas fa-chevron-right text-xs"></i>
    <span class="text-gray-600 font-medium">{{ $branch->name }}</span>
    <i class="fas fa-chevron-right text-xs"></i>
    <span class="text-gray-900 font-semibold">Antrenörler</span>
</div>

<div class="flex justify-between items-center mb-6">
    <p class="text-sm text-gray-500">
        <strong>{{ $coaches->count() }}</strong> antrenör
    </p>
    <a href="{{ route('admin.branch.antrenorler.create', $branch->id) }}"
       class="btn-primary">
        <i class="fas fa-plus mr-2"></i> Antrenör Ekle
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
    @forelse($coaches as $coach)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
        <div class="flex items-center space-x-4 mb-4">
            <div class="w-14 h-14 rounded-2xl overflow-hidden bg-gray-100 flex-shrink-0">
                @if($coach->photo)
                <img src="{{ $coach->photo_url }}"
                     class="w-full h-full object-cover">
                @else
                <div class="w-full h-full flex items-center justify-center
                            bg-gradient-to-br from-purple-100 to-purple-200">
                    <span class="text-purple-700 font-black text-xl">
                        {{ strtoupper(substr($coach->name, 0, 1)) }}
                    </span>
                </div>
                @endif
            </div>
            <div class="flex-1 min-w-0">
                <p class="font-bold text-gray-900 truncate">{{ $coach->name }}</p>
                <p class="text-gray-500 text-xs">{{ $coach->title }}</p>
                @if($coach->is_active)
                <span class="badge-success text-[10px]">Aktif</span>
                @else
                <span class="badge-danger text-[10px]">Pasif</span>
                @endif
            </div>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('admin.branch.antrenorler.edit', [$branch->id, $coach->id]) }}"
               class="flex-1 text-center text-xs font-semibold text-blue-600
                      bg-blue-50 hover:bg-blue-100 py-2 rounded-lg transition">
                <i class="fas fa-edit mr-1"></i> Düzenle
            </a>
            <form method="POST"
                  action="{{ route('admin.branch.antrenorler.destroy', [$branch->id, $coach->id]) }}"
                  onsubmit="return confirm('Antrenörü silmek istediğine emin misin?')">
                @csrf @method('DELETE')
                <button class="px-4 py-2 text-xs font-semibold text-red-500
                               bg-red-50 hover:bg-red-100 rounded-lg transition">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </div>
    </div>
    @empty
    <div class="col-span-3 bg-white rounded-2xl p-16 text-center
                border border-dashed border-gray-200">
        <i class="fas fa-whistle text-5xl text-gray-200 mb-4 block"></i>
        <p class="text-gray-400 mb-4">Henüz antrenör eklenmemiş.</p>
        <a href="{{ route('admin.branch.antrenorler.create', $branch->id) }}"
           class="btn-primary">
            <i class="fas fa-plus mr-2"></i> Antrenör Ekle
        </a>
    </div>
    @endforelse
</div>

@endsection