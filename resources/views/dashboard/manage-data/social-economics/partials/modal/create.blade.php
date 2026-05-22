<div x-show="openCreate" class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto transition-opacity duration-300 bg-gray-900 bg-opacity-50 backdrop-blur-sm" x-data="{ recipient: '0' }">

    <div class="w-full max-w-2xl overflow-hidden transition-all duration-300 transform scale-95 bg-white border border-gray-100 shadow-xl rounded-2xl">

        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gray-50">
            <div class="flex items-center gap-2">
                <div class="p-2 text-emerald-600 rounded-lg bg-emerald-50">
                    <x-ri-heart-pulse-line class="w-5 h-5" />
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Tambah Profil Sosial Ekonomi</h3>
                    <p class="text-xs text-gray-500">Buat klasifikasi kesejahteraan baru untuk warga desa.</p>
                </div>
            </div>
            <button @click="openCreate = false" class="p-1 text-gray-400 transition-colors rounded-lg hover:text-gray-600 hover:bg-gray-100">
                <x-heroicon-o-x-mark class="w-5 h-5" />
            </button>
        </div>

        <form action="{{ route('social-economics.store') }}" method="POST" class="p-6 space-y-4 max-h-[75vh] overflow-y-auto">
            @csrf

            <div>
                <label for="citizen_id" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Nama Penduduk (Warga) <span class="text-red-500">*</span></label>
                <select id="citizen_id" name="citizen_id" required
                    class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                    <option value="">-- Pilih Penduduk --</option>
                    @foreach($citizens as $cit)
                        @if(!$cit->socialEconomic)
                            <option value="{{ $cit->id }}">
                                {{ $cit->full_name }} (NIK: {{ $cit->id_number }})
                            </option>
                        @endif
                    @endforeach
                </select>
                <p class="mt-1 text-[10px] text-gray-400">Hanya menampilkan penduduk yang belum memiliki profil sosial ekonomi terdaftar.</p>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label for="education_level" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Pendidikan Terakhir <span class="text-red-500">*</span></label>
                    <select id="education_level" name="education_level" required
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                        <option value="">-- Pilih Pendidikan --</option>
                        @foreach($educationLevel as $val)
                            <option value="{{ $val->value }}">{{ $val->label() }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="occupation" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Pekerjaan Utama <span class="text-red-500">*</span></label>
                    <input type="text" id="occupation" name="occupation" required placeholder="Contoh: Buruh Harian Lepas, PNS"
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label for="monthly_income" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Estimasi Pendapatan Bulanan (Rupiah)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-xs text-gray-400 font-bold">
                            Rp.
                        </span>
                        <input type="number" id="monthly_income" name="monthly_income" min="0" placeholder="0"
                            class="w-full py-2 pl-10 pr-3 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                    </div>
                </div>

                <div>
                    <label for="is_welfare_recipient" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Penerima Bantuan Pemerintah (Bansos)? <span class="text-red-500">*</span></label>
                    <select id="is_welfare_recipient" name="is_welfare_recipient" x-model="recipient" required
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                        <option value="0">Tidak / Bukan Penerima</option>
                        <option value="1">Ya / Aktif Menerima</option>
                    </select>
                </div>
            </div>

            <div x-show="recipient === '1'" x-transition class="p-4 border border-amber-100 rounded-lg bg-amber-50 space-y-2">
                <label for="assistance_type" class="block text-xs font-semibold tracking-wider text-amber-800 uppercase">Jenis Bantuan Yang Diterima <span class="text-red-500">*</span></label>
                <input type="text" id="assistance_type" name="assistance_type" :required="recipient === '1'" placeholder="Contoh: PKH, BPNT, BLT Dana Desa"
                    class="w-full px-3 py-2 text-sm transition-all border border-amber-200 rounded-lg bg-white focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500">
                <p class="text-[10px] text-amber-700">Tuliskan program jaring pengaman sosial aktif yang diikuti penduduk bersangkutan.</p>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label for="house_condition" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Kelayakan Rumah Tinggal <span class="text-red-500">*</span></label>
                    <select id="house_condition" name="house_condition" required
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                        <option value="">-- Pilih Kelayakan --</option>
                        @foreach($houseCondition as $val)
                            <option value="{{ $val->value }}">{{ $val->label() }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="economic_status" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Klasifikasi Tingkat Ekonomi <span class="text-red-500">*</span></label>
                    <select id="economic_status" name="economic_status" required
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                        <option value="">-- Pilih Klasifikasi --</option>
                        @foreach($economicStatus as $val)
                            <option value="{{ $val->value }}">{{ $val->label() }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex items-center justify-end gap-2 pt-4 border-t border-gray-100">
                <button type="button" @click="openCreate = false" class="px-4 py-2 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-200 rounded-lg hover:bg-gray-50 focus:outline-none">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white transition-colors bg-emerald-600 rounded-lg shadow-sm hover:bg-emerald-700 focus:outline-none">
                    Simpan Profil
                </button>
            </div>
        </form>
    </div>
</div>
