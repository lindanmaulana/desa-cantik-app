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
        Lengkapi Profil Rumah Tanggal
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
            <dt class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Luas Lantai per Kapita</dt>
            <dd class="mt-2 text-sm font-semibold text-slate-800">
                @if($family->housingProfile->floor_area_per_capita === 'greater_equal_8_sqm')
                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> ≥ 8 m² (Layak)
                </span>
                @else
                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-rose-50 text-rose-700 border border-rose-200">
                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                    < 8 m² (Tidak Layak)
                        </span>
                        @endif
            </dd>
        </div>

        <div class="p-4 bg-white border shadow-sm rounded-xl border-slate-200">
            <dt class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Bahan Lantai Utama</dt>
            <dd class="mt-2 text-sm font-semibold text-slate-800">
                @if($family->housingProfile->floor_material === 'high_quality_floor')
                Ubin / Keramik / Marmer
                @elseif($family->housingProfile->floor_material === 'low_quality_floor')
                Semen / Kayu Sederhana
                @else
                <span class="font-medium text-rose-600">Tanah / Bambu</span>
                @endif
            </dd>
        </div>

        <div class="p-4 bg-white border shadow-sm rounded-xl border-slate-200">
            <dt class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Bahan Dinding Utama</dt>
            <dd class="mt-2 text-sm font-semibold text-slate-800">
                @if($family->housingProfile->wall_material === 'masonry_high_quality')
                Tembok Beton / Plesteran
                @elseif($family->housingProfile->wall_material === 'wood_low_quality')
                Kayu / GRC / Tanpa Plester
                @else
                <span class="font-medium text-rose-600">Anyaman Bambu / Rumbia</span>
                @endif
            </dd>
        </div>

        <div class="p-4 bg-white border shadow-sm rounded-xl border-slate-200">
            <dt class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Bahan Bakar Memasak</dt>
            <dd class="mt-2 text-sm font-semibold text-slate-800">
                @if($family->housingProfile->cooking_fuel === 'electricity')
                Listrik / Kompor Induksi
                @elseif($family->housingProfile->cooking_fuel === 'lpg_gas')
                Gas LPG (3kg / 12kg)
                @elseif($family->housingProfile->cooking_fuel === 'biogas')
                Biogas Alam
                @elseif($family->housingProfile->cooking_fuel === 'kerosene')
                Minyak Tanah
                @else
                <span class="font-medium text-amber-700">Kayu Bakar / Arang</span>
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
                    @if($family->housingProfile->water_source === 'bottled_refill')
                    Air Kemasan / Isi Ulang
                    @elseif($family->housingProfile->water_source === 'piped_pdam')
                    Air Pipa Ledeng (PDAM)
                    @elseif($family->housingProfile->water_source === 'protected_well')
                    Sumur Pompa / Terlindung
                    @elseif($family->housingProfile->water_source === 'unprotected_well')
                    <span class="font-medium text-rose-600">Sumur Tidak Terlindung</span>
                    @elseif($family->housingProfile->water_source === 'spring_water')
                    Mata Air Alami
                    @else
                    <span class="font-medium text-rose-600">Air Sungai / Air Hujan</span>
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
                    @if($family->housingProfile->sanitation_type === 'private_flush_toilet')
                    <span class="font-semibold text-emerald-700">Jamban Sendiri (Sptic Tank)</span>
                    @elseif($family->housingProfile->sanitation_type === 'shared_flush_toilet')
                    Jamban Bersama / MCK Umum
                    @elseif($family->housingProfile->sanitation_type === 'pit_latrine')
                    <span class="font-medium text-amber-700">Cemplung / Tradisional</span>
                    @else
                    <span class="font-medium text-rose-600">Tidak Ada (Mandi di Sungai/Kebun)</span>
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
                    @if($family->housingProfile->electricity_source === 'pln_metered')
                    PLN (Meteran Mandiri)
                    @elseif($family->housingProfile->electricity_source === 'pln_unmetered')
                    PLN (Non-Meteran / Sosial)
                    @elseif($family->housingProfile->electricity_source === 'non_pln')
                    Non-PLN (Genset / Solar)
                    @else
                    <span class="font-medium text-rose-600">Bukan Listrik (Lilin/Teplok)</span>
                    @endif
                    <span class="block mt-1 text-xs font-medium text-slate-500">
                        Kapasitas Beban: <span class="font-semibold text-slate-700">{{ strtoupper($family->housingProfile?->electricity_capacity?->value ?? '0 VA') }}</span>
                    </span>
                </dd>
            </div>
        </div>
    </div>
</div>
@endif
