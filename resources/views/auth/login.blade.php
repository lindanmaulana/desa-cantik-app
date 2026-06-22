<x-layouts.auth>
    <div class="p-8 bg-secondary/80 backdrop-blur-lg rounded-2xl shadow-2xl border border-textTertiary/20">

        <!-- Header Section -->
        <div class="mb-8 space-y-3">
            <x-button variant="ghost" class="!p-2 !text-primary !border-primary">
                <a href="{{ route('home') }}">
                    <x-bx-left-arrow-alt class="w-4 h-4 max-w-6 max-h-6" />
                </a>
            </x-button>
            <h2 class="text-center text-3xl font-bold text-textPrimary tracking-tight">Selamat Datang</h2>
            <p class="text-center mt-2 text-sm text-textSecondary font-medium">Silakan masuk untuk mengakses dashboard
            </p>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Form Login -->
        <form method="POST" action="{{ route('auth.login') }}" class="space-y-5" x-data="{ submitting: false }"
            @submit="submitting = true">
            @csrf

            <!-- Input Username -->
            <div>
                <x-input-label for="username" :value="__('Username')" class="text-textSecondary font-semibold text-sm" />
                <x-text-input id="username"
                    class="block w-full mt-1.5 border-textTertiary/40 bg-tertiary text-textPrimary focus:border-primary focus:ring focus:ring-primary/20 rounded-xl shadow-sm transition duration-150"
                    type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('username')" class="mt-1.5 text-xs text-red-500" />
            </div>

            <!-- Input Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" class="text-textSecondary font-semibold text-sm" />
                <x-text-input id="password"
                    class="block w-full mt-1.5 border-textTertiary/40 bg-tertiary text-textPrimary focus:border-primary focus:ring focus:ring-primary/20 rounded-xl shadow-sm transition duration-150"
                    type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-xs text-red-500" />
            </div>

            <!-- Opsi Tambahan Form (Remember Me & Lupa Password) -->
            <div class="flex items-center justify-between pt-1">
                <label for="remember_me" class="inline-flex items-center cursor-pointer">
                    <input id="remember_me" type="checkbox"
                        class="text-primary border-textTertiary/40 rounded focus:ring-primary/30 transition duration-150 h-4 w-4 bg-tertiary accent-primary"
                        name="remember">
                    <span class="text-xs text-textSecondary ms-2 font-medium select-none">{{ __('Ingat Saya') }}</span>
                </label>

                @if (Route::has('auth.password.request'))
                    <a class="text-xs text-primary hover:opacity-80 font-semibold underline transition duration-150"
                        href="{{ route('auth.password.request') }}">
                        {{ __('Lupa Password?') }}
                    </a>
                @endif
            </div>

            <!-- Tombol Aksi & Navigasi Register -->
            <div class="flex flex-col space-y-4 pt-2">
                <button type="submit" x-bind:disabled="submitting"
                    class="w-full flex justify-center items-center gap-2 py-3 px-4 border border-transparent rounded-xl shadow-md text-sm font-bold text-secondary bg-primary hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition duration-200 disabled:opacity-70 disabled:cursor-not-allowed">
                    <svg x-show="submitting" x-cloak class="animate-spin w-4 h-4" viewBox="0 0 24 24" fill="none">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z">
                        </path>
                    </svg>
                    <span x-text="submitting ? 'Memproses...' : '{{ __('Masuk Aplikasi') }}'"></span>
                </button>

                <div class="text-center">
                    <span class="text-xs text-textTertiary">Belum punya akun resmi?</span>
                    <a class="text-xs text-primary hover:opacity-80 font-bold underline ms-1 transition duration-150"
                        href="{{ route('auth.register') }}">
                        Daftar Petugas
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-layouts.auth>
