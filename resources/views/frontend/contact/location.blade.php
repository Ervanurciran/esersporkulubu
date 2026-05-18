@extends('layouts.app')
@section('title', 'Konum — Eser Spor Kulübü')

@section('content')

<section class="py-16"
         style="background: linear-gradient(135deg, #052e16, #111827)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="text-green-400 text-xs font-bold uppercase tracking-[0.3em]">
            Bize Ulaşın
        </span>
        <h1 class="text-4xl font-black text-white mt-2">Konumumuz</h1>
    </div>
</section>

<section class="py-20 bg-gray-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

       {{-- Harita (Google Maps embed) --}}
<div class="bg-white rounded-3xl shadow-sm overflow-hidden border border-gray-100 mb-8">
    <div class="h-96 w-full relative">
        {{-- Google Maps embed kodu --}}
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3056.8837269145694!2d32.8631169!3d39.9887132!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x408226056f710927%3A0xc66517a666e850b6!2sEser%20Spor%20Kul%C3%BCb%C3%BC!5e0!3m2!1str!2str!4v1715600000000!5m2!1str!2str" 
            class="absolute inset-0 w-full h-full"
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</div>>

        {{-- Adres Bilgileri --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 text-center">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center
                            justify-center mx-auto mb-4">
                    <i class="fas fa-map-marker-alt text-green-600 text-xl"></i>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Adres</h3>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Esertepe Mah. 282. Cad. No:3 Şehit Erkan Ataman Parkı İçi Keçiören-ANKARA/TÜRKİYE
                </p>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 text-center">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center
                            justify-center mx-auto mb-4">
                    <i class="fas fa-phone text-blue-600 text-xl"></i>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Telefon</h3>
                <p class="text-gray-500 text-sm">+90 507 539 24 22</p>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 text-center">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center
                            justify-center mx-auto mb-4">
                    <i class="fas fa-clock text-purple-600 text-xl"></i>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Çalışma Saatleri</h3>
                <p class="text-gray-500 text-sm">
                    Pzt - Cum: 09:00 - 18:00<br>
                    Cmt: 09:00 - 14:00
                </p>
            </div>
        </div>
    </div>
</section>

@endsection