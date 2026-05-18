<article class="group bg-white rounded-3xl overflow-hidden shadow-sm
                hover:shadow-xl transition-all duration-300
                transform hover:-translate-y-1 border border-gray-100">

    <div class="relative overflow-hidden h-52">
        @if($item->cover_image)
        <img src="{{ $item->cover_image_url }}" alt="{{ $item->title }}"
             class="w-full h-full object-cover
                    group-hover:scale-110 transition-transform duration-700">
        @else
        <div class="w-full h-full flex items-center justify-center"
             style="background: linear-gradient(135deg, #064e3b, #111827)">
            <i class="fas fa-newspaper text-5xl text-white/10"></i>
        </div>
        @endif
        <span class="absolute top-4 left-4 text-white text-[10px] font-black
                     px-3 py-1.5 rounded-full uppercase tracking-wider
                     {{ $item->type === 'haber' ? 'bg-green-600' : 'bg-purple-600' }}">
            {{ ucfirst($item->type) }}
        </span>
    </div>

    <div class="p-6">
        <p class="text-gray-400 text-xs mb-2">
            <i class="far fa-calendar mr-1"></i>
            {{ $item->published_at?->format('d M Y') }}
        </p>
        <h3 class="font-black text-gray-900 text-lg leading-tight mb-2
                   group-hover:text-green-600 transition duration-200"
            style="letter-spacing: -0.3px">
            {{ Str::limit($item->title, 65) }}
        </h3>
        @if($item->excerpt)
        <p class="text-gray-400 text-sm leading-relaxed mb-4">
            {{ Str::limit($item->excerpt, 100) }}
        </p>
        @endif
        <a href="{{ route('news.show', $item->slug) }}"
           class="inline-flex items-center space-x-2
                  text-green-600 hover:text-green-700
                  font-bold text-sm transition duration-200 group/link">
            <span>Devamını Oku</span>
            <i class="fas fa-arrow-right text-xs transform
                      group-hover/link:translate-x-1 transition duration-200"></i>
        </a>
    </div>
</article>