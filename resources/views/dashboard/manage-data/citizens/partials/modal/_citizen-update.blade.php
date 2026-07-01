<div x-show="citizen.openUpdate"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto transition-opacity duration-300 bg-textPrimary/50 backdrop-blur-sm">
    <div
        class="w-full max-w-3xl overflow-hidden transition-all duration-300 transform scale-95 bg-secondary border border-textTertiary/30 shadow-xl rounded-2xl">
        <div class="flex items-center justify-between px-6 py-4 border-b border-textTertiary/20 bg-tertiary">
            <div class="flex items-center gap-2">
                <div class="p-2 text-primary rounded-lg bg-primary/10">
                    <x-heroicon-o-identification class="w-5 h-5" />
                </div>
                <div>
                    <h3 class="text-lg font-bold text-textPrimary">Sensus Penduduk Baru</h3>
                    <p class="text-xs text-textSecondary">Formulir terpadu data warga & profil kesejahteraan.</p>
                </div>
            </div>
            <button @click="citizen.openUpdate = false"
                class="p-1 text-textSecondary transition-colors rounded-lg hover:text-textPrimary hover:bg-textTertiary/20">
                <x-heroicon-o-x-mark class="w-5 h-5" />
            </button>
        </div>

        <form :action="`/dashboard/manage-data/citizens/${citizen.data.id}/update`" method="POST"
            class="p-6 space-y-4 max-h-[70vh] overflow-y-auto" x-data="{ submitting: false }" @submit="submitting = true">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label for="update_id_number"
                            class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Nomor
                            Induk
                            Kependudukan (NIK) <span class="text-red-500">*</span></label>
                        <input type="text" id="update_id_number" name="id_number" required maxlength="16"
                            minlength="16" x-model="citizen.data.id_number" placeholder="16 digit NIK"
                            class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary placeholder:text-textSecondary/50 focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                    </div>

                    <div>
                        <label for="update_family_id"
                            class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Hubungkan
                            Ke
                            Keluarga (KK) <span class="text-red-500">*</span></label>
                        <select id="update_family_id" name="family_id" required x-model="citizen.data.family_id"
                            class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                            <option value="">-- Pilih Nomor KK --</option>
                            @foreach ($families as $fam)
                                <option value="{{ $fam->id }}">
                                    {{ $fam->family_card_number }} ({{ $fam->address_detail }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label for="update_full_name"
                        class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Nama
                        Lengkap
                        <span class="text-red-500">*</span></label>
                    <input type="text" id="update_full_name" name="full_name" required
                        x-model="citizen.data.full_name" placeholder="Contoh: Budi Santoso"
                        class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary placeholder:text-textSecondary/50 focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label for="update_gender"
                            class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Jenis
                            Kelamin <span class="text-red-500">*</span></label>
                        <select id="update_gender" name="gender" required x-model="citizen.data.gender"
                            class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            @foreach ($gender::cases() as $val)
                                <option value="{{ $val->value }}">{{ $val->label() }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="update_family_role"
                            class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Hubungan
                            Keluarga <span class="text-red-500">*</span></label>
                        <select id="update_family_role" name="family_role" required x-model="citizen.data.family_role"
                            class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                            <option value="">-- Pilih Hubungan --</option>
                            @foreach ($familyRole::cases() as $val)
                                <option value="{{ $val->value }}">{{ $val->label() }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label for="update_birth_place"
                            class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Tempat
                            Lahir
                            <span class="text-red-500">*</span></label>
                        <input type="text" id="update_birth_place" name="birth_place" required
                            x-model="citizen.data.birth_place" placeholder="Contoh: Cirebon"
                            class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary placeholder:text-textSecondary/50 focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                    </div>

                    <div>
                        <label for="update_birth_date"
                            class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Tanggal
                            Lahir</label>
                        <input type="date" id="update_birth_date" name="birth_date" x-model="citizen.data.birth_date"
                            class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                    <div>
                        <label
                            class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Agama
                            <span class="text-red-500">*</span></label>
                        <select name="religion" required x-model="citizen.data.religion"
                            class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                            <option value="">-- Pilih Agama --</option>
                            @foreach ($religion::cases() as $val)
                                <option value="{{ $val->value }}">{{ $val->label() }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label
                            class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Status
                            Pernikahan <span class="text-red-500">*</span></label>
                        <select name="marital_status" required x-model="citizen.data.marital_status"
                            class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                            <option value="">-- Pilih Status --</option>
                            @foreach ($maritalStatus::cases() as $val)
                                <option value="{{ $val->value }}">{{ $val->label() }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="update_blood_type"
                            class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Golongan
                            Darah</label>
                        <input type="text" id="update_blood_type" name="blood_type" maxlength="5"
                            x-model="citizen.data.blood_type" placeholder="Contoh: O, AB"
                            class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary placeholder:text-textSecondary/50 focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-2 pt-4 border-t border-textTertiary/20">
                <button type="button" @click="citizen.openUpdate = false" x-bind:disabled="submitting"
                    class="px-4 py-2 text-sm font-medium text-textPrimary transition-colors bg-secondary border border-textTertiary/40 rounded-lg hover:bg-tertiary focus:outline-none disabled:opacity-50 disabled:cursor-not-allowed">
                    Batal
                </button>
                <button type="submit" x-bind:disabled="submitting"
                    class="flex items-center justify-center gap-2 px-4 py-2 text-sm font-medium text-secondary transition-colors bg-primary rounded-lg shadow-sm hover:opacity-90 focus:outline-none disabled:opacity-70 disabled:cursor-not-allowed min-w-[140px]">
                    <svg x-show="submitting" x-cloak class="animate-spin w-4 h-4" viewBox="0 0 24 24"
                        fill="none">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z">
                        </path>
                    </svg>
                    <span x-text="submitting ? 'Menyimpan...' : 'Simpan Sensus Penduduk'"></span>
                </button>
            </div>
        </form>
    </div>
</div>
