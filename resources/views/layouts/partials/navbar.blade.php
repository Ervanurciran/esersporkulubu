<nav class="bg-white shadow-md sticky top-0 z-50" x-data="{ open: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">

            {{-- LOGO + YAZI --}}
            <a href="{{ route('home') }}" class="flex items-center space-x-3 group">

                {{-- Logo --}}
                <img src="{{ asset('images/logo.png') }}"
                     alt="Eser Spor"
                     class="h-12 w-auto transition-transform duration-300
                            group-hover:scale-105 drop-shadow-sm">

                {{-- Dikey ayraç --}}
                <div class="w-px h-10 bg-gray-200"></div>

                {{-- Yazı --}}
                <div class="flex flex-col leading-none">
                    <span class="font-black text-gray-900 group-hover:text-green-600
                                 transition duration-200"
                          style="font-size: 20px; letter-spacing: -0.5px">
                        ESER SPOR
                    </span>
                    <span class="font-bold text-green-600 uppercase mt-0.5"
                          style="font-size: 9px; letter-spacing: 0.25em">
                        Kulübü
                    </span>
                </div>
            </a>

            {{-- DESKTOP MENU --}}
            <div class="hidden lg:flex items-center gap-x-10">

                <a href="{{ route('home') }}"
                   class="nav-link {{ request()->routeIs('home') ? 'nav-link-active' : '' }}">
                    Ana Sayfa
                </a>

                <div class="relative" x-data="{ open: false }"
                    @mouseenter="open = true" @mouseleave="open = false">

                    <button class="nav-link flex items-center space-x-1 {{ request()->routeIs('about.*') ? 'nav-link-active' : '' }}">
                        <span>Hakkımızda</span>
                        <i class="fas fa-chevron-down text-xs transition duration-200" :class="open ? 'rotate-180' : ''"></i>
                    </button>

                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="absolute top-full left-0 bg-white rounded-xl shadow-2xl border border-gray-100 z-50 py-2 w-56">

                        {{-- Tarihçe --}}
                        <a href="{{ route('about.history') }}" class="dropdown-item">
                            <i class="w-4 text-gray-500"></i>Tarihçe
                        </a>

                        {{-- Misyon & Vizyon --}}
                        <a href="{{ route('about.mission') }}" class="dropdown-item">
                            <i class="w-4 text-gray-500"></i>Misyon & Vizyon
                        </a>

                    </div>
                </div>

                {{-- Kurumsal --}}
                <div class="relative" x-data="{ open: false }"
                    @mouseenter="open = true" @mouseleave="open = false">
                    <button class="nav-link flex items-center space-x-1 {{ request()->routeIs('corporate.*') ? 'nav-link-active' : '' }}">
                        <span>Kurumsal</span>
                        <i class="fas fa-chevron-down text-xs transition duration-200" :class="open ? 'rotate-180' : ''"></i>
                    </button>

                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="absolute top-full left-0 bg-white rounded-xl shadow-2xl border border-gray-100 z-50 py-2 w-56">

                        {{-- Başkan --}}
                        <a href="{{ route('corporate.president') }}" class="dropdown-item">
                            <i class="w-4 text-gray-500"></i>Başkan
                        </a>

                        {{-- Yönetim Kurulu --}}
                        <a href="{{ route('corporate.board') }}" class="dropdown-item">
                            <i class="w-4 text-gray-500"></i>Yönetim Kurulu
                        </a>

                        {{-- Denetim Kurulu --}}
                        <a href="{{ route('corporate.audit') }}" class="dropdown-item">
                            <i class="w-4 text-gray-500"></i>Denetim Kurulu
                        </a>

                        {{-- Tüzük --}}
                        <a href="{{ route('corporate.statute') }}" class="dropdown-item">
                            <i class="w-4 text-gray-500"></i>Tüzük
                        </a>

                    </div>
                </div>

                {{-- Branşlar --}}
                <div class="relative" x-data="{ open: false, timer: null }"
                    @mouseenter="clearTimeout(timer); open = true"
                    @mouseleave="timer = setTimeout(() => open = false, 150)">

                    <button class="nav-link flex items-center space-x-1 {{ request()->routeIs('branch.*') ? 'nav-link-active' : '' }}">
                        <span>Branşlar</span>
                        <i class="fas fa-chevron-down text-xs transition duration-200" :class="open ? 'rotate-180' : ''"></i>
                    </button>

                    {{-- Ana Dropdown (Branş Listesi) --}}
                    <div x-show="open"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 -translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="absolute top-full left-0 bg-white rounded-xl shadow-2xl border border-gray-100 z-50 py-2 w-56"
                        style="margin-top: 0;">

                        {{-- Görünmez köprü --}}
                        <div style="position:absolute; top:-10px; left:0; right:0; height:10px; background:transparent"></div>

                        {{-- Branş Elemanları --}}
                        <div class="flex flex-col space-y-1 px-2">

                            {{-- ⚽ FUTBOL --}}
                            <div class="relative group/sub" x-data="{ subOpen: false }">
                                <div @mouseenter="subOpen = true"
                                     @mouseleave="subOpen = false"
                                    class="flex items-center justify-between px-4 py-2.5 hover:bg-green-50 hover:text-green-600 cursor-pointer rounded-lg transition duration-150">
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('branch.show', 'futbol') }}" class="flex items-center space-x-3 flex-1">
                                            <span>⚽</span>
                                            <span class="text-sm font-normal">Futbol</span>
                                        </a>
                                    </div>
                                    <i class="fas fa-chevron-right text-[10px]"></i>

                                    {{-- YAN SEKME (Futbol Alt Menüsü) --}}
                                    <div x-show="subOpen" class="absolute left-full top-0 ml-1 bg-white rounded-xl shadow-2xl border border-gray-100 py-2 w-48">
                                        <a href="{{ route('branch.show', 'futbol') }}" class="dropdown-item">
                                            <i class="w-4 text-gray-500"></i>Genel
                                        </a>

                                        <a href="{{ route('branch.fixture', 'futbol') }}" class="dropdown-item">
                                            <i class="w-4 text-gray-500"></i>Fikstür
                                        </a>

                                        <a href="{{ route('branch.results', 'futbol') }}" class="dropdown-item">
                                            <i class="w-4 text-gray-500"></i>Sonuçlar
                                        </a>

                                        <a href="{{ route('branch.standings', 'futbol') }}" class="dropdown-item">
                                            <i class="w-4 text-gray-500"></i>Puan Durumu
                                        </a>

                                        <a href="{{ route('branch.coaches', 'futbol') }}" class="dropdown-item">
                                            <i class="w-4 text-gray-500"></i>Antrenörler
                                        </a>

                                    </div>
                                </div>
                            </div>

                            {{-- 🏐 VOLEYBOL --}}
                            <div class="relative group/sub" x-data="{ subOpen: false }">
                                <div @mouseenter="subOpen = true"
                                     @mouseleave="subOpen = false"
                                    class="flex items-center justify-between px-4 py-2.5 hover:bg-green-50 hover:text-green-600 cursor-pointer rounded-lg transition duration-150">
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('branch.show', 'voleybol') }}" class="flex items-center space-x-3 flex-1">
                                            <span>🏐</span>
                                            <span class="text-sm font-normal">Voleybol</span>
                                        </a>
                                    </div>
                                    <i class="fas fa-chevron-right text-[10px]"></i>

                                    {{-- YAN SEKME (Voleybol Alt Menüsü) --}}
                                    <div x-show="subOpen" class="absolute left-full top-0 ml-1 bg-white rounded-xl shadow-2xl border border-gray-100 py-2 w-48">
                                        <a href="{{ route('branch.show', 'voleybol') }}" class="dropdown-item">
                                            <i class="w-4 text-gray-500"></i>Genel
                                        </a>

                                        <a href="{{ route('branch.fixture', 'voleybol') }}" class="dropdown-item">
                                            <i class="w-4 text-gray-500"></i>Fikstür
                                        </a>

                                        <a href="{{ route('branch.results', 'voleybol') }}" class="dropdown-item">
                                            <i class="w-4 text-gray-500"></i>Sonuçlar
                                        </a>

                                        <a href="{{ route('branch.standings', 'voleybol') }}" class="dropdown-item">
                                            <i class="w-4 text-gray-500"></i>Puan Durumu
                                        </a>

                                        <a href="{{ route('branch.coaches', 'voleybol') }}" class="dropdown-item">
                                            <i class="w-4 text-gray-500"></i>Antrenörler
                                        </a>
                                    </div>
                                </div>
                            </div>

                            {{-- 🏋️ HALTER --}}
                            <div class="relative group/sub" x-data="{ subOpen: false }">
                                <div @mouseenter="subOpen = true"
                                     @mouseleave="subOpen = false"
                                    class="flex items-center justify-between px-4 py-2.5 hover:bg-green-50 hover:text-green-600 cursor-pointer rounded-lg transition duration-150">

                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('branch.show', 'halter') }}" class="flex items-center space-x-3 flex-1">
                                            <span>🏋️</span>
                                            <span class="text-sm font-normal">Halter</span>
                                        </a>
                                    </div>
                                    <i class="fas fa-chevron-right text-[10px]"></i>

                                    {{-- YAN SEKME (Halter Alt Menüsü) --}}
                                    <div x-show="subOpen" class="absolute left-full top-0 ml-1 bg-white rounded-xl shadow-2xl border border-gray-100 py-2 w-48">
                                        <a href="{{ route('branch.show', 'halter') }}" class="dropdown-item">
                                            <i class="w-4 text-gray-500"></i>Genel
                                        </a>

                                        <a href="{{ route('branch.fixture', 'halter') }}" class="dropdown-item">
                                            <i class="w-4 text-gray-500"></i>Fikstür
                                        </a>

                                        <a href="{{ route('branch.results', 'halter') }}" class="dropdown-item">
                                            <i class="w-4 text-gray-500"></i>Sonuçlar
                                        </a>

                                        <a href="{{ route('branch.standings', 'halter') }}" class="dropdown-item">
                                            <i class="w-4 text-gray-500"></i>Puan Durumu
                                        </a>

                                        <a href="{{ route('branch.coaches', 'halter') }}" class="dropdown-item">
                                            <i class="w-4 text-gray-500"></i>Antrenörler
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Haberler (Açılır Menü / Dropdown) --}}
                <div class="relative" x-data="{ open: false, timer: null }"
                     @mouseenter="clearTimeout(timer); open = true"
                     @mouseleave="timer = setTimeout(() => open = false, 150)">

                    <button class="nav-link flex items-center space-x-1
                                   {{ request()->routeIs('news.*') ? 'nav-link-active' : '' }}">
                        <span>Haberler</span>
                        <i class="fas fa-chevron-down text-xs transition duration-200"
                           :class="open ? 'rotate-180' : ''"></i>
                    </button>

                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         @mouseenter="clearTimeout(timer)"
                         @mouseleave="timer = setTimeout(() => open = false, 150)"
                         class="dropdown-menu">

                        <a href="{{ route('news.news') }}" class="dropdown-item">
                            <i class="w-4 text-gray-500"></i>Haberler
                        </a>

                        <a href="{{ route('news.events') }}" class="dropdown-item">
                            <i class="w-4 text-gray-500"></i>Etkinlikler
                        </a>
                    </div>
                </div>

                {{-- Duyurular --}}
                <a href="{{ route('announcement.index') }}"
                   class="nav-link flex items-center space-x-2 {{ request()->routeIs('gallery.*') ? 'nav-link-active' : '' }}">
                    <span>Duyurular</span>
                </a>

                {{-- Galeri --}}
                <a href="{{ route('gallery.index') }}"
                   class="nav-link flex items-center space-x-2 {{ request()->routeIs('gallery.*') ? 'nav-link-active' : '' }}">
                    <span>Galeri</span>
                </a>

                {{-- İletişim Butonu --}}
                <a href="{{ route('contact.form') }}"
                   class="ml-3 bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-full font-semibold text-sm transition duration-200 shadow-sm flex items-center space-x-2">
                    <span>İletişim</span>
                </a>

            </div>
            {{-- /DESKTOP MENU --}}

            {{-- MOBİL HAMBURGER (artık desktop menünün DIŞINDA, kardeş eleman) --}}
            <button @click="open = !open"
                    class="lg:hidden p-2 rounded-lg text-gray-700 hover:text-green-600
                           hover:bg-green-50 transition duration-200">
                <i x-show="!open" class="fas fa-bars text-2xl"></i>
                <i x-show="open"  class="fas fa-times text-2xl"></i>
            </button>

        </div>
        {{-- /flex justify-between --}}

        {{-- MOBİL MENU --}}
        <div x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="lg:hidden bg-white border-t border-gray-100 shadow-lg">
            <div class="px-3 py-4 flex flex-col gap-1 max-h-[75vh] overflow-y-auto">

                <a href="{{ route('home') }}"
                   class="block px-4 py-3 text-gray-800 hover:text-green-600 hover:bg-green-50 rounded-xl font-semibold text-sm transition duration-150">
                    Ana Sayfa
                </a>

                {{-- Hakkımızda --}}
                <div x-data="{ sub: false }" class="border-b border-gray-100 pb-1">
                    <button @click="sub = !sub" type="button"
                            class="flex items-center justify-between w-full px-4 py-3 text-gray-800 font-semibold text-sm hover:text-green-600 hover:bg-green-50 rounded-xl transition duration-150">
                        <span>Hakkımızda</span>
                        <i class="fas fa-chevron-down text-xs transition duration-200" :class="sub ? 'rotate-180 text-green-600' : ''"></i>
                    </button>
                    <div x-show="sub"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="flex flex-col gap-1 pl-3 pt-1 pb-2">
                        <a href="{{ route('about.history') }}"
                           class="block px-4 py-2.5 text-sm text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition duration-150">
                            Tarihçe
                        </a>
                        <a href="{{ route('about.mission') }}"
                           class="block px-4 py-2.5 text-sm text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition duration-150">
                            Misyon & Vizyon
                        </a>
                    </div>
                </div>

                {{-- Kurumsal --}}
                <div x-data="{ sub: false }" class="border-b border-gray-100 pb-1">
                    <button @click="sub = !sub" type="button"
                            class="flex items-center justify-between w-full px-4 py-3 text-gray-800 font-semibold text-sm hover:text-green-600 hover:bg-green-50 rounded-xl transition duration-150">
                        <span>Kurumsal</span>
                        <i class="fas fa-chevron-down text-xs transition duration-200" :class="sub ? 'rotate-180 text-green-600' : ''"></i>
                    </button>
                    <div x-show="sub"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="flex flex-col gap-1 pl-3 pt-1 pb-2">
                        <a href="{{ route('corporate.president') }}"
                           class="block px-4 py-2.5 text-sm text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition duration-150">
                            Başkan
                        </a>
                        <a href="{{ route('corporate.board') }}"
                           class="block px-4 py-2.5 text-sm text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition duration-150">
                            Yönetim Kurulu
                        </a>
                        <a href="{{ route('corporate.audit') }}"
                           class="block px-4 py-2.5 text-sm text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition duration-150">
                            Denetim Kurulu
                        </a>
                        <a href="{{ route('corporate.statute') }}"
                           class="block px-4 py-2.5 text-sm text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition duration-150">
                            Tüzük
                        </a>
                    </div>
                </div>

                {{-- Branşlar --}}
                <div x-data="{ sub: false }" class="border-b border-gray-100 pb-1">
                    <button @click="sub = !sub" type="button"
                            class="flex items-center justify-between w-full px-4 py-3 text-gray-800 font-semibold text-sm hover:text-green-600 hover:bg-green-50 rounded-xl transition duration-150">
                        <span>Branşlar</span>
                        <i class="fas fa-chevron-down text-xs transition duration-200" :class="sub ? 'rotate-180 text-green-600' : ''"></i>
                    </button>
                    <div x-show="sub"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="flex flex-col gap-1 pl-3 pt-1 pb-2">
                        <a href="{{ route('branch.show', 'futbol') }}"
                           class="block px-4 py-2.5 text-sm text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition duration-150">
                            ⚽ Futbol
                        </a>
                        <a href="{{ route('branch.show', 'voleybol') }}"
                           class="block px-4 py-2.5 text-sm text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition duration-150">
                            🏐 Voleybol
                        </a>
                        <a href="{{ route('branch.show', 'halter') }}"
                           class="block px-4 py-2.5 text-sm text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition duration-150">
                            🏋️ Halter
                        </a>
                    </div>
                </div>

                {{-- Haberler --}}
                <div x-data="{ sub: false }" class="border-b border-gray-100 pb-1">
                    <button @click="sub = !sub" type="button"
                            class="flex items-center justify-between w-full px-4 py-3 text-gray-800 font-semibold text-sm hover:text-green-600 hover:bg-green-50 rounded-xl transition duration-150">
                        <span>Haberler</span>
                        <i class="fas fa-chevron-down text-xs transition duration-200" :class="sub ? 'rotate-180 text-green-600' : ''"></i>
                    </button>
                    <div x-show="sub"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="flex flex-col gap-1 pl-3 pt-1 pb-2">
                        <a href="{{ route('news.news') }}"
                           class="block px-4 py-2.5 text-sm text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition duration-150">
                            Haberler
                        </a>
                        <a href="{{ route('news.events') }}"
                           class="block px-4 py-2.5 text-sm text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition duration-150">
                            Etkinlikler
                        </a>
                    </div>
                </div>

                <a href="{{ route('announcement.index') }}"
                   class="block px-4 py-3 text-gray-800 hover:text-green-600 hover:bg-green-50 rounded-xl font-semibold text-sm transition duration-150">
                    Duyurular
                </a>

                <a href="{{ route('gallery.index') }}"
                   class="block px-4 py-3 text-gray-800 hover:text-green-600 hover:bg-green-50 rounded-xl font-semibold text-sm transition duration-150">
                    Galeri
                </a>

                <a href="{{ route('contact.form') }}"
                   class="block w-full text-center bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-xl transition duration-200 mt-2">
                    İletişim
                </a>
            </div>
        </div>
        {{-- /MOBİL MENU --}}

    </div>
</nav>

<style>
.nav-link {
    @apply px-4 py-2 text-gray-700 hover:text-green-600 font-semibold text-sm
           rounded-lg transition duration-200 cursor-pointer
           hover:scale-110 transform;
}

.dropdown-menu {
    @apply absolute flex flex-col
           top-full left-0 mt-1 w-64 min-w-[220px]
           bg-white rounded-2xl shadow-xl border
           border-gray-100 p-3 z-50
           transition-all duration-200;
}

.dropdown-item {
    @apply flex items-center w-full px-4 py-2.5 text-sm text-gray-700
           rounded-lg whitespace-nowrap
           hover:bg-green-50 hover:text-green-600
           transition duration-150;
}
</style>
