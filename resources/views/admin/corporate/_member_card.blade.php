<div class="bg-white rounded-2xl shadow-sm p-5 border border-gray-100
            hover:shadow-md transition duration-200">
    <div class="flex items-center space-x-4 mb-4">

        {{-- Fotoğraf --}}
        <div class="w-14 h-14 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0">
            @if($member->photo)
            <img src="{{ $member->photo_url }}"
                 class="w-full h-full object-cover">
            @else
            <div class="w-full h-full flex items-center justify-center
                        bg-gradient-to-br from-green-100 to-green-200">
                <span class="text-green-700 font-black text-lg">
                    {{ strtoupper(substr($member->name, 0, 1)) }}
                </span>
            </div>
            @endif
        </div>

        {{-- Bilgi --}}
        <div class="flex-1 min-w-0">
            <p class="font-bold text-gray-900 truncate">{{ $member->name }}</p>
            <p class="text-gray-500 text-xs truncate">{{ $member->title }}</p>
            @if($member->is_active)
            <span class="badge-success text-[10px] mt-1 inline-block">Aktif</span>
            @else
            <span class="badge-danger text-[10px] mt-1 inline-block">Pasif</span>
            @endif
        </div>
    </div>

    {{-- İletişim --}}
    @if($member->email || $member->phone)
    <div class="space-y-1 mb-4 pb-4 border-b border-gray-100">
        @if($member->email)
        <p class="text-gray-400 text-xs truncate">
            <i class="fas fa-envelope mr-1.5 text-gray-300 w-3"></i>
            {{ $member->email }}
        </p>
        @endif
        @if($member->phone)
        <p class="text-gray-400 text-xs">
            <i class="fas fa-phone mr-1.5 text-gray-300 w-3"></i>
            {{ $member->phone }}
        </p>
        @endif
    </div>
    @endif

    {{-- Aksiyonlar --}}
    <div class="flex items-center space-x-2">
        <a href="{{ route('admin.corporate.edit', $member->id) }}"
           class="flex-1 text-center text-xs font-semibold text-blue-600
                  bg-blue-50 hover:bg-blue-100 py-2 rounded-lg transition duration-150">
            <i class="fas fa-edit mr-1"></i> Düzenle
        </a>
        <form method="POST"
              action="{{ route('admin.corporate.destroy', $member->id) }}"
              onsubmit="return confirm('Bu üyeyi silmek istediğine emin misin?')">
            @csrf @method('DELETE')
            <button class="px-4 py-2 text-xs font-semibold text-red-500
                           bg-red-50 hover:bg-red-100 rounded-lg transition duration-150">
                <i class="fas fa-trash"></i>
            </button>
        </form>
    </div>
</div>