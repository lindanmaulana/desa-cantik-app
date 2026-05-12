<x-layouts.app>
    <div class="flex min-h-screen" x-data="{ openStatistik: false, openSidebar: false }">
        <aside class=" bg-primary text-slate-300 shrink-0 transition-all ease-in-out duration-500"
            x-bind:class="openSidebar ? 'w-64' : 'w-20'">
            <div class="p-4 min-h-16 flex items-center border-b-2 border-third text-white"
                x-bind:class="openSidebar ? 'space-x-3 justify-start' : 'justify-center space-x-0'">

                <div class="rounded-lg shrink-0">
                    <x-fab-dev class="size-7" />
                </div>

                <span class="font-bold tracking-wider uppercase text-sm"
                    x-bind:class="openSidebar ? 'block truncate' : 'hidden'">
                    Desa Sukaraja
                </span>
            </div>

            <nav class="w-full mt-6 px-4 space-y-2 text-base">
                <a href="#" class="flex items-center gap-4 px-4 py-3 text-white bg-secondary rounded-lg">
                    <x-untitledui-home-line class="size-5" />
                    <span x-bind:class="openSidebar ? 'block' : 'hidden'">Beranda</span>
                </a>

                <div class="relative">
                    <button @click="openStatistik = !openStatistik"
                        class="w-full flex items-center justify-between px-4 py-3 rounded-lg transition text-slate-300 hover:bg-secondary hover:text-white"
                        :class="openStatistik ? 'bg-secondary text-white' : ''">

                        <div class="flex items-center">
                            <x-bx-line-chart class="w-5 h-5 mr-3" />
                            <span class="font-medium" x-bind:class="openSidebar ? 'block' : 'hidden'">Statistik</span>
                        </div>

                        <x-uiw-up class="w-4 h-4 transition-transform duration-200"
                            x-bind:class="openStatistik ? 'rotate-180' : ''"
                            x-bind:class="openSidebar ? 'block' : 'hidden'" />
                    </button>

                    <div x-show="openStatistik" x-collapse class="mt-2 ml-4 space-y-2 border-l border-third font-medium"
                        style="display: none;">
                        <a href="#"
                            class="px-8 py-2 text-sm hover:bg-secondary hover:text-white transition flex items-center gap-2"
                            x-bind:class="openSidebar ? 'block' : 'hidden'"><x-ionicon-people-sharp class="size-5" />
                            Demografi</a>
                        <a href="#"
                            class="px-8 py-2 text-sm hover:bg-secondary hover:text-white transition flex items-center gap-2"
                            x-bind:class="openSidebar ? 'block' : 'hidden'"> <x-ri-heart-pulse-line class="size-5" />
                            Sosial</a>
                        <a href="#"
                            class="px-8 py-2 text-sm hover:bg-secondary hover:text-white transition flex items-center gap-2"
                            x-bind:class="openSidebar ? 'block' : 'hidden'"> <x-phosphor-money class="size-5" />
                            Ekonomi</a>
                    </div>
                </div>

                <a href="#"
                    class="flex items-center gap-4 px-4 py-3 hover:bg-secondary hover:text-white rounded-lg transition text-slate-300">
                    <x-untitledui-star-06 class="size-5" />
                    <span class="" x-bind:class="openSidebar ? 'block' : 'hidden'">Pandawa - Analisis</span>
                </a>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col">
            <header class="h-16 bg-white border-b-2 border-primary flex items-center justify-between px-8">
                <button @click="openSidebar = !openSidebar"
                    class="text-slate-500 cursor-pointer hover:text-primary"><x-solar-hamburger-menu-broken
                        class="size-6" /></button>
                <button
                    class="bg-primary text-white px-5 py-2 rounded-md text-sm font-semibold hover:bg-secondary transition">
                    Login Petugas
                </button>
            </header>

            <main class="p-8 overflow-y-auto">
                {{ $slot ?? '' }}


                @yield('content')
            </main>
        </div>
    </div>

    @push('script')
    @endpush
</x-layouts.app>
