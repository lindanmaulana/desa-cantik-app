<x-layouts.auth>
    <div class="p-8 bg-white/80 backdrop-blur-lg rounded-2xl shadow-2xl border border-white/60">
        <div class="mb-8 text-center">
            <h2 class="text-3xl font-bold text-primary tracking-tight">Selamat Datang</h2>
            <p class="mt-2 text-sm text-gray-500 font-medium">Silakan daftar untuk mendapatkan akses</p>
        </div>

        <form method="POST" action="{{ route('auth.register') }}">
            @csrf
            <div>
                <x-input-label for="fullname" :value="__('Full Name')" />

                <x-text-input id="fullname"
                    class="block w-full mt-1.5 border-gray-300 focus:border-secondary focus:ring focus:ring-secondary/20 rounded-xl shadow-sm transition duration-150"
                    type="text" name="fullname" :value="old('fullname')" required autofocus autocomplete="fullname" />

                <x-input-error :messages="$errors->get('fullname')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="username" :value="__('Username')" />
                <x-text-input id="username"
                    class="block w-full mt-1.5 border-gray-300 focus:border-secondary focus:ring focus:ring-secondary/20 rounded-xl shadow-sm transition duration-150"
                    type="text" name="username" :value="old('username')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password"
                    class="block w-full mt-1.5 border-gray-300 focus:border-secondary focus:ring focus:ring-secondary/20 rounded-xl shadow-sm transition duration-150"
                    type="password" name="password" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation"
                    class="block w-full mt-1.5 border-gray-300 focus:border-secondary focus:ring focus:ring-secondary/20 rounded-xl shadow-sm transition duration-150"
                    type="password" name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="text-xs text-secondary hover:text-primary font-semibold underline transition duration-150 pr-3"
                    href="{{ route('auth.login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button
                    class="w-fit flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-md text-sm font-bold text-white bg-primary hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition duration-200">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-layouts.auth>
