<div x-show="openCreate" class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto transition-opacity duration-300 bg-gray-900 bg-opacity-50 backdrop-blur-sm">

    <div class="w-full max-w-2xl overflow-hidden transition-all duration-300 transform scale-95 bg-white border border-gray-100 shadow-xl rounded-2xl">

        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gray-50">
            <div class="flex items-center gap-2">
                <div class="p-2 text-emerald-600 rounded-lg bg-emerald-50">
                    <x-bi-shop class="w-5 h-5" />
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Tambah Profil Usaha UMKM</h3>
                    <p class="text-xs text-gray-500">Daftarkan usaha produktif lokal milik warga desa.</p>
                </div>
            </div>
            <button @click="openCreate = false" class="p-1 text-gray-400 transition-colors rounded-lg hover:text-gray-600 hover:bg-gray-100">
                <x-heroicon-o-x-mark class="w-5 h-5" />
            </button>
        </div>

        <form action="{{ route('msmes.store') }}" method="POST" class="p-6 space-y-4 max-h-[75vh] overflow-y-auto">
            @csrf

            <div>
                <label for="citizen_id" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Pemilik Usaha (Warga) <span class="text-red-500">*</span></label>
                <select id="citizen_id" name="citizen_id" required
                    class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                    <option value="">-- Pilih Pemilik Usaha --</option>
                    @foreach($citizens as $cit)
                        <option value="{{ $cit->id }}">
                            {{ $cit->full_name }} (NIK: {{ $cit->id_number }})
                        </option>
                    @endforeach
                </select>
                <p class="mt-1 text-[10px] text-gray-400">Hubungan kepemilikan bersifat 1-to-many. Satu orang dapat memiliki lebih dari satu bidang usaha.</p>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label for="business_name" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Nama Toko / Badan Usaha <span class="text-red-500">*</span></label>
                    <input type="text" id="business_name" name="business_name" required placeholder="Contoh: Toko Barokah Jaya, Sate Pak Kirno"
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                </div>

                <div>
                    <label for="business_category" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Kategori Bidang Usaha <span class="text-red-500">*</span></label>
                    <select id="business_category" name="business_category" required
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categoryLabels as $val => $lbl)
                            <option value="{{ $val }}">{{ $lbl }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <div class="md:col-span-2">
                    <label for="license_number" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Nomor Izin Usaha / NIB (Nomor Induk Berusaha)</label>
                    <input type="text" id="license_number" name="license_number" placeholder="Contoh: 9120001234567"
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                </div>

                <div>
                    <label for="employee_count" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Jumlah Karyawan <span class="text-red-500">*</span></label>
                    <input type="number" id="employee_count" name="employee_count" min="0" required placeholder="0"
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                </div>
            </div>

            <div>
                <label for="mothly_revenue" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Estimasi Omset Bulanan Usaha (Rupiah)</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-xs text-gray-400 font-bold">
                        Rp.
                    </span>
                    <input type="number" id="mothly_revenue" name="mothly_revenue" min="0" placeholder="0"
                        class="w-full py-2 pl-10 pr-3 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                </div>
            </div>

            <div class="flex items-center justify-end gap-2 pt-4 border-t border-gray-100">
                <button type="button" @click="openCreate = false" class="px-4 py-2 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-200 rounded-lg hover:bg-gray-50 focus:outline-none">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white transition-colors bg-emerald-600 rounded-lg shadow-sm hover:bg-emerald-700 focus:outline-none">
                    Simpan Usaha
                </button>
            </div>
        </form>
    </div>
</div>
