<aside class="w-64 bg-gray-900 text-white flex flex-col flex-shrink-0">

    {{-- LOGO --}}
    <div class="flex items-center h-20 px-5 border-b border-gray-700 flex-shrink-0">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-auto flex-shrink-0">
        <div class="ml-3">
            <p class="font-extrabold text-white text-sm leading-tight">ESER SPOR</p>
            <p class="text-green-400 text-xs font-semibold">Admin Panel</p>
        </div>
    </div>

    {{-- MENU --}}
    <nav class="flex-1 overflow-y-auto py-4 px-3">
        <ul class="space-y-1">

            <li>
                <a href="{{ route('admin.dashboard') }}"
                   class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'sidebar-link-active' : '' }}">
                    <i class="fas fa-tachometer-alt sidebar-icon"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.slider.index') }}"
                   class="sidebar-link {{ request()->routeIs('admin.slider') ? 'sidebar-link-active' : '' }}">
                    <i class="fas fa-images sidebar-icon"></i>
                    <span>Slider</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.about.index') }}"
                   class="sidebar-link {{ request()->routeIs('admin.about*') ? 'sidebar-link-active' : '' }}">
                    <i class="fas fa-info-circle sidebar-icon"></i>
                    <span>Hakkımızda</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.corporate.index') }}"
                   class="sidebar-link {{ request()->routeIs('admin.corporate*') ? 'sidebar-link-active' : '' }}">
                    <i class="fas fa-sitemap sidebar-icon"></i>
                    <span>Kurumsal</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.branslar.index') }}"
                   class="sidebar-link {{ request()->routeIs('admin.branslar*') || request()->routeIs('admin.branch*') ? 'sidebar-link-active' : '' }}">
                    <i class="fas fa-trophy sidebar-icon"></i>
                    <span>Branşlar</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.news.index') }}"
                   class="sidebar-link {{ request()->routeIs('admin.news*') ? 'sidebar-link-active' : '' }}">
                    <i class="fas fa-newspaper sidebar-icon"></i>
                    <span>Haberler</span>
                </a>
            </li>

            {{-- Duyurular --}}
            <li>
                <a href="{{ route('admin.announcement.index') }}"
                class="sidebar-link {{ request()->routeIs('admin.announcement*') ? 'sidebar-link-active' : '' }}">
                    <i class="fas fa-bullhorn sidebar-icon"></i>
                    <span>Duyurular</span>
                </a>
            </li>

            
            <li>
                <a href="{{ route('admin.galeri.index') }}"
                   class="sidebar-link {{ request()->routeIs('admin.galeri*') ? 'sidebar-link-active' : '' }}">
                    <i class="fas fa-photo-video sidebar-icon"></i>
                    <span>Galeri</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.contact.index') }}"
                   class="sidebar-link {{ request()->routeIs('admin.contact*') ? 'sidebar-link-active' : '' }}">
                    <i class="fas fa-envelope sidebar-icon"></i>
                    <span class="flex-1">Mesajlar</span>
                    @php $unread = \App\Models\Contact::unread()->count(); @endphp
                    @if($unread > 0)
                    <span class="bg-red-500 text-white text-xs rounded-full
                                 px-2 py-0.5 font-bold ml-auto">
                        {{ $unread }}
                    </span>
                    @endif
                </a>
            </li>

            <li>
                <a href="{{ route('admin.kullanicilar.index') }}"
                   class="sidebar-link {{ request()->routeIs('admin.kullanicilar*') ? 'sidebar-link-active' : '' }}">
                    <i class="fas fa-users sidebar-icon"></i>
                    <span>Kullanıcılar</span>
                </a>
            </li>

        </ul>
    </nav>

    {{-- ÇIKIŞ --}}
    <div class="border-t border-gray-700 p-4 flex-shrink-0">
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="sidebar-link w-full text-red-400
                                         hover:text-red-300 hover:bg-red-900/30">
                <i class="fas fa-sign-out-alt sidebar-icon"></i>
                <span>Çıkış Yap</span>
            </button>
        </form>
    </div>

</aside>

<style>
.sidebar-link {
    display: flex;
    align-items: center;
    width: 100%;
    padding: 10px 12px;
    border-radius: 10px;
    color: #d1d5db;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.15s;
    cursor: pointer;
    gap: 12px;
}
.sidebar-link:hover {
    background: #1f2937;
    color: #ffffff;
}
.sidebar-link-active {
    background: #15803d !important;
    color: #ffffff !important;
}
.sidebar-icon {
    width: 18px;
    text-align: center;
    flex-shrink: 0;
    font-size: 15px;
}
</style>