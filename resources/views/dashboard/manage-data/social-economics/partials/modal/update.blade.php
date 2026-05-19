<div x-show="openUpdate" class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto transition-opacity duration-300 bg-gray-900 bg-opacity-50 backdrop-blur-sm">

    <div class="w-full max-w-2xl overflow-hidden transition-all duration-300 transform scale-95 bg-white border border-gray-100 shadow-xl rounded-2xl">

        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gray-50">
            <div class="flex items-center gap-2">
                <div class="p-2 text-emerald-600 rounded-lg bg-emerald-50">
                    <x-heroicon-o-pencil-square class="w-5 h-5" />
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Perbarui Profil Sosial Ekonomi</h3>
                    <p class="text-xs text-gray-500">Perbarui status kesejahteraan dan bantuan penduduk.</p>
                </div>
            </div>
            <button @click="openUpdate = false" class="p-1 text-gray-400 transition-colors rounded-lg hover:text-gray-600 hover:bg-gray-100">
                <x-heroicon-o-x-mark class="w-5 h-5" />
            </button>
        </div>

        <form :action="`/dashboard/manage-data/social-economics/${profile.id}/update`" method="POST" class="p-6 space-y-4 max-h-[75vh] overflow-y-auto">
            @csrf
            @method('PUT')

            <div>
                <label for="update_citizen_id" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Nama Penduduk (Warga) <span class="text-red-500">*</span></label>
                <select id="update_citizen_id" name="citizen_id" required x-model="profile.citizen_id"
                    class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                    <option value="">-- Pilih Penduduk --</option>
                    @foreach($citizens as $cit)
                        <option value="{{ $cit->id }}">
                            {{ $cit->full_name }} (NIK: {{ $cit->id_number }})
                        </option>
                    @endforeach
                </select>
                <p class="mt-1 text-[10px] text-gray-400">Hubungan data penduduk bersifat unik 1-to-1.</p>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label for="update_education_level" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Pendidikan Terakhir <span class="text-red-500">*</span></label>
                    <select id="update_education_level" name="education_level" required x-model="profile.education_level"
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                        <option value="">-- Pilih Pendidikan --</option>
                        @foreach($educationLabels as $val => $lbl)
                            <option value="{{ $val }}">{{ $lbl }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="update_occupation" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Pekerjaan Utama <span class="text-red-500">*</span></label>
                    <input type="text" id="update_occupation" name="occupation" required x-model="profile.occupation" placeholder="Contoh: Buruh Harian Lepas, PNS"
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label for="update_monthly_income" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Estimasi Pendapatan Bulanan (Rupiah)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-xs text-gray-400 font-bold">
                            Rp.
                        </span>
                        <input type="number" id="update_monthly_income" name="monthly_income" min="0" x-model="profile.monthly_income" placeholder="0"
                            class="w-full py-2 pl-10 pr-3 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                    </div>
                </div>

                <div>
                    <label for="update_is_welfare_recipient" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Penerima Bantuan Pemerintah (Bansos)? <span class="text-red-500">*</span></label>
                    <select id="update_is_welfare_recipient" name="is_welfare_recipient" x-model="profile.is_welfare_recipient" required
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                        <option value="0">Tidak / Bukan Penerima</option>
                        <option value="1">Ya / Aktif Menerima</option>
                    </select>
                </div>
            </div>

            <div x-show="profile.is_welfare_recipient === '1'" x-transition class="p-4 border border-amber-100 rounded-lg bg-amber-50 space-y-2">
                <label for="update_assistance_type" class="block text-xs font-semibold tracking-wider text-amber-800 uppercase">Jenis Bantuan Yang Diterima <span class="text-red-500">*</span></label>
                <input type="text" id="update_assistance_type" name="assistance_type" :required="profile.is_welfare_recipient === '1'" x-model="profile.assistance_type" placeholder="Contoh: PKH, BPNT, BLT Dana Desa"
                    class="w-full px-3 py-2 text-sm transition-all border border-amber-200 rounded-lg bg-white focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500">
                <p class="text-[10px] text-amber-700">Tuliskan program jaring pengaman sosial aktif yang diikuti penduduk bersangkutan.</p>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label for="update_house_condition" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Kelayakan Rumah Tinggal <span class="text-red-500">*</span></label>
                    <select id="update_house_condition" name="house_condition" required x-model="profile.house_condition"
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                        <option value="">-- Pilih Kelayakan --</option>
                        @foreach($houseLabels as $val => $lbl)
                            <option value="{{ $val }}">{{ $lbl }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="update_economic_status" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Klasifikasi Tingkat Ekonomi <span class="text-red-500">*</span></label>
                    <select id="update_economic_status" name="economic_status" required x-model="profile.economic_status"
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                        <option value="">-- Pilih Klasifikasi --</option>
                        @foreach($economicLabels as $val => $lbl)
                            <option value="{{ $val }}">{{ $lbl }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex items-center justify-end gap-2 pt-4 border-t border-gray-100">
                <button type="button" @click="openUpdate = false" class="px-4 py-2 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-200 rounded-lg hover:bg-gray-50 focus:outline-none">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white transition-colors bg-emerald-600 rounded-lg shadow-sm hover:bg-emerald-700 focus:outline-none">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
