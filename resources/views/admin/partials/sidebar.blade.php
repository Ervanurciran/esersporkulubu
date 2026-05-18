<aside class="w-64 bg-gray-900 text-white flex flex-col flex-shrink-0 h-screen sticky top-0 overflow-y-auto">

    {{-- LOGO --}}
    <div class="flex items-center h-20 px-5 border-b border-gray-700 flex-shrink-0">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-auto">
        <div class="ml-3">
            <p class="font-extrabold text-white text-sm leading-tight uppercase">ESER SPOR</p>
            <p class="text-green-400 text-xs font-semibold">Admin Panel</p>
        </div>
    </div>

    {{-- MENU --}}
    <nav class="flex-1 py-4 px-3 space-y-1 overflow-x-hidden">

        <a href="{{ route('admin.dashboard') }}"
           class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'sidebar-link-active' : '' }}">
            <i class="fas fa-tachometer-alt w-5 text-center flex-shrink-0"></i>
            <span class="ml-3 truncate">Dashboard</span>
        </a>

        <a href="{{ route('admin.about.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.about*') ? 'sidebar-link-active' : '' }}">
            <i class="fas fa-info-circle w-5 text-center flex-shrink-0"></i>
            <span class="ml-3 truncate">Hakkımızda</span>
        </a>

        <a href="{{ route('admin.corporate.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.corporate*') ? 'sidebar-link-active' : '' }}">
            <i class="fas fa-sitemap w-5 text-center flex-shrink-0"></i>
            <span class="ml-3 truncate">Kurumsal</span>
        </a>

        <a href="{{ route('admin.branslar.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.branslar*') ? 'sidebar-link-active' : '' }}">
            <i class="fas fa-trophy w-5 text-center flex-shrink-0"></i>
            <span class="ml-3 truncate">Branşlar</span>
        </a>

        <a href="{{ route('admin.news.index') }}"
            class="sidebar-link {{ request()->routeIs('admin.news*') ? 'sidebar-link-active' : '' }}">
            <i class="fas fa-newspaper w-5 text-center flex-shrink-0"></i>
            <span class="ml-3">Haberler</span>
        </a>

        <a href="{{ route('admin.announcement.index') }}"
            class="sidebar-link {{ request()->routeIs('admin.announcement*') ? 'sidebar-link-active' : '' }}">
            <i class="fas fa-bullhorn w-5 text-center flex-shrink-0"></i>
            <span class="ml-3">Duyurular</span>
        </a>

        <a href="{{ route('admin.slider.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.slider*') ? 'sidebar-link-active' : '' }}">
            <i class="fas fa-images w-5 text-center flex-shrink-0"></i>
            <span class="ml-3 truncate">Slider Yönetimi</span>
        </a>

        <a href="{{ route('admin.galeri.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.galeri*') ? 'sidebar-link-active' : '' }}">
            <i class="fas fa-photo-video w-5 text-center flex-shrink-0"></i>
            <span class="ml-3 truncate">Galeri</span>
        </a>

        <a href="{{ route('admin.contact.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.contact*') ? 'sidebar-link-active' : '' }}">
            <i class="fas fa-envelope w-5 text-center flex-shrink-0"></i>
            <span class="ml-3 flex items-center justify-between w-full overflow-hidden">
                <span class="truncate">Mesajlar</span>
                @php $unread = \App\Models\Contact::unread()->count(); @endphp
                @if($unread > 0)
                <span class="bg-red-500 text-white text-[10px] rounded-full px-1.5 py-0.5 font-bold flex-shrink-0 ml-1">
                    {{ $unread }}
                </span>
                @endif
            </span>
        </a>

        <a href="{{ route('admin.kullanicilar.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.kullanicilar*') ? 'sidebar-link-active' : '' }}">
            <i class="fas fa-users w-5 text-center flex-shrink-0"></i>
            <span class="ml-3 truncate">Kullanıcılar</span>
        </a>

    </nav>

    {{-- ÇIKIŞ --}}
    <div class="border-t border-gray-700 p-4 flex-shrink-0">
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit"
                    class="sidebar-link w-full text-red-400 hover:text-red-300 hover:bg-red-900/30">
                <i class="fas fa-sign-out-alt w-5 text-center flex-shrink-0"></i>
                <span class="ml-3 truncate">Çıkış Yap</span>
            </button>
        </form>
    </div>
</aside>

<style>
.sidebar-link {
    display: flex;
    align-items: center;
    padding: 0.625rem 0.75rem;
    border-radius: 0.75rem;
    color: #d1d5db;
    font-size: 0.875rem;
    font-weight: 600;
    transition: all 0.15s;
    width: 100%;
    text-decoration: none;
}
.sidebar-link:hover {
    background-color: #1f2937;
    color: #ffffff;
}
.sidebar-link-active {
    background-color: #15803d !important;
    color: #ffffff !important;
}
</style>