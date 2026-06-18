<div x-show="openUpdate"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto transition-opacity duration-300 bg-textPrimary/50 backdrop-blur-sm">

    <div
        class="w-full max-w-2xl overflow-hidden transition-all duration-300 transform scale-95 bg-secondary border border-textTertiary/30 shadow-xl rounded-2xl">

        <div class="flex items-center justify-between px-6 py-4 border-b border-textTertiary/20 bg-tertiary">
            <div class="flex items-center gap-2">
                <div class="p-2 rounded-lg text-primary bg-primary/10">
                    <x-heroicon-o-pencil-square class="w-5 h-5" />
                </div>
                <div>
                    <h3 class="text-lg font-bold text-textPrimary">Perbarui Profil Usaha UMKM</h3>
                    <p class="text-xs text-textSecondary">Perbarui rincian tenaga kerja, omset bulanan, dan izin usaha.
                    </p>
                </div>
            </div>
            <button @click="openUpdate = false"
                class="p-1 text-textSecondary transition-colors rounded-lg hover:text-textPrimary hover:bg-textTertiary/20">
                <x-heroicon-o-x-mark class="w-5 h-5" />
            </button>
        </div>

        <form :action="`/dashboard/manage-data/msmes/${msme.id}/update`" method="POST"
            class="p-6 space-y-4 max-h-[75vh] overflow-y-auto">
            @csrf
            @method('PUT')

            <div>
                <label for="update_citizen_id"
                    class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Pemilik Usaha
                    (Warga) <span class="text-red-500">*</span></label>
                <select id="update_citizen_id" name="citizen_id" required x-model="msme.citizen_id"
                    class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                    <option value="">-- Pilih Pemilik Usaha --</option>
                    @foreach ($citizens as $cit)
                        <option value="{{ $cit->id }}">
                            {{ $cit->full_name }} (NIK: {{ $cit->id_number }})
                        </option>
                    @endforeach
                </select>
                <p class="mt-1 text-[10px] text-textSecondary">Hubungan kepemilikan bersifat 1-to-many. Satu orang dapat
                    memiliki lebih dari satu bidang usaha.</p>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label for="update_business_name"
                        class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Nama Toko /
                        Badan Usaha <span class="text-red-500">*</span></label>
                    <input type="text" id="update_business_name" name="business_name" required
                        x-model="msme.business_name" placeholder="Contoh: Toko Barokah Jaya, Sate Pak Kirno"
                        class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary placeholder:text-textSecondary/50 focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                </div>

                <div>
                    <label for="update_business_category"
                        class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Kategori
                        Bidang
                        Usaha <span class="text-red-500">*</span></label>
                    <select id="update_business_category" name="business_category" required
                        x-model="msme.business_category"
                        class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($businessCategory::cases() as $val)
                            <option value="{{ $val->value }}">{{ $val->label() }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <div class="md:col-span-2">
                    <label for="update_license_number"
                        class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Nomor Izin
                        Usaha
                        / NIB (Nomor Induk Berusaha)</label>
                    <input type="text" id="update_license_number" name="license_number" x-model="msme.license_number"
                        placeholder="Contoh: 9120001234567"
                        class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary placeholder:text-textSecondary/50 focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                </div>

                <div>
                    <label for="update_employee_count"
                        class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Jumlah
                        Karyawan
                        <span class="text-red-500">*</span></label>
                    <input type="number" id="update_employee_count" name="employee_count" min="0" required
                        x-model="msme.employee_count" placeholder="0"
                        class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary placeholder:text-textSecondary/50 focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                </div>
            </div>

            <div>
                <label for="update_mothly_revenue"
                    class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Estimasi Omset
                    Bulanan Usaha (Rupiah)</label>
                <div class="relative">
                    <span
                        class="absolute inset-y-0 left-0 flex items-center pl-3 text-xs font-bold text-gray-400 pointer-events-none">
                        Rp.
                    </span>
                    <input type="number" id="update_mothly_revenue" name="mothly_revenue" min="0"
                        x-model="msme.mothly_revenue" placeholder="0"
                        class="w-full py-2 pl-10 pr-3 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary placeholder:text-textSecondary/50 focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                </div>
            </div>

            <div class="flex items-center justify-end gap-2 pt-4 border-t border-gray-100">
                <button type="button" @click="openUpdate = false"
                    class="px-4 py-2 text-sm font-medium text-textPrimary transition-colors bg-secondary border border-textTertiary/40 rounded-lg hover:bg-tertiary focus:outline-none">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium text-secondary transition-colors rounded-lg shadow-sm bg-primary hover:opacity-90 focus:outline-none">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
