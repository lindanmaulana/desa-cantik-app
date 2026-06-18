<x-layouts.app>
    <div
        class="flex flex-col min-h-screen bg-tertiary text-slate-600 font-sans antialiased [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">

        <!-- Global Header / Navbar Component -->
        <x-layouts.partials.navbar />

        <!-- Main Content Slot Wrap -->
        <main class="container mx-auto flex-grow p-8 max-md:p-4 max-lg:p-6 animate-[fadeIn_0.4s_ease-out]">
            {{ $slot }}

            <!-- Modern Minimalist Floating Action Button -->
            <div x-data="{ open: false }"
                class="fixed z-50 flex flex-col-reverse items-center gap-3 bottom-8 right-8 max-md:bottom-5 max-md:right-5">
                <button @click="open = !open"
                    class="flex items-center justify-center text-slate-800 bg-white border border-slate-200/80 rounded-full shadow-[0_4px_24px_rgba(0,0,0,0.06)] hover:shadow-[0_8px_30px_rgba(0,0,0,0.12)] w-13 h-13 max-md:w-12 max-md:h-12 transition-all duration-300 focus:outline-none active:scale-95"
                    :class="open ? 'rotate-90 !bg-slate-900 !text-white !border-slate-900' : ''">
                    <x-sui-chain class="w-5 h-5" />
                </button>

                <div x-show="open" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 translate-y-4 scale-90"
                    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 scale-90" class="flex flex-col items-center gap-2.5"
                    style="display: none;" @click.away="open = false">

                    <!-- Floating CTA Link Items with high micro-interactions -->
                    <x-cta.item-cta icon="bi-instagram"
                        class="shadow-md hover:scale-110 border border-slate-100 bg-white text-slate-700 transition-transform p-3 rounded-full"
                        url="https://instagram.com/andrnshhrwn._" />
                    <x-cta.item-cta icon="bi-whatsapp"
                        class="shadow-md hover:scale-110 border border-slate-100 bg-white text-slate-700 transition-transform p-3 rounded-full"
                        url="https://wa.me/nomorhp" />
                </div>
            </div>
        </main>

        <!-- Soft Ivory/Slate Warm Footer -->
        <footer class="mt-auto bg-slate-50 text-slate-600 border-t border-slate-100/80">
            <div class="container mx-auto grid grid-cols-1 gap-12 px-8 py-16 max-md:px-4 max-lg:px-6 md:grid-cols-3">

                <!-- Brand Info Section -->
                <div class="flex flex-col gap-4">
                    <div class="flex items-center gap-2.5">
                        <div class="p-2 rounded-xl bg-emerald-50 text-emerald-600 shadow-sm">
                            <x-fab-dev class="size-5.5" />
                        </div>
                        <div>
                            <h3 class="text-sm font-bold tracking-wider text-slate-900 uppercase">Desa NamaDesa</h3>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Wilayah Kecamatan
                            </p>
                        </div>
                    </div>
                    <p class="text-xs leading-relaxed text-slate-500 max-w-sm">
                        Sistem Informasi terintegrasi resmi Pemerintah Desa NamaDesa. Media transparansi publikasi, tata
                        kelola data sektoral, dan interaksi layanan warga digital.
                    </p>
                </div>

                <!-- Navigation Quick Links -->
                <div class="flex flex-col gap-4 md:pl-12">
                    <h4 class="text-xs font-bold tracking-widest text-slate-400 uppercase">Tautan Informasi</h4>
                    <ul class="space-y-2.5 text-xs font-semibold">
                        <li><a href="#" class="text-slate-600 hover:text-emerald-600 transition-colors">Portal
                                Dokumentasi Terbuka</a></li>
                        <li><a href="#" class="text-slate-600 hover:text-emerald-600 transition-colors">Regulasi
                                Pemetaan Geografis</a></li>
                        <li><a href="#" class="text-slate-600 hover:text-emerald-600 transition-colors">Informasi
                                Publik Berkala</a></li>
                        <li><a href="#" class="text-slate-600 hover:text-emerald-600 transition-colors">Dataset
                                Statistik Tahunan</a></li>
                    </ul>
                </div>

                <!-- Office Contact Information -->
                <div class="flex flex-col gap-4">
                    <h4 class="text-xs font-bold tracking-widest text-slate-400 uppercase">Sekretariat</h4>
                    <ul class="space-y-3 text-xs text-slate-500 font-medium">
                        <li class="flex items-start gap-2">
                            <span class="font-bold text-slate-800 shrink-0">Alamat:</span>
                            <span class="leading-relaxed text-slate-600">Jl. Raya NamaDesa No. 01, Kode Pos 12345</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="font-bold text-slate-800">Email:</span>
                            <a href="mailto:pemdes@namadesa.id"
                                class="text-slate-600 hover:text-emerald-600 transition-colors hover:underline">pemdes@namadesa.id</a>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="font-bold text-slate-800">Kontak:</span>
                            <span class="text-slate-600">(021) 1234567</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Sub-Footer Bar -->
            <div class="py-5 bg-white border-t border-slate-100">
                <div
                    class="container mx-auto flex flex-col items-center justify-between gap-3 px-8 text-[11px] font-semibold text-slate-400 max-md:px-4 max-lg:px-6 sm:flex-row text-center sm:text-left">
                    <p>&copy; 2026 Pemerintah Desa NamaDesa. Hak Cipta Dilindungi.</p>
                    <p class="text-slate-400 tracking-wide">Archived by <span
                            class="text-slate-700 hover:text-emerald-600 transition-colors font-bold">Tim Timan</span>
                    </p>
                </div>
            </div>
        </footer>
    </div>
</x-layouts.app>
