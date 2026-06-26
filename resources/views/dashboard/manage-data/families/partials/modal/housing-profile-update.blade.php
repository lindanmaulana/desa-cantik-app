<div x-show="housingProfile.openUpdate"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto transition-opacity duration-300 bg-textPrimary/50 backdrop-blur-sm"
    style="display: none;">

    <div class="w-full max-w-xl overflow-hidden transition-all duration-300 transform scale-95 border shadow-xl bg-secondary border-textTertiary/30 rounded-2xl">

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

        <form :action="`/housing-profile/${family.id}/${housingProfile.data.id}/update`"
            method="POST"
            class="p-6 space-y-5 max-h-[75vh] overflow-y-auto">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label for="update_floor_area_per_capita" class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Luas Lantai Per Kapita <span class="text-red-500">*</span>
                    </label>
                    <select id="update_floor_area_per_capita" name="floor_area_per_capita" required
                        x-model="housingProfile.data.floor_area_per_capita"
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        <option value="" class="bg-secondary">-- Pilih Luas Lantai --</option>
                        <option value="less_than_8_sqm" class="bg-secondary">&lt; 8 m² (Kurang Layak)</option>
                        <option value="greater_equal_8_sqm" class="bg-secondary">≥ 8 m² (Layak)</option>
                    </select>
                </div>

                <div>
                    <label for="update_floor_material" class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Bahan Lantai Utama <span class="text-red-500">*</span>
                    </label>
                    <select id="update_floor_material" name="floor_material" required
                        x-model="housingProfile.data.floor_material"
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        <option value="" class="bg-secondary">-- Pilih Jenis Lantai --</option>
                        <option value="high_quality_floor" class="bg-secondary">Ubin / Keramik / Marmer</option>
                        <option value="low_quality_floor" class="bg-secondary">Semen / Kayu Kualitas Rendah</option>
                        <option value="dirt_bamboo" class="bg-secondary">Tanah / Bambu</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label for="update_wall_material" class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Bahan Dinding Utama <span class="text-red-500">*</span>
                    </label>
                    <select id="update_wall_material" name="wall_material" required
                        x-model="housingProfile.data.wall_material"
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        <option value="" class="bg-secondary">-- Pilih Jenis Dinding --</option>
                        <option value="masonry_high_quality" class="bg-secondary">Tembok Beton / Bata Plester</option>
                        <option value="wood_low_quality" class="bg-secondary">Kayu / GRC / Tembok Tanpa Plester</option>
                        <option value="bamboo_thatch" class="bg-secondary">Anyaman Bambu / Rumbia / Ketek</option>
                    </select>
                </div>

                <div>
                    <label for="update_water_source" class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Sumber Air Minum Utamanya <span class="text-red-500">*</span>
                    </label>
                    <select id="update_water_source" name="water_source" required
                        x-model="housingProfile.data.water_source"
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        <option value="" class="bg-secondary">-- Pilih Sumber Air --</option>
                        <option value="bottled_refill" class="bg-secondary">Air Kemasan / Isi Ulang Bermerk</option>
                        <option value="piped_pdam" class="bg-secondary">Pipa Ledeng (PDAM)</option>
                        <option value="protected_well" class="bg-secondary">Sumur Terlindung / Pompa</option>
                        <option value="unprotected_well" class="bg-secondary">Sumur Tak Terlindung / Mata Air Terbuka</option>
                        <option value="spring_water" class="bg-secondary">Mata Air Alami</option>
                        <option value="river_rainwater" class="bg-secondary">Air Sungai / Air Hujan</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label for="update_sanitation_type" class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Fasilitas Sanitasi / Toilet <span class="text-red-500">*</span>
                    </label>
                    <select id="update_sanitation_type" name="sanitation_type" required
                        x-model="housingProfile.data.sanitation_type"
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        <option value="" class="bg-secondary">-- Pilih Sanitasi --</option>
                        <option value="private_flush_toilet" class="bg-secondary">Jamban Sendiri (Leher Angsa + Tangki Septik)</option>
                        <option value="shared_flush_toilet" class="bg-secondary">Jamban Bersama / MCK Umum Layak</option>
                        <option value="pit_latrine" class="bg-secondary">Cemplung / Cubluk / Jamban Tanpa Tangki</option>
                        <option value="no_toilet" class="bg-secondary">Tidak Ada Fasilitas (Sungai / Kebun)</option>
                    </select>
                </div>

                <div>
                    <label for="update_cooking_fuel" class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Bahan Bakar Utama Memasak <span class="text-red-500">*</span>
                    </label>
                    <select id="update_cooking_fuel" name="cooking_fuel" required
                        x-model="housingProfile.data.cooking_fuel"
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        <option value="" class="bg-secondary">-- Pilih Bahan Bakar --</option>
                        <option value="electricity" class="bg-secondary">Listrik / Kompor Induksi</option>
                        <option value="lpg_gas" class="bg-secondary">Gas LPG (3kg / 12kg) / CNG</option>
                        <option value="biogas" class="bg-secondary">Biogas</option>
                        <option value="kerosene" class="bg-secondary">Minyak Tanah</option>
                        <option value="wood_charcoal" class="bg-secondary">Kayu Bakar / Arang Tradisional</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label for="update_electricity_source" class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Sumber Penerangan Utama <span class="text-red-500">*</span>
                    </label>
                    <select id="update_electricity_source" name="electricity_source" required
                        x-model="housingProfile.data.electricity_source"
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        <option value="" class="bg-secondary">-- Pilih Sumber Listrik --</option>
                        <option value="pln_metered" class="bg-secondary">Listrik PLN Dengan Meteran</option>
                        <option value="pln_unmetered" class="bg-secondary">Listrik PLN Tanpa Meteran / Numpang</option>
                        <option value="non_pln" class="bg-secondary">Listrik Non-PLN (Genset / Panel Surya Mandiri)</option>
                        <option value="no_electricity" class="bg-secondary">Bukan Listrik (Lampu Teplok / Lilin)</option>
                    </select>
                </div>

                <div>
                    <label for="update_electricity_capacity" class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">
                        Daya Listrik Rumah Tangga <span class="text-red-500">*</span>
                    </label>
                    <select id="update_electricity_capacity" name="electricity_capacity" required
                        x-model="housingProfile.data.electricity_capacity"
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        <option value="" class="bg-secondary">-- Pilih Kapasitas Daya --</option>
                        <option value="450va" class="bg-secondary">450 VA</option>
                        <option value="900va" class="bg-secondary">900 VA</option>
                        <option value="1300va" class="bg-secondary">1300 VA</option>
                        <option value="2200va" class="bg-secondary">2200 VA</option>
                        <option value="above_2200va" class="bg-secondary">Di atas 2200 VA</option>
                        <option value="non_electricity" class="bg-secondary">Tanpa Instalasi Listrik</option>
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
