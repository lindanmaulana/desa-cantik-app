<div class="flex items-center gap-3 pb-4 mb-6 border-b sm:gap-4 sm:pb-6 sm:mb-10 border-textTertiary/30">
    <x-ionicon-people-sharp class="p-2 rounded-md sm:p-3 size-10 sm:size-12 bg-primary/10 text-primary shrink-0" />
    <div>
        <h3 class="text-lg font-bold sm:text-xl text-textPrimary">Demografi</h3>
        <p class="text-sm sm:text-lg text-textSecondary">Analisis agregat demografi
            {{ $villageSettings->village_name ?? '-' }}</p>
    </div>
</div>

<div class="space-y-4" x-show="!isGenerated">
    <div
        class="flex items-center justify-center border-2 border-dashed rounded-2xl border-textTertiary/60 bg-secondary min-h-[300px] sm:min-h-96 p-4 shadow-sm relative overflow-hidden">

        <form action="{{ route('statistik.demografi') }}" method="GET" @submit="isGenerating = true"
            class="flex flex-col items-center justify-center max-w-md gap-2 text-center transition-all duration-300"
            :class="isGenerating ? 'opacity-30 pointer-events-none scale-95' : ''">

            <input type="hidden" name="type" value="ageGroup">

            <x-ionicon-people-sharp class="p-3 mb-2 rounded-md sm:mb-4 size-12 sm:size-16 bg-primary/10 text-primary" />

            <h4 class="text-lg font-bold sm:text-xl text-textPrimary">Hitung Agregat Demografi</h4>

            <p class="px-2 mb-4 text-xs sm:text-base text-textSecondary">
                Sistem akan memproses seluruh data untuk menghasilkan statistik Demografi berdasarkan kategori yang
                dipilih.
            </p>

            <button type="submit" :disabled="isGenerating"
                class="flex items-center justify-center gap-2 px-6 py-2.5 sm:px-8 sm:py-3 text-sm sm:text-base font-semibold text-secondary rounded-full shadow-lg bg-gradient-to-r from-primary to-textPrimary hover:opacity-95 active:scale-95 transition-all disabled:opacity-50 min-w-[200px]">

                <svg x-show="isGenerating" x-cloak class="animate-spin size-5 text-secondary" viewBox="0 0 24 24"
                    fill="none">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>

                <x-ri-play-circle-fill x-show="!isGenerating" class="size-4 sm:size-5 text-secondary" />
                <span x-text="isGenerating ? 'Memproses Data...' : 'Generate Aggregate'"></span>
            </button>
        </form>

        <div x-show="isGenerating" x-cloak x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            class="absolute inset-0 bg-secondary/60 backdrop-blur-[2px] flex flex-col items-center justify-center p-6 gap-4">

            <div class="w-full max-w-xs space-y-2 text-center">
                <div class="h-1.5 w-full bg-tertiary rounded-full overflow-hidden relative">
                    <div
                        class="h-full bg-primary rounded-full w-full origin-left animate-[loading_1.5s_infinite_ease-in-out]">
                    </div>
                </div>
                <p class="text-xs font-medium text-textSecondary animate-pulse">Mengalkulasi data demografi warga dari
                    database...</p>
            </div>
        </div>

    </div>
</div>
