<x-layouts.app>
    <div class="flex h-screen overflow-hidden" x-cloak x-data="{
        openStatistik: {{ request()->routeIs('dashboard.statistics.*') ? 'true' : 'false' }},
        openManageData: {{ request()->routeIs('dashboard.manage-data.*') ? 'true' : 'false' }},
        openSidebar: true
    }">

        <x-layouts.partials.sidebar />

        <div class="flex flex-col flex-1 h-full min-w-0">
            <header class="flex items-center justify-between h-16 px-8 bg-quaternary border-b-2 border-primary shrink-0">
                <button @click="openSidebar = !openSidebar"
                    class="cursor-pointer text-slate-500 hover:text-primary focus:outline-none">
                    <x-solar-hamburger-menu-broken class="size-6" />
                </button>

                <button
                    class="px-5 py-2 text-sm font-semibold text-white capitalize transition rounded-md bg-primary hover:bg-secondary">
                    {{ Auth::user()->fullname ?? 'Petugas' }}
                </button>
            </header>

            <main
                class="container flex-1 p-8 mx-auto bg-quaternary overflow-y-auto [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
                {{ $slot ?? '' }}
                @yield('content')
            </main>
        </div>
    </div>
</x-layouts.app>
