<nav class="sticky top-4 z-50 mx-auto my-4 w-[calc(100%-2rem)] max-w-7xl rounded-2xl border border-white/40 bg-white/70 text-slate-800 shadow-sm backdrop-blur-xl transition-all duration-300"
    x-data="{ mobileOpen: false }">
    <div class="relative z-50 flex h-16 items-center justify-between px-4 sm:px-6 lg:px-8">

        <div class="flex flex-shrink-0 items-center justify-start gap-2.5">
            <div class="rounded-xl bg-primary/10 p-2 text-primary shadow-inner">
                <x-heroicon-o-square-3-stack-3d class="w-6 h-6" />
            </div>
            <div
                class="max-w-[150px] truncate capitalize text-sm font-bold tracking-tight text-textPrimary sm:max-w-none sm:text-base">
                {{ $villageSettings->village_name ?? '-' }}
            </div>
        </div>

        <div class="hidden items-center gap-1 border border-slate-200/40 bg-slate-100/80 p-1 rounded-xl md:flex">
            <div class="relative">
                <a href="{{ route('home') }}"
                    class="block px-3 lg:px-4 py-1.5 rounded-lg text-xs font-semibold tracking-wide transition-all duration-200 {{ request()->routeIs('home') ? 'bg-white text-primary shadow-sm' : 'text-slate-600 hover:text-primary hover:bg-white/50' }}">
                    <span>Beranda</span>
                </a>
            </div>

            <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <button
                    class="flex items-center gap-1 px-3 lg:px-4 py-1.5 rounded-lg text-xs font-semibold tracking-wide transition-all duration-200 {{ request()->routeIs('statistik.*') ? 'bg-white text-primary shadow-sm' : 'text-slate-600 hover:text-primary hover:bg-white/50' }}">
                    <span>Statistik</span>
                    <svg class="h-3.5 w-3.5 opacity-70 transition-transform duration-200"
                        :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7">
                        </path>
                    </svg>
                </button>

                <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                    x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                    class="absolute left-1/2 pt-3 w-[480px] -translate-x-1/2 z-50 lg:w-[540px]" style="display: none;">

                    <div class="flex gap-2 rounded-2xl border border-slate-100 bg-white p-3 shadow-xl lg:gap-4">
                        <ul class="flex-1 flex flex-col gap-0.5">
                            <li>
                                <a href="{{ route('statistik.demografi') }}"
                                    class="group block p-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('statistik.demografi') ? 'bg-primary/5' : 'hover:bg-slate-50' }}">
                                    <div
                                        class="text-[11px] font-bold uppercase tracking-wider transition-colors {{ request()->routeIs('statistik.demografi') ? 'text-primary' : 'text-slate-800 group-hover:text-primary' }}">
                                        Demografi</div>
                                    <div class="mt-0.5 text-[11px] text-slate-400">Data kependudukan, usia, dan struktur
                                        warga.</div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('statistik.social') }}"
                                    class="group block p-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('statistik.social') ? 'bg-primary/5' : 'hover:bg-slate-50' }}">
                                    <div
                                        class="text-[11px] font-bold uppercase tracking-wider transition-colors {{ request()->routeIs('statistik.social') ? 'text-primary' : 'text-slate-800 group-hover:text-primary' }}">
                                        Sosial</div>
                                    <div class="mt-0.5 text-[11px] text-slate-400">Informasi kesehatan, pendidikan, dan
                                        kesejahteraan.</div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('statistik.economy') }}"
                                    class="group block p-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('statistik.economy') ? 'bg-primary/5' : 'hover:bg-slate-50' }}">
                                    <div
                                        class="text-[11px] font-bold uppercase tracking-wider transition-colors {{ request()->routeIs('statistik.economy') ? 'text-primary' : 'text-slate-800 group-hover:text-primary' }}">
                                        Ekonomi</div>
                                    <div class="mt-0.5 text-[11px] text-slate-400">Laporan pendapatan dan pertumbuhan
                                        pasar.</div>
                                </a>
                            </li>
                        </ul>
                        <ul class="flex-1 flex flex-col gap-0.5">
                            <li>
                                <a href="{{ route('statistik.msme') }}"
                                    class="group block p-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('statistik.msme') ? 'bg-primary/5' : 'hover:bg-slate-50' }}">
                                    <div
                                        class="text-[11px] font-bold uppercase tracking-wider transition-colors {{ request()->routeIs('statistik.msme') ? 'text-primary' : 'text-slate-800 group-hover:text-primary' }}">
                                        UMKM</div>
                                    <div class="mt-0.5 text-[11px] text-slate-400">Data usaha mikro, kecil, menengah,
                                        dan komoditas.</div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('statistik.infrastructure') }}"
                                    class="group block p-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('statistik.infrastructure') ? 'bg-primary/5' : 'hover:bg-slate-50' }}">
                                    <div
                                        class="text-[11px] font-bold uppercase tracking-wider transition-colors {{ request()->routeIs('statistik.infrastructure') ? 'text-primary' : 'text-slate-800 group-hover:text-primary' }}">
                                        Infrastruktur</div>
                                    <div class="mt-0.5 text-[11px] text-slate-400">Fasilitas umum, akses jalan, dan
                                        pembangunan fisik.</div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('statistik.spacial-data') }}"
                                    class="group block p-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('statistik.spacial-data') ? 'bg-primary/5' : 'hover:bg-slate-50' }}">
                                    <div
                                        class="text-[11px] font-bold uppercase tracking-wider transition-colors {{ request()->routeIs('statistik.spacial-data') ? 'text-primary' : 'text-slate-800 group-hover:text-primary' }}">
                                        Data Spasial</div>
                                    <div class="mt-0.5 text-[11px] text-slate-400">Pemetaan wilayah, tata ruang, dan
                                        geografis.</div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="relative">
                <a href="{{ route('analisis') }}"
                    class="block px-3 lg:px-4 py-1.5 rounded-lg text-xs font-semibold tracking-wide {{ request()->routeIs('analisis') ? 'bg-white text-primary shadow-sm' : 'text-slate-600 hover:text-primary hover:bg-white/50' }} transition-all duration-200">
                    <span>Analisis</span>
                </a>
            </div>
        </div>

        <!-- Tombol Autentikasi Desktop (Memicu globalLoading pada parent) -->
        <div class="hidden flex-shrink-0 md:block">
            @auth
                <a href="{{ route('dashboard') }}"
                    @click.prevent="$store.navLoading.start('nav-desktop'); setTimeout(() => window.location.href = $el.href, 50)">
                    <x-button variant="solid" size="sm"
                        class="!bg-primary hover:!bg-primary/90 rounded-xl px-4 py-2.5 text-xs font-bold tracking-wide text-white shadow-sm transition-colors">
                        Dashboard
                    </x-button>
                </a>
            @else
                <a href="{{ route('auth.login') }}"
                    @click.prevent="$store.navLoading.start('nav-desktop'); setTimeout(() => window.location.href = $el.href, 50)"">
                    <x-button variant="outline" size="sm"
                        class="!border-slate-200 hover:!bg-slate-50 rounded-xl px-4 py-2.5 text-xs font-bold tracking-wide text-slate-700 transition-colors">
                        Sign In
                    </x-button>
                </a>
            @endauth
        </div>

        <div class="flex md:hidden">
            <button @click="mobileOpen = !mobileOpen"
                class="relative h-10 w-10 rounded-xl text-slate-600 transition-colors hover:bg-slate-100/50 hover:text-primary focus:outline-none p-2">
                <svg class="absolute left-2.5 top-2.5 h-5 w-5 transform transition-all duration-300"
                    :class="{ 'rotate-90 opacity-0': mobileOpen, 'rotate-0 opacity-100': !mobileOpen }" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
                <svg class="absolute left-2.5 top-2.5 h-5 w-5 transform transition-all duration-300"
                    :class="{ 'rotate-0 opacity-100': mobileOpen, '-rotate-90 opacity-0': !mobileOpen }" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>
    </div>

    <div x-show="mobileOpen" x-cloak x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2 scale-[0.98]"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 -translate-y-2 scale-[0.98]"
        class="absolute inset-x-0 top-[calc(100%+0.5rem)] mx-auto w-full rounded-2xl border border-slate-100 bg-white/95 p-4 shadow-xl backdrop-blur-md md:hidden max-h-[80vh] overflow-y-auto z-40">

        <div class="space-y-1.5">
            <a href="{{ route('home') }}"
                class="block rounded-xl px-3 py-3 text-sm font-semibold transition-colors {{ request()->routeIs('home') ? 'bg-primary/10 text-primary' : 'text-slate-600 hover:bg-slate-50 hover:text-primary' }}">
                Beranda
            </a>

            <div x-data="{ localOpen: {{ request()->routeIs('statistik.*') ? 'true' : 'false' }} }">
                <button @click="localOpen = !localOpen"
                    class="flex w-full items-center justify-between rounded-xl px-3 py-3 text-sm font-semibold text-slate-600 hover:bg-slate-50 hover:text-primary focus:outline-none {{ request()->routeIs('statistik.*') ? 'bg-primary/5 text-primary' : '' }}">
                    <span>Statistik</span>
                    <svg class="h-4 w-4 opacity-60 transition-transform duration-300"
                        :class="{ 'rotate-180': localOpen }" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                        </path>
                    </svg>
                </button>

                <div x-show="localOpen" x-collapse class="mt-1 border-l-2 border-primary/20 pl-4 space-y-0.5">
                    <a href="{{ route('statistik.demografi') }}"
                        class="block rounded-lg px-3 py-2 text-xs font-medium hover:bg-slate-50 {{ request()->routeIs('statistik.demografi') ? 'text-primary font-bold' : 'text-slate-600' }}">Demografi</a>
                    <a href="{{ route('statistik.social') }}"
                        class="block rounded-lg px-3 py-2 text-xs font-medium hover:bg-slate-50 {{ request()->routeIs('statistik.social') ? 'text-primary font-bold' : 'text-slate-600' }}">Sosial</a>
                    <a href="{{ route('statistik.economy') }}"
                        class="block rounded-lg px-3 py-2 text-xs font-medium hover:bg-slate-50 {{ request()->routeIs('statistik.economy') ? 'text-primary font-bold' : 'text-slate-600' }}">Ekonomi</a>
                    <a href="{{ route('statistik.msme') }}"
                        class="block rounded-lg px-3 py-2 text-xs font-medium hover:bg-slate-50 {{ request()->routeIs('statistik.msme') ? 'text-primary font-bold' : 'text-slate-600' }}">UMKM</a>
                    <a href="{{ route('statistik.infrastructure') }}"
                        class="block rounded-lg px-3 py-2 text-xs font-medium hover:bg-slate-50 {{ request()->routeIs('statistik.infrastructure') ? 'text-primary font-bold' : 'text-slate-600' }}">Infrastruktur</a>
                    <a href="{{ route('statistik.spacial-data') }}"
                        class="block rounded-lg px-3 py-2 text-xs font-medium hover:bg-slate-50 {{ request()->routeIs('statistik.spacial-data') ? 'text-primary font-bold' : 'text-slate-600' }}">Data
                        Spasial</a>
                </div>
            </div>

            <a href="{{ route('analisis') }}"
                class="block rounded-xl px-3 py-3 text-sm font-semibold transition-colors {{ request()->routeIs('analisis') ? 'bg-primary/10 text-primary' : 'text-slate-600 hover:bg-slate-50 hover:text-primary' }}">
                Analisis
            </a>

            <!-- Tombol Autentikasi Mobile (Memicu globalLoading pada parent) -->
            <div class="border-t border-slate-100 pt-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="block w-full"
                        @click.prevent="$store.navLoading.start('nav-mobile'); setTimeout(() => window.location.href = $el.href, 50)">
                        <x-button variant="solid"
                            class="!bg-primary hover:!bg-primary/90 !w-full rounded-xl py-3.5 text-white transition-colors"
                            size="md">
                            <span class="text-xs font-bold tracking-wide">Dashboard</span>
                        </x-button>
                    </a>
                @else
                    <a href="{{ route('auth.login') }}" class="block w-full"
                        @click.prevent="$store.navLoading.start('nav-mobile'); setTimeout(() => window.location.href = $el.href, 50)">
                        <x-button variant="outline"
                            class="!border-slate-200 !w-full rounded-xl py-3.5 text-slate-700 hover:!bg-slate-50 transition-colors"
                            size="md">
                            <span class="text-xs font-bold tracking-wide">Sign In</span>
                        </x-button>
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
