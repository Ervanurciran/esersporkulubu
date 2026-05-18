@extends('layouts.app')
@section('title', 'Yönetim Kurulu — Eser Spor Kulübü')

@section('content')

<section class="py-16 relative overflow-hidden"
         style="background: linear-gradient(135deg, #052e16, #111827)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <span class="text-green-400 text-xs font-bold uppercase tracking-[0.3em]">
            Kurumsal
        </span>
        <h1 class="text-4xl font-black text-white mt-2" style="letter-spacing:-1px">
            Yönetim Kurulu
        </h1>
    </div>
</section>

<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if($members->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($members as $member)
            @include('frontend.corporate._member_card', ['member' => $member])
            @endforeach
        </div>
        @else
        <div class="text-center py-20">
            <i class="fas fa-users text-6xl text-gray-200 mb-4 block"></i>
            <p class="text-gray-400">Henüz üye eklenmemiş.</p>
        </div>
        @endif

    </div>
</section>

@endsection