@if (!$family->housingProfile)
<div class="flex flex-col items-center justify-center p-10 text-center border border-dashed bg-slate-50/50 rounded-xl border-slate-300">
    <div class="p-3.5 mb-4 text-slate-500 rounded-xl bg-slate-100 border border-slate-200 shadow-sm">
        <x-heroicon-o-home-modern class="w-7 h-7" />
    </div>
    <h5 class="text-base font-bold text-slate-800">Profil Rumah & Sanitasi Belum Tersedia</h5>
    <p class="max-w-md mt-1.5 text-xs leading-relaxed text-slate-500">
        Keluarga ini belum memiliki catatan indikator kelayakan hunian, sumber air bersih, jenis toilet, maupun fasilitas energi listrik dasar.
    </p>
    <button type="button" @click="housingProfile.openCreate = true"
        class="inline-flex items-center gap-2 px-4 py-2 mt-5 text-xs font-semibold text-white transition-colors bg-blue-600 rounded-lg shadow-sm hover:bg-blue-700">
        <x-heroicon-o-plus class="w-4 h-4" />
        Lengkapi Profil Rumah Tangga
    </button>
</div>
@else
<div class="space-y-6">
    <div class="flex items-center justify-between pb-6 border-b border-slate-200">
        <div class="flex items-center gap-2 text-slate-500">
            <x-heroicon-o-clock class="w-4 h-4" />
            <span class="text-xs font-medium">Terakhir Diperbarui:</span>
            <span class="text-xs font-semibold text-slate-700">
                {{ $family->housingProfile->updated_at ? $family->housingProfile->updated_at->translatedFormat('d F Y, H:i') . ' WIB' : '-' }}
            </span>
        </div>
        <button type="button"
            @click="housingProfile.openModal($event)"
            data-profile="{{ json_encode($family->housingProfile) }}"
            class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-slate-700 bg-white border border-slate-300 rounded-lg shadow-sm hover:bg-slate-50 transition-colors">
            <x-heroicon-o-pencil-square class="w-3.5 h-3.5 text-slate-500" />
            Ubah Data
        </button>
    </div>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

        <div class="flex flex-col justify-between p-4 bg-white border shadow-sm rounded-xl border-slate-200">
            <dt class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Kondisi & Kepemilikan</dt>
            <dd class="mt-2 space-y-1 text-sm font-semibold text-slate-800">
                <div>
                    @if($family->housingProfile->house_condition == $houseCondition::PROPER)
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Rumah Layak
                    </span>
                    @else
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-rose-50 text-rose-700 border border-rose-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Rumah Tidak Layak
                    </span>
                    @endif
                </div>
                <div class="text-xs font-medium text-slate-500">
                    Status:
                    @if($family->housingProfile->house_ownership == $houseOwnership::OWNED->value) Milik Sendiri
                    @elseif($family->housingProfile->house_ownership == $houseOwnership::RENTED->value) Sewa/Kontrak
                    @elseif($family->housingProfile->house_ownership == $houseOwnership::FREE_RENT->value) Bebas Sewa
                    @elseif($family->housingProfile->house_ownership == $houseOwnership::OFFICIAL_HOUSE->value) Dinas
                    @else -
                    @endif
                </div>
            </dd>
        </div>

        <div class="p-4 bg-white border shadow-sm rounded-xl border-slate-200">
            <dt class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Bahan Lantai Utama</dt>
            <dd class="mt-2 text-sm font-semibold text-slate-800">
                @if(in_array($family->housingProfile->floor_material, [$floorMaterial::MARBLE_GRANITE, $floorMaterial::CERAMIC_TILE]))
                Marmer / Granit / Keramik
                @elseif($family->housingProfile->floor_material == $floorMaterial::CEMENT_BRICK)
                Ubin Semen / Bata Merah
                @elseif($family->housingProfile->floor_material == $floorMaterial::WOOD_TIMBER)
                Kayu / Papan
                @else
                <span class="font-medium text-rose-600">Bambu / Tanah</span>
                @endif
            </dd>
        </div>

        <div class="p-4 bg-white border shadow-sm rounded-xl border-slate-200">
            <dt class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Bahan Dinding & Atap</dt>
            <dd class="mt-2 space-y-1 text-sm font-semibold text-slate-800">
                <div class="text-xs text-slate-500">
                    Dinding:
                    <span class="font-semibold text-slate-800">
                        @if(in_array($family->housingProfile->wall_material, [$wallMaterial::MASONRY_BRICK, $wallMaterial::REINFORCED_CONCRETE]))
                        Tembok/Beton
                        @elseif($family->housingProfile->wall_material == $wallMaterial::WOOD_PLANK)
                        Kayu/Papan
                        @else
                        <span class="text-rose-600">Bambu/Rumbia</span>
                        @endif
                    </span>
                </div>
                <div class="text-xs text-slate-500">
                    Atap:
                    <span class="font-semibold text-slate-800">
                        @if($family->housingProfile->roof_material == $roofMaterial::CONCRETE_TILE) Genteng Beton
                        @elseif($family->housingProfile->roof_material == $roofMaterial::CLAY_TILE) Genteng Tanah
                        @elseif($family->housingProfile->roof_material == $roofMaterial::METAL_SHEET) Seng/Spandek
                        @elseif($family->housingProfile->roof_material == $roofMaterial::ASBESTOS) Asbes
                        @else <span class="text-amber-700">Rumbia/Ijuk</span>
                        @endif
                    </span>
                </div>
            </dd>
        </div>

        <div class="p-4 bg-white border shadow-sm rounded-xl border-slate-200">
            <dt class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Bahan Bakar Memasak</dt>
            <dd class="mt-2 text-sm font-semibold text-slate-800">
                @if($family->housingProfile->cooking_fuel == $cookingFuel::ELECTRICITY)
                Listrik / Induksi
                @elseif($family->housingProfile->cooking_fuel == $cookingFuel::LPG_GAS)
                Gas LPG
                @elseif($family->housingProfile->cooking_fuel == $cookingFuel::BIOGAS)
                Biogas
                @elseif($family->housingProfile->cooking_fuel == $cookingFuel::KEROSENE)
                Minyak Tanah
                @else
                <span class="font-medium text-amber-700">Kayu / Arang</span>
                @endif
            </dd>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

        <div class="flex items-start gap-4 p-4 bg-white border shadow-sm rounded-xl border-slate-200">
            <div class="p-2.5 text-blue-600 bg-blue-50 border border-blue-100 rounded-lg shrink-0">
                <x-heroicon-o-beaker class="w-5 h-5" />
            </div>
            <div class="space-y-0.5">
                <dt class="text-[10px] font-bold tracking-wider uppercase text-slate-400">Sumber Air Minum</dt>
                <dd class="text-sm font-semibold text-slate-800">
                    @if($family->housingProfile->water_source == $waterSource::PIPED_WATER)
                    Air Pipa (PDAM)
                    @elseif($family->housingProfile->water_source == $waterSource::PROTECTED_WELL)
                    Sumur Terlindung
                    @elseif($family->housingProfile->water_source == $waterSource::BORE_WELL)
                    Sumur Bor
                    @elseif($family->housingProfile->water_source == $waterSource::SPRING_WATER)
                    Mata Air
                    @else
                    <span class="font-medium text-rose-600">Air Sungai / Hujan</span>
                    @endif
                </dd>
            </div>
        </div>

        <div class="flex items-start gap-4 p-4 bg-white border shadow-sm rounded-xl border-slate-200">
            <div class="p-2.5 text-emerald-600 bg-emerald-50 border border-emerald-100 rounded-lg shrink-0">
                <x-heroicon-o-variable class="w-5 h-5" />
            </div>
            <div class="space-y-0.5">
                <dt class="text-[10px] font-bold tracking-wider uppercase text-slate-400">Fasilitas Sanitasi</dt>
                <dd class="text-sm font-semibold text-slate-800">
                    @if($family->housingProfile->sanitation_type == $sanitationType::PRIVATE_FLUSH_TOILET)
                    <span class="font-semibold text-emerald-700">Jamban Sendiri</span>
                    @elseif($family->housingProfile->sanitation_type == $sanitationType::SHARED_FLUSH_TOILET)
                    Jamban Bersama / MCK
                    @elseif($family->housingProfile->sanitation_type == $sanitationType::PIT_LATRINE)
                    <span class="font-medium text-amber-700">Jamban Cemplung</span>
                    @else
                    <span class="font-medium text-rose-600">Tidak Ada Fasilitas</span>
                    @endif
                </dd>
            </div>
        </div>

        <div class="flex items-start gap-4 p-4 bg-white border shadow-sm rounded-xl border-slate-200">
            <div class="p-2.5 text-amber-600 bg-amber-50 border border-amber-100 rounded-lg shrink-0">
                <x-heroicon-o-bolt class="w-5 h-5" />
            </div>
            <div class="space-y-0.5">
                <dt class="text-[10px] font-bold tracking-wider uppercase text-slate-400">Daya & Sumber Energi</dt>
                <dd class="text-sm font-semibold text-slate-800">
                    @if($family->housingProfile->electricity_source == $electricitySource::PLN_METERED)
                    PLN (Meteran)
                    @elseif($family->housingProfile->electricity_source == $electricitySource::PLN_UNMETERED)
                    PLN (Non-Meteran)
                    @elseif($family->housingProfile->electricity_source == $electricitySource::NON_PLN)
                    Non-PLN
                    @else
                    <span class="font-medium text-rose-600">Bukan Listrik</span>
                    @endif

                    <span class="block mt-1 text-xs font-medium text-slate-500">
                        Kapasitas Beban:
                        <span class="font-semibold text-slate-700">
                            {{ is_object($family->housingProfile->electricity_capacity) ? strtoupper($family->housingProfile->electricity_capacity->value) : strtoupper($family->housingProfile->electricity_capacity) }}
                        </span>
                    </span>
                </dd>
            </div>
        </div>
    </div>
</div>
@endif
