<div x-show="openCreate"
    x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto transition-opacity duration-300 bg-textPrimary/50 backdrop-blur-sm">

    <div class="w-full max-w-xl overflow-hidden transition-all duration-300 transform scale-95 border shadow-xl bg-secondary border-textTertiary/30 rounded-2xl">

        <div class="flex items-center justify-between px-6 py-4 border-b border-textTertiary/20 bg-tertiary">
            <div class="flex items-center gap-2">
                <div class="p-2 rounded-lg text-primary bg-primary/10">
                    <x-heroicon-o-user-plus class="w-5 h-5" />
                </div>
                <div>
                    <h3 class="text-lg font-bold text-textPrimary">Tambah Akun Admin</h3>
                    <p class="text-xs text-textSecondary">Daftarkan administrator baru untuk mengelola sistem.</p>
                </div>
            </div>
            <button @click="openCreate = false"
                class="p-1 transition-colors rounded-lg text-textSecondary hover:text-textPrimary hover:bg-textTertiary/20">
                <x-heroicon-o-x-mark class="w-5 h-5" />
            </button>
        </div>

        <form action="{{ route('admin.manage-operator.store') }}" method="POST" class="p-6 space-y-4">
            @csrf

            <input type="hidden" name="role" value="operator">
            <input type="hidden" name="territory_id" value="">

            <div class="space-y-4">
                <h4 class="pb-1 text-sm font-bold border-b text-primary border-textTertiary/20">Kredensial Akun</h4>

                <div>
                    <label for="username" class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Username Akun <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="username" name="username" required placeholder="Contoh: admin_budi atau budi123"
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary placeholder:text-textSecondary/50 focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                </div>

                <div>
                    <label for="fullname" class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Nama Lengkap Admin <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="fullname" name="fullname" required placeholder="Contoh: Budi Santoso, S.Kom"
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary placeholder:text-textSecondary/50 focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                </div>

                <div>
                    <label for="password" class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Kata Sandi
                    </label>
                    <input type="password" id="password" name="password" minlength="8" placeholder="Kosongkan untuk menggunakan kata sandi default ('resident')"
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary placeholder:text-textSecondary/50 focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                </div>
            </div>

            <div class="flex items-center justify-end gap-2 pt-4 border-t border-textTertiary/20">
                <button type="button" @click="openCreate = false"
                    class="px-4 py-2 text-sm font-medium transition-colors border rounded-lg text-textPrimary bg-secondary border-textTertiary/40 hover:bg-tertiary focus:outline-none">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium transition-colors rounded-lg shadow-sm text-secondary bg-primary hover:opacity-90 focus:outline-none">
                    Simpan & Buat Admin
                </button>
            </div>
        </form>
    </div>
</div>
