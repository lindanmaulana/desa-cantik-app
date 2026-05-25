<x-layouts.auth>
    <div class="p-8 bg-white/80 backdrop-blur-lg rounded-2xl shadow-2xl border border-white/60">

        <div class="mb-8 space-y-3">
            <x-button variant="ghost" class="!p-2 !text-primary !border-primary">
                <a href="{{ route('home') }}">
                    <x-bx-left-arrow-alt class="w-4 h-4 max-w-6 max-h-6" />
                </a>
            </x-button>
            <h2 class="text-center text-3xl font-bold text-primary tracking-tight">Selamat Datang</h2>
            <p class="text-center mt-2 text-sm text-gray-500 font-medium">Silakan masuk untuk mengakses dashboard</p>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('auth.login') }}" class="space-y-5">
            @csrf

            <div>
                <x-input-label for="username" :value="__('Username')" class="text-gray-700 font-semibold text-sm" />
                <x-text-input id="username"
                    class="block w-full mt-1.5 border-gray-300 focus:border-secondary focus:ring focus:ring-secondary/20 rounded-xl shadow-sm transition duration-150"
                    type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('username')" class="mt-1.5 text-xs text-red-500" />
            </div>

            <div>
                <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-semibold text-sm" />
                <x-text-input id="password"
                    class="block w-full mt-1.5 border-gray-300 focus:border-secondary focus:ring focus:ring-secondary/20 rounded-xl shadow-sm transition duration-150"
                    type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-xs text-red-500" />
            </div>

            <div class="flex items-center justify-between pt-1">
                <label for="remember_me" class="inline-flex items-center cursor-pointer">
                    <input id="remember_me" type="checkbox"
                        class="text-primary border-gray-300 rounded focus:ring-secondary/30 transition duration-150 h-4 w-4"
                        name="remember">
                    <span class="text-xs text-gray-600 ms-2 font-medium select-none">{{ __('Ingat Saya') }}</span>
                </label>

                @if (Route::has('auth.password.request'))
                    <a class="text-xs text-secondary hover:text-primary font-semibold underline transition duration-150"
                        href="{{ route('auth.password.request') }}">
                        {{ __('Lupa Password?') }}
                    </a>
                @endif
            </div>

            <div class="flex flex-col space-y-4 pt-2">
                <button type="submit"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-md text-sm font-bold text-white bg-primary hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition duration-200">
                    {{ __('Masuk Aplikasi') }}
                </button>

                <div class="text-center">
                    <span class="text-xs text-gray-500">Belum punya akun resmi?</span>
                    <a class="text-xs text-secondary hover:text-primary font-bold underline ms-1 transition duration-150"
                        href="{{ route('auth.register') }}">
                        Daftar Petugas
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-layouts.auth>
