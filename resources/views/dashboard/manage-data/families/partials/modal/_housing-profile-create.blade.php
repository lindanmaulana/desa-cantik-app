<div x-show="housingProfile.openCreate"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto transition-opacity duration-300 bg-textPrimary/50 backdrop-blur-sm"
    style="display: none;">

    <div class="w-full max-w-2xl overflow-hidden transition-all duration-300 transform scale-95 border shadow-xl bg-secondary border-textTertiary/30 rounded-2xl">

        <div class="flex items-center justify-between px-6 py-4 border-b border-textTertiary/20 bg-tertiary">
            <div class="flex items-center gap-2">
                <div class="p-2 text-blue-500 rounded-lg bg-blue-500/10">
                    <x-heroicon-o-home-modern class="w-5 h-5" />
                </div>
                <div>
                    <h3 class="text-lg font-bold text-textPrimary">Lengkapi Profil Rumah & Hunian</h3>
                    <p class="text-xs text-textSecondary">Tambahkan data kelayakan hunian, sanitasi, dan fasilitas dasar rumah keluarga.</p>
                </div>
            </div>
            <button @click="housingProfile.openCreate = false"
                class="p-1 transition-colors rounded-lg text-textSecondary hover:text-textPrimary hover:bg-textTertiary/20">
                <x-heroicon-o-x-mark class="w-5 h-5" />
            </button>
        </div>

        <form action="{{ route('housing-profile.store', ['family' => $family->id]) }}"
            method="POST" class="p-6 space-y-5 max-h-[75vh] overflow-y-auto">
            @csrf

            <input type="hidden" name="family_id" value="{{ $family->id }}">

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label for="create_house_condition" class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Kondisi Kelayakan Rumah <span class="text-red-500">*</span>
                    </label>
                    <select id="create_house_condition" name="house_condition" required
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        <option value="">-- Pilih Kondisi --</option>
                        <option value="proper">Layak Huni</option>
                        <option value="unfit">Tidak Layak Huni</option>
                    </select>
                </div>

                <div>
                    <label for="create_house_ownership" class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Status Kepemilikan Rumah
                    </label>
                    <select id="create_house_ownership" name="house_ownership"
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        <option value="">-- Pilih Kepemilikan --</option>
                        <option value="owned">Milik Sendiri</option>
                        <option value="rented">Sewa / Kontrak</option>
                        <option value="free_rent">Bebas Sewa (Numpang)</option>
                        <option value="official_house">Rumah Dinas</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                <div>
                    <label for="create_floor_material" class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Bahan Lantai Utama <span class="text-red-500">*</span>
                    </label>
                    <select id="create_floor_material" name="floor_material" required
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        <option value="cement_brick">Ubin Semen / Bata (Default)</option>
                        <option value="marble_granite">Marmer / Granit</option>
                        <option value="ceramic_tile">Keramik</option>
                        <option value="wood_timber">Kayu / Papan</option>
                        <option value="bamboo">Bambu</option>
                        <option value="dirt_earth">Tanah</option>
                    </select>
                </div>

                <div>
                    <label for="create_wall_material" class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Bahan Dinding Utama <span class="text-red-500">*</span>
                    </label>
                    <select id="create_wall_material" name="wall_material" required
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        <option value="mansory_brick">Bata / Plesteran (Default)</option>
                        <option value="reinforced_concrete">Beton Bertulang</option>
                        <option value="wood_plank">Papan Kayu</option>
                        <option value="bamboo_woven">Anyaman Bambu</option>
                        <option value="logs_thatch">Batang Kayu / Rumbia</option>
                    </select>
                </div>

                <div>
                    <label for="create_roof_material" class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Bahan Atap Utama <span class="text-red-500">*</span>
                    </label>
                    <select id="create_roof_material" name="roof_material" required
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        <option value="clay_tile">Genteng Tanah (Default)</option>
                        <option value="concrete_tile">Genteng Beton</option>
                        <option value="metal_sheet">Seng / Spandek</option>
                        <option value="asbestos">Asbes</option>
                        <option value="thatch_palm">Rumbia / Ijuk</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label for="create_water_source" class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Sumber Air Minum <span class="text-red-500">*</span>
                    </label>
                    <select id="create_water_source" name="water_source" required
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        <option value="protected_well">Sumur Terlindung (Default)</option>
                        <option value="piped_water">Air Pipa (PDAM)</option>
                        <option value="bore_well">Sumur Bor / Pompa</option>
                        <option value="spring_water">Mata Air</option>
                        <option value="river_rainwater">Air Sungai / Air Hujan</option>
                    </select>
                </div>

                <div>
                    <label for="create_sanitation_type" class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Fasilitas Toilet / Sanitasi <span class="text-red-500">*</span>
                    </label>
                    <select id="create_sanitation_type" name="sanitation_type" required
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        <option value="private_flush_toilet">Jamban Sendiri (Default)</option>
                        <option value="shared_flush_toilet">Jamban Bersama / MCK</option>
                        <option value="pit_latrine">Cemplung / Tradisional</option>
                        <option value="no_toilet">Tidak Ada Fasilitas</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                <div class="sm:col-span-1">
                    <label for="create_cooking_fuel" class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Bahan Bakar Memasak <span class="text-red-500">*</span>
                    </label>
                    <select id="create_cooking_fuel" name="cooking_fuel" required
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        <option value="lpg_gas">Gas LPG (Default)</option>
                        <option value="electricity">Listrik / Induksi</option>
                        <option value="biogas">Biogas</option>
                        <option value="kerosene">Minyak Tanah</option>
                        <option value="wood_charcoal">Kayu / Arang</option>
                    </select>
                </div>

                <div class="sm:col-span-1">
                    <label for="create_electricity_source" class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Sumber Penerangan <span class="text-red-500">*</span>
                    </label>
                    <select id="create_electricity_source" name="electricity_source" required
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        <option value="pln_metered">PLN (Meteran) (Default)</option>
                        <option value="pln_unmetered">PLN (Non Meteran)</option>
                        <option value="non_pln">Non-PLN (Solar/Genset)</option>
                        <option value="no_electricity">Bukan Listrik</option>
                    </select>
                </div>

                <div class="sm:col-span-1">
                    <label for="create_electricity_capacity" class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Daya Listrik <span class="text-red-500">*</span>
                    </label>
                    <select id="create_electricity_capacity" name="electricity_capacity" required
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        <option value="900va">900 VA (Default)</option>
                        <option value="450va">450 VA</option>
                        <option value="1300va">1300 VA</option>
                        <option value="2200va">2200 VA</option>
                        <option value="above_2200va">Di atas 2200 VA</option>
                        <option value="non_electricity">Tanpa Listrik</option>
                    </select>
                </div>
            </div>

            <div class="flex items-center justify-end gap-2 pt-4 border-t border-textTertiary/20">
                <button type="button" @click="housingProfile.openCreate = false"
                    class="px-4 py-2 text-sm font-medium transition-colors border rounded-lg text-textPrimary bg-secondary border-textTertiary/40 hover:bg-tertiary focus:outline-none">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium transition-colors bg-blue-600 rounded-lg shadow-sm text-secondary hover:opacity-90 focus:outline-none">
                    Simpan Data Hunian
                </button>
            </div>
        </form>
    </div>
</div>
