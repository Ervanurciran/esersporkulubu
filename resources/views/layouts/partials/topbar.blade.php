<header class="bg-white shadow-sm h-16 flex items-center justify-between px-6 flex-shrink-0">

    {{-- Sidebar Toggle --}}
    <button @click="sidebarOpen = !sidebarOpen"
            class="text-gray-500 hover:text-gray-700 transition">
        <i class="fas fa-bars text-xl"></i>
    </button>

    {{-- Sağ Taraf --}}
    <div class="flex items-center space-x-4">

        {{-- Okunmamış Mesaj Bildirimi --}}
        @php $unread = \App\Models\Contact::unread()->count(); @endphp
        @if($unread > 0)
        <a href="{{ route('admin.contact.index') }}"
           class="relative text-gray-500 hover:text-green-600 transition">
            <i class="fas fa-envelope text-xl"></i>
            <span class="absolute -top-1 -right-1 bg-red-500 text-white
                         text-xs rounded-full w-4 h-4 flex items-center justify-center">
                {{ $unread }}
            </span>
        </a>
        @endif

        {{-- Siteyi Görüntüle --}}
        <a href="{{ route('home') }}" target="_blank"
           class="text-sm text-gray-500 hover:text-green-600 transition flex items-center space-x-1">
            <i class="fas fa-external-link-alt"></i>
            <span>Siteyi Gör</span>
        </a>

        {{-- Kullanıcı Adı --}}
        <div class="flex items-center space-x-2 text-sm text-gray-700 font-medium">
            <div class="w-8 h-8 bg-green-600 rounded-full flex items-center justify-center text-white text-xs font-bold">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <span>{{ auth()->user()->name }}</span>
        </div>
    </div>
</header>