<div x-show="citizen.openDelete"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto bg-textPrimary/50 backdrop-blur-sm"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    x-cloak>

    <div @click.away="!citizen.submitting && (citizen.openDelete = false)"
        x-show="citizen.openDelete"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95 translate-y-4 sm:translate-y-0"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-4 sm:translate-y-0"
        class="w-full max-w-lg overflow-hidden border shadow-2xl bg-secondary border-textTertiary/30 rounded-2xl">

        <div class="p-6">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0 p-3 bg-red-500/10 rounded-xl">
                    <x-heroicon-o-exclamation-triangle class="w-6 h-6 text-red-600" />
                </div>

                <div>
                    <h3 class="mb-1 text-lg font-bold text-textPrimary">
                        Hapus Data Warga
                    </h3>
                    <p class="text-sm leading-relaxed text-textSecondary">
                        Apakah Anda yakin ingin menghapus data warga bernama <span class="font-semibold text-textPrimary" x-text="citizen.data.full_name"></span> secara permanen? Tindakan ini akan menghapus seluruh data sekunder yang melekat seperti profil pendidikan, pekerjaan, riwayat kesehatan, serta log pertumbuhan anak yang terhubung. <span class="font-semibold text-red-500">Aksi ini tidak dapat dibatalkan</span>.
                    </p>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 px-6 py-4 border-t bg-tertiary/40 border-textTertiary/20">
            <button type="button"
                @click="citizen.openDelete = false"
                x-bind:disabled="citizen.submitting"
                class="px-4 py-2 text-sm font-medium transition-colors border rounded-lg text-textPrimary bg-secondary border-textTertiary/40 hover:bg-tertiary focus:outline-none disabled:opacity-50 disabled:pointer-events-none">
                Batal
            </button>

            <form :action="citizen.deleteRoute" method="POST" class="inline" @submit="citizen.submitting = true">
                @csrf
                @method('DELETE')

                <button type="submit"
                    x-bind:disabled="citizen.submitting"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 disabled:opacity-60 disabled:pointer-events-none min-w-[140px] transition-all">

                    <svg x-show="citizen.submitting" x-cloak class="w-4 h-4 text-white animate-spin" viewBox="0 0 24 24" fill="none">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                    </svg>

                    <span x-text="citizen.submitting ? 'Memproses...' : 'Ya, Hapus Warga'"></span>
                </button>
            </form>
        </div>
    </div>
</div>
