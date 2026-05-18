@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')
@section('page_subtitle', 'Genel bakış ve hızlı istatistikler')

@section('content')

{{-- İSTATİSTİK KARTLARI --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-5 mb-8">

    <div class="stat-card bg-white">
        <div class="stat-icon bg-green-100 text-green-600">
            <i class="fas fa-trophy"></i>
        </div>
        <div class="ml-4">
            <p class="stat-label">Branş</p>
            <p class="stat-value">{{ $stats['branches'] }}</p>
        </div>
    </div>

    <div class="stat-card bg-white">
        <div class="stat-icon bg-blue-100 text-blue-600">
            <i class="fas fa-running"></i>
        </div>
        <div class="ml-4">
            <p class="stat-label">Sporcu</p>
            <p class="stat-value">{{ $stats['players'] }}</p>
        </div>
    </div>

    <div class="stat-card bg-white">
        <div class="stat-icon bg-purple-100 text-purple-600">
            <i class="fa-solid fa-user-shield"></i>
        </div>
        <div class="ml-4">
            <p class="stat-label">Antrenör</p>
            <p class="stat-value">{{ $stats['coaches'] }}</p>
        </div>
    </div>

    <div class="stat-card bg-white">
        <div class="stat-icon bg-yellow-100 text-yellow-600">
            <i class="fas fa-bullhorn"></i>
        </div>
        <div class="ml-4">
            <p class="stat-label">Duyuru</p>
            <p class="stat-value">{{ $stats['announcement'] }}</p>
        </div>
    </div>

    <div class="stat-card bg-white">
        <div class="stat-icon bg-red-100 text-red-600">
            <i class="fas fa-envelope"></i>
        </div>
        <div class="ml-4">
            <p class="stat-label">Okunmamış Mesaj</p>
            <p class="stat-value text-red-600">{{ $stats['unread'] }}</p>
        </div>
    </div>

    <div class="stat-card bg-white">
        <div class="stat-icon bg-indigo-100 text-indigo-600">
            <i class="fas fa-calendar-alt"></i>
        </div>
        <div class="ml-4">
            <p class="stat-label">Yaklaşan Maç</p>
            <p class="stat-value">{{ $stats['fixtures'] }}</p>
        </div>
    </div>

    <div class="stat-card bg-white">
        <div class="stat-icon bg-orange-100 text-orange-600">
            <i class="fas fa-flag-checkered"></i>
        </div>
        <div class="ml-4">
            <p class="stat-label">Sonuç</p>
            <p class="stat-value">{{ $stats['results'] }}</p>
        </div>
    </div>

    <div class="stat-card bg-white">
        <div class="stat-icon bg-pink-100 text-pink-600">
            <i class="fas fa-images"></i>
        </div>
        <div class="ml-4">
            <p class="stat-label">Galeri Albümü</p>
            <p class="stat-value">{{ $stats['albums'] }}</p>
        </div>
    </div>

</div>

{{-- HIZLI ERİŞİM --}}
<div class="bg-white rounded-2xl shadow-sm p-8 mb-8">
    <h3 class="text-gray-800 font-bold text-lg mb-5 flex items-center">
        <i class="fas fa-bolt text-yellow-500 mr-2"></i>
        Hızlı Erişim
    </h3>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-7 gap-3">

        <a href="{{ route('admin.news.create') }}"    class="quick-btn">
            <i class="fas fa-newspaper text-xl mb-2"></i>
            <span>Haber Ekle</span>
        </a>
        <a href="{{ route('admin.announcement.create') }}"    class="quick-btn">
            <i class="fas fa-bullhorn text-xl mb-2"></i>
            <span>Duyuru Ekle</span>
        </a>

        <a href="{{ route('admin.galeri.create') }}"       class="quick-btn">
            <i class="fas fa-folder-plus text-xl mb-2"></i>
            <span>Albüm Ekle</span>
        </a>
        <a href="{{ route('admin.branslar.index') }}"      class="quick-btn">
            <i class="fas fa-trophy text-xl mb-2"></i>
            <span>Branşlar</span>
        </a>
        <a href="{{ route('admin.contact.index') }}"       class="quick-btn">
            <i class="fas fa-envelope text-xl mb-2"></i>
            <span>Mesajlar</span>
        </a>
        <a href="{{ route('admin.corporate.index') }}"     class="quick-btn">
            <i class="fas fa-sitemap text-xl mb-2"></i>
            <span>Kurumsal</span>
        </a>
        <a href="{{ route('admin.slider.index') }}" class="quick-btn">
            <i class="fas fa-images text-xl mb-2"></i>
            <span>Slider</span>
        </a>

    </div>
</div>

{{-- ALT KISIM: Son Mesajlar + Son Haberler --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    {{-- Son Gelen Mesajlar --}}
    <div class="bg-white rounded-2xl shadow-sm p-6">
        <div class="flex items-center justify-between mb-5">
            <h3 class="text-gray-800 font-bold text-lg flex items-center">
                <i class="fas fa-inbox text-green-500 mr-2"></i>
                Son Mesajlar
            </h3>
            <a href="{{ route('admin.contact.index') }}"
               class="text-sm text-green-600 hover:text-green-700 font-medium">
                Tümünü Gör →
            </a>
        </div>

        <div class="space-y-3">
            @forelse($recentContacts as $contact)
            <a href="{{ route('admin.contact.show', $contact->id) }}"
               class="flex items-start space-x-3 p-3 rounded-xl
                      hover:bg-gray-50 transition duration-150 group">
                <div class="w-9 h-9 rounded-full bg-green-100 text-green-600
                            flex items-center justify-center flex-shrink-0 font-bold text-sm">
                    {{ strtoupper(substr($contact->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-semibold text-gray-800 truncate">
                            {{ $contact->name }}
                            @if(!$contact->is_read)
                            <span class="ml-1 inline-block w-2 h-2 bg-red-500 rounded-full"></span>
                            @endif
                        </p>
                        <span class="text-xs text-gray-400 flex-shrink-0 ml-2">
                            {{ $contact->created_at->diffForHumans() }}
                        </span>
                    </div>
                    <p class="text-xs text-gray-500 truncate mt-0.5">{{ $contact->subject }}</p>
                </div>
            </a>
            @empty
            <p class="text-gray-400 text-sm text-center py-6">Mesaj bulunmuyor.</p>
            @endforelse
        </div>
    </div>

    {{-- Son Haberler --}}
    <div class="bg-white rounded-2xl shadow-sm p-6">
        <div class="flex items-center justify-between mb-5">
            <h3 class="text-gray-800 font-bold text-lg flex items-center">
                <i class="fas fa-newspaper text-blue-500 mr-2"></i>
                Son Duyurular
            </h3>
            <a href="{{ route('admin.news.index') }}"
               class="text-sm text-green-600 hover:text-green-700 font-medium">
                Tümünü Gör →
            </a>
        </div>

        <div class="space-y-3">
            @forelse($recentNews as $news)
            <a href="{{ route('admin.news.edit', $news->id) }}"
               class="flex items-center space-x-3 p-3 rounded-xl
                      hover:bg-gray-50 transition duration-150">
                <div class="w-9 h-9 rounded-xl overflow-hidden flex-shrink-0 bg-gray-100">
                    @if($news->cover_image)
                    <img src="{{ $news->cover_image_url }}"
                         class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <i class="fas fa-newspaper text-gray-400 text-sm"></i>
                    </div>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-800 truncate">
                        {{ $news->title }}
                    </p>
                    <div class="flex items-center space-x-2 mt-0.5">
                        <span class="text-xs px-2 py-0.5 rounded-full font-medium
                            {{ $news->type === 'haber' ? 'bg-blue-100 text-blue-600' : 'bg-purple-100 text-purple-600' }}">
                            {{ ucfirst($news->type) }}
                        </span>
                        <span class="text-xs text-gray-400">
                            {{ $news->created_at->format('d.m.Y') }}
                        </span>
                        @if($news->is_published)
                        <span class="text-xs text-green-500 font-medium">
                            <i class="fas fa-circle text-[8px]"></i> Yayında
                        </span>
                        @else
                        <span class="text-xs text-gray-400 font-medium">
                            <i class="fas fa-circle text-[8px]"></i> Taslak
                        </span>
                        @endif
                    </div>
                </div>
            </a>
            @empty
            <p class="text-gray-400 text-sm text-center py-6">Duyuru bulunmuyor.</p>
            @endforelse
        </div>
    </div>

</div>

@endsection

@push('styles')
<style>
.stat-card {
    @apply flex items-center p-5 rounded-2xl shadow-sm border border-gray-100;
}
.stat-icon {
    @apply w-12 h-12 rounded-xl flex items-center justify-center text-xl flex-shrink-0;
}
.stat-label {
    @apply text-xs text-gray-500 font-medium;
}
.stat-value {
    @apply text-2xl font-extrabold text-gray-800;
}
.quick-btn {
    @apply flex flex-col items-center justify-center p-4 bg-gray-50
           hover:bg-green-50 hover:text-green-600 text-gray-600
           rounded-xl text-xs font-semibold transition duration-200
           border border-gray-100 hover:border-green-200;
}
</style>
@endpush