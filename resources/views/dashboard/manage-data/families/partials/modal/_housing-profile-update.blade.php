<div x-show="housingProfile.openUpdate"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto transition-opacity duration-300 bg-textPrimary/50 backdrop-blur-sm"
    style="display: none;">

    <div class="w-full max-w-2xl overflow-hidden transition-all duration-300 transform scale-95 border shadow-xl bg-secondary border-textTertiary/30 rounded-2xl">

        <div class="flex items-center justify-between px-6 py-4 border-b border-textTertiary/20 bg-tertiary">
            <div class="flex items-center gap-2">
                <div class="p-2 rounded-lg text-amber-500 bg-amber-500/10">
                    <x-heroicon-o-pencil-square class="w-5 h-5" />
                </div>
                <div>
                    <h3 class="text-lg font-bold text-textPrimary">Ubah Profil Rumah & Hunian</h3>
                    <p class="text-xs text-textSecondary">Perbarui data kelayakan hunian, sanitasi, dan fasilitas dasar rumah keluarga.</p>
                </div>
            </div>
            <button @click="housingProfile.openUpdate = false"
                class="p-1 transition-colors rounded-lg text-textSecondary hover:text-textPrimary hover:bg-textTertiary/20">
                <x-heroicon-o-x-mark class="w-5 h-5" />
            </button>
        </div>

        <form :action="`{{ route('housing-profile.update', ['family' => ':familyId']) }}`.replace(':familyId', housingProfile.data.family_id)"
            method="POST" class="p-6 space-y-5 max-h-[75vh] overflow-y-auto">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label for="update_house_condition" class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Kondisi Kelayakan Rumah <span class="text-red-500">*</span>
                    </label>
                    <select id="update_house_condition" name="house_condition" required
                        x-model="housingProfile.data.house_condition"
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        <option value="" class="bg-secondary">-- Pilih Kondisi --</option>
                        <option value="proper" class="bg-secondary">Layak Huni</option>
                        <option value="unfit" class="bg-secondary">Tidak Layak Huni</option>
                    </select>
                </div>

                <div>
                    <label for="update_house_ownership" class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Status Kepemilikan Rumah
                    </label>
                    <select id="update_house_ownership" name="house_ownership"
                        x-model="housingProfile.data.house_ownership"
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        <option value="" class="bg-secondary">-- Pilih Kepemilikan --</option>
                        <option value="owned" class="bg-secondary">Milik Sendiri</option>
                        <option value="rented" class="bg-secondary">Sewa / Kontrak</option>
                        <option value="free_rent" class="bg-secondary">Bebas Sewa (Numpang)</option>
                        <option value="official_house" class="bg-secondary">Rumah Dinas</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                <div>
                    <label for="update_floor_material" class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Bahan Lantai Utama <span class="text-red-500">*</span>
                    </label>
                    <select id="update_floor_material" name="floor_material" required
                        x-model="housingProfile.data.floor_material"
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        <option value="" class="bg-secondary">-- Pilih Lantai --</option>
                        <option value="marble_granite" class="bg-secondary">Marmer / Granit</option>
                        <option value="ceramic_tile" class="bg-secondary">Keramik</option>
                        <option value="cement_brick" class="bg-secondary">Ubin Semen / Bata</option>
                        <option value="wood_timber" class="bg-secondary">Kayu / Papan</option>
                        <option value="bamboo" class="bg-secondary">Bambu</option>
                        <option value="dirt_earth" class="bg-secondary">Tanah</option>
                    </select>
                </div>

                <div>
                    <label for="update_wall_material" class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Bahan Dinding Utama <span class="text-red-500">*</span>
                    </label>
                    <select id="update_wall_material" name="wall_material" required
                        x-model="housingProfile.data.wall_material"
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        <option value="" class="bg-secondary">-- Pilih Dinding --</option>
                        <option value="mansory_brick" class="bg-secondary">Bata / Plesteran</option>
                        <option value="reinforced_concrete" class="bg-secondary">Beton Bertulang</option>
                        <option value="wood_plank" class="bg-secondary">Papan Kayu</option>
                        <option value="bamboo_woven" class="bg-secondary">Anyaman Bambu</option>
                        <option value="logs_thatch" class="bg-secondary">Batang Kayu / Rumbia</option>
                    </select>
                </div>

                <div>
                    <label for="update_roof_material" class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Bahan Atap Utama <span class="text-red-500">*</span>
                    </label>
                    <select id="update_roof_material" name="roof_material" required
                        x-model="housingProfile.data.roof_material"
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        <option value="" class="bg-secondary">-- Pilih Atap --</option>
                        <option value="concrete_tile" class="bg-secondary">Genteng Beton</option>
                        <option value="clay_tile" class="bg-secondary">Genteng Tanah</option>
                        <option value="metal_sheet" class="bg-secondary">Seng / Spandek</option>
                        <option value="asbestos" class="bg-secondary">Asbes</option>
                        <option value="thatch_palm" class="bg-secondary">Rumbia / Ijuk</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label for="update_water_source" class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Sumber Air Minum <span class="text-red-500">*</span>
                    </label>
                    <select id="update_water_source" name="water_source" required
                        x-model="housingProfile.data.water_source"
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        <option value="" class="bg-secondary">-- Pilih Sumber Air --</option>
                        <option value="piped_water" class="bg-secondary">Air Pipa (PDAM)</option>
                        <option value="protected_well" class="bg-secondary">Sumur Terlindung</option>
                        <option value="bore_well" class="bg-secondary">Sumur Bor / Pompa</option>
                        <option value="spring_water" class="bg-secondary">Mata Air</option>
                        <option value="river_rainwater" class="bg-secondary">Air Sungai / Air Hujan</option>
                    </select>
                </div>

                <div>
                    <label for="update_sanitation_type" class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Fasilitas Toilet / Sanitasi <span class="text-red-500">*</span>
                    </label>
                    <select id="update_sanitation_type" name="sanitation_type" required
                        x-model="housingProfile.data.sanitation_type"
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        <option value="" class="bg-secondary">-- Pilih Sanitasi --</option>
                        <option value="private_flush_toilet" class="bg-secondary">Jamban Sendiri</option>
                        <option value="shared_flush_toilet" class="bg-secondary">Jamban Bersama / MCK</option>
                        <option value="pit_latrine" class="bg-secondary">Cemplung / Tradisional</option>
                        <option value="no_toilet" class="bg-secondary">Tidak Ada Fasilitas</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                <div class="sm:col-span-1">
                    <label for="update_cooking_fuel" class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Bahan Bakar Memasak <span class="text-red-500">*</span>
                    </label>
                    <select id="update_cooking_fuel" name="cooking_fuel" required
                        x-model="housingProfile.data.cooking_fuel"
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        <option value="" class="bg-secondary">-- Pilih Bahan Bakar --</option>
                        <option value="electricity" class="bg-secondary">Listrik / Induksi</option>
                        <option value="lpg_gas" class="bg-secondary">Gas LPG</option>
                        <option value="biogas" class="bg-secondary">Biogas</option>
                        <option value="kerosene" class="bg-secondary">Minyak Tanah</option>
                        <option value="wood_charcoal" class="bg-secondary">Kayu / Arang</option>
                    </select>
                </div>

                <div class="sm:col-span-1">
                    <label for="update_electricity_source" class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Sumber Penerangan <span class="text-red-500">*</span>
                    </label>
                    <select id="update_electricity_source" name="electricity_source" required
                        x-model="housingProfile.data.electricity_source"
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        <option value="" class="bg-secondary">-- Pilih Sumber Listrik --</option>
                        <option value="pln_metered" class="bg-secondary">PLN (Meteran)</option>
                        <option value="pln_unmetered" class="bg-secondary">PLN (Non Meteran)</option>
                        <option value="non_pln" class="bg-secondary">Non-PLN (Solar/Genset)</option>
                        <option value="no_electricity" class="bg-secondary">Bukan Listrik</option>
                    </select>
                </div>

                <div class="sm:col-span-1">
                    <label for="update_electricity_capacity" class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Daya Listrik <span class="text-red-500">*</span>
                    </label>
                    <select id="update_electricity_capacity" name="electricity_capacity" required
                        x-model="housingProfile.data.electricity_capacity"
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        <option value="" class="bg-secondary">-- Pilih Daya --</option>
                        <option value="450va" class="bg-secondary">450 VA</option>
                        <option value="900va" class="bg-secondary">900 VA</option>
                        <option value="1300va" class="bg-secondary">1300 VA</option>
                        <option value="2200va" class="bg-secondary">2200 VA</option>
                        <option value="above_2200va" class="bg-secondary">Di atas 2200 VA</option>
                        <option value="non_electricity" class="bg-secondary">Tanpa Listrik</option>
                    </select>
                </div>
            </div>

            <div class="flex items-start gap-2 p-3 text-xs border rounded-lg bg-blue-500/10 border-blue-500/20 text-textPrimary">
                <x-heroicon-o-information-circle class="w-5 h-5 text-blue-500 shrink-0 mt-0.5" />
                <p class="text-textSecondary">Melakukan perubahan data akan memperbarui metadata <code class="text-xs bg-tertiary px-1 py-0.5 rounded">updated_at</code> profil hunian keluarga ini secara real-time pada sistem database.</p>
            </div>

            <div class="flex items-center justify-end gap-2 pt-4 border-t border-textTertiary/20">
                <button type="button" @click="housingProfile.openUpdate = false"
                    class="px-4 py-2 text-sm font-medium transition-colors border rounded-lg text-textPrimary bg-secondary border-textTertiary/40 hover:bg-tertiary focus:outline-none">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium transition-colors rounded-lg shadow-sm text-secondary bg-amber-500 hover:opacity-90 focus:outline-none">
                    Perbarui Profil Rumah
                </button>
            </div>
        </form>
    </div>
</div>