<div x-show="openCreate" class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto transition-opacity duration-300 bg-gray-900 bg-opacity-50 backdrop-blur-sm">

    <div class="w-full max-w-2xl overflow-hidden transition-all duration-300 transform scale-95 bg-white border border-gray-100 shadow-xl rounded-2xl">

        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gray-50">
            <div class="flex items-center gap-2">
                <div class="p-2 rounded-lg text-primary bg-primary/10">
                    <x-iconsax-lin-buildings class="w-5 h-5" />
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Registrasi Inventaris Aset Desa</h3>
                    <p class="text-xs text-gray-500">Daftarkan pembangunan sarana fisik publik baru milik wilayah desa.</p>
                </div>
            </div>
            <button @click="openCreate = false" class="p-1 text-gray-400 transition-colors rounded-lg hover:text-gray-600 hover:bg-gray-100">
                <x-heroicon-o-x-mark class="w-5 h-5" />
            </button>
        </div>

        <form action="{{ route('infrastructures.store') }}" method="POST" class="p-6 space-y-4 max-h-[75vh] overflow-y-auto">
            @csrf

            <div>
                <label for="facility_name" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Nama Sarana Prasarana <span class="text-red-500">*</span></label>
                <input type="text" id="facility_name" name="facility_name" required placeholder="Contoh: Jembatan Ciherang, Jalan RT 02 Dusun A"
                    class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label for="facility_type" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Jenis Fasilitas <span class="text-red-500">*</span></label>
                    <select id="facility_type" name="facility_type" required
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                        <option value="">-- Pilih Jenis Fasilitas --</option>
                        @foreach($facilityType::cases() as $val)
                            <option value="{{ $val->value }}">{{ $val->label() }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="condition" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Kondisi Kelayakan Fisik</label>
                    <select id="condition" name="condition"
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                        <option value="">-- Pilih Kondisi (Default: Baik / Layak) --</option>
                        @foreach($conditionInfrastructure::cases() as $val)
                            <option value="{{ $val->value }}">{{ $val->label() }}</option>
                        @endforeach
                    </select>
                    <p class="mt-1 text-[10px] text-gray-400">Jika dikosongkan, sistem akan otomatis menetapkannya ke status "Baik / Layak" sesuai aturan kelayakan default.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <div>
                    <label for="construction_year" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Tahun Pembangunan</label>
                    <input type="number" id="construction_year" name="construction_year" min="1900" max="{{ date('Y') }}" placeholder="Contoh: 2024"
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                </div>

                <div class="md:col-span-2">
                    <label for="funding_source" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Sumber Pendanaan Anggaran <span class="text-red-500">*</span></label>
                    <input type="text" id="funding_source" name="funding_source" required placeholder="Contoh: Dana Desa (Village Fund), APBD Kabupaten"
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                </div>
            </div>

            <div class="flex items-center justify-end gap-2 pt-4 border-t border-gray-100">
                <button type="button" @click="openCreate = false" class="px-4 py-2 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-200 rounded-lg hover:bg-gray-50 focus:outline-none">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 text-sm font-medium transition-colors rounded-lg shadow-sm text-secondary bg-primary hover:opacity-90 focus:outline-none">
                    Simpan Inventaris
                </button>
            </div>
        </form>
    </div>
</div>
