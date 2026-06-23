<footer class="bg-[#0b121f] text-white">
    {{-- ANA FOOTER --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-12 items-start">

            {{-- 1. Sütun: Logo & Slogan --}}
            <div class="md:col-span-4 flex flex-col items-start">
                <img src="{{ asset('images/logo.png') }}"
                     alt="Eser Spor Kulübü"
                     class="h-60 w-auto mb-4 opacity-95">
                <p class="text-gray-400 text-sm italic leading-relaxed max-w-[250px]">"Eser Spor Kulübü"</p>   
            </div>

            {{-- 2. Sütun: Sosyal Medya (Ortalanmış Alan) --}}
            <div class="md:col-span-4 flex flex-col md:items-center">
                <div class="w-full max-w-[200px]">
                    <h4 class="text-white font-semibold text-base mb-6 border-b border-green-600 pb-2 uppercase tracking-widest">
                        Sosyal Medya
                    </h4>
                    <div class="flex flex-col space-y-4">
                        <a href="https://www.facebook.com/esersporkulubu" class="flex items-center text-gray-400 hover:text-blue-500 transition-all group">
                            <i class="fab fa-facebook-f w-6 text-center text-lg"></i>
                            <span class="ml-3 text-sm group-hover:translate-x-1 transition-transform">Facebook</span>
                        </a>
                        <a href="https://www.instagram.com/esersporkulubu/" class="flex items-center text-gray-400 hover:text-pink-500 transition-all group">
                            <i class="fab fa-instagram w-6 text-center text-lg"></i>
                            <span class="ml-3 text-sm group-hover:translate-x-1 transition-transform">Instagram</span>
                        </a>
                        <a href="https://x.com/esersporkulubu" class="flex items-center text-gray-400 hover:text-black transition-all group">
                            <i class="fa-brands fa-x-twitter w-6 text-center text-lg"></i>
                            <span class="ml-3 text-sm group-hover:translate-x-1 transition-transform">Twitter</span>
                        </a>
                        <a href="https://www.youtube.com/user/esersporkulubu"
                       class="flex items-center text-gray-400 hover:text-red-500 transition duration-300">
                        <i class="fab fa-youtube w-6 text-lg text-center"></i>
                        <span class="ml-3 text-base">Youtube</span>
                        </a>

                    </div>
                </div>
            </div>

            {{-- 3. Sütun: İletişim (Sağa Yakın Ama Dengeli) --}}
            <div class="md:col-span-4 flex flex-col md:items-end">
                <div class="w-full max-w-[280px]">
                    <h4 class="text-white font-semibold text-base mb-6 border-b border-green-600 pb-2 uppercase tracking-widest">
                        İletişim
                    </h4>
                    <ul class="space-y-4">
                        <li class="flex items-start space-x-3 group">
                            <i class="fas fa-map-marker-alt text-green-500 mt-1 w-5 text-center"></i>
                            <span class="text-gray-400 text-sm leading-relaxed">Esertepe Mah. 282. Cad. No:3 Keçiören/ANKARA</span>
                        </li>
                        <li class="flex items-center space-x-3 group">
                            <i class="fas fa-phone text-green-500 w-5 text-center"></i>
                            <span class="text-gray-400 text-sm">+90 507 539 24 22</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-fax text-green-500 w-4"></i>
                            <span class="text-gray-400 text-sm">+90 312 378 08 08</span>    
                        </li>
                        <li class="flex items-center space-x-3 group">
                            <i class="fas fa-envelope text-green-500 w-5 text-center"></i>
                            <span class="text-gray-400 text-sm">info@eserspor.com</span>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

    {{-- ALT FOOTER --}}
    <div class="border-t border-gray-800/50">
        <div class="max-w-7xl mx-auto px-4 py-6 flex flex-col md:flex-row justify-between items-center text-xs text-gray-500 uppercase tracking-tighter">
            <p>© {{ date('Y') }} Eser Spor Kulübü. Tüm hakları saklıdır.</p>
        </div>
    </div>
</footer>

<style>
.footer-link {
    @apply text-gray-400 hover:text-green-400 text-sm transition duration-200;
}
.social-icon {
    @apply w-9 h-9 bg-gray-800 hover:bg-green-600 rounded-full
           flex items-center justify-center text-sm
           transition duration-200;
}
</style>