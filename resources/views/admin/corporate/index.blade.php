@extends('layouts.admin')
@section('title', 'Kurumsal Yapı')
@section('page_title', 'Kurumsal Yapı')
@section('page_subtitle', 'Başkan, Yönetim ve Denetim Kurulu yönetimi')

@section('content')

{{-- Üst Bar --}}
<div class="flex items-center justify-between mb-6">
    <div class="flex items-center space-x-3">
        <a href="{{ route('admin.corporate.create') }}" class="btn-primary">
            <i class="fas fa-plus mr-2"></i> Yeni Üye Ekle
        </a>
        <a href="{{ route('admin.corporate.statute.edit') }}" class="btn-secondary">
            <i class="fas fa-file-pdf mr-2"></i> Tüzük
        </a>
    </div>
</div>

{{-- BAŞKAN --}}
<div class="mb-8">
    <h3 class="text-gray-700 font-bold text-base mb-4 flex items-center">
        <span class="w-1 h-5 bg-yellow-500 rounded-full mr-2 inline-block"></span>
        Başkan
    </h3>

    @if($baskan)
    <div class="bg-white rounded-2xl shadow-sm p-6 flex items-center
                justify-between border border-gray-100">
        <div class="flex items-center space-x-5">
            <div class="w-16 h-16 rounded-2xl overflow-hidden bg-gray-100 flex-shrink-0">
                @if($baskan->photo)
                <img src="{{ $baskan->photo_url }}"
                     class="w-full h-full object-cover">
                @else
                <div class="w-full h-full flex items-center justify-center">
                    <i class="fas fa-user text-gray-400 text-2xl"></i>
                </div>
                @endif
            </div>
            <div>
                <p class="font-bold text-gray-900 text-lg">{{ $baskan->name }}</p>
                <p class="text-gray-500 text-sm">{{ $baskan->title }}</p>
                @if($baskan->email)
                <p class="text-gray-400 text-xs mt-1">
                    <i class="fas fa-envelope mr-1"></i>{{ $baskan->email }}
                </p>
                @endif
            </div>
        </div>
        <div class="flex items-center space-x-2">
            <a href="{{ route('admin.corporate.edit', $baskan->id) }}"
               class="btn-icon text-blue-600 hover:bg-blue-50">
                <i class="fas fa-edit"></i>
            </a>
            <form method="POST"
                  action="{{ route('admin.corporate.destroy', $baskan->id) }}"
                  onsubmit="return confirm('Başkanı silmek istediğine emin misin?')">
                @csrf @method('DELETE')
                <button class="btn-icon text-red-500 hover:bg-red-50">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </div>
    </div>
    @else
    <div class="bg-white rounded-2xl shadow-sm p-8 text-center
                border border-dashed border-gray-200">
        <i class="fas fa-user-tie text-4xl text-gray-200 mb-3 block"></i>
        <p class="text-gray-400 text-sm mb-4">Henüz başkan eklenmemiş.</p>
        <a href="{{ route('admin.corporate.create') }}" class="btn-primary">
            <i class="fas fa-plus mr-2"></i> Başkan Ekle
        </a>
    </div>
    @endif
</div>

{{-- YÖNETİM KURULU --}}
<div class="mb-8">
    <h3 class="text-gray-700 font-bold text-base mb-4 flex items-center">
        <span class="w-1 h-5 bg-green-500 rounded-full mr-2 inline-block"></span>
        Yönetim Kurulu
        <span class="ml-2 text-xs text-gray-400 font-normal">
            ({{ $yonetimKurulu->count() }} üye)
        </span>
    </h3>

    @if($yonetimKurulu->count())
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        @foreach($yonetimKurulu as $member)
        @include('admin.corporate._member_card', ['member' => $member])
        @endforeach
    </div>
    @else
    <div class="bg-white rounded-2xl shadow-sm p-8 text-center
                border border-dashed border-gray-200">
        <p class="text-gray-400 text-sm">Yönetim kurulu üyesi eklenmemiş.</p>
    </div>
    @endif
</div>

{{-- DENETİM KURULU --}}
<div>
    <h3 class="text-gray-700 font-bold text-base mb-4 flex items-center">
        <span class="w-1 h-5 bg-blue-500 rounded-full mr-2 inline-block"></span>
        Denetim Kurulu
        <span class="ml-2 text-xs text-gray-400 font-normal">
            ({{ $denetimKurulu->count() }} üye)
        </span>
    </h3>

    @if($denetimKurulu->count())
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        @foreach($denetimKurulu as $member)
        @include('admin.corporate._member_card', ['member' => $member])
        @endforeach
    </div>
    @else
    <div class="bg-white rounded-2xl shadow-sm p-8 text-center
                border border-dashed border-gray-200">
        <p class="text-gray-400 text-sm">Denetim kurulu üyesi eklenmemiş.</p>
    </div>
    @endif
</div>

@endsection