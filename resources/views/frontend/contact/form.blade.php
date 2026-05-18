@extends('layouts.app')
@section('title', 'İletişim — Eser Spor Kulübü')

@section('content')

<section class="py-16"
         style="background: linear-gradient(135deg, #052e16, #111827)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="text-green-400 text-xs font-bold uppercase tracking-[0.3em]">
            Bize Ulaşın
        </span>
        <h1 class="text-4xl font-black text-white mt-2">İletişim</h1>
    </div>
</section>

<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

{{-- Sol: İletişim Bilgileri --}}
<div class="lg:col-span-1 space-y-6">

    {{-- Adres Kartı (Haritaya Gider) --}}
    <a href=href="https://www.google.com/maps/search/?api=1&query=Ankara+Keçiören+Eser+Spor+Kulübü"
     
       target="_blank" 
       class="block transition-transform hover:scale-[1.02]">
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 h-full">
            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-4">
                <i class="fas fa-map-marker-alt text-green-600 text-xl"></i>
            </div>
            <h3 class="font-bold text-gray-900 mb-1">Adres</h3>
            <p class="text-gray-500 text-sm leading-relaxed">
                Esertepe Mah. 282. Cad. No:3 Şehit Erkan Ataman Parkı İçi Keçiören-ANKARA/TÜRKİYE
            </p>
            <span class="text-green-600 text-xs font-semibold mt-2 inline-block">Haritalarda Gör →</span>
        </div>
    </a>

    {{-- Telefon Kartı (Arama Yapar) --}}
    <a href="tel:+905075392422" class="block transition-transform hover:scale-[1.02]">
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-4">
                <i class="fas fa-phone text-blue-600 text-xl"></i>
            </div>
            <h3 class="font-bold text-gray-900 mb-1">Telefon</h3>
            <p class="text-gray-500 text-sm">+90 507 539 24 22</p>
        </div>
    </a>

    {{-- E-posta Kartı --}}
    <a href="mailto:info@eserspor.org" class="block transition-transform hover:scale-[1.02]">
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4">
                <i class="fas fa-envelope text-purple-600 text-xl"></i>
            </div>
            <h3 class="font-bold text-gray-900 mb-1">E-posta</h3>
            <p class="text-gray-500 text-sm">info@eserspor.org</p>
        </div>
    </a>

</div>

            {{-- Sağ: Form --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm p-8 border border-gray-100">

                    {{-- Başarı mesajı --}}
                    @if(session('success'))
                    <div class="mb-6 bg-green-50 border border-green-200 text-green-700
                                px-5 py-4 rounded-xl flex items-start space-x-3">
                        <i class="fas fa-check-circle mt-0.5 flex-shrink-0"></i>
                        <p class="text-sm font-medium">{{ session('success') }}</p>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('contact.send') }}">
                        @csrf

                        <div class="grid grid-cols-2 gap-4 mb-5">
                            <div>
                                <label class="form-label">
                                    Ad Soyad <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="name"
                                       value="{{ old('name') }}"
                                       placeholder="Adınız Soyadınız"
                                       class="form-input">
                                @error('name')
                                <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="form-label">Telefon</label>
                                <input type="text" name="phone"
                                       value="{{ old('phone') }}"
                                       placeholder="+90 5xx xxx xx xx"
                                       class="form-input">
                            </div>
                        </div>

                        <div class="mb-5">
                            <label class="form-label">
                                E-posta <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email"
                                   value="{{ old('email') }}"
                                   placeholder="ornek@mail.com"
                                   class="form-input">
                            @error('email')
                            <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label class="form-label">
                                Konu <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="subject"
                                   value="{{ old('subject') }}"
                                   placeholder="Mesajınızın konusu"
                                   class="form-input">
                            @error('subject')
                            <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="form-label">
                                Mesaj <span class="text-red-500">*</span>
                            </label>
                            <textarea name="message" rows="5"
                                      placeholder="Mesajınızı buraya yazın..."
                                      class="form-input resize-none">{{ old('message') }}</textarea>
                            @error('message')
                            <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                                class="w-full bg-green-600 hover:bg-green-700
                                       text-white font-bold py-4 rounded-xl
                                       transition duration-300 flex items-center
                                       justify-center space-x-2">
                            <i class="fas fa-paper-plane"></i>
                            <span>Mesaj Gönder</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection