<div class="p-6 space-y-8 border shadow-sm rounded-2xl border-textTertiary/20 bg-secondary">
    <div class="space-y-4">
        <div class="flex flex-col gap-2 pb-3 border-b border-textTertiary/10 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h3 class="font-bold tracking-wide text-md text-textPrimary">Kredensial Pengguna</h3>
                <p class="text-xs text-textSecondary">Atribut identitas utama yang digunakan di dalam platform database desa.</p>
            </div>
            <div class="flex">
                <button type="button"
                    @click="openEditProfileModal({ id: '{{ $user->id }}', username: '{{ $user->username }}', fullname: '{{ $user->fullname }}', role: '{{ $user->role?->value }}' })"
                    class="inline-flex items-center justify-center px-4 py-2 text-xs font-semibold tracking-wide text-white transition-all rounded-lg shadow-sm bg-primary hover:bg-primary/90">
                    Perbarui Profil
                </button>
            </div>
        </div>  

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <label class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">Nama Lengkap</label>
                <input type="text" readonly value="{{ $user->fullname }}"
                    class="w-full px-3 py-2 text-sm font-medium border rounded-lg cursor-not-allowed border-textTertiary/30 bg-tertiary text-textPrimary focus:outline-none opacity-80">
            </div>

            <div>
                <label class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">ID Pengguna (Username)</label>
                <input type="text" readonly value="{{ $user->username }}"
                    class="w-full px-3 py-2 font-mono text-sm border rounded-lg cursor-not-allowed border-textTertiary/30 bg-tertiary text-textPrimary focus:outline-none opacity-80">
            </div>

            <div>
                <label class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">Otoritas Tingkat</label>
                <input type="text" readonly value="{{ $user->role?->label() ?? 'Warga' }}"
                    class="w-full px-3 py-2 text-sm font-medium border rounded-lg cursor-not-allowed border-textTertiary/30 bg-tertiary text-textPrimary focus:outline-none opacity-80">
            </div>

            <div>
                <label class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">Batas Wilayah Kerja</label>
                <input type="text" readonly value="{{ $user->territory_id ?? 'Akses Penuh Kelola Desa' }}"
                    class="w-full px-3 py-2 text-sm font-medium border rounded-lg cursor-not-allowed border-textTertiary/30 bg-tertiary text-textPrimary focus:outline-none opacity-80">
            </div>
        </div>
    </div>

    <div class="pt-6 space-y-4 border-t border-textTertiary/20">
        <div>
            <h3 class="font-bold tracking-wide text-md text-textPrimary">Autentikasi & Keamanan</h3>
            <p class="text-xs text-textSecondary">Ganti kata sandi Anda secara berkala untuk menjaga integritas dan kerahasiaan data operasional.</p>
        </div>

        <div class="flex">
            <button type="button" @click="openPasswordModal()"
                class="inline-flex items-center justify-center px-4 py-2 text-xs font-semibold tracking-wide transition-all bg-transparent border rounded-lg shadow-sm text-primary border-primary hover:bg-primary/5 focus:outline-none focus:ring-2 focus:ring-primary/50">
                Perbarui Kata Sandi
            </button>
        </div>
    </div>
</div>
