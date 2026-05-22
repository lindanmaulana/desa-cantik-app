<nav class="sticky top-0 z-50 bg-primary text-white shadow-md shadow-primary/20" x-data="{ mobileOpen: false }">
    <div class="px-6 h-16 flex items-center justify-between">

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
                    <div class="group block p-3 rounded-xl hover:bg-white/10 transition-all duration-200">
                        <div class="font-semibold text-sm text-white group-hover:text-[#FFF7E6] transition-colors">
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
                                class="group block p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('statistik.demografi') ? 'bg-white/10' : 'hover:bg-white/10' }}">
                                <div
                                    class="font-semibold text-sm transition-colors {{ request()->routeIs('statistik.demografi') ? 'text-[#FFF7E6]' : 'text-white group-hover:text-[#FFF7E6]' }}">
                                    Demografi
                                </div>
                                <div
                                    class="text-xs mt-0.5 {{ request()->routeIs('statistik.demografi') ? 'text-white/90' : 'text-white/60' }}">
                                    Data kependudukan, usia, dan struktur warga.
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/statistik/sosial"
                                class="group block p-3 rounded-xl hover:bg-white/10 transition-all duration-200">
                                <div
                                    class="font-semibold text-sm text-white group-hover:text-[#FFF7E6] transition-colors">
                                    Sosial</div>
                                <div class="text-xs text-white/60 mt-0.5">Informasi kesehatan, pendidikan, dan
                                    kesejahteraan.</div>
                            </a>
                        </li>
                        <li>
                            <a href="/statistik/ekonomi"
                                class="group block p-3 rounded-xl hover:bg-white/10 transition-all duration-200">
                                <div
                                    class="font-semibold text-sm text-white group-hover:text-[#FFF7E6] transition-colors">
                                    Ekonomi</div>
                                <div class="text-xs text-white/60 mt-0.5">Laporan pendapatan, inflasi, dan pertumbuhan
                                    pasar.</div>
                            </a>
                        </li>
                    </ul>

                    <ul class="flex-1 flex flex-col gap-2">
                        <li>
                            <a href="/statistik/umkm"
                                class="group block p-3 rounded-xl hover:bg-white/10 transition-all duration-200">
                                <div
                                    class="font-semibold text-sm text-white group-hover:text-[#FFF7E6] transition-colors">
                                    UMKM</div>
                                <div class="text-xs text-white/60 mt-0.5">Data usaha mikro, kecil, menengah, dan
                                    komoditas.</div>
                            </a>
                        </li>
                        <li>
                            <a href="/statistik/infrastruktur"
                                class="group block p-3 rounded-xl hover:bg-white/10 transition-all duration-200">
                                <div
                                    class="font-semibold text-sm text-white group-hover:text-[#FFF7E6] transition-colors">
                                    Infrastruktur</div>
                                <div class="text-xs text-white/60 mt-0.5">Fasilitas umum, akses jalan, dan pembangunan
                                    fisik.</div>
                            </a>
                        </li>
                        <li>
                            <a href="/statistik/spasial"
                                class="group block p-3 rounded-xl hover:bg-white/10 transition-all duration-200">
                                <div
                                    class="font-semibold text-sm text-white group-hover:text-[#FFF7E6] transition-colors">
                                    Data Spasial</div>
                                <div class="text-xs text-white/60 mt-0.5">Pemetaan wilayah, tata ruang, dan geografis.
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="relative flex flex-col items-center" x-data="{ open: false }" @mouseenter="open = true"
                @mouseleave="open = false">
                <a href="/layanan"
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
                    <div class="group block p-3 rounded-xl hover:bg-white/10 transition-all duration-200">
                        <div class="font-semibold text-sm text-white group-hover:text-[#FFF7E6] transition-colors">Pusat
                            Analisis Data</div>
                        <div class="text-xs text-white/60 mt-0.5">Eksplorasi kalkulasi mendalam, grafik komparatif, dan
                            hasil interpretasi data sektoral secara komprehensif.</div>
                    </div>
                </div>
            </div>

        </div>

        <div class="hidden md:block">
            <x-button variant="ghost" size="md">
                <a href="{{ route('auth.login') }}" class="capitalize font-semibold">login</a>
            </x-button>
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
        x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-[450px]"
        x-transition:leave="transition-all ease-in duration-250" x-transition:leave-start="opacity-100 max-h-[450px]"
        x-transition:leave-end="opacity-0 max-h-0"
        class="md:hidden bg-primary border-t border-white/10 px-6 min-h-screen space-y-4 shadow-inner overflow-hidden"
        style="display: none;">

        <div class="py-4 space-y-4">

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
                    class="pl-4 mt-1 border-l border-white/20 space-y-1 overflow-hidden" style="display: none;">
                    <a href="{{ route('statistik.demografi') }}"
                        class="block py-2 text-sm text-slate-300 hover:text-white transition-colors {{ request()->routeIs('statistik.demografi') ? 'text-white font-medium' : '' }}">Demografi</a>
                    <a href="/statistik/sosial"
                        class="block py-2 text-sm text-slate-300 hover:text-white transition-colors">Sosial</a>
                    <a href="/statistik/ekonomi"
                        class="block py-2 text-sm text-slate-300 hover:text-white transition-colors">Ekonomi</a>
                    <a href="/statistik/umkm"
                        class="block py-2 text-sm text-slate-300 hover:text-white transition-colors">UMKM</a>
                    <a href="/statistik/infrastruktur"
                        class="block py-2 text-sm text-slate-300 hover:text-white transition-colors">Infrastruktur</a>
                    <a href="/statistik/spasial"
                        class="block py-2 text-sm text-slate-300 hover:text-white transition-colors">Data Spasial</a>
                </div>
            </div>

            <a href="/layanan"
                class="block text-slate-300 hover:text-white py-2 font-medium transition-colors duration-200">Analisis</a>

            <div class="pt-2 border-t border-white/10">
                <x-button variant="ghost" size="md" class="w-full justify-center">
                    <a href="{{ route('auth.login') }}"
                        class="capitalize font-semibold block text-center w-full">login</a>
                </x-button>
            </div>
        </div>
    </div>
</nav>
