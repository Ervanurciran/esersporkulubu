@extends('layouts.admin')
@section('title', 'Branş Yönetimi')
@section('page_title', 'Branş Yönetimi')
@section('page_subtitle', 'Tüm branşları ve alt yönetimlerini buradan kontrol edin')

@section('content')

<div class="flex justify-between items-center mb-6">
    <p class="text-sm text-gray-500">
        Toplam <strong>{{ $branches->count() }}</strong> branş
    </p>
    {{-- Route ismini kendi "create" rotana göre güncelle --}}
    <a href="{{ route('admin.branslar.create') }}" class="btn-primary">
        <i class="fas fa-plus mr-2"></i> Yeni Branş
    </a>
</div>

<div class="space-y-4">
    @forelse($branches as $branch)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        {{-- Branş Başlığı --}}
        <div class="flex items-center justify-between p-6 border-b border-gray-50">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-2xl"
                     style="background: linear-gradient(135deg, #052e16, #111827); color: white;">
                    {{ $branch->icon }}
                </div>
                <div>
                    <h3 class="font-black text-gray-900 text-lg">{{ $branch->name }}</h3>
                    <p class="text-gray-400 text-xs font-mono">/{{ $branch->slug }}</p>
                </div>
                @if($branch->is_active)
                <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-lg">Aktif</span>
                @else
                <span class="px-2 py-1 bg-red-100 text-red-700 text-xs font-bold rounded-lg">Pasif</span>
                @endif
            </div>
            <div class="flex items-center space-x-2">
                <a href="{{ route('admin.branslar.edit', $branch->id) }}"
                   class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition">
                    <i class="fas fa-edit"></i>
                </a>
                <form method="POST"
                      action="{{ route('admin.branslar.destroy', $branch->id) }}"
                      onsubmit="return confirm('Emin misiniz?')">
                    @csrf @method('DELETE')
                    <button class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>

        {{-- Alt Yönetim Linkleri (Senin Route Yapına Göre Düzenlendi) --}}
        <div class="p-4 grid grid-cols-2 sm:grid-cols-5 gap-3 bg-gray-50/50">

            <a href="{{ route('branch.coaches', $branch->slug) }}" class="branch-mgmt-btn">
                <i class="fas fa-user-tie text-purple-500"></i>
                <span>Antrenörler</span>
                <span class="badge-count">{{ $branch->coaches_count ?? 0 }}</span>
            </a>

            {{-- Sporcular rotası paylaştığın kodda yok, 'show' sayfasına veya genel listeye yönlendirebilirsin --}}
            <a href="{{ route('branch.show', $branch->slug) }}" class="branch-mgmt-btn">
                <i class="fas fa-running text-blue-500"></i>
                <span>Genel Bakış</span>
                <span class="badge-count">Detay</span>
            </a>

            {{-- FİKSTÜR --}}
            <a href="{{ route('branch.fixture', $branch->slug) }}" class="branch-mgmt-btn">
                <i class="fas fa-calendar-alt text-green-500"></i>
                <span>Fikstür</span>
                <span class="badge-count">{{ $branch->fixtures_count ?? 0 }}</span>
            </a>

            <a href="{{ route('branch.results', $branch->slug) }}" class="branch-mgmt-btn">
                <i class="fas fa-flag-checkered text-orange-500"></i>
                <span>Sonuçlar</span>
                <span class="badge-count">{{ $branch->results_count ?? 0 }}</span>
            </a>

            <a href="{{ route('branch.standings', $branch->slug) }}" class="branch-mgmt-btn">
                <i class="fas fa-table text-red-500"></i>
                <span>Puan Durumu</span>
                <span class="badge-count">0</span>
            </a>

        </div>
    </div>
    @empty
    <div class="bg-white rounded-2xl p-16 text-center border border-dashed border-gray-200">
        <p class="text-gray-400">Henüz branş eklenmemiş.</p>
    </div>
    @endforelse
</div>

@endsection

@push('styles')
<style>
.branch-mgmt-btn {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 1rem;
    background-color: white;
    border-radius: 0.75rem;
    font-size: 0.75rem;
    font-weight: 600;
    color: #4b5563;
    transition: all 0.2s;
    border: 1px solid #f3f4f6;
}
.branch-mgmt-btn:hover {
    background-color: #f9fafb;
    border-color: #e5e7eb;
    transform: translateY(-2px);
    color: #111827;
}
.branch-mgmt-btn i {
    font-size: 1.25rem;
    margin-bottom: 0.5rem;
}
.badge-count {
    margin-top: 0.25rem;
    background-color: #f3f4f6;
    color: #6b7280;
    font-size: 10px;
    padding: 1px 6px;
    border-radius: 999px;
}
</style>
@endpush