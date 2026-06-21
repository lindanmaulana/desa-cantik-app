<div x-show="citizen.openCreate"
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
            <button @click="citizen.openCreate = false"
                class="p-1 text-textSecondary transition-colors rounded-lg hover:text-textPrimary hover:bg-textTertiary/20">
                <x-heroicon-o-x-mark class="w-5 h-5" />
            </button>
        </div>

        <form action="{{ route('citizens.store') }}" method="POST" class="p-6 space-y-4 max-h-[70vh] overflow-y-auto">
            @csrf

            <div class="space-y-4">
                <h4 class="pb-1 text-sm font-bold text-primary border-b border-textTertiary/20">Tambah Identitas
                    Kependudukan</h4>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label for="id_number"
                            class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Nomor
                            Induk Kependudukan (NIK) <span class="text-red-500">*</span></label>
                        <input type="text" id="id_number" name="id_number" required maxlength="16" minlength="16"
                            placeholder="16 digit NIK"
                            class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary placeholder:text-textSecondary/50 focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                    </div>

                    <div>
                        <label for="family_id"
                            class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Hubungkan
                            Ke Keluarga (KK) <span class="text-red-500">*</span></label>
                        <select id="family_id" name="family_id" required
                            class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                            <option value="" class="bg-secondary">-- Pilih Nomor KK --</option>
                            @foreach ($families as $fam)
                                <option value="{{ $fam->id }}" class="bg-secondary">
                                    {{ $fam->family_card_number }} ({{ $fam->address_detail }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label for="full_name"
                        class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Nama
                        Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" id="full_name" name="full_name" required placeholder="Contoh: Budi Santoso"
                        class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary placeholder:text-textSecondary/50 focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label for="gender"
                            class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Jenis
                            Kelamin <span class="text-red-500">*</span></label>
                        <select id="gender" name="gender" required
                            class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                            <option value="" class="bg-secondary">-- Pilih Jenis Kelamin --</option>
                            @foreach ($gender::cases() as $val)
                                <option value="{{ $val->value }}" class="bg-secondary">{{ $val->label() }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="family_role"
                            class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Hubungan
                            Keluarga <span class="text-red-500">*</span></label>
                        <select id="family_role" name="family_role" required
                            class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                            <option value="" class="bg-secondary">-- Pilih Hubungan --</option>
                            @foreach ($familyRole::cases() as $val)
                                <option value="{{ $val->value }}" class="bg-secondary">{{ $val->label() }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label for="birth_place"
                            class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Tempat
                            Lahir <span class="text-red-500">*</span></label>
                        <input type="text" id="birth_place" name="birth_place" required placeholder="Contoh: Cirebon"
                            class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary placeholder:text-textSecondary/50 focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                    </div>

                    <div>
                        <label for="birth_date"
                            class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Tanggal
                            Lahir</label>
                        <input type="date" id="birth_date" name="birth_date"
                            class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                    <div>
                        <label
                            class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Agama
                            <span class="text-red-500">*</span></label>
                        <select name="religion" required
                            class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                            <option value="" class="bg-secondary">-- Pilih Agama --</option>
                            @foreach ($religion::cases() as $val)
                                <option value="{{ $val->value }}" class="bg-secondary">{{ $val->label() }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label
                            class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Status
                            Pernikahan <span class="text-red-500">*</span></label>
                        <select name="marital_status" required
                            class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                            <option value="" class="bg-secondary">-- Pilih Status --</option>
                            @foreach ($maritalStatus::cases() as $val)
                                <option value="{{ $val->value }}" class="bg-secondary">{{ $val->label() }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="blood_type"
                            class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Golongan
                            Darah</label>
                        <input type="text" id="blood_type" name="blood_type" maxlength="5"
                            placeholder="Contoh: O, AB"
                            class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary placeholder:text-textSecondary/50 focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-2 pt-4 border-t border-textTertiary/20">
                <button type="button" @click="citizen.openCreate = false"
                    class="px-4 py-2 text-sm font-medium text-textPrimary transition-colors bg-secondary border border-textTertiary/40 rounded-lg hover:bg-tertiary focus:outline-none">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium text-secondary transition-colors bg-primary rounded-lg shadow-sm hover:opacity-90 focus:outline-none">
                    Simpan Sensus Penduduk
                </button>
            </div>
        </form>
    </div>
</div>
