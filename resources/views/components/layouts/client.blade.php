<x-layouts.app>
    <div x-data="{ globalLoading: false }" id="app-root"
        class="flex flex-col min-h-screen bg-ter tertiary text-slate-600 bg-tertiary font-sans antialiased [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">

        <x-layouts.partials.navbar />

        <main
            class="container mx-auto max-w-7xl flex-grow p-8 pt-4 max-md:p-2 max-md:pt-2 max-lg:p-6 max-lg:pt-3 animate-[fadeIn_0.4s_ease-out]">
            {{ $slot }}

            <!-- FAB Button (CTA) -->
            <div x-data="{ open: false }"
                class="fixed z-50 flex flex-col-reverse items-center gap-3 bottom-8 right-8 max-md:bottom-5 max-md:right-5">
                <button @click="open = !open"
                    class="flex items-center justify-center text-slate-800 bg-white border border-slate-200/80 rounded-full shadow-[0_4px_24px_rgba(0,0,0,0.06)] hover:shadow-[0_8px_30px_rgba(0,0,0,0.12)] w-14 h-14 max-md:w-12 max-md:h-12 transition-all duration-300 focus:outline-none active:scale-95 z-50"
                    :class="open ?
                        'rotate-90 !bg-primary !text-white !border-primary shadow-[0_8px_25px_rgba(var(--primary-color),0.4)]' :
                        ''">
                    <x-sui-chain class="w-5 h-5" />
                </button>

                <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 translate-y-4 scale-90"
                    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 scale-90"
                    class="flex flex-col items-center gap-2.5 mb-1" style="display: none;" @click.away="open = false">
                    <x-cta.item-cta icon="bi-instagram" url="https://instagram.com/andrnshhrwn._" />
                    <x-cta.item-cta icon="bi-whatsapp" url="https://wa.me/nomorhp" />
                </div>
            </div>
        </main>

        <x-layouts.partials.footer />

    </div>

</x-layouts.app>
