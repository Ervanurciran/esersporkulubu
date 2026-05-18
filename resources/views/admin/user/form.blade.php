@extends('layouts.admin')
@section('title', $user->exists ? 'Kullanıcı Düzenle' : 'Yeni Kullanıcı')
@section('page_title', $user->exists ? 'Kullanıcı Düzenle' : 'Yeni Kullanıcı Ekle')
@section('page_subtitle', 'Admin paneli kullanıcısı')

@section('content')
<div class="max-w-lg">
<div class="bg-white rounded-2xl shadow-sm p-8">

<form method="POST"
      action="{{ $user->exists
        ? route('admin.kullanicilar.update', $user->id)
        : route('admin.kullanicilar.store') }}">
    @csrf
    @if($user->exists) @method('PUT') @endif

    {{-- Ad Soyad --}}
    <div class="mb-5">
        <label class="form-label">Ad Soyad <span class="text-red-500">*</span></label>
        <input type="text" name="name"
               value="{{ old('name', $user->name) }}"
               placeholder="Örn: Ahmet Yılmaz"
               class="form-input">
        @error('name') <p class="form-error">{{ $message }}</p> @enderror
    </div>

    {{-- E-posta --}}
    <div class="mb-5">
        <label class="form-label">E-posta <span class="text-red-500">*</span></label>
        <input type="email" name="email"
               value="{{ old('email', $user->email) }}"
               placeholder="ornek@mail.com"
               class="form-input">
        @error('email') <p class="form-error">{{ $message }}</p> @enderror
    </div>

    {{-- Şifre --}}
    <div class="mb-5">
        <label class="form-label">
            Şifre
            @if($user->exists)
            <span class="text-gray-400 font-normal">(boş bırakırsanız değişmez)</span>
            @else
            <span class="text-red-500">*</span>
            @endif
        </label>
        <input type="password" name="password"
               placeholder="{{ $user->exists ? 'Yeni şifre (opsiyonel)' : 'En az 8 karakter' }}"
               class="form-input">
        @error('password') <p class="form-error">{{ $message }}</p> @enderror
    </div>

    {{-- Şifre Tekrar --}}
    <div class="mb-6">
        <label class="form-label">Şifre Tekrar</label>
        <input type="password" name="password_confirmation"
               placeholder="Şifreyi tekrar girin"
               class="form-input">
    </div>

    <div class="flex items-center space-x-3 pt-4 border-t border-gray-100">
        <button type="submit" class="btn-primary">
            <i class="fas fa-save mr-2"></i>
            {{ $user->exists ? 'Güncelle' : 'Kaydet' }}
        </button>
        <a href="{{ route('admin.kullanicilar.index') }}" class="btn-secondary">
            İptal
        </a>
    </div>
</form>
</div>
</div>
@endsection