<div x-show="openDelete"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto transition-opacity duration-300 bg-textPrimary/50 backdrop-blur-sm"
    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-cloak>

    <div @click.away="!submitting && (openDelete = false)" x-show="openDelete"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95 transform"
        x-transition:enter-end="opacity-100 scale-100 transform" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100 transform" x-transition:leave-end="opacity-0 scale-95 transform"
        class="w-full max-w-md overflow-hidden bg-secondary border border-textTertiary/30 shadow-xl rounded-xl">

        <div class="p-6">
            <div class="flex items-center gap-3 text-red-500 mb-4">
                <div class="p-2 bg-red-50 rounded-lg">
                    <x-heroicon-o-exclamation-triangle class="w-6 h-6 text-red-600" />
                </div>
                <h3 class="text-lg font-bold text-textPrimary">Konfirmasi Hapus Operator</h3>
            </div>

            <p class="text-sm text-textSecondary leading-relaxed">
                Apakah Anda yakin ingin menghapus data operator ini? Tindakan ini tidak dapat dibatalkan.
            </p>
        </div>

        <div class="flex items-center justify-end gap-2 px-6 py-4 bg-tertiary/20 border-t border-textTertiary/20"
            x-data="{ submitting: false }">

            <button type="button" @click="openDelete = false" x-bind:disabled="submitting"
                class="px-4 py-2 text-sm font-medium text-textPrimary transition-colors bg-secondary border border-textTertiary/40 rounded-lg hover:bg-tertiary focus:outline-none disabled:opacity-50 disabled:cursor-not-allowed">
                Batal
            </button>

            <form :action="deleteRoute" method="POST" class="inline" @submit="submitting = true">
                @csrf
                @method('DELETE')
                <button type="submit" x-bind:disabled="submitting"
                    class="flex items-center justify-center gap-2 px-4 py-2 text-sm font-medium text-white transition-colors bg-red-600 rounded-lg shadow-sm hover:bg-red-700 focus:outline-none disabled:opacity-70 disabled:cursor-not-allowed min-w-[140px]">

                    <svg x-show="submitting" x-cloak class="animate-spin w-4 h-4 text-white" viewBox="0 0 24 24"
                        fill="none">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z">
                        </path>
                    </svg>

                    <span x-text="submitting ? 'Menghapus...' : 'Ya, Hapus Data'"></span>
                </button>
            </form>
        </div>
    </div>
</div>
