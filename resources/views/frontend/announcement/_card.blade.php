<article class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100">
    <div class="p-8">
        <div class="flex items-center gap-2 mb-4">
            <span class="bg-green-100 text-green-700 text-[10px] font-bold px-3 py-1 rounded-full uppercase">
                Güncel
            </span>
            <span class="text-gray-400 text-xs font-medium">
                <i class="far fa-calendar-alt mr-1"></i> {{ $item->published_at }}
            </span>
        </div>
        
        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-green-600 transition-colors line-clamp-2">
            {{ $item->title }}
        </h3>
        
        <p class="text-gray-500 text-sm leading-relaxed mb-6 line-clamp-3">
            {{ $item->excerpt ?? Str::limit(strip_tags($item->content), 120) }}
        </p>

        <a href="{{ route('announcement.show', $item->slug) }}" 
           class="inline-flex items-center font-bold text-sm text-green-600 group/link">
            DETAYLI OKU 
            <svg class="w-4 h-4 ml-2 transform group-hover/link:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
            </svg>
        </a>
    </div>
</article>