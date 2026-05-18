@extends('layouts.app')

@section('title', 'Ana Sayfa — Eser Spor Kulübü')
@section('meta_description', 'Eser Spor Kulübü resmi web sitesi.')

@section('content')

{{-- ══════════════════════════════════════
     1. HERO SLIDER
══════════════════════════════════════ --}}
<section class="relative">
    <div class="swiper hero-swiper"
         style="height: clamp(520px, 92vh, 900px)">
        <div class="swiper-wrapper">

            @forelse($sliders as $slide)
<div class="swiper-slide relative overflow-hidden">

    {{-- FOTOĞRAF --}}
    @if($slide->media_type === 'image' || !$slide->isVideo())
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
         style="background-image: url('{{ $slide->image_url }}')">
    </div>

    {{-- MP4 VİDEO --}}
    @elseif($slide->media_type === 'video' && $slide->video_path)
    <video class="absolute inset-0 w-full h-full object-cover"
           autoplay muted loop playsinline>
        <source src="{{ $slide->video_path_url }}" type="video/mp4">
    </video>

    {{-- YOUTUBE VİDEO --}}
    @elseif($slide->media_type === 'video' && $slide->video_url)
    <div class="absolute inset-0 overflow-hidden">
        <iframe class="absolute w-[300%] h-[300%]"
                style="top: -100%; left: -100%"
                src="{{ $slide->youtube_embed }}"
                frameborder="0"
                allow="autoplay; muted; encrypted-media"
                allowfullscreen>
        </iframe>
    </div>
    @endif

    {{-- Watermark Logo --}}
    <div class="absolute inset-0 flex items-center
                justify-center pointer-events-none">
        <img src="{{ asset('images/logo.png') }}"
             alt=""
             class="select-none"
             style="width: clamp(280px, 32vw, 480px);
                    opacity: 0.06;
                    filter: grayscale(20%)">
    </div>

    {{-- İçerik --}}
    <div class="relative z-10 h-full flex items-center">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 w-full">
            <div class="max-w-2xl">

                @if($slide->subtitle)
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-8 h-px bg-white"></div>
                    <span class="text-white text-xs font-bold
                                 uppercase tracking-[0.3em] drop-shadow-lg">
                        {{ $slide->subtitle }}
                    </span>
                </div>
                @endif

                @if($slide->title)
                <h1 class="font-black text-white leading-none mb-6 drop-shadow-2xl"
                    style="font-size: clamp(2.5rem, 6vw, 5.5rem);
                           letter-spacing: -2px;
                           text-shadow: 0 4px 20px rgba(0,0,0,0.5)">
                    {{ $slide->title }}
                </h1>
                @endif

                @if($slide->button_text && $slide->button_url)
                <a href="{{ $slide->button_url }}"
                   class="inline-flex items-center space-x-2
                          bg-green-600 hover:bg-green-500
                          text-white font-bold px-8 py-4
                          rounded-full transition-all duration-300
                          shadow-2xl">
                    <span>{{ $slide->button_text }}</span>
                    <i class="fas fa-arrow-right text-sm"></i>
                </a>
                @endif

            </div>
        </div>
    </div>
</div>
@empty
            {{-- ── SLIDER YOK — Varsayılan ── --}}
            <div class="swiper-slide relative overflow-hidden">

                {{-- Arka plan gradient --}}
                <div class="absolute inset-0"
                     style="background: linear-gradient(135deg,
                            #030712 0%, #052e16 40%,
                            #450a0a 80%, #030712 100%)">
                </div>

                {{-- Watermark Logo --}}
                <div class="absolute inset-0 flex items-center
                            justify-center pointer-events-none">
                    <img src="{{ asset('images/logo.png') }}"
                         alt=""
                         class="select-none"
                         style="width: clamp(280px, 32vw, 480px);
                                opacity: 0.12;
                                filter: grayscale(20%)">
                </div>

                {{-- İçerik --}}
                <div class="relative z-10 h-full flex items-center
                            justify-center text-center">
                    <div class="px-6">
                        <div class="flex items-center justify-center
                                    space-x-3 mb-6">
                            <div class="w-8 h-px bg-green-500"></div>
                            <span class="text-green-400 text-xs font-bold
                                         uppercase tracking-[0.3em]">
                                Resmi Web Sitesi
                            </span>
                            <div class="w-8 h-px bg-green-500"></div>
                        </div>

                        <h1 class="font-black text-white leading-none mb-3"
                            style="font-size: clamp(3.5rem, 9vw, 7rem);
                                   letter-spacing: -2px">
                            ESER SPOR
                        </h1>
                        <p class="font-bold text-green-400 tracking-[0.4em]
                                  uppercase mb-8"
                           style="font-size: clamp(1rem, 2vw, 1.4rem)">
                            Kulübü
                        </p>
                        <p class="text-gray-400 text-lg mb-10
                                  max-w-lg mx-auto leading-relaxed">
                            Futbol, Voleybol ve Halter branşlarımızda
                            yüzlerce sporcu yetiştiriyoruz.
                        </p>

                        <div class="flex flex-wrap items-center
                                    justify-center gap-4">
                            <a href="{{ route('branch.index') }}"
                               class="inline-flex items-center space-x-2
                                      bg-green-600 hover:bg-green-500
                                      text-white font-bold px-10 py-4
                                      rounded-full transition-all duration-300
                                      shadow-xl shadow-green-600/40">
                                <span>Branşlarımızı Keşfet</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                            <a href="{{ route('about.index') }}"
                               class="inline-flex items-center space-x-2
                                      bg-white/10 hover:bg-white/20
                                      text-white font-semibold px-8 py-4
                                      rounded-full border border-white/20
                                      transition-all duration-300
                                      backdrop-blur-sm">
                                <span>Hakkımızda</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforelse

        </div>

        {{-- Swiper Kontrolleri --}}
        <div class="swiper-pagination !bottom-6"></div>
        <div class="swiper-button-prev
                    !text-white !w-11 !h-11
                    !bg-white/10 hover:!bg-green-600
                    rounded-full !transition-all !duration-300
                    backdrop-blur-sm after:!text-sm !left-6">
        </div>
        <div class="swiper-button-next
                    !text-white !w-11 !h-11
                    !bg-white/10 hover:!bg-green-600
                    rounded-full !transition-all !duration-300
                    backdrop-blur-sm after:!text-sm !right-6">
        </div>
    </div>
</section>


{{-- ══════════════════════════════════════
     2. STATS BAR

{{-- ══════════════════════════════════════
     2. SON MAÇ & YAKLAŞAN
══════════════════════════════════════ --}}
<section class="bg-gray-900 py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            {{-- Son Sonuçlar --}}
            <div>
                <div class="flex items-center justify-between mb-5">
                    <h2 class="text-white font-extrabold text-xl flex items-center">
                        <span class="w-1.5 h-6 bg-green-500 rounded-full mr-3 inline-block"></span>
                        Son Maç Sonuçları
                    </h2>
                    <a href="{{ route('branch.show', 'futbol') }}"
                       class="text-green-400 text-sm hover:text-green-300 transition font-medium">
                        Tümü →
                    </a>
                </div>
                <div class="space-y-3">
                    @forelse($lastResults as $result)
                    <div class="bg-gray-800 rounded-2xl px-5 py-4 border border-gray-700">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-green-400 text-xs font-bold uppercase tracking-wider">
                                {{ $result->branch->name ?? '' }}
                                @if($result->competition) — {{ $result->competition }} @endif
                            </span>
                            <span class="text-gray-500 text-xs">
                                {{ $result->match_date->format('d.m.Y') }}
                            </span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-white font-bold text-sm flex-1 text-right pr-4">
                                {{ $result->home_team }}
                            </span>
                            <div class="bg-gray-900 rounded-xl px-5 py-2.5 border border-gray-600">
                                <span class="text-white font-extrabold text-xl">
                                    {{ $result->home_score }}
                                </span>
                                <span class="text-gray-500 mx-2 font-bold">–</span>
                                <span class="text-white font-extrabold text-xl">
                                    {{ $result->away_score }}
                                </span>
                            </div>
                            <span class="text-white font-bold text-sm flex-1 pl-4">
                                {{ $result->away_team }}
                            </span>
                        </div>
                    </div>
                    @empty
                    <div class="bg-gray-800 rounded-2xl px-5 py-10 text-center
                                text-gray-500 border border-gray-700">
                        <i class="fas fa-futbol text-3xl mb-2 block text-gray-700"></i>
                        Henüz sonuç girilmemiş.
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- Yaklaşan Maçlar --}}
            <div>
                <div class="flex items-center justify-between mb-5">
                    <h2 class="text-white font-extrabold text-xl flex items-center">
                        <span class="w-1.5 h-6 bg-red-500 rounded-full mr-3 inline-block"></span>
                        Yaklaşan Maçlar
                    </h2>
                </div>
                <div class="space-y-3">
                    @forelse($upcomingFixtures as $fixture)
                    <div class="bg-gray-800 rounded-2xl px-5 py-4 border border-gray-700">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-red-400 text-xs font-bold uppercase tracking-wider">
                                {{ $fixture->branch->name ?? '' }}
                                @if($fixture->competition) — {{ $fixture->competition }} @endif
                            </span>
                            <span class="text-gray-500 text-xs">
                                {{ $fixture->match_date->format('d.m.Y H:i') }}
                            </span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-white font-bold text-sm flex-1 text-right pr-4">
                                {{ $fixture->home_team }}
                            </span>
                            <div class="bg-gray-900 rounded-xl px-5 py-2.5 border border-gray-600">
                                <span class="text-gray-400 font-extrabold text-sm tracking-widest">VS</span>
                            </div>
                            <span class="text-white font-bold text-sm flex-1 pl-4">
                                {{ $fixture->away_team }}
                            </span>
                        </div>
                        @if($fixture->venue)
                        <p class="text-gray-500 text-xs text-center mt-2">
                            <i class="fas fa-map-marker-alt mr-1 text-red-400"></i>{{ $fixture->venue }}
                        </p>
                        @endif
                    </div>
                    @empty
                    <div class="bg-gray-800 rounded-2xl px-5 py-10 text-center
                                text-gray-500 border border-gray-700">
                        <i class="fas fa-calendar text-3xl mb-2 block text-gray-700"></i>
                        Yaklaşan maç bulunmuyor.
                    </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</section>


{{-- ══════════════════════════════════════
     3. BRANŞLARIMIZ 
══════════════════════════════════════ --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-14">
            <span class="text-green-600 font-bold text-sm uppercase tracking-widest">
                Spor Ailemiz
            </span>
            <h2 class="text-4xl font-extrabold text-gray-900 mt-2">Branşlarımız</h2>
            <p class="text-gray-500 mt-3 max-w-xl mx-auto">
                Üç farklı branşta yüzlerce sporcumuzu yetiştiriyor,
                başarılarını sahaya taşıyoruz.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($branches as $branch)
            <a href="{{ route('branch.show', $branch->slug) }}"
               class="group relative overflow-hidden rounded-3xl shadow-xl
                      transform transition duration-300 hover:-translate-y-2 hover:shadow-2xl
                      min-h-[280px] flex flex-col">

                {{-- Arka plan --}}
                @if($branch->cover_image)
                <div class="absolute inset-0 bg-cover bg-center opacity-40
                            group-hover:opacity-60 transition duration-500"
                     style="background-image: url('{{ asset('storage/' . $branch->cover_image) }}')">
                </div>
                @endif
                <div class="absolute inset-0"
                     style="background: linear-gradient(135deg,
                            rgba(4,120,87,0.92) 0%,
                            rgba(17,24,39,0.95) 100%)">
                </div>

                {{-- Dekoratif daire --}}
                <div class="absolute -right-8 -top-8 w-32 h-32 bg-white/5
                            rounded-full"></div>
                <div class="absolute -left-6 -bottom-6 w-24 h-24 bg-white/5
                            rounded-full"></div>

                <div class="relative z-10 p-8 flex flex-col flex-1 justify-between">
                    <div>
                        <div class="text-5xl mb-4">{{ $branch->icon }}</div>
                        <h3 class="text-2xl font-extrabold text-white mb-2">
                            {{ $branch->name }}
                        </h3>
                        @if($branch->description)
                        <p class="text-gray-300 text-sm leading-relaxed">
                            {{ Str::limit($branch->description, 90) }}
                        </p>
                        @endif
                    </div>
                    <div class="mt-6">
                        <span class="inline-flex items-center space-x-2
                                     text-green-300 group-hover:text-white
                                     font-bold text-sm transition duration-200">
                            <span>Detayları İncele</span>
                            <i class="fas fa-arrow-right transform
                                      group-hover:translate-x-1 transition duration-200"></i>
                        </span>
                    </div>
                </div>
            </a>
            @endforeach

</section>


{{-- ══════════════════════════════════════
     4. HAKKIMIZDA — Renk geçişli arka plan
══════════════════════════════════════ --}}
<section class="py-20 relative overflow-hidden"
         style="background: linear-gradient(135deg, #f0fdf4 0%, #fff 40%, #fef2f2 100%)">

    {{-- Dekoratif --}}
    <div class="absolute top-0 left-0 w-96 h-96 bg-green-600/5 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-80 h-80 bg-red-600/5 rounded-full translate-x-1/3 translate-y-1/3"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            <div class="relative flex items-center justify-center">
                <div class="absolute w-72 h-72 bg-green-600/10 rounded-full animate-pulse"></div>
                <div class="absolute w-52 h-52 bg-red-600/10 rounded-full
                            -translate-x-6 translate-y-6"></div>
                <img src="{{ asset('images/logo.png') }}"
                     alt="Eser Spor Kulübü"
                     class="relative z-10 w-60 drop-shadow-2xl">
            </div>

            <div>
                <span class="text-green-600 font-bold text-sm uppercase tracking-widest">
                    Biz Kimiz?
                </span>
                <h2 class="text-4xl font-extrabold text-gray-900 mt-2 mb-5">
                    Eser Spor Kulübü
                </h2>
                <p class="text-gray-600 leading-relaxed mb-4">
                    Eser Spor Kulübü olarak yıllar içinde büyüyen bir spor ailesi oluşturduk.
                    Futbol, Voleybol ve Halter branşlarımızda sporcuları yetiştirerek
                    sahaya kazandırdık.
                </p>
                <p class="text-gray-600 leading-relaxed mb-8">
                    Misyonumuz; sporu seven, sporla büyüyen nesiller yetiştirmek.
                    Vizyonumuz; bölgemizin en güçlü ve köklü spor kulübü olmak.
                </p>

                <div class="grid grid-cols-3 gap-4 mb-8">
                    <div class="text-center bg-white rounded-2xl p-4 shadow-sm
                                border border-gray-100">
                        <div class="text-3xl font-extrabold text-green-600">3</div>
                        <div class="text-xs text-gray-500 mt-1 font-medium">Branş</div>
                    </div>
                    <div class="text-center bg-white rounded-2xl p-4 shadow-sm
                                border border-gray-100">
                        <div class="text-3xl font-extrabold text-green-600">100+</div>
                        <div class="text-xs text-gray-500 mt-1 font-medium">Sporcu</div>
                    </div>
                    <div class="text-center bg-white rounded-2xl p-4 shadow-sm
                                border border-gray-100">
                        <div class="text-3xl font-extrabold text-green-600">50+</div>
                        <div class="text-xs text-gray-500 mt-1 font-medium">Kupa</div>
                    </div>
                </div>

                <a href="{{ route('about.index') }}"
                   class="inline-flex items-center space-x-2
                          bg-green-600 hover:bg-green-700 text-white
                          font-bold px-8 py-3.5 rounded-full
                          transition duration-300 shadow-lg shadow-green-600/30">
                    <span>Daha Fazla</span>
                    <i class="fas fa-arrow-right text-sm"></i>
                </a>
            </div>
        </div>
    </div>
</section>


{{-- ══════════════════════════════════════
     5. SON HABERLER — Renk geçişli arka plan
══════════════════════════════════════ --}}
<section class="py-20"
         style="background: linear-gradient(180deg, #ffffff 0%, #f9fafb 100%)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-center justify-between mb-12">
            <div>
                <span class="text-green-600 font-bold text-sm uppercase tracking-widest">
                    Güncel
                </span>
                <h2 class="text-4xl font-extrabold text-gray-900 mt-1">Son Haberler</h2>
            </div>
            <a href="{{ route('news.news') }}"
               class="hidden sm:inline-flex items-center space-x-1
                      text-green-600 hover:text-green-700 font-bold text-sm transition">
                <span>Tüm Haberler</span>
                <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($latestNews as $news)
            <article class="group bg-white rounded-3xl shadow-md overflow-hidden
                            hover:shadow-xl transition duration-300
                            transform hover:-translate-y-1 border border-gray-100">
                <div class="relative overflow-hidden h-52">
                    @if($news->cover_image)
                    <img src="{{ $news->cover_image_url }}" alt="{{ $news->title }}"
                         class="w-full h-full object-cover
                                group-hover:scale-105 transition duration-500">
                    @else
                    <div class="w-full h-full flex items-center justify-center"
                         style="background: linear-gradient(135deg, #064e3b, #111827)">
                        <i class="fas fa-newspaper text-5xl text-white/20"></i>
                    </div>
                    @endif
                    <span class="absolute top-3 left-3 bg-green-600 text-white
                                 text-xs font-bold px-3 py-1 rounded-full">
                        Haber
                    </span>
                </div>
                <div class="p-6">
                    <p class="text-gray-400 text-xs mb-2">
                        <i class="far fa-calendar mr-1"></i>
                        {{ $news->published_at?->format('d.m.Y') }}
                    </p>
                    <h3 class="font-extrabold text-gray-900 text-lg leading-tight mb-2
                               group-hover:text-green-600 transition duration-200">
                        {{ Str::limit($news->title, 60) }}
                    </h3>
                    @if($news->excerpt)
                    <p class="text-gray-500 text-sm leading-relaxed mb-4">
                        {{ Str::limit($news->excerpt, 100) }}
                    </p>
                    @endif
                    <a href="{{ route('news.show', $news->slug) }}"
                       class="inline-flex items-center space-x-1
                              text-green-600 hover:text-green-700
                              font-bold text-sm transition">
                        <span>Devamını Oku</span>
                        <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </article>
            @empty
            <div class="col-span-3 text-center text-gray-400 py-12">
                <i class="fas fa-newspaper text-4xl mb-3 block text-gray-200"></i>
                Henüz haber eklenmemiş.
            </div>
            @endforelse
        </div>
    </div>
</section>


{{-- ══════════════════════════════════════
     6. CTA BANDI
══════════════════════════════════════ --}}
<section class="relative py-20 overflow-hidden"
         style="background: linear-gradient(135deg, #15803d 0%, #166534 50%, #991b1b 100%)">
    <div class="absolute inset-0 opacity-10">
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-4">
            Eser Spor Ailesine Katıl!
        </h2>
        <p class="text-green-100 text-lg mb-8 max-w-xl mx-auto">
            Sporcu olmak, forma giymek veya sponsor olmak istiyorsan
            bizimle iletişime geç.
        </p>
        <a href="{{ route('contact.form') }}"
           class="inline-flex items-center space-x-2
                  bg-white text-green-700 hover:bg-gray-100
                  font-extrabold px-10 py-4 rounded-full
                  transition duration-300 shadow-2xl">
            <i class="fas fa-paper-plane"></i>
            <span>Bize Ulaş</span>
        </a>
    </div>
</section>

@endsection

@push('scripts')
<script>
new Swiper('.hero-swiper', {
    loop: true,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    effect: 'slide',
    speed: 800,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
        renderBullet: (i, cls) =>
            `<span class="${cls}"
                   style="width:32px; height:3px;
                          border-radius:2px;
                          background:#16a34a">
             </span>`
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
});
</script>
@endpush