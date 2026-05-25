<nav class="sticky top-0 z-50 bg-primary text-white shadow-md shadow-primary/20" x-data="{ mobileOpen: false }">
    <div class="px-6 h-16 flex items-center justify-between relative z-50 bg-primary">

        <div class="flex justify-start items-center gap-1 text-white">
            <x-fab-dev class="size-7" />
            <div class="text-xl font-bold tracking-wide capitalize">Nama Desa</div>
        </div>

        <div class="hidden md:flex items-center gap-6">
            <div class="relative flex flex-col items-center" x-data="{ open: false }" @mouseenter="open = true"
                @mouseleave="open = false">
                <a href="{{ route('home') }}"
                    class="flex items-center gap-1 text-slate-300 hover:text-white py-4 focus:outline-none transition-colors duration-200 {{ request()->routeIs('home') ? 'text-white' : '' }}">
                    <span>Beranda</span>
                </a>
                <div x-show="open" x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                    x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                    class="absolute left-1/2 -translate-x-1/2 mt-14 w-[320px] bg-primary border border-white/10 rounded-xl shadow-xl p-4 z-50"
                    style="display: none;">
                    <div class="group block p-3 rounded-xl hover:bg-quaternary/10 transition-all duration-200">
                        <div class="font-semibold text-sm text-white group-hover:text-quaternary transition-colors">
                            Halaman Utama</div>
                        <div class="text-xs text-white/60 mt-0.5">Kembali ke beranda untuk melihat ringkasan informasi,
                            berita terbaru, dan pengumuman platform.</div>
                    </div>
                </div>
            </div>

            <div class="relative flex flex-col items-center" x-data="{ open: false }" @mouseenter="open = true"
                @mouseleave="open = false">
                <button
                    class="flex items-center gap-1 text-slate-300 hover:text-white py-4 focus:outline-none transition-colors duration-200 {{ request()->routeIs('statistik.*') ? 'text-white' : '' }}">
                    <span>Statistik</span>
                    <svg class="size-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <div x-show="open" x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                    x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                    class="absolute left-1/2 -translate-x-1/2 mt-14 w-[550px] bg-primary border border-white/10 rounded-xl shadow-xl p-5 z-50 flex gap-6"
                    style="display: none;">

                    <ul class="flex-1 flex flex-col gap-2">
                        <li>
                            <a href="{{ route('statistik.demografi') }}"
                                class="group block p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('statistik.demografi') ? 'bg-quaternary/10' : 'hover:bg-quaternary/10' }}">
                                <div
                                    class="font-semibold text-sm transition-colors {{ request()->routeIs('statistik.demografi') ? 'text-quaternary' : 'text-white group-hover:text-quaternary' }}">
                                    Demografi
                                </div>
                                <div
                                    class="text-xs mt-0.5 {{ request()->routeIs('statistik.demografi') ? 'text-white/90' : 'text-white/60' }}">
                                    Data kependudukan, usia, dan struktur warga.
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('statistik.social') }}"
                                class="group block p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('statistik.social') ? 'bg-quaternary/10' : 'hover:bg-quaternary/10' }}">
                                <div
                                    class="font-semibold text-sm transition-colors {{ request()->routeIs('statistik.social') ? 'text-quaternary' : 'text-white group-hover:text-quaternary' }}">
                                    Sosial
                                </div>
                                <div
                                    class="text-xs mt-0.5 {{ request()->routeIs('statistik.social') ? 'text-white/90' : 'text-white/60' }}">
                                    Informasi kesehatan, pendidikan, dan kesejahteraan.
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('statistik.economy') }}"
                                class="group block p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('statistik.economy') ? 'bg-quaternary/10' : 'hover:bg-quaternary/10' }}">
                                <div
                                    class="font-semibold text-sm transition-colors {{ request()->routeIs('statistik.economy') ? 'text-quaternary' : 'text-white group-hover:text-quaternary' }}">
                                    Ekonomi
                                </div>
                                <div
                                    class="text-xs mt-0.5 {{ request()->routeIs('statistik.economy') ? 'text-white/90' : 'text-white/60' }}">
                                    Laporan pendapatan, inflasi, dan pertumbuhan pasar.
                                </div>
                            </a>
                        </li>
                    </ul>

                    <ul class="flex-1 flex flex-col gap-2">
                        <li>
                            <a href="{{ route('statistik.msme') }}"
                                class="group block p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('statistik.msme') ? 'bg-quaternary/10' : 'hover:bg-quaternary/10' }}">
                                <div
                                    class="font-semibold text-sm transition-colors {{ request()->routeIs('statistik.msme') ? 'text-quaternary' : 'text-white group-hover:text-quaternary' }}">
                                    UMKM
                                </div>
                                <div
                                    class="text-xs mt-0.5 {{ request()->routeIs('statistik.msme') ? 'text-white/90' : 'text-white/60' }}">
                                    Data usaha mikro, kecil, menengah, dan komoditas.
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('statistik.infrastructure') }}"
                                class="group block p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('statistik.infrastructure') ? 'bg-quaternary/10' : 'hover:bg-quaternary/10' }}">
                                <div
                                    class="font-semibold text-sm transition-colors {{ request()->routeIs('statistik.infrastructure') ? 'text-quaternary' : 'text-white group-hover:text-quaternary' }}">
                                    Infrastruktur
                                </div>
                                <div
                                    class="text-xs mt-0.5 {{ request()->routeIs('statistik.infrastructure') ? 'text-white/90' : 'text-white/60' }}">
                                    Fasilitas umum, akses jalan, dan pembangunan fisik.
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('statistik.spacial-data') }}"
                                class="group block p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('statistik.spacial-data') ? 'bg-quaternary/10' : 'hover:bg-quaternary/10' }}">
                                <div
                                    class="font-semibold text-sm transition-colors {{ request()->routeIs('statistik.spacial-data') ? 'text-quaternary' : 'text-white group-hover:text-quaternary' }}">
                                    Data Spasial
                                </div>
                                <div
                                    class="text-xs mt-0.5 {{ request()->routeIs('statistik.spacial-data') ? 'text-white/90' : 'text-white/60' }}">
                                    Pemetaan wilayah, tata ruang, dan geografis.
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="relative flex flex-col items-center" x-data="{ open: false }" @mouseenter="open = true"
                @mouseleave="open = false">
                <a href="/"
                    class="flex items-center gap-1 text-slate-300 hover:text-white py-4 focus:outline-none transition-colors duration-200">
                    <span>Analisis</span>
                </a>

                <div x-show="open" x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                    x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                    class="absolute left-1/2 -translate-x-1/2 mt-14 w-[320px] bg-primary border border-white/10 rounded-xl shadow-xl p-4 z-50"
                    style="display: none;">
                    <div class="group block p-3 rounded-xl hover:bg-quaternary/10 transition-all duration-200">
                        <div class="font-semibold text-sm text-white group-hover:text-quaternary transition-colors">
                            Pusat
                            Analisis Data</div>
                        <div class="text-xs text-white/60 mt-0.5">Eksplorasi kalkulasi mendalam, grafik komparatif, dan
                            hasil interpretasi data sektoral secara komprehensif.</div>
                    </div>
                </div>
            </div>

        </div>

        <div class="hidden md:block">
            @auth
                <x-button variant="ghostv2" size="md">
                    <a href="{{ route('auth.login') }}" class="capitalize font-semibold">dashboard</a>
                </x-button>
            @else
                <x-button variant="ghostv2" size="md">
                    <a href="{{ route('auth.login') }}" class="capitalize font-semibold">login</a>  
                </x-button>
            @endauth
        </div>

        <div class="flex md:hidden">
            <button @click="mobileOpen = !mobileOpen"
                class="text-slate-300 hover:text-white focus:outline-none p-2 relative size-10">
                <svg class="size-6 absolute top-2 left-2 transition-all duration-300 transform"
                    :class="{ 'rotate-90 opacity-0': mobileOpen, 'rotate-0 opacity-100': !mobileOpen }" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
                <svg class="size-6 absolute top-2 left-2 transition-all duration-300 transform"
                    :class="{ 'rotate-0 opacity-100': mobileOpen, '-rotate-90 opacity-0': !mobileOpen }" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>
    </div>

    <div x-show="mobileOpen" x-transition:enter="transition-all ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition-all ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-4"
        class="md:hidden bg-primary fixed inset-0 pt-16 px-6 overflow-y-auto space-y-4 z-40 border-t-2 border-quaternary/30"
        style="display: none;">

        <div class="py-6 space-y-4 pb-20">

            <a href="{{ route('home') }}"
                class="block text-slate-300 hover:text-white py-2 font-medium transition-colors duration-200 {{ request()->routeIs('home') ? 'text-white' : '' }}">Beranda</a>

            <div x-data="{ localOpen: false }">
                <button @click="localOpen = !localOpen"
                    class="w-full flex items-center justify-between text-slate-300 hover:text-white py-2 font-medium focus:outline-none {{ request()->routeIs('statistik.*') ? 'text-white font-medium' : '' }}">
                    <span>Statistik</span>
                    <svg class="size-4 transition-transform duration-300" :class="{ 'rotate-180': localOpen }"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                        </path>
                    </svg>
                </button>

                <div x-show="localOpen" x-transition:enter="transition-all ease-out duration-300"
                    x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-60"
                    x-transition:leave="transition-all ease-in duration-200"
                    x-transition:leave-start="opacity-100 max-h-60" x-transition:leave-end="opacity-0 max-h-0"
                    class="pl-4 mt-1 border-l border-quaternary/30 space-y-1 overflow-hidden" style="display: none;">
                    <a href="{{ route('statistik.demografi') }}"
                        class="block py-2 text-sm text-slate-300 hover:text-white transition-colors {{ request()->routeIs('statistik.demografi') ? 'text-white font-medium' : '' }}">Demografi</a>
                    <a href="{{ route('statistik.social') }}"
                        class="block py-2 text-sm text-slate-300 hover:text-white transition-colors {{ request()->routeIs('statistik.social') ? 'text-white font-medium' : '' }}">Sosial</a>
                    <a href="{{ route('statistik.economy') }}"
                        class="block py-2 text-sm text-slate-300 hover:text-white transition-colors {{ request()->routeIs('statistik.economy') ? 'text-white font-medium' : '' }}">Ekonomi</a>
                    <a href="{{ route('statistik.msme') }}"
                        class="block py-2 text-sm text-slate-300 hover:text-white transition-colors {{ request()->routeIs('statistik.msme') ? 'text-white font-medium' : '' }}">UMKM</a>
                    <a href="{{ route('statistik.infrastructure') }}"
                        class="block py-2 text-sm text-slate-300 hover:text-white transition-colors {{ request()->routeIs('statistik.infrastructure') ? 'text-white font-medium' : '' }}">Infrastruktur</a>
                    <a href="{{ route('statistik.spacial-data') }}"
                        class="block py-2 text-sm text-slate-300 hover:text-white transition-colors {{ request()->routeIs('statistik.spacial-data') ? 'text-white font-medium' : '' }}">Data
                        Spasial</a>
                </div>
            </div>

            <a href="/"
                class="block text-slate-300 hover:text-white py-2 font-medium transition-colors duration-200">Analisis</a>

            <div class="pt-4 border-t border-white/10">
                <x-button variant="ghostv2" class="!w-full" size="md">
                    <a href="{{ route('auth.login') }}"
                        class="capitalize font-semibold block text-center w-full">login</a>
                </x-button>
            </div>
        </div>
    </div>
</nav>
