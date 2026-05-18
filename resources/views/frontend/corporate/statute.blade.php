@extends('layouts.app')
@section('title', 'Tüzük — Eser Spor Kulübü')

@section('content')

<section class="py-16 relative overflow-hidden"
         style="background: linear-gradient(135deg, #052e16, #111827)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <span class="text-green-400 text-xs font-bold uppercase tracking-[0.3em]">
            Kurumsal
        </span>
        <h1 class="text-4xl font-black text-white mt-2" style="letter-spacing:-1px">
            Tüzük
        </h1>
    </div>
</section>

<section class="py-20 bg-gray-50">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        @if($page)

            @if($page->file_path)
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100
                        flex items-center justify-between mb-8">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-file-pdf text-red-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="font-bold text-gray-900">Tüzük PDF</p>
                        <p class="text-gray-400 text-sm">Resmi tüzük belgesi</p>
                    </div>
                </div>
                <a href="{{ $page->file_url }}" target="_blank"
                   class="inline-flex items-center space-x-2
                          bg-red-600 hover:bg-red-700 text-white
                          font-bold px-5 py-2.5 rounded-xl
                          transition duration-200 text-sm">
                    <i class="fas fa-download"></i>
                    <span>İndir</span>
                </a>
            </div>
            @endif

            @if($page->content)
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
                    {!! nl2br(e($page->content)) !!}
                </div>
            </div>
            @endif

        @else
        <div class="text-center py-20">
            <i class="fas fa-file-alt text-6xl text-gray-200 mb-4 block"></i>
            <p class="text-gray-400">Henüz tüzük eklenmemiş.</p>
        </div>
        @endif

    </div>
</section>

@endsection