<div class="grid grid-cols-1 gap-x-8 gap-y-6 md:grid-cols-3">
    <div>
        <h2 class="text-base font-semibold leading-7 text-gray-950">Banner Wallpaper Utama</h2>
        <p class="mt-1 text-sm leading-6 text-gray-500">Gambar latar belakang beresolusi tinggi (*landscape*) untuk beranda portal publik.</p>
    </div>
    <div class="md:col-span-2">
        <form id="banner-update-form" action="{{ route('settings.update-banner') }}" method="POST" enctype="multipart/form-data"
            class="relative overflow-hidden bg-white border border-gray-200 shadow-sm rounded-xl"
            x-data="{ submitting: false, previewOpen: false, preview: null, cancelPreview() { preview = null; previewOpen = false; $refs.file.value = '' }, confirmUpdate() { previewOpen = false; submitting = true; $refs.form.requestSubmit() } }"
            x-ref="form">
            @csrf
            @method('PUT')
            <div class="p-6 space-y-4">
                @if (!empty($settings->hero_image))
                    <div class="w-full overflow-hidden border border-gray-200 rounded-lg aspect-w-16 aspect-h-4">
                        <img src="{{ asset('storage/' . $settings->hero_image) }}" class="object-cover w-full h-28" alt="Hero Banner">
                    </div>
                @endif
                <div class="space-y-1">
                    <input x-ref="file" type="file" name="hero_image" accept="image/*"
                        @change="const file = $event.target.files[0]; if (file) { const reader = new FileReader(); reader.onload = event => { preview = event.target.result; previewOpen = true }; reader.readAsDataURL(file); }"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:rounded-md file:border-0 file:bg-indigo-50 file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-indigo-700 hover:file:bg-indigo-100">
                    <p class="text-xs text-gray-400">Rasio ideal landscape 16:9 atau 21:9 dengan ukuran maksimal 4 MB.</p>
                    @error('hero_image') <p class="text-xs font-medium text-rose-500">{{ $message }}</p> @enderror
                </div>
            </div>
            <div class="flex flex-wrap items-center justify-end px-6 py-3 border-t border-gray-100 gap-3 bg-gray-50">
                @if (!empty($settings->hero_image))
                    <button type="button" onclick="if (confirm('Hapus banner utama?')) document.getElementById('banner-delete-form').submit()"
                        class="flex items-center justify-center gap-2 px-4 py-2 text-xs font-semibold text-white transition bg-gray-900 rounded-md shadow-sm hover:bg-gray-800">Hapus Banner</button>
                @endif
            </div>
            <div x-show="previewOpen" x-cloak x-transition class="fixed inset-0 z-[100] flex items-center justify-center bg-gray-950/60 p-4" @click.self="previewOpen = false">
                <div class="overflow-y-auto rounded-xl bg-white p-5 shadow-2xl" style="width: 360px; max-width: calc(100vw - 2rem); max-height: 90vh;">
                    <h3 class="text-base font-bold text-gray-950">Preview Banner Utama</h3>
                    <div class="mx-auto mt-4 overflow-hidden rounded-lg border border-gray-200 bg-gray-50 p-3"
                        style="width: 256px; height: 256px; max-width: 100%;">
                        <img :src="preview" alt="Preview banner" class="h-full w-full object-contain">
                    </div>
                    <div class="mt-5 flex justify-end gap-3">
                        <button type="button" @click="cancelPreview()" class="px-4 py-2 text-xs font-semibold text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50">Batal</button>
                        <button type="button" @click="confirmUpdate()" class="px-4 py-2 text-xs font-semibold text-white bg-gray-900 rounded-md hover:bg-gray-800">Perbarui Banner</button>
                    </div>
                </div>
            </div>
        </form>
        <form id="banner-delete-form" action="{{ route('settings.delete-banner') }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>
