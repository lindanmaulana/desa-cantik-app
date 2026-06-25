<div class="grid grid-cols-1 gap-x-8 gap-y-6 md:grid-cols-3">
    <div>
        <h2 class="text-base font-semibold leading-7 text-gray-950">Logo Identitas Resmi</h2>
        <p class="mt-1 text-sm leading-6 text-gray-500">Aset gambar visual transparan lambang desa. Disarankan berformat PNG atau SVG.</p>
    </div>
    <div class="md:col-span-2">
        <form action="{{ route('settings.update-logo') }}" method="POST" enctype="multipart/form-data" class="overflow-hidden bg-white border border-gray-200 shadow-sm rounded-xl">
            @csrf
            @method('PUT')
            <div class="p-6 sm:flex sm:items-center sm:gap-x-6">
                <div class="flex items-center justify-center w-24 h-24 p-2 border border-gray-200 shadow-inner shrink-0 rounded-xl bg-gray-50">
                    @if(!empty($settings->village_logo))
                    <img src="{{ asset('storage/' . $settings->village_logo) }}" class="object-contain max-w-full max-h-full" alt="Logo">
                    @else
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    @endif
                </div>
                <div class="flex-1 mt-4 space-y-1 sm:mt-0">
                    <input type="file" name="village_logo" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:rounded-md file:border-0 file:bg-indigo-50 file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-indigo-700 hover:file:bg-indigo-100">
                    <p class="text-xs text-gray-400">Ukuran file maksimal 2 MB dengan ekstensi .png, .jpg atau .svg</p>
                    @error('village_logo') <p class="text-xs font-medium text-rose-500">{{ $message }}</p> @enderror
                </div>
            </div>
            <div class="flex items-center justify-end px-6 py-3 border-t border-gray-100 gap-x-6 bg-gray-50">
                <button type="submit" class="px-4 py-2 text-xs font-semibold text-white transition bg-gray-900 rounded-md shadow-sm hover:bg-gray-800">Perbarui Logo Resmi</button>
            </div>
        </form>
    </div>
</div>