<x-layouts.app>
    <div class="flex h-screen overflow-hidden" x-data="{ openStatistik: {{ request()->routeIs('dashboard.statistics.*') ? 'true' : 'false' }}, openManageData: {{ request()->routeIs('dashboard.manage-data.*') ? 'true' : 'false' }} , openSidebar: true }">

        <aside
            class="h-full overflow-y-auto transition-all duration-500 ease-in-out border-r bg-primary text-slate-300 shrink-0 border-tertiary"
            x-bind:class="openSidebar ? 'w-64' : 'w-20'">

            <div class="sticky top-0 z-10 flex items-center h-16 p-4 text-white transition-all duration-500 border-b-2 border-tertiary bg-primary"
                x-bind:class="openSidebar ? 'px-6 justify-start' : 'justify-center'">
                <div class="flex items-center justify-center rounded-lg shrink-0">
                    <x-fab-dev class="size-7" />
                </div>
                <span class="ml-3 text-sm font-bold tracking-wider uppercase truncate origin-left transform"
                    x-bind:class="openSidebar ? 'opacity-100 max-w-xs scale-100 transition-all duration-500 delay-200' :
                        'opacity-0 max-w-0 scale-95 absolute pointer-events-none invisible transition-all duration-150'">
                    Desa Sukaraja
                </span>
            </div>

            <nav class="flex flex-col w-full gap-2 px-4 mt-6 text-base">

                <a href="{{ route('dashboard') }}"
                    class="flex items-center px-4 py-3 rounded-lg transition-all duration-500 {{ request()->routeIs('dashboard') ? 'bg-secondary text-white border-l-4 rounded-l-md' : 'text-slate-300 hover:bg-secondary hover:text-white' }}"
                    x-bind:class="openSidebar ? 'justify-start' : 'justify-center'">
                    <x-untitledui-home-line class="transition-all duration-500 size-5 shrink-0" />
                    <span class="ml-4 truncate origin-left transform"
                        x-bind:class="openSidebar ? 'opacity-100 max-w-xs scale-100 transition-all duration-500 delay-200' :
                            'opacity-0 max-w-0 scale-95 absolute pointer-events-none invisible transition-all duration-150'">
                        Beranda
                    </span>
                </a>

                <div class="relative space-y-2">
                    <button @click="openStatistik = !openStatistik"
                        class="flex items-center w-full px-4 py-3 transition-all duration-500 rounded-lg text-slate-300 hover:bg-secondary hover:text-white"
                        x-bind:class="openSidebar ? 'justify-between' : 'justify-center'">
                        <div class="flex items-center min-w-0">
                            <x-bx-line-chart class="w-5 h-5 transition-all duration-500 shrink-0" />
                            <span class="ml-3 font-medium truncate origin-left transform"
                                x-bind:class="openSidebar ? 'opacity-100 max-w-xs scale-100 transition-all duration-500 delay-200' :
                                    'opacity-0 max-w-0 scale-95 absolute pointer-events-none invisible transition-all duration-150'">
                                Statistik
                            </span>
                        </div>
                        <x-uiw-up class="w-4 h-4 transition-all duration-300 origin-center shrink-0"
                            x-bind:class="[openStatistik ? 'rotate-180' : '', openSidebar ? 'opacity-100 scale-100' :
                                'opacity-0 scale-0 absolute invisible'
                            ]" />
                    </button>

                    <div x-show="openStatistik" x-collapse
                        class="font-medium transition-all duration-500 border-l border-tertiary/50"
                        x-bind:class="openSidebar ? 'ml-4 pl-2 space-y-2' : 'ml-0 pl-0 space-y-0'">

                        <a href="{{ route('dashboard.statistics.demograph') }}"
                            class="flex items-center gap-2 px-4 py-2 text-sm transition-all duration-500 {{ request()->routeIs('dashboard.statistics.demograph') ? 'bg-secondary text-white border-l-4 rounded-l-md ml-1 rounded-r-md' : 'text-slate-300 hover:bg-secondary hover:text-white' }}"
                            x-bind:class="openSidebar ? 'justify-start pl-4' : 'justify-center py-3'">
                            <x-ionicon-people-sharp class="transition-all duration-500 size-5 shrink-0" />
                            <span class="truncate origin-left transform"
                                x-bind:class="openSidebar ? 'opacity-100 max-w-xs scale-100 transition-all duration-500 delay-200' :
                                    'opacity-0 max-w-0 scale-95 absolute pointer-events-none invisible transition-all duration-150'">
                                Demografi
                            </span>
                        </a>

                        <a href="{{ route('dashboard.statistics.social') }}"
                            class="flex items-center gap-2 px-4 py-2 text-sm transition-all duration-500 {{ request()->routeIs('dashboard.statistics.social') ? 'bg-secondary text-white border-l-4 rounded-l-md ml-1 rounded-r-md' : 'text-slate-300 hover:bg-secondary hover:text-white' }}"
                            x-bind:class="openSidebar ? 'justify-start pl-4' : 'justify-center py-3'">
                            <x-ri-heart-pulse-line class="transition-all duration-500 size-5 shrink-0" />
                            <span class="truncate origin-left transform"
                                x-bind:class="openSidebar ? 'opacity-100 max-w-xs scale-100 transition-all duration-500 delay-200' :
                                    'opacity-0 max-w-0 scale-95 absolute pointer-events-none invisible transition-all duration-150'">
                                Sosial
                            </span>
                        </a>

                        <a href="{{ route('dashboard.statistics.economy') }}"
                            class="flex items-center gap-2 px-4 py-2 text-sm transition-all duration-500 {{ request()->routeIs('dashboard.statistics.economy') ? 'bg-secondary text-white border-l-4 rounded-l-md ml-1 rounded-r-md' : 'text-slate-300 hover:bg-secondary hover:text-white' }}"
                            x-bind:class="openSidebar ? 'justify-start pl-4' : 'justify-center py-3'">
                            <x-phosphor-money class="transition-all duration-500 size-5 shrink-0" />
                            <span class="truncate origin-left transform"
                                x-bind:class="openSidebar ? 'opacity-100 max-w-xs scale-100 transition-all duration-500 delay-200' :
                                    'opacity-0 max-w-0 scale-95 absolute pointer-events-none invisible transition-all duration-150'">
                                Ekonomi
                            </span>
                        </a>

                        <a href="{{ route('dashboard.statistics.msme') }}"
                            class="flex items-center gap-2 px-4 py-2 text-sm transition-all duration-500 {{ request()->routeIs('dashboard.statistics.msme') ? 'bg-secondary text-white border-l-4 rounded-l-md ml-1 rounded-r-md' : 'text-slate-300 hover:bg-secondary hover:text-white' }}"
                            x-bind:class="openSidebar ? 'justify-start pl-4' : 'justify-center py-3'">
                            <x-bi-shop class="transition-all duration-500 size-5 shrink-0" />
                            <span class="truncate origin-left transform"
                                x-bind:class="openSidebar ? 'opacity-100 max-w-xs scale-100 transition-all duration-500 delay-200' :
                                    'opacity-0 max-w-0 scale-95 absolute pointer-events-none invisible transition-all duration-150'">
                                Umkm
                            </span>
                        </a>

                        <a href="{{ route('dashboard.statistics.infrastructure') }}"
                            class="flex items-center gap-2 px-4 py-2 text-sm transition-all duration-500 {{ request()->routeIs('dashboard.statistics.infrastructure') ? 'bg-secondary text-white border-l-4 rounded-l-md ml-1 rounded-r-md' : 'text-slate-300 hover:bg-secondary hover:text-white' }}"
                            x-bind:class="openSidebar ? 'justify-start pl-4' : 'justify-center py-3'">
                            <x-bi-building-gear class="transition-all duration-500 size-5 shrink-0" />
                            <span class="truncate origin-left transform"
                                x-bind:class="openSidebar ? 'opacity-100 max-w-xs scale-100 transition-all duration-500 delay-200' :
                                    'opacity-0 max-w-0 scale-95 absolute pointer-events-none invisible transition-all duration-150'">
                                Infrastruktur
                            </span>
                        </a>

                        <a href="{{ route('dashboard.statistics.spatial-data') }}"
                            class="flex items-center gap-2 px-4 py-2 text-sm transition-all duration-500 {{ request()->routeIs('dashboard.statistics.spatial-data') ? 'bg-secondary text-white border-l-4 rounded-l-md ml-1 rounded-r-md' : 'text-slate-300 hover:bg-secondary hover:text-white' }}"
                            x-bind:class="openSidebar ? 'justify-start pl-4' : 'justify-center py-3'">
                            <x-iconsax-out-map class="transition-all duration-500 size-5 shrink-0" />
                            <span class="truncate origin-left transform"
                                x-bind:class="openSidebar ? 'opacity-100 max-w-xs scale-100 transition-all duration-500 delay-200' :
                                    'opacity-0 max-w-0 scale-95 absolute pointer-events-none invisible transition-all duration-150'">
                                Data Spasial
                            </span>
                        </a>
                    </div>
                </div>

                <div class="relative space-y-2">
                    <button @click="openManageData = !openManageData"
                        class="flex items-center w-full px-4 py-3 transition-all duration-500 rounded-lg text-slate-300 hover:bg-secondary hover:text-white"
                        x-bind:class="openSidebar ? 'justify-between' : 'justify-center'">
                        <div class="flex items-center min-w-0">
                            <x-iconsax-lin-data-2 class="w-5 h-5 transition-all duration-500 shrink-0" />
                            <span class="ml-3 font-medium truncate origin-left transform"
                                x-bind:class="openSidebar ? 'opacity-100 max-w-xs scale-100 transition-all duration-500 delay-200' :
                                    'opacity-0 max-w-0 scale-95 absolute pointer-events-none invisible transition-all duration-150'">
                                Kelola Data
                            </span>
                        </div>
                        <x-uiw-up class="w-4 h-4 transition-all duration-300 origin-center shrink-0"
                            x-bind:class="[openManageData ? 'rotate-180' : '', openSidebar ? 'opacity-100 scale-100' :
                                'opacity-0 scale-0 absolute invisible'
                            ]" />
                    </button>

                    <div x-show="openManageData" x-collapse
                        class="font-medium transition-all duration-500 border-l border-tertiary/50"
                        x-bind:class="openSidebar ? 'ml-4 pl-2 space-y-2' : 'ml-0 pl-0 space-y-0'">

                        <a href="{{ route('dashboard.manage-data.territories') }}"
                            class="flex items-center gap-2 px-4 py-2 text-sm transition-all duration-500 {{ request()->routeIs('dashboard.manage-data.territories') ? 'bg-secondary text-white border-l-4 rounded-l-md ml-1 rounded-r-md' : 'text-slate-300 hover:bg-secondary hover:text-white' }}"
                            x-bind:class="openSidebar ? 'justify-start pl-4' : 'justify-center py-3'">
                            <x-iconsax-out-flag class="transition-all duration-500 size-5 shrink-0" />
                            <span class="truncate origin-left transform"
                                x-bind:class="openSidebar ? 'opacity-100 max-w-xs scale-100 transition-all duration-500 delay-200' :
                                    'opacity-0 max-w-0 scale-95 absolute pointer-events-none invisible transition-all duration-150'">
                                Data Wilayah
                            </span>
                        </a>

                        <a href="{{ route('dashboard.manage-data.families') }}"
                            class="flex items-center gap-2 px-4 py-2 text-sm transition-all duration-500 {{ request()->routeIs('dashboard.manage-data.families') ? 'bg-secondary text-white border-l-4 rounded-l-md ml-1 rounded-r-md' : 'text-slate-300 hover:bg-secondary hover:text-white' }}"
                            x-bind:class="openSidebar ? 'justify-start pl-4' : 'justify-center py-3'">
                            <x-iconsax-bro-user-add class="transition-all duration-500 size-5 shrink-0" />
                            <span class="truncate origin-left transform"
                                x-bind:class="openSidebar ? 'opacity-100 max-w-xs scale-100 transition-all duration-500 delay-200' :
                                    'opacity-0 max-w-0 scale-95 absolute pointer-events-none invisible transition-all duration-150'">
                                Data Keluarga
                            </span>
                        </a>

                        <a href="{{ route('dashboard.manage-data.citizens') }}"
                            class="flex items-center gap-2 px-4 py-2 text-sm transition-all duration-500 {{ request()->routeIs('dashboard.manage-data.citizens') ? 'bg-secondary text-white border-l-4 rounded-l-md ml-1 rounded-r-md' : 'text-slate-300 hover:bg-secondary hover:text-white' }}"
                            x-bind:class="openSidebar ? 'justify-start pl-4' : 'justify-center py-3'">
                            <x-untitledui-user class="transition-all duration-500 size-5 shrink-0" />
                            <span class="truncate origin-left transform"
                                x-bind:class="openSidebar ? 'opacity-100 max-w-xs scale-100 transition-all duration-500 delay-200' :
                                    'opacity-0 max-w-0 scale-95 absolute pointer-events-none invisible transition-all duration-150'">
                                Data Penduduk
                            </span>
                        </a>

                        <a href="{{ route('dashboard.manage-data.social-economics') }}"
                            class="flex items-center gap-2 px-4 py-2 text-sm transition-all duration-500 {{ request()->routeIs('dashboard.manage-data.social-economics') ? 'bg-secondary text-white border-l-4 rounded-l-md ml-1 rounded-r-md' : 'text-slate-300 hover:bg-secondary hover:text-white' }}"
                            x-bind:class="openSidebar ? 'justify-start pl-4' : 'justify-center py-3'">
                            <x-ri-heart-pulse-line class="transition-all duration-500 size-5 shrink-0" />
                            <span class="truncate origin-left transform"
                                x-bind:class="openSidebar ? 'opacity-100 max-w-xs scale-100 transition-all duration-500 delay-200' :
                                    'opacity-0 max-w-0 scale-95 absolute pointer-events-none invisible transition-all duration-150'">
                                Sosial Ekonomi
                            </span>
                        </a>

                        <a href="{{ route('dashboard.manage-data.msmes') }}"
                            class="flex items-center gap-2 px-4 py-2 text-sm transition-all duration-500 {{ request()->routeIs('dashboard.manage-data.msmes') ? 'bg-secondary text-white border-l-4 rounded-l-md ml-1 rounded-r-md' : 'text-slate-300 hover:bg-secondary hover:text-white' }}"
                            x-bind:class="openSidebar ? 'justify-start pl-4' : 'justify-center py-3'">
                            <x-bi-shop class="transition-all duration-500 size-5 shrink-0" />
                            <span class="truncate origin-left transform"
                                x-bind:class="openSidebar ? 'opacity-100 max-w-xs scale-100 transition-all duration-500 delay-200' :
                                    'opacity-0 max-w-0 scale-95 absolute pointer-events-none invisible transition-all duration-150'">
                                Data UMKM (MSMEs)
                            </span>
                        </a>

                        <a href="{{ route('dashboard.manage-data.infrastructures') }}"
                            class="flex items-center gap-2 px-4 py-2 text-sm transition-all duration-500 {{ request()->routeIs('dashboard.manage-data.infrastructures') ? 'bg-secondary text-white border-l-4 rounded-l-md ml-1 rounded-r-md' : 'text-slate-300 hover:bg-secondary hover:text-white' }}"
                            x-bind:class="openSidebar ? 'justify-start pl-4' : 'justify-center py-3'">
                            <x-iconsax-lin-buildings class="transition-all duration-500 size-5 shrink-0" />
                            <span class="truncate origin-left transform"
                                x-bind:class="openSidebar ? 'opacity-100 max-w-xs scale-100 transition-all duration-500 delay-200' :
                                    'opacity-0 max-w-0 scale-95 absolute pointer-events-none invisible transition-all duration-150'">
                                Data Infrastruktur
                            </span>
                        </a>

                        <a href="{{ route('dashboard.manage-data.spatial-data') }}"
                            class="flex items-center gap-2 px-4 py-2 text-sm transition-all duration-500 {{ request()->routeIs('dashboard.manage-data.spatial-data') ? 'bg-secondary text-white border-l-4 rounded-l-md ml-1 rounded-r-md' : 'text-slate-300 hover:bg-secondary hover:text-white' }}"
                            x-bind:class="openSidebar ? 'justify-start pl-4' : 'justify-center py-3'">
                            <x-iconsax-lin-map class="transition-all duration-500 size-5 shrink-0" />
                            <span class="truncate origin-left transform"
                                x-bind:class="openSidebar ? 'opacity-100 max-w-xs scale-100 transition-all duration-500 delay-200' :
                                    'opacity-0 max-w-0 scale-95 absolute pointer-events-none invisible transition-all duration-150'">
                                Data Spasial (GIS)
                            </span>
                        </a>
                    </div>
                </div>

                <a href="{{ route('dashboard.pandawa-analysis') }}"
                    class="flex items-center px-4 py-3 transition-all duration-500 rounded-lg {{ request()->routeIs('dashboard.pandawa-analysis') ? 'bg-secondary text-white' : 'text-slate-300 hover:bg-secondary hover:text-white' }}"
                    x-bind:class="openSidebar ? 'justify-start' : 'justify-center'">
                    <x-untitledui-star-06 class="transition-all duration-500 size-5 shrink-0" />
                    <span class="ml-4 truncate origin-left transform"
                        x-bind:class="openSidebar ? 'opacity-100 max-w-xs scale-100 transition-all duration-500 delay-200' :
                            'opacity-0 max-w-0 scale-95 absolute pointer-events-none invisible transition-all duration-150'">
                        Pandawa - Analisis
                    </span>
                </a>

                @auth
                <form method="POST" action="{{ route('auth.logout') }}" class="w-full">
                    @csrf
                    <button type="submit"
                        class="flex items-center w-full px-4 py-3 text-red-800 transition-all duration-500 rounded-lg hover:bg-red-800 hover:text-white"
                        x-bind:class="openSidebar ? 'justify-start' : 'justify-center'">
                        <x-iconsax-out-logout class="transition-all duration-500 size-5 shrink-0" />
                        <span class="ml-4 truncate origin-left transform"
                            x-bind:class="openSidebar ? 'opacity-100 max-w-xs scale-100 transition-all duration-500 delay-200' :
                                    'opacity-0 max-w-0 scale-95 absolute pointer-events-none invisible transition-all duration-150'">
                            Logout
                        </span>
                    </button>
                </form>
                @endauth
            </nav>
        </aside>

        <div class="flex flex-col flex-1 h-full min-w-0">
            <header class="flex items-center justify-between h-16 px-8 bg-quaternary border-b-2 border-primary shrink-0">
                <button @click="openSidebar = !openSidebar" class="cursor-pointer text-slate-500 hover:text-primary">
                    <x-solar-hamburger-menu-broken class="size-6" />
                </button>

                <button
                    class="px-5 py-2 text-sm font-semibold text-white capitalize transition rounded-md bg-primary hover:bg-secondary">
                    {{ Auth::user()->fullname ?? 'Petugas' }}
                </button>
            </header>

            <main class="container flex-1 p-8 mx-auto overflow-y-auto bg-quaternary">
                {{ $slot ?? '' }}
                @yield('content')
            </main>
        </div>
    </div>
</x-layouts.app>
