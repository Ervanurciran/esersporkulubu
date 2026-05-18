@extends('layouts.admin')
@section('title', 'Branş Yönetimi')
@section('page_title', 'Branş Yönetimi')
@section('page_subtitle', 'Tüm branşları ve alt yönetimlerini buradan kontrol edin')

@section('content')

<div class="flex justify-between items-center mb-6">
    <p class="text-sm text-gray-500">
        Toplam <strong>{{ $branches->count() }}</strong> branş
    </p>
    <a href="{{ route('admin.branslar.create') }}" class="btn-primary">
        <i class="fas fa-plus mr-2"></i> Yeni Branş
    </a>
</div>

<div class="space-y-4">
    @forelse($branches as $branch)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        {{-- Branş Başlığı --}}
        <div class="flex items-center justify-between p-6
                    border-b border-gray-50">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center
                            text-2xl"
                     style="background: linear-gradient(135deg, #052e16, #111827)">
                    {{ $branch->icon }}
                </div>
                <div>
                    <h3 class="font-black text-gray-900 text-lg">{{ $branch->name }}</h3>
                    <p class="text-gray-400 text-xs font-mono">/{{ $branch->slug }}</p>
                </div>
                @if($branch->is_active)
                <span class="badge-success">Aktif</span>
                @else
                <span class="badge-danger">Pasif</span>
                @endif
            </div>
            <div class="flex items-center space-x-2">
                <a href="{{ route('admin.branslar.edit', $branch->id) }}"
                   class="btn-icon text-blue-600 hover:bg-blue-50">
                    <i class="fas fa-edit"></i>
                </a>
                <form method="POST"
                      action="{{ route('admin.branslar.destroy', $branch->id) }}"
                      onsubmit="return confirm('Bu branşı silmek istediğine emin misin? Tüm veriler silinecek!')">
                    @csrf @method('DELETE')
                    <button class="btn-icon text-red-500 hover:bg-red-50">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>

        {{-- Alt Yönetim Linkleri --}}
        <div class="p-4 grid grid-cols-2 sm:grid-cols-5 gap-3">

            <a href="{{ route('admin.branch.antrenorler.index', $branch->id) }}"
               class="branch-mgmt-btn">
                <i class="fas fa-whistle text-purple-500"></i>
                <span>Antrenörler</span>
                <span class="badge-count">{{ $branch->coaches_count }}</span>
            </a>

            <a href="{{ route('admin.branch.oyuncular.index', $branch->id) }}"
               class="branch-mgmt-btn">
                <i class="fas fa-running text-blue-500"></i>
                <span>Sporcular</span>
                <span class="badge-count">{{ $branch->players_count }}</span>
            </a>

            <a href="{{ route('admin.branch.fikstur.index', $branch->id) }}"
               class="branch-mgmt-btn">
                <i class="fas fa-calendar-alt text-green-500"></i>
                <span>Fikstür</span>
                <span class="badge-count">{{ $branch->fixtures_count }}</span>
            </a>

            <a href="{{ route('admin.branch.sonuclar.index', $branch->id) }}"
               class="branch-mgmt-btn">
                <i class="fas fa-flag-checkered text-orange-500"></i>
                <span>Sonuçlar</span>
                <span class="badge-count">{{ $branch->results_count }}</span>
            </a>

            <a href="{{ route('admin.branch.puan-durumu.index', $branch->id) }}"
               class="branch-mgmt-btn">
                <i class="fas fa-table text-red-500"></i>
                <span>Puan Durumu</span>
                <span class="badge-count">0</span>
            </a>

        </div>
    </div>
    @empty
    <div class="bg-white rounded-2xl p-16 text-center border border-dashed border-gray-200">
        <i class="fas fa-trophy text-5xl text-gray-200 mb-4 block"></i>
        <p class="text-gray-400 mb-4">Henüz branş eklenmemiş.</p>
        <a href="{{ route('admin.branslar.create') }}" class="btn-primary">
            <i class="fas fa-plus mr-2"></i> Branş Ekle
        </a>
    </div>
    @endforelse
</div>

@endsection

@push('styles')
<style>
.branch-mgmt-btn {
    @apply flex flex-col items-center justify-center p-4 bg-gray-50
           hover:bg-white rounded-xl text-xs font-semibold text-gray-600
           hover:text-gray-900 transition duration-150 border border-transparent
           hover:border-gray-200 hover:shadow-sm space-y-1;
}
.badge-count {
    @apply bg-gray-200 text-gray-600 text-[10px] font-bold
           px-2 py-0.5 rounded-full;
}
</style>
@endpush