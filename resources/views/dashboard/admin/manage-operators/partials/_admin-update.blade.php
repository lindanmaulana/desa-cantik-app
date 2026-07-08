<div x-show="openUpdate" x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto transition-opacity duration-300 bg-textPrimary/50 backdrop-blur-sm">

    <div class="w-full max-w-xl overflow-hidden transition-all duration-300 transform scale-95 border shadow-xl bg-secondary border-textTertiary/30 rounded-2xl"
        @click.away="openUpdate = false">

        <div class="flex items-center justify-between px-6 py-4 border-b border-textTertiary/20 bg-tertiary">
            <div class="flex items-center gap-2">
                <div class="p-2 rounded-lg text-primary bg-primary/10">
                    <x-heroicon-o-pencil-square class="w-5 h-5" />
                </div>
                <div>
                    <h3 class="text-lg font-bold text-textPrimary">Ubah Akses Operator</h3>
                    <p class="text-xs text-textSecondary">Perbarui nama lengkap atau ganti kata sandi akun operator.
                    </p>
                </div>
            </div>
            <button @click="openUpdate = false"
                class="p-1 transition-colors rounded-lg text-textSecondary hover:text-textPrimary hover:bg-textTertiary/20">
                <x-heroicon-o-x-mark class="w-5 h-5" />
            </button>
        </div>
        <form
            :action="'{{ route('admin.manage-operator.update', ['operator' => 'OPERATOR_ID']) }}'.replace('OPERATOR_ID', user.id)"
            method="POST" class="p-6 space-y-4" x-data="{ submitting: false }" @submit="submitting = true">
            @csrf
            @method('PUT')

            <input type="hidden" name="role" value="operator">

            <div class="space-y-4">
                <h4 class="pb-1 text-sm font-bold border-b text-primary border-textTertiary/20">Perbarui Kredensial</h4>

                <div>
                    <label class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary/60">
                        Username Akun <span class="text-textSecondary/40">(Tidak Dapat Diubah)</span>
                    </label>
                    <div
                        class="flex items-center w-full gap-2 px-3 py-2 text-sm border rounded-lg select-none border-textTertiary/20 bg-tertiary/50 text-textSecondary">
                        <x-heroicon-o-lock-closed class="w-4 h-4 text-textSecondary/40 shrink-0" />
                        <span x-text="user.username || 'Memuat data...'"></span>
                    </div>
                </div>

                <div>
                    <label for="edit_fullname"
                        class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Nama Lengkap Operator <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="edit_fullname" name="fullname" required x-model="user.fullname"
                        placeholder="Contoh: Budi Santoso, S.Kom"
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                </div>

                <div>
                    <label for="edit_password"
                        class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Ganti Kata Sandi
                    </label>
                    <input type="password" id="edit_password" name="password" minlength="8"
                        placeholder="Kosongkan jika tidak ingin mengubah kata sandi"
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary placeholder:text-textSecondary/50 focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                </div>
            </div>

            <div class="flex items-center justify-end gap-2 pt-4 border-t border-textTertiary/20">
                <button type="button" @click="openUpdate = false"
                    class="px-4 py-2 text-sm font-medium transition-colors border rounded-lg text-textPrimary bg-secondary border-textTertiary/40 hover:bg-tertiary focus:outline-none">
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
                    <span x-text="submitting ? 'Menyimpan...' : 'Simpan Perubahan'"></span>
                </button>
            </div>
        </form>
    </div>
</div>
