@extends('layouts.admin')
@section('title', $member->exists ? 'Üye Düzenle' : 'Yeni Üye Ekle')
@section('page_title', $member->exists ? 'Üye Düzenle' : 'Yeni Üye Ekle')
@section('page_subtitle', 'Başkan, Yönetim Kurulu veya Denetim Kurulu üyesi')

@section('content')
<div class="max-w-2xl">
<div class="bg-white rounded-2xl shadow-sm p-8">

<form method="POST"
      action="{{ $member->exists
        ? route('admin.corporate.update', $member->id)
        : route('admin.corporate.store') }}"
      enctype="multipart/form-data">
    @csrf
    @if($member->exists) @method('PUT') @endif

    {{-- Fotoğraf --}}
    <div class="mb-6">
        <label class="form-label">Fotoğraf</label>

        @if($member->exists && $member->photo)
        <div class="mb-3">
            <img src="{{ $member->photo_url }}"
                 class="w-24 h-24 object-cover rounded-2xl border border-gray-200"
                 id="preview-img">
        </div>
        @else
        <div class="mb-3 hidden" id="preview-wrap">
            <img src="" class="w-24 h-24 object-cover rounded-2xl border border-gray-200"
                 id="preview-img">
        </div>
        @endif

        <input type="file" name="photo" accept="image/*"
               class="form-input" onchange="previewImage(this)">
        @error('photo') <p class="form-error">{{ $message }}</p> @enderror
        <p class="text-xs text-gray-400 mt-1">JPG, PNG, WEBP — Max 2MB</p>
    </div>

    {{-- Ad Soyad --}}
    <div class="mb-5">
        <label class="form-label">Ad Soyad <span class="text-red-500">*</span></label>
        <input type="text" name="name"
               value="{{ old('name', $member->name) }}"
               placeholder="Örn: Ahmet Yılmaz"
               class="form-input">
        @error('name') <p class="form-error">{{ $message }}</p> @enderror
    </div>

    {{-- Ünvan --}}
    <div class="mb-5">
        <label class="form-label">Ünvan / Görev <span class="text-red-500">*</span></label>
        <input type="text" name="title"
               value="{{ old('title', $member->title) }}"
               placeholder="Örn: Kulüp Başkanı"
               class="form-input">
        @error('title') <p class="form-error">{{ $message }}</p> @enderror
    </div>

    {{-- Tür --}}
    <div class="mb-5">
        <label class="form-label">Tür <span class="text-red-500">*</span></label>
        <select name="type" class="form-input">
            <option value="">Seçiniz...</option>
            <option value="baskan"
                {{ old('type', $member->type) === 'baskan' ? 'selected' : '' }}>
                Başkan
            </option>
            <option value="yonetim_kurulu"
                {{ old('type', $member->type) === 'yonetim_kurulu' ? 'selected' : '' }}>
                Yönetim Kurulu
            </option>
            <option value="denetim_kurulu"
                {{ old('type', $member->type) === 'denetim_kurulu' ? 'selected' : '' }}>
                Denetim Kurulu
            </option>
        </select>
        @error('type') <p class="form-error">{{ $message }}</p> @enderror
    </div>

    {{-- Biyografi --}}
    <div class="mb-5">
        <label class="form-label">Biyografi</label>
        <textarea name="bio" rows="4" class="form-input"
                  placeholder="Kısa biyografi...">{{ old('bio', $member->bio) }}</textarea>
    </div>

    {{-- İletişim --}}
    <div class="grid grid-cols-2 gap-4 mb-5">
        <div>
            <label class="form-label">E-posta</label>
            <input type="email" name="email"
                   value="{{ old('email', $member->email) }}"
                   placeholder="ornek@mail.com"
                   class="form-input">
        </div>
        <div>
            <label class="form-label">Telefon</label>
            <input type="text" name="phone"
                   value="{{ old('phone', $member->phone) }}"
                   placeholder="+90 5xx xxx xx xx"
                   class="form-input">
        </div>
    </div>

    {{-- Sıra & Aktif --}}
    <div class="grid grid-cols-2 gap-4 mb-6">
        <div>
            <label class="form-label">Sıralama</label>
            <input type="number" name="sort_order" min="0"
                   value="{{ old('sort_order', $member->sort_order ?? 0) }}"
                   class="form-input">
        </div>
        <div class="flex items-center pt-7">
            <input type="checkbox" name="is_active" id="is_active"
                   value="1"
                   {{ old('is_active', $member->is_active ?? true) ? 'checked' : '' }}
                   class="w-4 h-4 text-green-600 rounded border-gray-300">
            <label for="is_active" class="ml-2 text-sm font-medium text-gray-700">
                Aktif
            </label>
        </div>
    </div>

    {{-- Butonlar --}}
    <div class="flex items-center space-x-3 pt-4 border-t border-gray-100">
        <button type="submit" class="btn-primary">
            <i class="fas fa-save mr-2"></i>
            {{ $member->exists ? 'Güncelle' : 'Kaydet' }}
        </button>
        <a href="{{ route('admin.corporate.index') }}" class="btn-secondary">
            İptal
        </a>
    </div>
</form>

</div>
</div>
@endsection

@push('scripts')
<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.getElementById('preview-img');
            const wrap = document.getElementById('preview-wrap');
            img.src = e.target.result;
            if (wrap) wrap.classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush