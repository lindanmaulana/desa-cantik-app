<nav class="sticky top-0 z-50 bg-white/70 backdrop-blur-xl text-slate-800 border-b border-emerald-50/60 shadow-[0_2px_20px_-12px_rgba(0,0,0,0.05)] transition-all duration-300"
    x-data="{ mobileOpen: false }">
    <div class="px-6 h-16 flex items-center justify-between relative z-50">

        <!-- Brand / Logo -->
        <div class="flex justify-start items-center gap-2.5">
            <div class="p-2 rounded-xl bg-emerald-50 text-emerald-600 shadow-inner">
                <x-fab-dev class="size-5.5" />
            </div>
            <div class="text-base font-bold tracking-tight text-slate-900 capitalize">Nama Desa</div>
        </div>

        <!-- Desktop Navigation Menu -->
        <div class="hidden md:flex items-center gap-1.5 bg-slate-100/60 p-1 rounded-xl border border-slate-200/40">
            <!-- Beranda -->
            <div class="relative flex flex-col items-center" x-data="{ open: false }" @mouseenter="open = true"
                @mouseleave="open = false">
                <a href="{{ route('home') }}"
                    class="px-4 py-1.5 rounded-lg text-xs font-semibold tracking-wide transition-all duration-200 {{ request()->routeIs('home') ? 'bg-white text-emerald-600 shadow-sm' : 'text-slate-600 hover:text-slate-900 hover:bg-white/50' }}">
                    <span>Beranda</span>
                </a>
                <div x-show="open" x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                    x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                    class="absolute left-1/2 -translate-x-1/2 mt-10 w-[320px] bg-white border border-slate-100 rounded-2xl shadow-xl p-2.5 z-50"
                    style="display: none;">
                    <div class="group block p-3 rounded-xl hover:bg-emerald-50/50 transition-all duration-200">
                        <div
                            class="font-bold text-xs uppercase tracking-wider text-slate-800 group-hover:text-emerald-600 transition-colors">
                            Halaman Utama</div>
                        <div class="text-xs text-slate-500 mt-1 leading-relaxed">Kembali ke beranda untuk melihat
                            ringkasan informasi, berita terbaru, dan pengumuman platform.</div>
                    </div>
                </div>
            </div>

            <!-- Statistik Dropdown -->
            <div class="relative flex flex-col items-center" x-data="{ open: false }" @mouseenter="open = true"
                @mouseleave="open = false">
                <button
                    class="flex items-center gap-1 px-4 py-1.5 rounded-lg text-xs font-semibold tracking-wide transition-all duration-200 {{ request()->routeIs('statistik.*') ? 'bg-white text-emerald-600 shadow-sm' : 'text-slate-600 hover:text-slate-900 hover:bg-white/50' }}">
                    <span>Statistik</span>
                    <svg class="size-3.5 opacity-70 transition-transform duration-200" :class="{ 'rotate-180': open }"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7">
                        </path>
                    </svg>
                </button>

                <div x-show="open" x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                    x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                    class="absolute left-1/2 -translate-x-1/2 mt-10 w-[540px] bg-white border border-slate-100 rounded-2xl shadow-xl p-3.5 z-50 flex gap-4"
                    style="display: none;">

                    <ul class="flex-1 flex flex-col gap-1">
                        <li>
                            <a href="{{ route('statistik.demografi') }}"
                                class="group block p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('statistik.demografi') ? 'bg-emerald-50/60' : 'hover:bg-slate-50' }}">
                                <div
                                    class="font-bold text-xs uppercase tracking-wider transition-colors {{ request()->routeIs('statistik.demografi') ? 'text-emerald-600' : 'text-slate-800 group-hover:text-emerald-600' }}">
                                    Demografi</div>
                                <div class="text-xs mt-0.5 text-slate-400">Data kependudukan, usia, dan struktur warga.
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('statistik.social') }}"
                                class="group block p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('statistik.social') ? 'bg-emerald-50/60' : 'hover:bg-slate-50' }}">
                                <div
                                    class="font-bold text-xs uppercase tracking-wider transition-colors {{ request()->routeIs('statistik.social') ? 'text-emerald-600' : 'text-slate-800 group-hover:text-emerald-600' }}">
                                    Sosial</div>
                                <div class="text-xs mt-0.5 text-slate-400">Informasi kesehatan, pendidikan, dan
                                    kesejahteraan.</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('statistik.economy') }}"
                                class="group block p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('statistik.economy') ? 'bg-emerald-50/60' : 'hover:bg-slate-50' }}">
                                <div
                                    class="font-bold text-xs uppercase tracking-wider transition-colors {{ request()->routeIs('statistik.economy') ? 'text-emerald-600' : 'text-slate-800 group-hover:text-emerald-600' }}">
                                    Ekonomi</div>
                                <div class="text-xs mt-0.5 text-slate-400">Laporan pendapatan, inflasi, dan pertumbuhan
                                    pasar.</div>
                            </a>
                        </li>
                    </ul>

                    <ul class="flex-1 flex flex-col gap-1">
                        <li>
                            <a href="{{ route('statistik.msme') }}"
                                class="group block p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('statistik.msme') ? 'bg-emerald-50/60' : 'hover:bg-slate-50' }}">
                                <div
                                    class="font-bold text-xs uppercase tracking-wider transition-colors {{ request()->routeIs('statistik.msme') ? 'text-emerald-600' : 'text-slate-800 group-hover:text-emerald-600' }}">
                                    UMKM</div>
                                <div class="text-xs mt-0.5 text-slate-400">Data usaha mikro, kecil, menengah, dan
                                    komoditas.</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('statistik.infrastructure') }}"
                                class="group block p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('statistik.infrastructure') ? 'bg-emerald-50/60' : 'hover:bg-slate-50' }}">
                                <div
                                    class="font-bold text-xs uppercase tracking-wider transition-colors {{ request()->routeIs('statistik.infrastructure') ? 'text-emerald-600' : 'text-slate-800 group-hover:text-emerald-600' }}">
                                    Infrastruktur</div>
                                <div class="text-xs mt-0.5 text-slate-400">Fasilitas umum, akses jalan, dan pembangunan
                                    fisik.</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('statistik.spacial-data') }}"
                                class="group block p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('statistik.spacial-data') ? 'bg-emerald-50/60' : 'hover:bg-slate-50' }}">
                                <div
                                    class="font-bold text-xs uppercase tracking-wider transition-colors {{ request()->routeIs('statistik.spacial-data') ? 'text-emerald-600' : 'text-slate-800 group-hover:text-emerald-600' }}">
                                    Data Spasial</div>
                                <div class="text-xs mt-0.5 text-slate-400">Pemetaan wilayah, tata ruang, dan geografis.
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Analisis -->
            <div class="relative flex flex-col items-center" x-data="{ open: false }" @mouseenter="open = true"
                @mouseleave="open = false">
                <a href="/"
                    class="px-4 py-1.5 rounded-lg text-xs font-semibold tracking-wide text-slate-600 hover:text-slate-900 hover:bg-white/50 transition-all duration-200">
                    <span>Analisis</span>
                </a>
                <div x-show="open" x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                    x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                    class="absolute left-1/2 -translate-x-1/2 mt-10 w-[320px] bg-white border border-slate-100 rounded-2xl shadow-xl p-2.5 z-50"
                    style="display: none;">
                    <div class="group block p-3 rounded-xl hover:bg-emerald-50/50 transition-all duration-200">
                        <div
                            class="font-bold text-xs uppercase tracking-wider text-slate-800 group-hover:text-emerald-600 transition-colors">
                            Pusat Analisis Data</div>
                        <div class="text-xs text-slate-500 mt-1 leading-relaxed">Eksplorasi kalkulasi mendalam, grafik
                            komparatif, dan hasil interpretasi data sektoral secara komprehensif.</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Desktop Action Button -->
        <div class="hidden md:block">
            @auth
                <a href="{{ route('dashboard') }}">
                    <x-button variant="solid" size="sm"
                        class="!bg-slate-900 hover:!bg-black text-white text-xs font-bold rounded-xl tracking-wide px-4 py-2 shadow-sm">
                        Dashboard
                    </x-button>
                </a>
            @else
                <a href="{{ route('auth.login') }}">
                    <x-button variant="outline" size="sm"
                        class="!border-slate-200 hover:!bg-slate-50 text-slate-700 text-xs font-bold rounded-xl tracking-wide px-4 py-2">
                        Sign In
                    </x-button>
                </a>
            @endauth
        </div>

        <!-- Mobile Toggle Button -->
        <div class="flex md:hidden">
            <button @click="mobileOpen = !mobileOpen"
                class="text-slate-600 hover:text-slate-900 focus:outline-none p-2 relative size-10 rounded-xl hover:bg-slate-100/50 transition-colors">
                <svg class="size-5 absolute top-2.5 left-2.5 transition-all duration-300 transform"
                    :class="{ 'rotate-90 opacity-0': mobileOpen, 'rotate-0 opacity-100': !mobileOpen }" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                <svg class="size-5 absolute top-2.5 left-2.5 transition-all duration-300 transform"
                    :class="{ 'rotate-0 opacity-100': mobileOpen, '-rotate-90 opacity-0': !mobileOpen }" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation Drawer -->
    <div x-show="mobileOpen" x-transition:enter="transition-all ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition-all ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        class="md:hidden bg-white/95 backdrop-blur-md fixed inset-x-0 top-16 bottom-0 px-6 overflow-y-auto z-40 border-t border-slate-100 shadow-xl"
        style="display: none;">

        <div class="py-6 space-y-2.5 pb-20">
            <a href="{{ route('home') }}"
                class="block px-3 py-2.5 rounded-xl text-sm font-semibold transition-colors {{ request()->routeIs('home') ? 'bg-emerald-50 text-emerald-600' : 'text-slate-600 hover:bg-slate-50' }}">Beranda</a>

            <div x-data="{ localOpen: false }">
                <button @click="localOpen = !localOpen"
                    class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-50 focus:outline-none {{ request()->routeIs('statistik.*') ? 'bg-emerald-50 text-emerald-600' : '' }}">
                    <span>Statistik</span>
                    <svg class="size-4 transition-transform duration-300 opacity-60"
                        :class="{ 'rotate-180': localOpen }" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                        </path>
                    </svg>
                </button>

                <div x-show="localOpen" class="pl-4 mt-1 border-l-2 border-emerald-100 space-y-0.5"
                    style="display: none;">
                    <a href="{{ route('statistik.demografi') }}"
                        class="block px-3 py-2 rounded-lg text-xs font-medium text-slate-600 hover:bg-slate-50 {{ request()->routeIs('statistik.demografi') ? 'text-emerald-600 font-semibold' : '' }}">Demografi</a>
                    <a href="{{ route('statistik.social') }}"
                        class="block px-3 py-2 rounded-lg text-xs font-medium text-slate-600 hover:bg-slate-50 {{ request()->routeIs('statistik.social') ? 'text-emerald-600 font-semibold' : '' }}">Sosial</a>
                    <a href="{{ route('statistik.economy') }}"
                        class="block px-3 py-2 rounded-lg text-xs font-medium text-slate-600 hover:bg-slate-50 {{ request()->routeIs('statistik.economy') ? 'text-emerald-600 font-semibold' : '' }}">Ekonomi</a>
                    <a href="{{ route('statistik.msme') }}"
                        class="block px-3 py-2 rounded-lg text-xs font-medium text-slate-600 hover:bg-slate-50 {{ request()->routeIs('statistik.msme') ? 'text-emerald-600 font-semibold' : '' }}">UMKM</a>
                    <a href="{{ route('statistik.infrastructure') }}"
                        class="block px-3 py-2 rounded-lg text-xs font-medium text-slate-600 hover:bg-slate-50 {{ request()->routeIs('statistik.infrastructure') ? 'text-emerald-600 font-semibold' : '' }}">Infrastruktur</a>
                    <a href="{{ route('statistik.spacial-data') }}"
                        class="block px-3 py-2 rounded-lg text-xs font-medium text-slate-600 hover:bg-slate-50 {{ request()->routeIs('statistik.spacial-data') ? 'text-emerald-600 font-semibold' : '' }}">Data
                        Spasial</a>
                </div>
            </div>

            <a href="/"
                class="block px-3 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-50">Analisis</a>

            <!-- Mobile Auth Action -->
            <div class="pt-4 border-t border-slate-100">
                @auth
                    <a href="{{ route('dashboard') }}" class="block w-full">
                        <x-button variant="solid" class="!w-full !bg-slate-900 text-white rounded-xl py-3.5"
                            size="md">
                            <span class="text-xs font-bold tracking-wide">Dashboard</span>
                        </x-button>
                    </a>
                @else
                    <a href="{{ route('auth.login') }}" class="block w-full">
                        <x-button variant="outline" class="!w-full !border-slate-200 text-slate-700 rounded-xl py-3.5"
                            size="md">
                            <span class="text-xs font-bold tracking-wide">Sign In</span>
                        </x-button>
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
