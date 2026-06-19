<x-layouts.app>
    <!-- Inisialisasi state loading di elemen induk tertinggi agar bisa menutup seluruh layar -->
    <div x-data="{ globalLoading: false }" @pageshow.window="if ($event.detail.persisted) globalLoading = false"
        class="flex flex-col min-h-screen bg-ter tertiary text-slate-600 font-sans antialiased [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">

        <!--
          ========================================================================
          FULL-SCREEN CENTER LOADING OVERLAY
          ========================================================================
        -->
        <div x-show="globalLoading" x-cloak x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-[9999] flex flex-col items-center justify-center bg-slate-900/40 backdrop-blur-md">

            <div
                class="flex flex-col items-center p-6 rounded-2xl bg-white/90 border border-white shadow-2xl max-w-xs text-center animate-[scaleUp_0.3s_ease-out]">
                <!-- Animasi Bar Chart Bergetar/Melompat -->
                <div class="flex items-end gap-1.5 h-10 w-12 mb-4 justify-center">
                    <div class="w-1.5 bg-primary/40 rounded-full animate-[bounce_1s_infinite_100ms] h-4"></div>
                    <div class="w-1.5 bg-primary/70 rounded-full animate-[bounce_1s_infinite_200ms] h-7"></div>
                    <div class="w-1.5 bg-primary rounded-full animate-[bounce_1s_infinite_300ms] h-10"></div>
                    <div class="w-1.5 bg-primary/60 rounded-full animate-[bounce_1s_infinite_400ms] h-6"></div>
                </div>
                <h3 class="text-sm font-bold text-slate-900 tracking-wide">Menyiapkan Layanan</h3>
                <p class="mt-1 text-xs text-slate-500 leading-relaxed">Mohon tunggu sebentar, halaman sedang
                    dialihkan...</p>
            </div>
        </div>

        <x-layouts.partials.navbar />

        <main
            class="container mx-auto max-w-7xl flex-grow p-8 pt-4 max-md:p-4 max-md:pt-2 max-lg:p-6 max-lg:pt-3 animate-[fadeIn_0.4s_ease-out]">
            {{ $slot }}

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

        <footer class="mt-auto w-full bg-white border-t border-slate-200/60 shadow-[0_-10px_30px_rgba(0,0,0,0.02)]">
            <div class="mx-auto max-w-7xl px-8 py-10 max-md:px-5 max-md:py-6">
                <div class="hidden md:grid grid-cols-4 gap-8 lg:gap-12 pb-8">
                    <div class="space-y-3">
                        <div class="flex items-center gap-2.5">
                            <div class="rounded-xl bg-primary/10 p-2 text-primary shadow-inner">
                                <x-heroicon-o-square-3-stack-3d class="w-6 h-6" />
                            </div>
                            <span class="text-base font-bold tracking-tight text-slate-900 capitalize">Nama Desa</span>
                        </div>
                        <p class="text-xs leading-relaxed text-slate-400">
                            Platform Satu Data Desa terintegrasi. Menghadirkan transparansi, akurasi, dan kemudahan
                            akses data untuk kemajuan masyarakat.
                        </p>
                    </div>

                    <div class="space-y-3">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-800">Navigasi</h4>
                        <ul class="space-y-2 text-xs">
                            <li>
                                <a href="{{ route('home') }}"
                                    class="inline-flex items-center text-slate-500 transition-all duration-150 hover:text-primary hover:translate-x-1 group">
                                    <span
                                        class="opacity-0 w-0 transition-all duration-150 group-hover:opacity-100 group-hover:w-3 text-primary">→</span>Beranda
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('dashboard') }}"
                                    class="inline-flex items-center text-slate-500 transition-all duration-150 hover:text-primary hover:translate-x-1 group">
                                    <span
                                        class="opacity-0 w-0 transition-all duration-150 group-hover:opacity-100 group-hover:w-3 text-primary">→</span>Analisis
                                    Data
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="space-y-3">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-800">Sektoral Statistik</h4>
                        <ul class="space-y-2 text-xs text-slate-500">
                            <li><a href="{{ route('statistik.demografi') }}"
                                    class="hover:text-primary transition-colors">Demografi Warga</a></li>
                            <li><a href="{{ route('statistik.social') }}"
                                    class="hover:text-primary transition-colors">Sosial & Kesehatan</a></li>
                            <li><a href="{{ route('statistik.economy') }}"
                                    class="hover:text-primary transition-colors">Ekonomi & Pasar</a></li>
                            <li><a href="{{ route('statistik.msme') }}"
                                    class="hover:text-primary transition-colors">Pengembangan UMKM</a></li>
                        </ul>
                    </div>

                    <div class="space-y-3">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-800">Kantor Desa</h4>
                        <ul class="space-y-2 text-xs text-slate-500">
                            <li>Jl. Utama No. 01, Wilayah Desa, Indonesia</li>
                            <li class="pt-1">
                                <span
                                    class="inline-flex items-center rounded-md bg-emerald-50 px-1.5 py-0.5 text-[10px] font-medium text-emerald-700 ring-1 ring-inset ring-emerald-600/10">08:00
                                    - 15:00</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <hr class="hidden md:block border-slate-200/60 mb-8" />

                <div
                    class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between text-xs text-slate-400 max-md:text-center">
                    <div class="font-medium max-md:text-slate-500">
                        <span class="md:hidden font-bold text-slate-800 block mb-1 text-sm">Nama Desa</span>
                        &copy; {{ date('Y') }} Pemerintah Desa. <span class="max-md:hidden">Hak Cipta
                            Dilindungi.</span>
                    </div>

                    <div class="flex items-center gap-2 max-md:justify-center">
                        <span class="relative flex h-1.5 w-1.5">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-emerald-500"></span>
                        </span>
                        <span class="text-[11px] font-medium tracking-wide text-slate-400/90">Sistem Aktif</span>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</x-layouts.app>
