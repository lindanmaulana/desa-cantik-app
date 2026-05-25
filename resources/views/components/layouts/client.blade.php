<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex flex-col min-h-screen bg-quaternary">

    <x-layouts.partials.navbar />

    <main class="container flex-grow p-8 mx-auto max-md:p-4 max-lg:p-6">
        {{ $slot }}

        <div x-data="{ open: false }"
            class="fixed z-50 flex flex-col-reverse items-center gap-3 bottom-8 right-8 max-md:bottom-4 max-md:right-4">

            <button @click="open = !open"
                class="flex items-center justify-center text-white transition-transform duration-300 transform rounded-full shadow-lg w-14 h-14 max-md:w-12 max-md:h-12 bg-primary hover:bg-secondary focus:outline-none active:scale-95"
                :class="open ? 'rotate-90 bg-black/30 backdrop-blur-md hover:bg-black/40' : ''">
                <x-sui-chain class="w-8 h-8 max-md:w-6 max-md:h-6" />
            </button>

            <div x-show="open" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 scale-95" class="flex flex-col items-center gap-2"
                style="display: none;" @click.away="open = false">
                <x-cta.item-cta icon="bi-instagram" url="https://instagram.com/andrnshhrwn._" />
                <x-cta.item-cta icon="bi-whatsapp" url="https://wa.me/nomorhp" />
            </div>
        </div>
    </main>

    <footer class="mt-auto text-white bg-primary">
        <div class="container grid grid-cols-1 gap-8 px-8 py-12 mx-auto max-md:px-4 max-lg:px-6 md:grid-cols-3">

            <div class="flex flex-col gap-3">
                <div class="flex items-center gap-3">
                    <div class="flex items-center justify-center">
                        <x-fab-dev class="size-7" />
                    </div>
                    <div>
                        <h3 class="text-lg font-bold tracking-wide uppercase">Desa NamaDesa</h3>
                        <p class="text-xs text-white/70">Kecamatan, Kabupaten, Provinsi</p>
                    </div>
                </div>
                <p class="mt-2 text-sm leading-relaxed text-white/85">
                    Website resmi Pemerintah Desa NamaDesa. Media transparansi, pelayanan publik, dan pusat informasi
                    seputar kegiatan serta potensi desa.
                </p>
            </div>

            <div class="flex flex-col gap-3 md:pl-8">
                <h4 class="pb-2 text-base font-semibold border-b border-white/20">Tautan Kilat</h4>
                <ul class="space-y-2 text-sm text-white/85">
                    <li>
                      <a href="#" class="transition-all duration-200 hover:text-secondary hover:underline">
                        Link 1
                      </a>
                    </li>
                    <li>
                      <a href="#" class="transition-all duration-200 hover:text-secondary hover:underline">
                        Link 2
                      </a>
                    </li>
                    <li>
                      <a href="#" class="transition-all duration-200 hover:text-secondary hover:underline">
                        Link 3
                      </a>
                    </li>
                    <li>
                      <a href="#" class="transition-all duration-200 hover:text-secondary hover:underline">
                        Link 4
                      </a>
                    </li>
                </ul>
            </div>

            <div class="flex flex-col gap-3">
                <h4 class="pb-2 text-base font-semibold border-b border-white/20">Kontak Pemerintah Desa</h4>
                <ul class="space-y-3 text-sm text-white/85">
                    <li class="flex items-start gap-2">
                        <span class="font-medium">Alamat:</span>
                        <span>Jl. Raya NamaDesa No. 01, Kode Pos 12345</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="font-medium">Email:</span>
                        <a href="mailto:pemdes@namadesa.id" class="hover:underline">pemdes@namadesa.id</a>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="font-medium">Telepon:</span>
                        <span>(021) 1234567</span>
                    </li>
                </ul>
            </div>

        </div>

        <div class="py-4 bg-secondary">
            <div
                class="container flex flex-col items-center justify-between gap-2 px-8 mx-auto text-xs text-center max-md:px-4 max-lg:px-6 sm:flex-row text-white/70 sm:text-left">
                <p>&copy; 2026 Pemerintah Desa NamaDesa. Hak Cipta Dilindungi.</p>
                <p>Develop by <span class="font-semibold text-white">Tim Timan</span></p>
            </div>
        </div>
    </footer>
    @stack('scripts')
</body>

</html>
