<div class="bg-white rounded-3xl overflow-hidden shadow-sm
            hover:shadow-xl transition-all duration-300
            transform hover:-translate-y-1 border border-gray-100 text-center">

    {{-- Fotoğraf --}}
    <div class="pt-8 px-8">
        <div class="w-28 h-28 rounded-full overflow-hidden mx-auto
                    border-4 border-green-100 shadow-lg">
            @if($member->photo)
            <img src="{{ $member->photo_url }}"
                 alt="{{ $member->name }}"
                 class="w-full h-full object-cover">
            @else
            <div class="w-full h-full flex items-center justify-center"
                 style="background: linear-gradient(135deg, #16a34a, #052e16)">
                <span class="text-white font-black text-3xl">
                    {{ strtoupper(substr($member->name, 0, 1)) }}
                </span>
            </div>
            @endif
        </div>
    </div>

    {{-- Bilgi --}}
    <div class="p-6">
        <h3 class="font-black text-gray-900 text-lg leading-tight mb-1"
            style="letter-spacing: -0.3px">
            {{ $member->name }}
        </h3>
        <p class="text-green-600 font-bold text-sm mb-3">
            {{ $member->title }}
        </p>
        @if($member->bio)
        <p class="text-gray-400 text-xs leading-relaxed">
            {{ Str::limit($member->bio, 100) }}
        </p>
        @endif
    </div>
</div>