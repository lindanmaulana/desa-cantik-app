<div class="flex items-center gap-3 pb-4 mb-6 border-b sm:gap-4 sm:pb-6 sm:mb-10 border-slate-200">
    <x-phosphor-money
        class="p-2 rounded-md sm:p-3 size-10 sm:size-12 bg-primary/20 text-primary shrink-0" />
    <div>
        <h3 class="text-lg font-bold sm:text-xl text-slate-800">Ekonomi</h3>
        <p class="text-sm sm:text-lg text-slate-600">Analisis ekonomi & aset Desa Sukaraja</p>
    </div>
</div>

<div class="space-y-4" x-show="!isGenerated" x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 -translate-y-4 absolute w-full">

    <div
        class="flex items-center justify-center border-2 border-dashed rounded-2xl border-slate-300 min-h-[300px] sm:min-h-96 p-4">
        <div class="flex flex-col items-center justify-center max-w-md gap-2 text-center">
            <x-phosphor-money
                class="p-3 mb-2 rounded-md sm:mb-4 size-12 sm:size-16 bg-primary/20 text-primary" />
            <h4 class="text-lg font-bold sm:text-xl text-slate-800">Hitung Agregat Ekonomi</h4>
            <p class="px-2 mb-4 text-xs sm:text-base text-slate-600">
                Sistem akan memproses seluruh data untuk menghasilkan statistik Ekonomi. Proses ini hanya dilakukan sekali per sesi.
            </p>

            <a href="{{ route('dashboard.statistics.economic', ['type' => $economicType::OCCUPATION->value]) }}"
                class="flex items-center gap-2 px-5 py-2.5 sm:px-6 sm:py-3 text-sm sm:text-lg font-semibold text-white rounded-full shadow-lg bg-gradient-to-r from-primary to-secondary active:scale-95 transition-transform">
                <x-ri-play-circle-fill class="size-4 sm:size-5" />
                Generate Aggregate
            </a>
        </div>
    </div>
</div>
