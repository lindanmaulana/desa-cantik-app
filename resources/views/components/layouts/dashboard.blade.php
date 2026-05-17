<x-layouts.app>
    <div class="flex h-screen overflow-hidden" x-data="{ openStatistik: {{ request()->routeIs('dashboard.statistics.*') ? 'true' : 'false' }}, openSidebar: true }">

        <aside class="h-full overflow-y-auto transition-all duration-500 ease-in-out border-r bg-primary text-slate-300 shrink-0 border-third"
            x-bind:class="openSidebar ? 'w-64' : 'w-20'">

            <div class="sticky top-0 z-10 flex items-center h-16 p-4 text-white border-b-2 border-third bg-primary"
                x-bind:class="openSidebar ? 'space-x-3 justify-start' : 'justify-center space-x-0'">
                <div class="rounded-lg shrink-0">
                    <x-fab-dev class="size-7" />
                </div>
                <span class="text-sm font-bold tracking-wider uppercase"
                    x-bind:class="openSidebar ? 'block truncate' : 'hidden'">
                    Desa Sukaraja
                </span>
            </div>

            <nav class="flex flex-col w-full gap-2 px-4 mt-6 text-base">
                <a href="{{ route('dashboard') }} " class="flex items-center gap-4 px-4 py-3 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-secondary text-white border-l-4 rounded-l-md' : 'text-slate-300 hover:bg-secondary hover:text-white' }}">
                    <x-untitledui-home-line class="size-5" />
                    <span x-bind:class="openSidebar ? 'block' : 'hidden'">Beranda</span>
                </a>

                <div class="relative">
                    <button @click="openStatistik = !openStatistik"
                        class="flex items-center justify-between w-full px-4 py-3 transition rounded-lgtext-slate-300 hover:bg-secondary hover:text-white">
                        <div class="flex items-center">
                            <x-bx-line-chart class="w-5 h-5 mr-3" />
                            <span class="font-medium" x-bind:class="openSidebar ? 'block' : 'hidden'">Statistik</span>
                        </div>
                        <x-uiw-up class="w-4 h-4 transition-transform duration-200"
                            x-bind:class="openStatistik ? 'rotate-180' : ''"
                            x-bind:class="openSidebar ? 'block' : 'hidden'" />
                    </button>

                    <div x-show="openStatistik" x-collapse class="ml-4 space-y-2 font-medium border-l border-third/50">
                        <a href="{{ route('dashboard.statistics.demograph') }}"
                            class="flex items-center gap-2 px-8 py-2 text-sm transition {{ request()->routeIs('dashboard.statistics.demograph') ? 'bg-secondary text-white border-l-4 rounded-l-md ml-1 rounded-r-md' : 'text-slate-300 hover:bg-secondary hover:text-white' }}"
                            x-show="openSidebar">
                            <x-ionicon-people-sharp class="size-5" /> Demografi
                        </a>

                        <a href="{{ route('dashboard.statistics.social') }}"
                            class="flex items-center gap-2 px-8 py-2 text-sm transition {{ request()->routeIs('dashboard.statistics.social') ? 'bg-secondary text-white border-l-4 rounded-l-md ml-1 rounded-r-md' : 'text-slate-300 hover:bg-secondary hover:text-white' }}"
                            x-bind:class="openSidebar ? 'block' : 'hidden'"> <x-ri-heart-pulse-line class="size-5" />
                            Sosial</a>

                        <a href="{{ route('dashboard.statistics.economy') }}"
                            class="flex items-center gap-2 px-8 py-2 text-sm transition {{ request()->routeIs('dashboard.statistics.economy') ? 'bg-secondary text-white border-l-4 rounded-l-md ml-1 rounded-r-md' : 'text-slate-300 hover:bg-secondary hover:text-white' }}"
                            x-bind:class="openSidebar ? 'block' : 'hidden'"> <x-phosphor-money class="size-5" />
                            Ekonomi</a>

                        <a href="{{ route('dashboard.statistics.msme') }}"
                            class="flex items-center gap-2 px-8 py-2 text-sm transition {{ request()->routeIs('dashboard.statistics.msme') ? 'bg-secondary text-white border-l-4 rounded-l-md ml-1 rounded-r-md' : 'text-slate-300 hover:bg-secondary hover:text-white' }}"
                            x-bind:class="openSidebar ? 'block' : 'hidden'"> <x-bi-shop class="size-5" />
                            Umkm</a>

                        <a href="{{ route('dashboard.statistics.infrastructure') }}"
                            class="flex items-center gap-2 px-8 py-2 text-sm transition {{ request()->routeIs('dashboard.statistics.infrastructure') ? 'bg-secondary text-white border-l-4 rounded-l-md ml-1 rounded-r-md' : 'text-slate-300 hover:bg-secondary hover:text-white' }}"
                            x-bind:class="openSidebar ? 'block' : 'hidden'"> <x-bi-building-gear class="size-5" />
                            Infrastruktur</a>
                    </div>
                </div>


                <a href="#"
                    class="flex items-center gap-4 px-4 py-3 transition rounded-lg {{ request()->routeIs('dashboard.pandawa') ? 'bg-secondary text-white' : 'text-slate-300 hover:bg-secondary hover:text-white' }}">
                    <x-untitledui-star-06 class="size-5" />
                    <span class="" x-bind:class="openSidebar ? 'block' : 'hidden'">Pandawa - Analisis</span>
                </a>

                <form method="POST" action="{{ route('auth.logout') }}" class="">
                    @csrf

                    <button type="submit"
                        class="flex items-center w-full gap-4 px-4 py-3 text-red-800 transition rounded-lg hover:bg-red-800 hover:text-white">
                        <x-iconsax-out-logout class=" size-5" />
                        <span class="">Logout</span>
                    </button>
                </form>
            </nav>
        </aside>

        <div class="flex flex-col flex-1 h-full min-w-0">
            <header class="flex items-center justify-between h-16 px-8 bg-white border-b-2 border-primary shrink-0">
                <button @click="openSidebar = !openSidebar"
                    class="cursor-pointer text-slate-500 hover:text-primary">
                    <x-solar-hamburger-menu-broken class="size-6" />
                </button>

                <button class="px-5 py-2 text-sm font-semibold text-white transition rounded-md bg-primary hover:bg-secondary">
                    {{ Auth::user()->fullname ?? 'Petugas' }}
                </button>
            </header>

            <main class="flex-1 p-8 overflow-y-auto bg-slate-50">
                {{ $slot ?? '' }}


                @yield('content')
            </main>
        </div>
    </div>
</x-layouts.app>
