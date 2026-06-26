<div x-show="openCreate"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto transition-opacity duration-300 bg-textPrimary/50 backdrop-blur-sm">
    <div
        class="w-full max-w-lg overflow-hidden transition-all duration-300 transform scale-95 bg-secondary border border-textTertiary/30 shadow-xl rounded-2xl">

        <div class="flex items-center justify-between px-6 py-4 border-b border-textTertiary/20 bg-tertiary">
            <div class="flex items-center gap-2">
                <div class="p-2 text-primary rounded-lg bg-primary/10">
                    <x-heroicon-o-map-pin class="w-5 h-5" />
                </div>
                <div>
                    <h3 class="text-lg font-bold text-textPrimary">Tambah Wilayah Baru</h3>
                    <p class="text-xs text-textSecondary">Masukkan data master teritori administratif baru.</p>
                </div>
            </div>
            <button @click="openCreate = false"
                class="p-1 text-textSecondary transition-colors rounded-lg hover:text-textPrimary hover:bg-textTertiary/20">
                <x-heroicon-o-x-mark class="w-5 h-5" />
            </button>
        </div>

        <form action="{{ route('territories.store') }}" method="POST" class="p-6 space-y-6" x-data="{ submitting: false }"
            @submit="submitting = true">
            @csrf

            <div>
                <label for="sub_village"
                    class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Nama Dusun
                    <span class="text-red-500">*</span></label>
                <input type="text" id="sub_village" name="sub_village" required
                    placeholder="Contoh: Pahing, Pon, Wage"
                    class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary placeholder:text-textSecondary/50 focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
            </div>

            <div>
                <label for="area_name"
                    class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Nama Spesifik /
                    Blok <span class="text-textSecondary/60">(Opsional)</span></label>
                <input type="text" id="area_name" name="area_name"
                    placeholder="Contoh: Blok Al-Hidayah, Kampung Baru"
                    class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary placeholder:text-textSecondary/50 focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="rw"
                        class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Nomor RW
                        <span class="text-red-500">*</span></label>
                    <input type="text" id="rw" name="rw" required maxlength="5"
                        placeholder="Contoh: 001"
                        class="w-full px-3 py-2 text-sm text-center transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary placeholder:text-textSecondary/50 focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                </div>

                <div>
                    <label for="rt"
                        class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Nomor RT
                        <span class="text-red-500">*</span></label>
                    <input type="text" id="rt" name="rt" required maxlength="5"
                        placeholder="Contoh: 003"
                        class="w-full px-3 py-2 text-sm text-center transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary placeholder:text-textSecondary/50 focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                </div>
            </div>

            <div
                class="flex items-start gap-2 p-3 text-xs border rounded-lg bg-amber-500/10 border-amber-500/20 text-amber-500">
                <x-heroicon-o-information-circle class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" />
                <p>Pastikan kombinasi Dusun, RW, dan RT belum pernah terdaftar sebelumnya untuk menghindari ambiguitas
                    penempatan domisili warga.</p>
            </div>

            <div class="flex items-center justify-end gap-2 pt-4 border-t border-textTertiary/20">
                <button type="button" @click="openCreate = false" x-bind:disabled="submitting"
                    class="px-4 py-2 text-sm font-medium text-textPrimary transition-colors bg-secondary border border-textTertiary/40 rounded-lg hover:bg-tertiary focus:outline-none disabled:opacity-50 disabled:cursor-not-allowed">
                    Batal
                </button>
                <button type="submit" x-bind:disabled="submitting"
                    class="flex items-center justify-center gap-2 px-4 py-2 text-sm font-medium text-secondary transition-colors bg-primary rounded-lg shadow-sm hover:opacity-90 focus:outline-none disabled:opacity-70 disabled:cursor-not-allowed min-w-[140px]">
                    <svg x-show="submitting" x-cloak class="animate-spin w-4 h-4" viewBox="0 0 24 24" fill="none">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z">
                        </path>
                    </svg>
                    <span x-text="submitting ? 'Menyimpan...' : 'Simpan Wilayah'"></span>
                </button>
            </div>
        </form>
    </div>
</div>
