<div x-show="employmentProfile.openCreate"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto transition-opacity duration-300 bg-textPrimary/50 backdrop-blur-sm">
    <div
        class="w-full max-w-3xl overflow-hidden transition-all duration-300 transform scale-95 bg-secondary border border-textTertiary/20 shadow-xl rounded-2xl">

        <!-- Header Modal -->
        <div class="flex items-center justify-between px-6 py-4 border-b border-textTertiary/10 bg-tertiary">
            <div class="flex items-center gap-2">
                <div class="p-2 text-primary rounded-lg bg-primary/10">
                    <x-heroicon-o-identification class="w-5 h-5" />
                </div>
                <div>
                    <h3 class="text-lg font-bold text-textPrimary">Profile Pekerjaan & Status Ekonomi</h3>
                </div>
            </div>
            <button @click="employmentProfile.openCreate = false"
                class="p-1 text-textSecondary transition-colors rounded-lg hover:text-textPrimary hover:bg-textTertiary/20">
                <x-heroicon-o-x-mark class="w-5 h-5" />
            </button>
        </div>

        <!-- Form Input Data Ekonomi & Pekerjaan -->
        <form action="{{ route('employment-profile.store', $citizen) }}" method="POST"
            class="p-6 space-y-4 max-h-[70vh] overflow-y-auto">
            @csrf

            <div class="space-y-4" x-data="{ isWelfare: '0' }">
                <!-- Baris 1: Pekerjaan Utama & Sektor Pekerjaan -->
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label for="occupation"
                            class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Pekerjaan
                            Utama <span class="text-red-500">*</span></label>
                        <input type="text" id="occupation" name="occupation" required
                            placeholder="Contoh: Petani, Ibu Rumah Tangga, Swasta"
                            class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary placeholder:text-textTertiary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                    </div>
                    <div>
                        <label for="job_sector"
                            class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Sektor
                            Pekerjaan <span class="text-red-500">*</span></label>
                        <select id="job_sector" name="job_sector" required
                            class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                            @foreach ($jobSector::cases() as $val)
                                <option value="{{ $val->value }}" class="bg-secondary">{{ $val->label() }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Baris 2: Hubungan Kerja & Pendapatan -->
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label for="employment_status"
                            class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Status
                            Hubungan Kerja <span class="text-red-500">*</span></label>
                        <select id="employment_status" name="employment_status" required
                            class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                            @foreach ($employmentStatus::cases() as $val)
                                <option value="{{ $val->value }}" class="bg-secondary">{{ $val->label() }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="monthly_income"
                            class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Pendapatan
                            Bulanan (Rupiah)</label>
                        <input type="number" id="monthly_income" name="monthly_income" min="0" placeholder="0"
                            class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary placeholder:text-textTertiary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                    </div>
                </div>

                <!-- Baris 3: Kesejahteraan & Status Bansos -->
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label id="label_economic_status" for="economic_status"
                            class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Klasifikasi
                            Kesejahteraan <span class="text-red-500">*</span></label>
                        <select id="economic_status" name="economic_status" required
                            class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                            @foreach ($economicStatus::cases() as $val)
                                <option value="{{ $val->value }}" class="bg-secondary">{{ $val->label() }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label id="label_welfare_recipient" for="is_welfare_recipient"
                            class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Menerima
                            Bansos / Bantuan Pemerintah? <span class="text-red-500">*</span></label>
                        <select id="is_welfare_recipient" name="is_welfare_recipient" x-model="isWelfare" required
                            class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                            <option value="0" class="bg-secondary">Tidak</option>
                            <option value="1" class="bg-secondary">Ya</option>
                        </select>
                    </div>
                </div>

                <!-- Input Bersyarat: Detail Jenis Bansos (Aksen Warning Dipertahankan) -->
                <div x-show="isWelfare === '1'" x-transition class="p-3 border rounded-lg bg-amber-50 border-amber-100">
                    <label for="assistance_type"
                        class="block mb-1 text-xs font-semibold tracking-wider uppercase text-amber-800">Jenis Bantuan
                        Yang Diterima <span class="text-red-500">*</span></label>
                    <input type="text" id="assistance_type" name="assistance_type"
                        :required="isWelfare === '1'" placeholder="Contoh: PKH, BPNT, BLT-DD"
                        class="w-full px-3 py-2 text-sm transition-all bg-white border rounded-lg border-amber-200 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500">
                </div>
            </div>

            <!-- Footer Modal Actions -->
            <div class="flex items-center justify-end gap-2 pt-4 border-t border-textTertiary/10">
                <button type="button" @click="employmentProfile.openCreate = false"
                    class="px-4 py-2 text-sm font-medium text-textPrimary transition-colors bg-secondary border border-textTertiary/40 rounded-lg hover:bg-tertiary focus:outline-none">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium text-secondary transition-colors bg-primary rounded-lg shadow-sm hover:opacity-90 focus:outline-none">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
