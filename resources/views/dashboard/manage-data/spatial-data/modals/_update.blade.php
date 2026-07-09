{{-- <div x-show="openUpdate" class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto transition-opacity duration-300 bg-gray-900 bg-opacity-50 backdrop-blur-sm">

    <div class="w-full max-w-2xl overflow-hidden transition-all duration-300 transform scale-95 bg-white border border-gray-100 shadow-xl rounded-2xl">

        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gray-50">
            <div class="flex items-center gap-2">
                <div class="p-2 rounded-lg text-emerald-600 bg-emerald-50">
                    <x-heroicon-o-pencil-square class="w-5 h-5" />
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Perbarui Koordinat GIS Desa</h3>
                    <p class="text-xs text-gray-500">Perbarui posisi garis lintang/bujur atau geometri poligon.</p>
                </div>
            </div>
            <button @click="openUpdate = false" class="p-1 text-gray-400 transition-colors rounded-lg hover:text-gray-600 hover:bg-gray-100">
                <x-heroicon-o-x-mark class="w-5 h-5" />
            </button>
        </div>

        <form :action="`/dashboard/manage-data/spatial-data/${spatial.id}/update`" method="POST" class="p-6 space-y-4 max-h-[75vh] overflow-y-auto">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label for="update_feature_type" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Jenis Objek Spasial <span class="text-red-500">*</span></label>
                    <select id="update_feature_type" name="feature_type" required x-model="spatial.feature_type"
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                        <option value="">-- Pilih Jenis Objek --</option>
                        @foreach($featureType::cases() as $val )
                            <option value="{{ $val->value }}">{{ $val->label() }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Pilih Objek Terkait <span class="text-red-500">*</span></label>

                    <!-- If type is resident_house -->
                    <div x-show="spatial.feature_type === 'resident_house'">
                        <select name="feature_id" :required="spatial.feature_type === 'resident_house'" x-model="spatial.feature_id"
                            class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                            <option value="">-- Pilih Penduduk / Rumah --</option>
                            @foreach($citizens as $c)
                                <option value="{{ $c->id }}">{{ $c->name }} (NIK: {{ $c->id_number }})</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- If type is public_facility -->
                    <div x-show="spatial.feature_type === 'public_facility'">
                        <select name="feature_id" :required="spatial.feature_type === 'public_facility'" x-model="spatial.feature_id"
                            class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                            <option value="">-- Pilih Sarana / Fasilitas --</option>
                            @foreach($infrastructures as $inf)
                                <option value="{{ $inf->id }}">{{ $inf->facility_name }} ({{ $inf->facility_type->value }})</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- If type is msme_location -->
                    <div x-show="spatial.feature_type === 'msme_location'">
                        <select name="feature_id" :required="spatial.feature_type === 'msme_location'" x-model="spatial.feature_id"
                            class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                            <option value="">-- Pilih Unit Usaha UMKM --</option>
                            @foreach($msmes as $m)
                                <option value="{{ $m->id }}">{{ $m->name }} (Pemilik: {{ $m->citizen->name ?? 'Belum tercatat' }})</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- If type is village_boundary -->
                    <div x-show="spatial.feature_type === 'village_boundary'">
                        <input type="text" readonly name="feature_id" x-model="spatial.feature_id"
                            class="w-full px-3 py-2 text-sm text-gray-500 bg-gray-100 border border-gray-200 rounded-lg focus:outline-none">
                        <p class="mt-1 text-[10px] text-gray-400">Batas wilayah merupakan entitas spasial global desa dan menggunakan ID global khusus.</p>
                    </div>

                    <!-- If empty/no selection -->
                    <div x-show="!spatial.feature_type">
                        <select disabled class="w-full px-3 py-2 text-sm text-gray-400 bg-gray-100 border border-gray-200 rounded-lg">
                            <option value="">-- Silakan Pilih Jenis Terlebih Dahulu --</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label for="update_latitude" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Garis Lintang (Latitude) <span class="text-red-500">*</span></label>
                    <input type="number" step="any" min="-90" max="90" id="update_latitude" name="latitude" required x-model="spatial.latitude" placeholder="Contoh: -6.12345678"
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                </div>

                <div>
                    <label for="update_longitude" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Garis Bujur (Longitude) <span class="text-red-500">*</span></label>
                    <input type="number" step="any" min="-180" max="180" id="update_longitude" name="longitude" required x-model="spatial.longitude" placeholder="Contoh: 106.12345678"
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                </div>
            </div>

            <div>
                <label for="update_geojson" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Data Spasial Tambahan (GeoJSON)</label>
                <textarea id="update_geojson" name="geojson" rows="4" x-model="spatial.geojson" placeholder='Contoh: { "type": "Point", "coordinates": [106.12, -6.12] }'
                    class="w-full px-3 py-2 font-mono text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500"></textarea>
                <p class="mt-1 text-[10px] text-gray-400">Optional: Masukkan data koordinat poligon batas wilayah atau geometri GeoJSON dalam format teks JSON murni.</p>
            </div>

            <div class="flex items-center justify-end gap-2 pt-4 border-t border-gray-100">
                <button type="button" @click="openUpdate = false" class="px-4 py-2 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-200 rounded-lg hover:bg-gray-50 focus:outline-none">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white transition-colors rounded-lg shadow-sm bg-emerald-600 hover:bg-emerald-700 focus:outline-none">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div> --}}

<div x-show="openUpdate" class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto transition-opacity duration-300 bg-textPrimary/50 backdrop-blur-sm">

    <div class="w-full max-w-2xl overflow-hidden transition-all duration-300 transform scale-95 bg-secondary border border-textTertiary/30 shadow-xl rounded-2xl">

        <div class="flex items-center justify-between px-6 py-4 border-b border-textTertiary/30 bg-tertiary">
            <div class="flex items-center gap-2">
                <div class="p-2 rounded-lg text-primary bg-primary/10">
                    <x-heroicon-o-pencil-square class="w-5 h-5" />
                </div>
                <div>
                    <h3 class="text-lg font-bold text-textPrimary">Perbarui Koordinat GIS Desa</h3>
                    <p class="text-xs text-textSecondary">Perbarui posisi garis lintang/bujur atau geometri poligon.</p>
                </div>
            </div>
            <button @click="openUpdate = false" class="p-1 text-textSecondary transition-colors rounded-lg hover:text-textPrimary hover:bg-textTertiary/20">
                <x-heroicon-o-x-mark class="w-5 h-5" />
            </button>
        </div>

        <form :action="`/dashboard/manage-data/spatial-data/${spatial.id}/update`" method="POST" 
            class="p-6 space-y-4 max-h-[75vh] overflow-y-auto" 
            x-data="{ submitting: false }" 
            @submit="submitting = true">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label for="update_feature_type" class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Jenis Objek Spasial <span class="text-red-500">*</span></label>
                    <select id="update_feature_type" name="feature_type" required x-model="spatial.feature_type"
                        class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        <option value="" class="bg-secondary">-- Pilih Jenis Objek --</option>
                        @foreach($featureType::cases() as $val)
                            <option value="{{ $val->value }}" class="bg-secondary">{{ $val->label() }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Pilih Objek Terkait <span class="text-red-500">*</span></label>

                    <div x-show="spatial.feature_type === 'resident_house'">
                        <select name="feature_id" :required="spatial.feature_type === 'resident_house'" x-model="spatial.feature_id"
                            class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                            <option value="" class="bg-secondary">-- Pilih Penduduk / Rumah --</option>
                            @foreach($citizens as $c)
                                <option value="{{ $c->id }}" class="bg-secondary">{{ $c->name }} (NIK: {{ $c->id_number }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div x-show="spatial.feature_type === 'public_facility'">
                        <select name="feature_id" :required="spatial.feature_type === 'public_facility'" x-model="spatial.feature_id"
                            class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                            <option value="" class="bg-secondary">-- Pilih Sarana / Fasilitas --</option>
                            @foreach($infrastructures as $inf)
                                <option value="{{ $inf->id }}" class="bg-secondary">{{ $inf->facility_name }} ({{ $inf->facility_type->value }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div x-show="spatial.feature_type === 'msme_location'">
                        <select name="feature_id" :required="spatial.feature_type === 'msme_location'" x-model="spatial.feature_id"
                            class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                            <option value="" class="bg-secondary">-- Pilih Unit Usaha UMKM --</option>
                            @foreach($msmes as $m)
                                <option value="{{ $m->id }}" class="bg-secondary">{{ $m->name }} (Pemilik: {{ $m->citizen->name ?? 'Belum tercatat' }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div x-show="spatial.feature_type === 'village_boundary'">
                        <input type="text" readonly name="feature_id" x-model="spatial.feature_id"
                            class="w-full px-3 py-2 text-sm border rounded-lg bg-tertiary/50 border-textTertiary/30 text-textSecondary focus:outline-none">
                        <p class="mt-1 text-[10px] text-textSecondary/70">Batas wilayah merupakan entitas spasial global desa dan menggunakan ID global khusus.</p>
                    </div>

                    <div x-show="!spatial.feature_type">
                        <select disabled class="w-full px-3 py-2 text-sm border rounded-lg bg-tertiary/50 border-textTertiary/20 text-textSecondary/40">
                            <option value="">-- Silakan Pilih Jenis Terlebih Dahulu --</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label for="update_latitude" class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Garis Lintang (Latitude) <span class="text-red-500">*</span></label>
                    <input type="number" step="any" min="-90" max="90" id="update_latitude" name="latitude" required x-model="spatial.latitude" placeholder="Contoh: -6.12345678"
                        class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary placeholder:text-textSecondary/50 focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                </div>

                <div>
                    <label for="update_longitude" class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Garis Bujur (Longitude) <span class="text-red-500">*</span></label>
                    <input type="number" step="any" min="-180" max="180" id="update_longitude" name="longitude" required x-model="spatial.longitude" placeholder="Contoh: 106.12345678"
                        class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary placeholder:text-textSecondary/50 focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                </div>
            </div>

            <div>
                <label for="update_geojson" class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Data Spasial Tambahan (GeoJSON)</label>
                <textarea id="update_geojson" name="geojson" rows="4" x-model="spatial.geojson" placeholder='Contoh: { "type": "Point", "coordinates": [106.12, -6.12] }'
                    class="w-full px-3 py-2 font-mono text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary placeholder:text-textSecondary/50 focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary"></textarea>
                <p class="mt-1 text-[10px] text-textSecondary/70">Optional: Masukkan data koordinat poligon batas wilayah atau geometri GeoJSON dalam format teks JSON murni.</p>
            </div>

            <div class="flex items-center justify-end gap-2 pt-4 border-t border-textTertiary/30">
                <button type="button" @click="openUpdate = false" x-bind:disabled="submitting"
                    class="px-4 py-2 text-sm font-medium text-textPrimary transition-colors bg-secondary border border-textTertiary/40 rounded-lg hover:bg-tertiary focus:outline-none disabled:opacity-50 disabled:cursor-not-allowed">
                    Batal
                </button>
                <button type="submit" x-bind:disabled="submitting"
                    class="flex items-center justify-center gap-2 px-4 py-2 text-sm font-medium text-secondary transition-colors bg-primary rounded-lg shadow-sm hover:opacity-90 focus:outline-none disabled:opacity-70 disabled:cursor-not-allowed min-w-[160px]">
                    <svg x-show="submitting" x-cloak class="animate-spin w-4 h-4" viewBox="0 0 24 24" fill="none">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                    </svg>
                    <span x-text="submitting ? 'Menyimpan...' : 'Simpan Perubahan'"></span>
                </button>
            </div>
        </form>
    </div>
</div>