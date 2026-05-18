@extends('layouts.app')
@section('title', 'Hakkımızda — Eser Spor Kulübü')

@section('content')

{{-- Sayfa Başlığı --}}
<section class="py-16 relative overflow-hidden"
         style="background: linear-gradient(135deg, #052e16, #111827)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <span class="text-green-400 text-xs font-bold uppercase tracking-[0.3em]">
            Kulübümüz
        </span>
        <h1 class="text-4xl font-black text-white mt-2" style="letter-spacing:-1px">
            Hakkımızda
        </h1>
    </div>
</section>

{{-- Alt Sekmeler --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <a href="{{ route('about.history') }}"
               class="group bg-white rounded-3xl p-8 shadow-sm border border-gray-100
                      hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center
                            justify-center mb-5 group-hover:bg-blue-600 transition duration-300">
                    <i class="fas fa-history text-blue-600 text-xl
                              group-hover:text-white transition duration-300"></i>
                </div>
                <h3 class="font-black text-gray-900 text-xl mb-2">Tarihçe</h3>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Kulübümüzün kuruluşundan bugüne uzanan
                    başarı dolu yolculuğu.
                </p>
                <span class="inline-flex items-center space-x-2 mt-5
                             text-blue-600 font-bold text-sm
                             group-hover:text-blue-700 transition duration-200">
                    <span>İncele</span>
                    <i class="fas fa-arrow-right text-xs transform
                              group-hover:translate-x-1 transition duration-200"></i>
                </span>
            </a>

            <a href="{{ route('about.mission') }}"
               class="group bg-white rounded-3xl p-8 shadow-sm border border-gray-100
                      hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center
                            justify-center mb-5 group-hover:bg-green-600 transition duration-300">
                    <i class="fas fa-bullseye text-green-600 text-xl
                              group-hover:text-white transition duration-300"></i>
                </div>
                <h3 class="font-black text-gray-900 text-xl mb-2">Misyon & Vizyon</h3>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Hedeflerimiz, değerlerimiz ve geleceğe
                    dair vizyonumuz.
                </p>
                <span class="inline-flex items-center space-x-2 mt-5
                             text-green-600 font-bold text-sm
                             group-hover:text-green-700 transition duration-200">
                    <span>İncele</span>
                    <i class="fas fa-arrow-right text-xs transform
                              group-hover:translate-x-1 transition duration-200"></i>
                </span>
            </a>

        </div>
    </div>
</section>

@endsection