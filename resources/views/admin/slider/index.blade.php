@extends('layouts.admin')

@section('title', 'Slider Yönetimi')
@section('page_title', 'Slider Yönetimi')
@section('page_subtitle', 'Ana sayfa slider görsellerini yönetin')

@section('content')

{{-- Üst Bar --}}
<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-500">Toplam <strong>{{ $sliders->count() }}</strong> slider</p>
    <a href="{{ route('admin.slider.create') }}" class="btn-primary">
        <i class="fas fa-plus mr-2"></i> Yeni Slider
    </a>
</div>

{{-- Tablo --}}
<div class="bg-white rounded-2xl shadow-sm overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="th">Sıra</th>
                <th class="th">Görsel</th>
                <th class="th">Başlık</th>
                <th class="th">Alt Başlık</th>
                <th class="th">Buton</th>
                <th class="th">Durum</th>
                <th class="th text-right">İşlem</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($sliders as $slider)
            <tr class="hover:bg-gray-50 transition duration-150">
                <td class="td text-center font-bold text-gray-500">
                    {{ $slider->sort_order }}
                </td>
                <td class="td">
                    <img src="{{ $slider->image_url }}"
                         alt="{{ $slider->title }}"
                         class="w-24 h-14 object-cover rounded-lg">
                </td>
                <td class="td font-medium text-gray-800">
                    {{ $slider->title ?? '—' }}
                </td>
                <td class="td text-gray-500 text-sm">
                    {{ $slider->subtitle ?? '—' }}
                </td>
                <td class="td text-sm">
                    @if($slider->button_text)
                    <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">
                        {{ $slider->button_text }}
                    </span>
                    @else
                    <span class="text-gray-400">—</span>
                    @endif
                </td>
                <td class="td">
                    @if($slider->is_active)
                    <span class="badge-success">Aktif</span>
                    @else
                    <span class="badge-danger">Pasif</span>
                    @endif
                </td>
                <td class="td text-right">
                    <div class="flex items-center justify-end space-x-2">
                        <a href="{{ route('admin.slider.edit', $slider->id) }}"
                           class="btn-icon text-blue-600 hover:bg-blue-50">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form method="POST"
                              action="{{ route('admin.slider.destroy', $slider->id) }}"
                              onsubmit="return confirm('Bu slider silinecek. Emin misin?')">
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
                    <i class="fas fa-images text-4xl mb-3 block text-gray-200"></i>
                    Henüz slider eklenmemiş.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection