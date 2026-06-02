<div x-show="employmentProfile.openCreate" class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto transition-opacity duration-300 bg-gray-900 bg-opacity-50 backdrop-blur-sm">
    <div class="w-full max-w-3xl overflow-hidden transition-all duration-300 transform scale-95 bg-white border border-gray-100 shadow-xl rounded-2xl">

        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gray-50">
            <div class="flex items-center gap-2">
                <div class="p-2 text-teal-600 rounded-lg bg-teal-50">
                    <x-heroicon-o-identification class="w-5 h-5" />
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Profile Pekerjaan & Status Ekonomi</h3>
                </div>
            </div>
            <button @click="employmentProfile.openCreate = false" class="p-1 text-gray-400 transition-colors rounded-lg hover:text-gray-600 hover:bg-gray-100">
                <x-heroicon-o-x-mark class="w-5 h-5" />
            </button>
        </div>

        <form action="{{ route('employment-profile.store', $citizen) }}" method="POST" class="p-6 space-y-4 max-h-[70vh] overflow-y-auto">
            @csrf

            <div class="space-y-4" x-data="{ isWelfare: '0' }">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label for="occupation" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Pekerjaan Utama <span class="text-red-500">*</span></label>
                        <input type="text" id="occupation" name="occupation" required placeholder="Contoh: Petani, Ibu Rumah Tangga, Swasta"
                            class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                    </div>
                    <div>
                        <label for="job_sector" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Sektor Pekerjaan <span class="text-red-500">*</span></label>
                        <select id="job_sector" name="job_sector" required
                            class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                            @foreach($jobSector::cases() as $val)
                            <option value="{{ $val->value }}">{{ $val->label() }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label for="employment_status" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Status Hubungan Kerja <span class="text-red-500">*</span></label>
                        <select id="employment_status" name="employment_status" required
                            class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                            @foreach($employmentStatus::cases() as $val)
                            <option value="{{ $val->value }}">{{ $val->label() }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="monthly_income" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Pendapatan Bulanan (Rupiah)</label>
                        <input type="number" id="monthly_income" name="monthly_income" min="0" placeholder="0"
                            class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label for="economic_status" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Klasifikasi Kesejahteraan <span class="text-red-500">*</span></label>
                        <select id="economic_status" name="economic_status" required
                            class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                            @foreach($economicStatus::cases() as $val)
                            <option value="{{ $val->value }}">{{ $val->label() }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="is_welfare_recipient" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Menerima Bansos / Bantuan Pemerintah? <span class="text-red-500">*</span></label>
                        <select id="is_welfare_recipient" name="is_welfare_recipient" x-model="isWelfare" required
                            class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                            <option value="0">Tidak</option>
                            <option value="1">Ya</option>
                        </select>
                    </div>
                </div>

                <div x-show="isWelfare === '1'" x-transition class="p-3 border rounded-lg bg-amber-50 border-amber-100">
                    <label for="assistance_type" class="block mb-1 text-xs font-semibold tracking-wider uppercase text-amber-800">Jenis Bantuan Yang Diterima <span class="text-red-500">*</span></label>
                    <input type="text" id="assistance_type" name="assistance_type" :required="isWelfare === '1'" placeholder="Contoh: PKH, BPNT, BLT-DD"
                        class="w-full px-3 py-2 text-sm transition-all bg-white border rounded-lg border-amber-200 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500">
                </div>
            </div>

            <div class="flex items-center justify-end gap-2 pt-4 border-t border-gray-100">
                <button type="button" @click="openCreate = false" class="px-4 py-2 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-200 rounded-lg hover:bg-gray-50 focus:outline-none">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white transition-colors bg-teal-600 rounded-lg shadow-sm hover:bg-teal-700 focus:outline-none">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
