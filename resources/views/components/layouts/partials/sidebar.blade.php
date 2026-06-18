<aside
    class="h-full overflow-y-auto [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none] transition-all duration-300 ease-in-out bg-secondary text-textSecondary shrink-0 border-r-2 border-textTertiary/20 fixed top-0 left-0 z-50 w-64 transform -translate-x-full md:relative md:translate-x-0 md:w-64"
    x-bind:class="{
        'translate-x-0': openSidebar,
        '-translate-x-full md:translate-x-0': !openSidebar,
        'md:w-64': openSidebar,
        'md:w-20': !openSidebar
    }">

    <!-- Sidebar Header (Sticky Brand Area) -->
    <div class="sticky top-0 z-10 flex items-center h-16 p-4 text-textPrimary transition-all duration-500  bg-secondary"
        x-bind:class="openSidebar ? 'px-6 justify-between md:justify-start' : 'justify-center'">
        <div class="flex items-center justify-center rounded-lg shrink-0 text-primary">
            <x-fab-dev class="size-7" />
        </div>
        <span
            class="ml-3 text-sm font-bold tracking-wider uppercase truncate origin-left transform whitespace-nowrap text-textPrimary"
            x-bind:class="openSidebar ? 'opacity-100 max-w-xs scale-100 transition-all duration-500 delay-200' :
                'opacity-0 max-w-0 scale-95 absolute pointer-events-none invisible transition-all duration-150'">
            Desa Sukaraja
        </span>

        <button @click="openSidebar = false" class="text-textSecondary hover:text-textPrimary md:hidden">
            <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Navigation Menu Items -->
    <nav class="flex flex-col w-full gap-2 px-4 mt-6 text-base">

        <!-- Menu: Beranda -->
        <a href="{{ route('dashboard') }}"
            class="flex items-center px-4 py-3 rounded-lg transition-all duration-300 {{ request()->routeIs('dashboard') ? 'bg-primary text-secondary' : 'text-textSecondary hover:bg-tertiary hover:text-textPrimary' }}"
            x-bind:class="openSidebar ? 'justify-start' : 'md:justify-center'">
            <x-untitledui-home-line class="transition-all duration-500 size-5 shrink-0" />
            <span class="ml-4 truncate origin-left transform whitespace-nowrap"
                x-bind:class="openSidebar ? 'opacity-100 max-w-xs scale-100 transition-all duration-500 delay-200' :
                    'opacity-0 max-w-0 scale-95 md:absolute pointer-events-none md:invisible transition-all duration-150'">
                Beranda
            </span>
        </a>

        <!-- Menu Dropdown: Statistik -->
        <div class="relative space-y-2">
            <button
                @click="if(window.innerWidth < 768) { openStatistik = !openStatistik } else { if(!openSidebar) { openSidebar = true; openStatistik = true; } else { openStatistik = !openStatistik; } }"
                class="flex items-center w-full px-4 py-3 transition-all duration-300 rounded-lg text-textSecondary hover:bg-tertiary hover:text-textPrimary"
                x-bind:class="openSidebar ? 'justify-between' : 'md:justify-center'">
                <div class="flex items-center min-w-0">
                    <x-bx-line-chart class="w-5 h-5 transition-all duration-500 shrink-0" />
                    <span class="ml-3 truncate origin-left transform whitespace-nowrap"
                        x-bind:class="openSidebar ? 'opacity-100 max-w-xs scale-100 transition-all duration-500 delay-200' :
                            'opacity-0 max-w-0 scale-95 md:absolute pointer-events-none md:invisible transition-all duration-150'">
                        Statistik
                    </span>
                </div>
                <x-uiw-up class="w-4 h-4 transition-all duration-300 origin-center shrink-0"
                    x-bind:class="[openStatistik && (openSidebar || window.innerWidth < 768) ? 'rotate-180' : '', openSidebar ?
                        'opacity-100 scale-100' :
                        'opacity-0 scale-0 md:absolute md:invisible'
                    ]" />
            </button>

            <!-- Sub-menu: Statistik Halaman -->
            <div x-show="openStatistik && (openSidebar || window.innerWidth < 768)" x-collapse x-cloak
                x-init="$el.classList.remove('hidden')" class="hidden pl-2 ml-4 space-y-1 border-l border-textTertiary/30">
                <a href="{{ route('dashboard.statistics.demograph') }}"
                    class="flex items-center gap-2 px-4 py-2.5 text-sm transition-all duration-300 {{ request()->routeIs('dashboard.statistics.demograph') ? 'bg-primary text-secondary font-semibold' : 'text-textSecondary hover:bg-tertiary hover:text-textPrimary' }} justify-start pl-4 rounded-lg">
                    <x-ionicon-people-sharp class="size-5 shrink-0" /> <span class="truncate">Demografi</span>
                </a>
                <a href="{{ route('dashboard.statistics.social') }}"
                    class="flex items-center gap-2 px-4 py-2.5 text-sm transition-all duration-300 {{ request()->routeIs('dashboard.statistics.social') ? 'bg-primary text-secondary font-semibold' : 'text-textSecondary hover:bg-tertiary hover:text-textPrimary' }} justify-start pl-4 rounded-lg">
                    <x-ri-heart-pulse-line class="size-5 shrink-0" /> <span class="truncate">Sosial</span>
                </a>
                <a href="{{ route('dashboard.statistics.economy') }}"
                    class="flex items-center gap-2 px-4 py-2.5 text-sm transition-all duration-300 {{ request()->routeIs('dashboard.statistics.economy') ? 'bg-primary text-secondary font-semibold' : 'text-textSecondary hover:bg-tertiary hover:text-textPrimary' }} justify-start pl-4 rounded-lg">
                    <x-phosphor-money class="size-5 shrink-0" /> <span class="truncate">Ekonomi</span>
                </a>
                <a href="{{ route('dashboard.statistics.msme') }}"
                    class="flex items-center gap-2 px-4 py-2.5 text-sm transition-all duration-300 {{ request()->routeIs('dashboard.statistics.msme') ? 'bg-primary text-secondary font-semibold' : 'text-textSecondary hover:bg-tertiary hover:text-textPrimary' }} justify-start pl-4 rounded-lg">
                    <x-bi-shop class="size-5 shrink-0" /> <span class="truncate">Umkm</span>
                </a>
                <a href="{{ route('dashboard.statistics.infrastructure') }}"
                    class="flex items-center gap-2 px-4 py-2.5 text-sm transition-all duration-300 {{ request()->routeIs('dashboard.statistics.infrastructure') ? 'bg-primary text-secondary font-semibold' : 'text-textSecondary hover:bg-tertiary hover:text-textPrimary' }} justify-start pl-4 rounded-lg">
                    <x-bi-building-gear class="size-5 shrink-0" /> <span class="truncate">Infrastruktur</span>
                </a>
                <a href="{{ route('dashboard.statistics.spatial-data') }}"
                    class="flex items-center gap-2 px-4 py-2.5 text-sm transition-all duration-300 {{ request()->routeIs('dashboard.statistics.spatial-data') ? 'bg-primary text-secondary font-semibold' : 'text-textSecondary hover:bg-tertiary hover:text-textPrimary' }} justify-start pl-4 rounded-lg">
                    <x-iconsax-out-map class="size-5 shrink-0" /> <span class="truncate">Data Spasial</span>
                </a>
            </div>
        </div>

        <!-- Menu Dropdown: Kelola Data -->
        <div class="relative space-y-2">
            <button
                @click="if(window.innerWidth < 768) { openManageData = !openManageData } else { if(!openSidebar) { openSidebar = true; openManageData = true; } else { openManageData = !openManageData; } }"
                class="flex items-center w-full px-4 py-3 transition-all duration-300 rounded-lg text-textSecondary hover:bg-tertiary hover:text-textPrimary"
                x-bind:class="openSidebar ? 'justify-between' : 'md:justify-center'">
                <div class="flex items-center min-w-0">
                    <x-iconsax-lin-data-2 class="w-5 h-5 transition-all duration-500 shrink-0" />
                    <span class="ml-3 truncate origin-left transform whitespace-nowrap"
                        x-bind:class="openSidebar ? 'opacity-100 max-w-xs scale-100 transition-all duration-500 delay-200' :
                            'opacity-0 max-w-0 scale-95 md:absolute pointer-events-none md:invisible transition-all duration-150'">
                        Kelola Data
                    </span>
                </div>
                <x-uiw-up class="w-4 h-4 transition-all duration-300 origin-center shrink-0"
                    x-bind:class="[openManageData && (openSidebar || window.innerWidth < 768) ? 'rotate-180' : '', openSidebar ?
                        'opacity-100 scale-100' :
                        'opacity-0 scale-0 md:absolute md:invisible'
                    ]" />
            </button>

            <!-- Sub-menu: Kelola Data Halaman -->
            <div x-show="openManageData && (openSidebar || window.innerWidth < 768)" x-collapse x-cloak
                x-init="$el.classList.remove('hidden')" class="hidden pl-2 ml-4 space-y-1 border-l border-textTertiary/30">
                <a href="{{ route('dashboard.manage-data.territories') }}"
                    class="flex items-center gap-2 px-4 py-2.5 text-sm transition-all duration-300 {{ request()->routeIs('dashboard.manage-data.territories') ? 'bg-primary text-secondary font-semibold' : 'text-textSecondary hover:bg-tertiary hover:text-textPrimary' }} justify-start pl-4 rounded-lg">
                    <x-iconsax-out-flag class="size-5 shrink-0" /> <span class="truncate">Data Wilayah</span>
                </a>
                <a href="{{ route('dashboard.manage-data.families') }}"
                    class="flex items-center gap-2 px-4 py-2.5 text-sm transition-all duration-300 {{ request()->routeIs('dashboard.manage-data.families') ? 'bg-primary text-secondary font-semibold' : 'text-textSecondary hover:bg-tertiary hover:text-textPrimary' }} justify-start pl-4 rounded-lg">
                    <x-iconsax-bro-user-add class="size-5 shrink-0" /> <span class="truncate">Data Keluarga</span>
                </a>
                <a href="{{ route('dashboard.manage-data.citizens') }}"
                    class="flex items-center gap-2 px-4 py-2.5 text-sm transition-all duration-300 {{ request()->routeIs('dashboard.manage-data.citizens') ? 'bg-primary text-secondary font-semibold' : 'text-textSecondary hover:bg-tertiary hover:text-textPrimary' }} justify-start pl-4 rounded-lg">
                    <x-untitledui-user class="size-5 shrink-0" /> <span class="truncate">Data Penduduk</span>
                </a>
                <a href="{{ route('dashboard.manage-data.msmes') }}"
                    class="flex items-center gap-2 px-4 py-2.5 text-sm transition-all duration-300 {{ request()->routeIs('dashboard.manage-data.msmes') ? 'bg-primary text-secondary font-semibold' : 'text-textSecondary hover:bg-tertiary hover:text-textPrimary' }} justify-start pl-4 rounded-lg">
                    <x-bi-shop class="size-5 shrink-0" /> <span class="truncate">Data UMKM (MSMEs)</span>
                </a>
                <a href="{{ route('dashboard.manage-data.infrastructures') }}"
                    class="flex items-center gap-2 px-4 py-2.5 text-sm transition-all duration-300 {{ request()->routeIs('dashboard.manage-data.infrastructures') ? 'bg-primary text-secondary font-semibold' : 'text-textSecondary hover:bg-tertiary hover:text-textPrimary' }} justify-start pl-4 rounded-lg">
                    <x-iconsax-lin-buildings class="size-5 shrink-0" /> <span class="truncate">Data Infrastruktur</span>
                </a>
                <a href="{{ route('dashboard.manage-data.spatial-data') }}"
                    class="flex items-center gap-2 px-4 py-2.5 text-sm transition-all duration-300 {{ request()->routeIs('dashboard.manage-data.spatial-data') ? 'bg-primary text-secondary font-semibold' : 'text-textSecondary hover:bg-tertiary hover:text-textPrimary' }} justify-start pl-4 rounded-lg">
                    <x-iconsax-lin-map class="size-5 shrink-0" /> <span class="truncate">Data Spasial (GIS)</span>
                </a>
            </div>
        </div>

        <!-- Menu: Pandawa Analisis -->
        <a href="{{ route('dashboard.pandawa-analysis') }}"
            class="flex items-center px-4 py-3 rounded-lg transition-all duration-300 {{ request()->routeIs('dashboard.pandawa-analysis') ? 'bg-primary text-secondary' : 'text-textSecondary hover:bg-tertiary hover:text-textPrimary' }}"
            x-bind:class="openSidebar ? 'justify-start' : 'md:justify-center'">
            <x-untitledui-star-06 class="transition-all duration-500 size-5 shrink-0" />
            <span class="ml-4 truncate origin-left transform whitespace-nowrap"
                x-bind:class="openSidebar ? 'opacity-100 max-w-xs scale-100 transition-all duration-500 delay-200' :
                    'opacity-0 max-w-0 scale-95 md:absolute pointer-events-none md:invisible transition-all duration-150'">
                Pandawa - Analisis
            </span>
        </a>

        <!-- Form: Logout Action -->
        @auth
            <form method="POST" action="{{ route('auth.logout') }}" class="w-full mt-auto pt-4">
                @csrf
                <button type="submit"
                    class="flex items-center w-full px-4 py-3 text-red-500 transition-all duration-300 rounded-lg hover:bg-red-50/80 hover:text-red-600"
                    x-bind:class="openSidebar ? 'justify-start' : 'md:justify-center'">
                    <x-iconsax-out-logout class="transition-all duration-500 size-5 shrink-0" />
                    <span class="ml-4 truncate origin-left transform whitespace-nowrap"
                        x-bind:class="openSidebar ? 'opacity-100 max-w-xs scale-100 transition-all duration-500 delay-200' :
                            'opacity-0 max-w-0 scale-95 md:absolute pointer-events-none md:invisible transition-all duration-150'">
                        Logout
                    </span>
                </button>
            </form>
        @endauth
    </nav>
</aside>
