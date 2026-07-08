<div x-show="openUpdate"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto transition-opacity duration-300 bg-textPrimary/50 backdrop-blur-sm">

    <div class="w-full max-w-2xl overflow-hidden transition-all duration-300 transform scale-95 border shadow-xl bg-secondary border-textTertiary/30 rounded-2xl">

        {{-- Header Modal --}}
        <div class="flex items-center justify-between px-6 py-4 border-b border-textTertiary/20 bg-tertiary">
            <div class="flex items-center gap-2">
                <div class="p-2 rounded-lg text-primary bg-primary/10">
                    <x-heroicon-o-pencil-square class="w-5 h-5" />
                </div>
                <div>
                    <h3 class="text-lg font-bold text-textPrimary">Perbarui Profil Usaha UMKM</h3>
                    <p class="text-xs text-textSecondary">Perbarui rincian tenaga kerja, omset bulanan, dan izin usaha.</p>
                </div>
            </div>
            <button @click="openUpdate = false"
                class="p-1 transition-colors rounded-lg text-textSecondary hover:text-textPrimary hover:bg-textTertiary/20">
                <x-heroicon-o-x-mark class="w-5 h-5" />
            </button>
        </div>

        {{-- Form Konten --}}
        <form :action="`/dashboard/manage-data/msmes/${msme.id}/update`" method="POST"
            class="p-6 space-y-4 max-h-[75vh] overflow-y-auto" x-data="{ submitting: false }" @submit="submitting = true">
            @csrf
            @method('PUT')

            {{-- 1. Pemilik Usaha (Warga) --}}
            <div class="space-y-1">
                <label for="update_citizen_id" class="block text-xs font-semibold tracking-wider uppercase text-textSecondary">
                    Pemilik Usaha (Warga) <span class="text-red-500">*</span>
                </label>
                <select id="update_citizen_id" name="citizen_id" required x-model="msme.citizen_id"
                    class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                    <option value="">-- Pilih Pemilik Usaha --</option>
                    @foreach ($citizens as $cit)
                    <option value="{{ $cit->id }}">
                        {{ $cit->full_name }} (NIK: {{ $cit->id_number }})
                    </option>
                    @endforeach
                </select>
                <p class="text-[10px] text-textSecondary">Hubungan kepemilikan bersifat 1-to-many. Satu orang dapat memiliki lebih dari satu bidang usaha.</p>
            </div>

            {{-- 2. Nama Usaha & Kategori --}}
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="space-y-1">
                    <label for="update_business_name" class="block text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Nama Toko / Badan Usaha <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="update_business_name" name="business_name" required x-model="msme.business_name"
                        placeholder="Contoh: Toko Barokah Jaya, Sate Pak Kirno"
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary placeholder:text-textSecondary/50 focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                </div>

                <div class="space-y-1">
                    <label for="update_business_category" class="block text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Kategori Bidang Usaha <span class="text-red-500">*</span>
                    </label>
                    <select id="update_business_category" name="business_category" required x-model="msme.business_category"
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($businessCategory::cases() as $val)
                        <option value="{{ $val->value }}">{{ $val->label() }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- 3. NIB & Jumlah Karyawan --}}
            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <div class="space-y-1 md:col-span-2">
                    <label for="update_license_number" class="block text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Nomor Izin Usaha / NIB (Nomor Induk Berusaha)
                    </label>
                    <input type="text" id="update_license_number" name="license_number" x-model="msme.license_number"
                        placeholder="Contoh: 9120001234567"
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary placeholder:text-textSecondary/50 focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                </div>

                <div class="space-y-1">
                    <label for="update_employee_count" class="block text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Jumlah Karyawan <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="update_employee_count" name="employee_count" min="0" required x-model="msme.employee_count"
                        placeholder="0"
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary placeholder:text-textSecondary/50 focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                </div>
            </div>

            {{-- 4. Badan Hukum Usaha & Estimasi Omset --}}
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="space-y-1">
                    <label for="update_legal_entity_type" class="block text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Badan Hukum Usaha <span class="text-red-500">*</span>
                    </label>
                    <select id="update_legal_entity_type" name="legal_entity_type" required x-model="msme.legal_entity_type"
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        <option value="unregistered">Belum Berbadan Hukum (Unregistered)</option>
                        <option value="sole_proprietorship">Perusahaan Perseorangan</option>
                        <option value="limited_partnership">CV (Limited Partnership)</option>
                        <option value="limited_company">PT (Limited Company)</option>
                        <option value="cooperative">Koperasi</option>
                    </select>
                </div>

                <div class="space-y-1">
                    <label for="update_monthly_revenue" class="block text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Estimasi Omset Bulanan Usaha
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-xs font-bold pointer-events-none text-textSecondary/60">
                            Rp.
                        </span>
                        <input type="number" id="update_monthly_revenue" name="monthly_revenue" min="0" x-model="msme.monthly_revenue"
                            placeholder="0"
                            class="w-full py-2 pl-10 pr-3 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary placeholder:text-textSecondary/50 focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                    </div>
                </div>
            </div>

            {{-- 5. Sumber Modal & Platform Digital --}}
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="space-y-1">
                    <label for="update_capital_source" class="block text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Sumber Modal Usaha <span class="text-red-500">*</span>
                    </label>
                    <select id="update_capital_source" name="capital_source" required x-model="msme.capital_source"
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        <option value="personal">Modal Mandiri / Sendiri</option>
                        <option value="bank_loan">Pinjaman Bank (Kredit Komersial)</option>
                        <option value="goverment_credit">Kredit Usaha Rakyat (KUR)</option>
                        <option value="goverment_grant">Bantuan / Hibah Pemerintah</option>
                        <option value="family_relative">Pinjaman Keluarga / Kerabat</option>
                    </select>
                </div>

                <div class="space-y-1">
                    <label for="update_digita_platform_type" class="block text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Penggunaan Platform Digital <span class="text-red-500">*</span>
                    </label>
                    <select id="update_digita_platform_type" name="digita_platform_type" required x-model="msme.digita_platform_type"
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        <option value="none">Tidak Menggunakan Platform</option>
                        <option value="social_media">Media Sosial (FB, IG, WA Business)</option>
                        <option value="ecommerce">E-Commerce (Shopee, Tokopedia, dll)</option>
                        <option value="delivery_app">Aplikasi Delivery Kuliner (GoFood/GrabFood)</option>
                        <option value="ride_hailing">Layanan Ride Hailing</option>
                    </select>
                </div>
            </div>

            {{-- 6. Status Kemitraan BumDes --}}
            <div class="space-y-1">
                <label for="update_bumdes_partnership_status" class="block text-xs font-semibold tracking-wider uppercase text-textSecondary">
                    Status Kemitraan dengan BUM Desa <span class="text-red-500">*</span>
                </label>
                <select id="update_bumdes_partnership_status" name="bumdes_partnership_status" required x-model="msme.bumdes_partnership_status"
                    class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                    <option value="none">Tidak Ada Kemitraan</option>
                    <option value="consigment_product">Titip Jual Produk (Consignment)</option>
                    <option value="raw_material_supply">Pasokan Bahan Baku</option>
                    <option value="capital_invesment">Penyertaan Modal BumDes</option>
                    <option value="marketing_cooperation">Kerjasama Pemasaran / Distribusi</option>
                </select>
            </div>

            {{-- 7. Boolean Checkboxes (Transaksi Digital & Ramah Lingkungan) --}}
            <div class="grid grid-cols-1 gap-4 p-4 border border-textTertiary/20 rounded-xl bg-tertiary/50 sm:grid-cols-2">
                <div class="flex items-start gap-3">
                    <div class="flex items-center h-5">
                        <input id="update_uses_digital_payment" name="uses_digital_payment" type="checkbox" value="1"
                            x-model="msme.uses_digital_payment" :checked="msme.uses_digital_payment == 1"
                            class="w-4 h-4 rounded border-textTertiary/40 text-primary focus:ring-primary bg-tertiary">
                    </div>
                    <div class="text-sm">
                        <label for="update_uses_digital_payment" class="font-medium text-textPrimary">Mendukung Pembayaran Digital</label>
                        <p class="text-xs text-textSecondary">Usaha menyediakan fasilitas QRIS, Transfer Bank, atau E-Wallet.</p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <div class="flex items-center h-5">
                        <input id="update_is_environmentally_friendly" name="is_environmentally_friendly" type="checkbox" value="1"
                            x-model="msme.is_environmentally_friendly" :checked="msme.is_environmentally_friendly == 1"
                            class="w-4 h-4 rounded border-textTertiary/40 text-primary focus:ring-primary bg-tertiary">
                    </div>
                    <div class="text-sm">
                        <label for="update_is_environmentally_friendly" class="font-medium text-textPrimary">Lolos Standar Ramah Lingkungan</label>
                        <p class="text-xs text-textSecondary">Usaha mengelola limbah dengan baik dan meminimalisir plastik sekali pakai.</p>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center justify-end gap-2 pt-4 border-t border-textTertiary/20">
                <button type="button" @click="openUpdate = false" x-bind:disabled="submitting"
                    class="px-4 py-2 text-sm font-medium text-textPrimary transition-colors bg-secondary border border-textTertiary/40 rounded-lg hover:bg-tertiary focus:outline-none disabled:opacity-50 disabled:cursor-not-allowed">
                    Batal
                </button>
                <button type="submit" x-bind:disabled="submitting"
                    class="flex items-center justify-center gap-2 px-4 py-2 text-sm font-medium text-secondary transition-colors bg-primary rounded-lg shadow-sm hover:opacity-90 focus:outline-none disabled:opacity-70 disabled:cursor-not-allowed min-w-[140px]">
                    <svg x-show="submitting" x-cloak class="animate-spin w-4 h-4" viewBox="0 0 24 24" fill="none">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z">
                        </path>
                    </svg>
                    <span x-text="submitting ? 'Menyimpan...' : 'Simpan Perubahan'"></span>
                </button>
            </div>
        </form>
    </div>
</div>