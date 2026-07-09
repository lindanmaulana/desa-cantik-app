<div x-show="openUpdatePassword"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    x-cloak>

    <div @click.outside="openUpdatePassword = false"
        class="w-full max-w-md overflow-hidden border shadow-xl rounded-2xl border-textTertiary/20 bg-secondary"
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95">

        <div class="flex items-center justify-between px-6 py-4 border-b border-textTertiary/20 bg-tertiary">
            <div class="flex items-center gap-2">
                <div class="p-2 rounded-lg text-primary bg-primary/10">
                    <x-heroicon-o-lock-closed class="w-5 h-5" />
                </div>
                <div>
                    <h3 class="font-bold text-md text-textPrimary">Perbarui Kata Sandi</h3>
                    <p class="text-xs text-textSecondary">Ganti kata sandi demi integritas keamanan akun.</p>
                </div>
            </div>
            <button @click="openUpdatePassword = false"
                class="p-1 transition-colors rounded-lg text-textSecondary hover:text-textPrimary hover:bg-textTertiary/20">
                <x-heroicon-o-x-mark class="w-5 h-5" />
            </button>
        </div>

        <form action="{{ route('profile.password') }}" method="POST" class="p-6 space-y-4"
            x-data="{ submitting: false }" @submit="submitting = true">
            @csrf
            @method('PUT')

            <div>
                <label class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">Kata Sandi Saat Ini</label>
                <input type="password" name="current_password" required
                    class="w-full px-3 py-2 text-sm border rounded-lg border-textTertiary/30 bg-tertiary text-textPrimary focus:outline-none focus:ring-2 focus:ring-primary/40">
            </div>

            <div>
                <label class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">Kata Sandi Baru</label>
                <input type="password" name="password" required
                    class="w-full px-3 py-2 text-sm border rounded-lg border-textTertiary/30 bg-tertiary text-textPrimary focus:outline-none focus:ring-2 focus:ring-primary/40">
            </div>

            <div>
                <label class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">Konfirmasi Kata Sandi Baru</label>
                <input type="password" name="password_confirmation" required
                    class="w-full px-3 py-2 text-sm border rounded-lg border-textTertiary/30 bg-tertiary text-textPrimary focus:outline-none focus:ring-2 focus:ring-primary/40">
            </div>

            <div class="flex items-center justify-end gap-2 pt-4 border-t border-textTertiary/20">
                <button type="button" @click="openUpdatePassword = false" x-bind:disabled="submitting"
                    class="px-4 py-2 text-xs font-semibold tracking-wide transition-colors border rounded-lg text-textPrimary bg-secondary border-textTertiary/40 hover:bg-tertiary focus:outline-none disabled:opacity-50 disabled:cursor-not-allowed">
                    Batal
                </button>
                <button type="submit" x-bind:disabled="submitting"
                    class="flex items-center justify-center gap-2 px-4 py-2 text-xs font-semibold tracking-wide text-white transition-colors bg-primary rounded-lg shadow-sm hover:opacity-90 focus:outline-none disabled:opacity-70 disabled:cursor-not-allowed min-w-[140px]">
                    <svg x-show="submitting" x-cloak class="w-4 h-4 animate-spin" viewBox="0 0 24 24" fill="none">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                    </svg>
                    <span x-text="submitting ? 'Memproses...' : 'Perbarui Password'"></span>
                </button>
            </div>
        </form>
    </div>
</div>