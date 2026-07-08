<div x-show="openUpdate"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto transition-opacity duration-300 bg-textPrimary/50 backdrop-blur-sm">

    <div
        class="w-full max-w-lg overflow-hidden transition-all duration-300 transform scale-95 border shadow-xl bg-secondary border-textTertiary/30 rounded-2xl">

        <div class="flex items-center justify-between px-6 py-4 border-b border-textTertiary/20 bg-tertiary">
            <div class="flex items-center gap-2">
                <div class="p-2 rounded-lg text-primary bg-primary/10">
                    <x-heroicon-o-users class="w-5 h-5" />
                </div>
                <div>
                    <h3 class="text-lg font-bold text-textPrimary">Perbarui Keluarga</h3>
                    <p class="text-xs text-textSecondary">Perbarui data nomor KK dan alamat keluarga.</p>
                </div>
            </div>
            <button @click="openUpdate = false"
                class="p-1 transition-colors rounded-lg text-textSecondary hover:text-textPrimary hover:bg-textTertiary/20">
                <x-heroicon-o-x-mark class="w-5 h-5" />
            </button>
        </div>

        <form :action="`/dashboard/manage-data/families/${family.id}/update`" method="POST" class="p-6 space-y-6"
            x-data="{ submitting: false }" @submit="submitting = true">
            @csrf
            @method('PUT')

            <div>
                <label for="update_family_card_number"
                    class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">Nomor Kartu
                    Keluarga (KK) <span class="text-red-500">*</span></label>
                <input type="text" id="update_family_card_number" name="family_card_number" required minlength="16" maxlength="16"
                    x-model="family.family_card_number" placeholder="Contoh: 3208123456789012"
                    class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary placeholder:text-textSecondary/50 focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
            </div>

            <div>
                <label for="update_territory_id"
                    class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">Wilayah
                    Domisili (RT/RW/Dusun) <span class="text-red-500">*</span></label>
                <select id="update_territory_id" name="territory_id" required x-model="family.territory_id"
                    class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                    <option value="" class="bg-secondary">-- Pilih Wilayah --</option>
                    @foreach ($territories as $id => $label)
                    <option value="{{ $id }}" class="bg-secondary">
                        {{ $label }})
                    </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="update_address_detail"
                    class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">Detail Alamat
                    <span class="text-red-500">*</span></label>
                <textarea id="update_address_detail" name="address_detail" required rows="3" x-model="family.address_detail"
                    placeholder="Contoh: Blok Pahing RT 03/RW 01, samping Masjid Al-Ikhlas"
                    class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary placeholder:text-textSecondary/50 focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary"></textarea>
            </div>

            <div
                class="flex items-start gap-2 p-3 text-xs border rounded-lg bg-amber-500/10 border-amber-500/20 text-amber-500">
                <x-heroicon-o-information-circle class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" />
                <p>Harap pastikan Nomor Kartu Keluarga (KK) terdiri dari 16 digit angka yang valid sesuai dengan KTP/KK
                    fisik untuk keakuratan data sensus.</p>
            </div>

            <div class="flex items-center justify-end gap-2 pt-4 border-t border-textTertiary/20">
                <button type="button" @click="openUpdate = false" x-bind:disabled="submitting"
                    class="px-4 py-2 text-sm font-medium transition-colors border rounded-lg text-textPrimary bg-secondary border-textTertiary/40 hover:bg-tertiary focus:outline-none disabled:opacity-50 disabled:cursor-not-allowed">
                    Batal
                </button>
                <button type="submit" x-bind:disabled="submitting"
                    class="flex items-center justify-center gap-2 px-4 py-2 text-sm font-medium text-secondary transition-colors bg-primary rounded-lg shadow-sm hover:opacity-90 focus:outline-none disabled:opacity-70 disabled:cursor-not-allowed min-w-[140px]">
                    <svg x-show="submitting" x-cloak class="w-4 h-4 animate-spin" viewBox="0 0 24 24" fill="none">
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
