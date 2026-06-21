<x-layouts.app>
    <div class="flex h-screen overflow-hidden bg-tertiary" x-cloak x-data="{
        openStatistik: {{ request()->routeIs('dashboard.statistics.*') ? 'true' : 'false' }},
        openManageData: {{ request()->routeIs('dashboard.manage-data.*') ? 'true' : 'false' }},
        openSidebar: window.innerWidth >= 768
    }"
        @resize.window="if (window.innerWidth >= 768) { openSidebar = true } else { openSidebar = false }">

        <div x-show="openSidebar" x-transition:enter="transition ease-in-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in-out duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" @click="openSidebar = false"
            class="fixed inset-0 z-40 bg-black/50 md:hidden">
        </div>

        <x-layouts.partials.sidebar />

        <div class="flex flex-col flex-1 h-full min-w-0">

            <header
                class="flex items-center justify-between h-16 px-8 bg-secondary border-b-2 border-textTertiary/20 shrink-0">

                <button @click="openSidebar = !openSidebar"
                    class="cursor-pointer text-textSecondary hover:text-primary focus:outline-none z-30">
                    <x-solar-hamburger-menu-broken class="size-6" />
                </button>

                <button
                    class="px-5 py-2 text-sm font-semibold text-secondary capitalize transition rounded-md bg-primary hover:opacity-90">
                    {{ Auth::user()->fullname ?? 'Petugas' }}
                </button>
            </header>

            <main
                class="container flex-1 p-8 max-lg:p-6 max-md:p-4 mx-auto bg-tertiary overflow-y-auto [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
                {{ $slot ?? '' }}
                @yield('content')
            </main>
        </div>
    </div>
</x-layouts.app>
