<div x-show="openCreate" class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto transition-opacity duration-300 bg-gray-900 bg-opacity-50 backdrop-blur-sm">
    <div class="w-full max-w-lg overflow-hidden transition-all duration-300 transform scale-95 bg-white border border-gray-100 shadow-xl rounded-2xl">

        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gray-50">
            <div class="flex items-center gap-2">
                <div class="p-2 text-teal-600 rounded-lg bg-teal-50">
                    <x-heroicon-o-map-pin class="w-5 h-5" />
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Tambah Wilayah Baru</h3>
                    <p class="text-xs text-gray-500">Masukkan data master teritori administratif baru.</p>
                </div>
            </div>
            <button @click="openCreate = false" class="p-1 text-gray-400 transition-colors rounded-lg hover:text-gray-600 hover:bg-gray-100">
                <x-heroicon-o-x-mark class="w-5 h-5" />
            </button>
        </div>

        <form action="{{ route('territories.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <div>
                <label for="sub_village" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Nama Dusun <span class="text-red-500">*</span></label>
                <input type="text" id="sub_village" name="sub_village" required placeholder="Contoh: Pahing, Pon, Wage"
                    class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
            </div>

            <div>
                <label for="area_name" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Nama Spesifik / Blok <span class="text-gray-400">(Opsional)</span></label>
                <input type="text" id="area_name" name="area_name" placeholder="Contoh: Blok Al-Hidayah, Kampung Baru"
                    class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="rw" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Nomor RW <span class="text-red-500">*</span></label>
                    <input type="text" id="rw" name="rw" required maxlength="5" placeholder="Contoh: 001"
                        class="w-full px-3 py-2 text-sm text-center transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                </div>

                <div>
                    <label for="rt" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Nomor RT <span class="text-red-500">*</span></label>
                    <input type="text" id="rt" name="rt" required maxlength="5" placeholder="Contoh: 003"
                        class="w-full px-3 py-2 text-sm text-center transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                </div>
            </div>

            <div class="flex items-start gap-2 p-3 text-xs border rounded-lg bg-amber-50 border-amber-100 text-amber-700">
                <x-heroicon-o-information-circle class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" />
                <p>Pastikan kombinasi Dusun, RW, dan RT belum pernah terdaftar sebelumnya untuk menghindari ambiguitas penempatan domisili warga.</p>
            </div>

            <div class="flex items-center justify-end gap-2 pt-4 border-t border-gray-100">
                <button type="button" @click="openCreate = false" class="px-4 py-2 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-200 rounded-lg hover:bg-gray-50 focus:outline-none">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white transition-colors bg-teal-600 rounded-lg shadow-sm hover:bg-teal-700 focus:outline-none">
                    Simpan Wilayah
                </button>
            </div>
        </form>
    </div>
</div>