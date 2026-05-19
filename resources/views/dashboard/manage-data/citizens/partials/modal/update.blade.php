<div x-show="openUpdate" class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto transition-opacity duration-300 bg-gray-900 bg-opacity-50 backdrop-blur-sm">

    <div class="w-full max-w-2xl overflow-hidden transition-all duration-300 transform scale-95 bg-white border border-gray-100 shadow-xl rounded-2xl">

        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gray-50">
            <div class="flex items-center gap-2">
                <div class="p-2 text-teal-600 rounded-lg bg-teal-50">
                    <x-heroicon-o-pencil-square class="w-5 h-5" />
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Perbarui Penduduk</h3>
                    <p class="text-xs text-gray-500">Perbarui identitas lengkap warga desa.</p>
                </div>
            </div>
            <button @click="openUpdate = false" class="p-1 text-gray-400 transition-colors rounded-lg hover:text-gray-600 hover:bg-gray-100">
                <x-heroicon-o-x-mark class="w-5 h-5" />
            </button>
        </div>

        <form :action="`/dashboard/manage-data/citizens/${citizen.id}/update`" method="POST" class="p-6 space-y-4 max-h-[75vh] overflow-y-auto">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label for="update_id_number" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Nomor Induk Kependudukan (NIK) <span class="text-red-500">*</span></label>
                    <input type="text" id="update_id_number" name="id_number" required maxlength="16" minlength="16" x-model="citizen.id_number" placeholder="16 digit NIK"
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                </div>

                <div>
                    <label for="update_family_id" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Hubungkan Ke Keluarga (KK) <span class="text-red-500">*</span></label>
                    <select id="update_family_id" name="family_id" required x-model="citizen.family_id"
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                        <option value="">-- Pilih Nomor KK --</option>
                        @foreach($families as $fam)
                            <option value="{{ $fam->id }}">
                                {{ $fam->family_card_number }} ({{ $fam->address_detail }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label for="update_full_name" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" id="update_full_name" name="full_name" required x-model="citizen.full_name" placeholder="Contoh: Budi Santoso"
                    class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label for="update_gender" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Jenis Kelamin <span class="text-red-500">*</span></label>
                    <select id="update_gender" name="gender" required x-model="citizen.gender"
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        @foreach($genderLabels as $val => $lbl)
                            <option value="{{ $val }}">{{ $lbl }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="update_family_role" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Hubungan Keluarga <span class="text-red-500">*</span></label>
                    <select id="update_family_role" name="family_role" required x-model="citizen.family_role"
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                        <option value="">-- Pilih Hubungan --</option>
                        @foreach($roleLabels as $val => $lbl)
                            <option value="{{ $val }}">{{ $lbl }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label for="update_birth_place" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Tempat Lahir <span class="text-red-500">*</span></label>
                    <input type="text" id="update_birth_place" name="birth_place" required x-model="citizen.birth_place" placeholder="Contoh: Cirebon"
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                </div>

                <div>
                    <label for="update_birth_date" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Tanggal Lahir</label>
                    <input type="date" id="update_birth_date" name="birth_date" x-model="citizen.birth_date"
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <div class="col-span-1 md:col-span-1">
                    <label class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Agama <span class="text-red-500">*</span></label>
                    <select name="religion" required x-model="citizen.religion"
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                        <option value="">-- Pilih Agama --</option>
                        @foreach($religionLabels as $val => $lbl)
                            <option value="{{ $val }}">{{ $lbl }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-span-1 md:col-span-1">
                    <label class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Status Pernikahan <span class="text-red-500">*</span></label>
                    <select name="marital_status" required x-model="citizen.marital_status"
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                        <option value="">-- Pilih Status --</option>
                        @foreach($maritalLabels as $val => $lbl)
                            <option value="{{ $val }}">{{ $lbl }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-span-1 md:col-span-1">
                    <label for="update_blood_type" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Golongan Darah</label>
                    <input type="text" id="update_blood_type" name="blood_type" maxlength="5" x-model="citizen.blood_type" placeholder="Contoh: O, AB"
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                </div>
            </div>

            <div class="flex items-start gap-2 p-3 text-xs border rounded-lg bg-amber-50 border-amber-100 text-amber-700">
                <x-heroicon-o-information-circle class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" />
                <p>Harap pastikan semua perubahan data telah dikonfirmasi dengan dokumen fisik (KTP/KK) warga bersangkutan untuk menghindari ketidaksesuaian laporan sensus.</p>
            </div>

            <div class="flex items-center justify-end gap-2 pt-4 border-t border-gray-100">
                <button type="button" @click="openUpdate = false" class="px-4 py-2 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-200 rounded-lg hover:bg-gray-50 focus:outline-none">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white transition-colors bg-teal-600 rounded-lg shadow-sm hover:bg-teal-700 focus:outline-none">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
