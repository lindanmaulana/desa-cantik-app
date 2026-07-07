<div class="grid grid-cols-1 gap-x-8 gap-y-6 md:grid-cols-3">
    <div>
        <h2 class="text-base font-semibold leading-7 text-gray-950">Banner Wallpaper Utama</h2>
        <p class="mt-1 text-sm leading-6 text-gray-500">Gambar latar belakang beresolusi tinggi (*landscape*) untuk
            beranda portal publik.</p>
    </div>
    <div class="md:col-span-2">
        <form action="{{ route('settings.update-banner') }}" method="POST" enctype="multipart/form-data"
            class="overflow-hidden bg-white border border-gray-200 shadow-sm rounded-xl" x-data="{ submitting: false }"
            @submit="submitting = true">
            @csrf
            @method('PUT')
            <div class="p-6 space-y-4">
                @if (!empty($settings->hero_image))
                    <div class="w-full overflow-hidden border border-gray-200 rounded-lg aspect-w-16 aspect-h-4">
                        <img src="{{ asset('storage/' . $settings->hero_image) }}" class="object-cover w-full h-28"
                            alt="Hero Banner">
                    </div>
                @endif
                <div class="space-y-1">
                    <input type="file" name="hero_image" accept="image/*"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:rounded-md file:border-0 file:bg-indigo-50 file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-indigo-700 hover:file:bg-indigo-100">
                    <p class="text-xs text-gray-400">Rasio ideal landscape 16:9 atau 21:9 dengan ukuran maksimal 4 MB.
                    </p>
                    @error('hero_image')
                        <p class="text-xs font-medium text-rose-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="flex items-center justify-end px-6 py-3 border-t border-gray-100 gap-x-6 bg-gray-50">
                <button type="submit" x-bind:disabled="submitting"
                    class="flex items-center justify-center gap-2 px-4 py-2 text-xs font-semibold text-white transition bg-gray-900 rounded-md shadow-sm hover:bg-gray-800">
                    <svg x-show="submitting" x-cloak class="w-4 h-4 animate-spin" viewBox="0 0 24 24" fill="none">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z">
                        </path>
                    </svg>
                    <span x-text="submitting ? 'Memperbaharui...' : 'Perbarui Banner Utama'"></span>
                </button>
            </div>
        </form>
    </div>
</div>
