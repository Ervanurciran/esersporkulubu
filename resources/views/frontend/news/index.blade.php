@extends('layouts.app')
@section('title', 'Haberler — Eser Spor Kulübü')

@section('content')

<section class="py-16"
         style="background: linear-gradient(135deg, #052e16, #111827)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="text-green-400 text-xs font-bold uppercase tracking-[0.3em]">
            Güncel
        </span>
        <h1 class="text-4xl font-black text-white mt-2">Haberler</h1>
    </div>
</section>

<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <a href="{{ route('news.news') }}"
               class="group bg-white rounded-3xl p-8 shadow-sm border border-gray-100
                      hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center
                            justify-center mb-5 group-hover:bg-blue-600 transition duration-300">
                    <i class="fas fa-newspaper text-blue-600 text-xl
                              group-hover:text-white transition duration-300"></i>
                </div>
                <h3 class="font-black text-gray-900 text-xl mb-2">Haberler</h3>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Kulübümüzden son haberler ve gelişmeler.
                </p>
                <span class="inline-flex items-center space-x-2 mt-5
                             text-blue-600 font-bold text-sm">
                    <span>Haberlere Git</span>
                    <i class="fas fa-arrow-right text-xs"></i>
                </span>
            </a>

            <a href="{{ route('news.events') }}"
               class="group bg-white rounded-3xl p-8 shadow-sm border border-gray-100
                      hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="w-14 h-14 bg-purple-100 rounded-2xl flex items-center
                            justify-center mb-5 group-hover:bg-purple-600 transition duration-300">
                    <i class="fas fa-calendar-check text-purple-600 text-xl
                              group-hover:text-white transition duration-300"></i>
                </div>
                <h3 class="font-black text-gray-900 text-xl mb-2">Etkinlikler</h3>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Yaklaşan etkinlikler ve organizasyonlar.
                </p>
                <span class="inline-flex items-center space-x-2 mt-5
                             text-purple-600 font-bold text-sm">
                    <span>Etkinliklere Git</span>
                    <i class="fas fa-arrow-right text-xs"></i>
                </span>
            </a>

        </div>
    </div>
</section>

@endsection