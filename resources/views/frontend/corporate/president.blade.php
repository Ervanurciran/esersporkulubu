@extends('layouts.app')
@section('title', 'Başkan — Eser Spor Kulübü')

@section('content')

{{-- Başlık --}}
<section class="py-16 relative overflow-hidden"
         style="background: linear-gradient(135deg, #052e16, #111827)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <span class="text-green-400 text-xs font-bold uppercase tracking-[0.3em]">
            Kurumsal
        </span>
        <h1 class="text-4xl font-black text-white mt-2" style="letter-spacing:-1px">
            Başkanımız
        </h1>
    </div>
</section>

{{-- İçerik --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        @if($baskan)
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">

            {{-- Üst Bant --}}
            <div class="h-3 w-full"
                 style="background: linear-gradient(90deg, #16a34a, #15803d)"></div>

            <div class="p-10">
                <div class="flex flex-col sm:flex-row items-center sm:items-start
                            space-y-6 sm:space-y-0 sm:space-x-10">

                    {{-- Fotoğraf --}}
                    <div class="flex-shrink-0">
                        <div class="w-40 h-40 rounded-3xl overflow-hidden
                                    border-4 border-green-100 shadow-xl">
                            @if($baskan->photo)
                            <img src="{{ $baskan->photo_url }}"
                                 alt="{{ $baskan->name }}"
                                 class="w-full h-full object-cover">
                            @else
                            <div class="w-full h-full flex items-center justify-center"
                                 style="background: linear-gradient(135deg, #052e16, #111827)">
                                <span class="text-white font-black text-5xl">
                                    {{ strtoupper(substr($baskan->name, 0, 1)) }}
                                </span>
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- Bilgi --}}
                    <div class="flex-1 text-center sm:text-left">
                        <span class="inline-block bg-green-100 text-green-700
                                     text-xs font-bold px-3 py-1 rounded-full mb-3
                                     uppercase tracking-wider">
                            {{ $baskan->title }}
                        </span>
                        <h2 class="text-3xl font-black text-gray-900 mb-4"
                            style="letter-spacing: -0.5px">
                            {{ $baskan->name }}
                        </h2>

                        @if($baskan->bio)
                        <p class="text-gray-500 leading-relaxed mb-6">
                            {{ $baskan->bio }}
                        </p>
                        @endif

                        {{-- İletişim --}}
                        <div class="flex flex-wrap gap-3 justify-center sm:justify-start">
                            @if($baskan->email)
                            <a href="mailto:{{ $baskan->email }}"
                               class="inline-flex items-center space-x-2
                                      bg-gray-50 hover:bg-green-50 text-gray-600
                                      hover:text-green-600 border border-gray-200
                                      hover:border-green-200 px-4 py-2 rounded-xl
                                      text-sm font-medium transition duration-200">
                                <i class="fas fa-envelope text-xs"></i>
                                <span>{{ $baskan->email }}</span>
                            </a>
                            @endif
                            @if($baskan->phone)
                            <a href="tel:{{ $baskan->phone }}"
                               class="inline-flex items-center space-x-2
                                      bg-gray-50 hover:bg-green-50 text-gray-600
                                      hover:text-green-600 border border-gray-200
                                      hover:border-green-200 px-4 py-2 rounded-xl
                                      text-sm font-medium transition duration-200">
                                <i class="fas fa-phone text-xs"></i>
                                <span>{{ $baskan->phone }}</span>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="text-center py-20">
            <i class="fas fa-user-tie text-6xl text-gray-200 mb-4 block"></i>
            <p class="text-gray-400">Henüz başkan bilgisi eklenmemiş.</p>
        </div>
        @endif

    </div>
</section>

@endsection