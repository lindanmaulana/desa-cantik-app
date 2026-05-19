<div x-show="openCreate" class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto transition-opacity duration-300 bg-gray-900 bg-opacity-50 backdrop-blur-sm">

    <div class="w-full max-w-lg overflow-hidden transition-all duration-300 transform scale-95 bg-white border border-gray-100 shadow-xl rounded-2xl">

        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gray-50">
            <div class="flex items-center gap-2">
                <div class="p-2 text-teal-600 rounded-lg bg-teal-50">
                    <x-heroicon-o-users class="w-5 h-5" />
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Tambah Keluarga Baru</h3>
                    <p class="text-xs text-gray-500">Masukkan nomor KK dan alamat keluarga baru.</p>
                </div>
            </div>
            <button @click="openCreate = false" class="p-1 text-gray-400 transition-colors rounded-lg hover:text-gray-600 hover:bg-gray-100">
                <x-heroicon-o-x-mark class="w-5 h-5" />
            </button>
        </div>

        <form action="{{ route('families.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <div>
                <label for="family_card_number" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Nomor Kartu Keluarga (KK) <span class="text-red-500">*</span></label>
                <input type="text" id="family_card_number" name="family_card_number" required maxlength="16" placeholder="Contoh: 3208123456789012"
                    class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
            </div>

            <div>
                <label for="territory_id" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Wilayah Domisili (RT/RW/Dusun) <span class="text-red-500">*</span></label>
                <select id="territory_id" name="territory_id" required
                    class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                    <option value="">-- Pilih Wilayah --</option>
                    @foreach($territories as $territory)
                        <option value="{{ $territory->id }}">
                            Dusun {{ ucfirst($territory->sub_village) }} (RT {{ $territory->rt }} / RW {{ $territory->rw }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="address_detail" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Detail Alamat <span class="text-red-500">*</span></label>
                <textarea id="address_detail" name="address_detail" required rows="3" placeholder="Contoh: Blok Pahing RT 03/RW 01, samping Masjid Al-Ikhlas"
                    class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500"></textarea>
            </div>

            <div class="flex items-start gap-2 p-3 text-xs border rounded-lg bg-amber-50 border-amber-100 text-amber-700">
                <x-heroicon-o-information-circle class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" />
                <p>Harap pastikan Nomor Kartu Keluarga (KK) terdiri dari 16 digit angka yang valid sesuai dengan KTP/KK fisik untuk keakuratan data sensus.</p>
            </div>

            <div class="flex items-center justify-end gap-2 pt-4 border-t border-gray-100">
                <button type="button" @click="openCreate = false" class="px-4 py-2 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-200 rounded-lg hover:bg-gray-50 focus:outline-none">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white transition-colors bg-teal-600 rounded-lg shadow-sm hover:bg-teal-700 focus:outline-none">
                    Simpan Keluarga
                </button>
            </div>
        </form>
    </div>
</div>
