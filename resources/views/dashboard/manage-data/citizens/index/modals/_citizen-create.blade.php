<div x-show="citizen.openCreate"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto transition-opacity duration-300 bg-textPrimary/50 backdrop-blur-sm">

    <div
        class="w-full max-w-3xl overflow-hidden transition-all duration-300 transform scale-95 border shadow-xl bg-secondary border-textTertiary/30 rounded-2xl">

        <div class="flex items-center justify-between px-6 py-4 border-b border-textTertiary/20 bg-tertiary">
            <div class="flex items-center gap-2">
                <div class="p-2 rounded-lg text-primary bg-primary/10">
                    <x-heroicon-o-identification class="w-5 h-5" />
                </div>
                <div>
                    <h3 class="text-lg font-bold text-textPrimary">Sensus Penduduk Baru</h3>
                    <p class="text-xs text-textSecondary">Formulir terpadu data warga & profil kesejahteraan.</p>
                </div>
            </div>
            <button @click="citizen.openCreate = false"
                class="p-1 transition-colors rounded-lg text-textSecondary hover:text-textPrimary hover:bg-textTertiary/20">
                <x-heroicon-o-x-mark class="w-5 h-5" />
            </button>
        </div>

        <form action="{{ route('citizens.create') }}" method="POST" class="p-6 space-y-4 max-h-[70vh] overflow-y-auto"
            x-data="{ submitting: false }" @submit="submitting = true">
            @csrf

            <div class="space-y-4">
                <h4 class="pb-1 text-sm font-bold border-b text-primary border-textTertiary/20">Tambah Identitas
                    Kependudukan</h4>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label for="id_number"
                            class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">Nomor
                            Induk Kependudukan (NIK) <span class="text-red-500">*</span></label>
                        <input type="text" id="id_number" name="id_number" required maxlength="16" minlength="16"
                            placeholder="16 digit NIK"
                            class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary placeholder:text-textSecondary/50 focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                    </div>

                    <div>
                        <label for="family_id"
                            class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">Hubungkan
                            Ke Keluarga (KK) <span class="text-red-500">*</span></label>
                        <select id="family_id" name="family_id" required
                            class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                            <option value="" class="bg-secondary">-- Pilih Nomor KK --</option>
                            @foreach ($families as $id => $label)
                            <option value="{{ $id }}" class="bg-secondary">
                                {{ $label }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label for="full_name"
                        class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">Nama
                        Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" id="full_name" name="full_name" required placeholder="Contoh: Budi Santoso"
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary placeholder:text-textSecondary/50 focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label for="gender"
                            class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">Jenis
                            Kelamin <span class="text-red-500">*</span></label>
                        <select id="gender" name="gender" required
                            class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                            <option value="" class="bg-secondary">-- Pilih Jenis Kelamin --</option>
                            @foreach ($gender::cases() as $val)
                            <option value="{{ $val->value }}" class="bg-secondary">{{ $val->label() }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="family_role"
                            class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">Hubungan
                            Keluarga <span class="text-red-500">*</span></label>
                        <select id="family_role" name="family_role" required
                            class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
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
                            class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">Tempat
                            Lahir <span class="text-red-500">*</span></label>
                        <input type="text" id="birth_place" name="birth_place" required placeholder="Contoh: Cirebon"
                            class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary placeholder:text-textSecondary/50 focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                    </div>

                    <div>
                        <label for="birth_date"
                            class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">Tanggal
                            Lahir</label>
                        <input type="date" id="birth_date" name="birth_date"
                            class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                    <div>
                        <label
                            class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">Agama
                            <span class="text-red-500">*</span></label>
                        <select name="religion" required
                            class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                            <option value="" class="bg-secondary">-- Pilih Agama --</option>
                            @foreach ($religion::cases() as $val)
                            <option value="{{ $val->value }}" class="bg-secondary">{{ $val->label() }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label
                            class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">Status
                            Pernikahan <span class="text-red-500">*</span></label>
                        <select name="marital_status" required
                            class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                            <option value="" class="bg-secondary">-- Pilih Status --</option>
                            @foreach ($maritalStatus::cases() as $val)
                            <option value="{{ $val->value }}" class="bg-secondary">{{ $val->label() }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">
                            Golongan Darah <span class="text-red-500">*</span>
                        </label>
                        <select name="blood_type"
                            class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                            <option value="" class="bg-secondary">-- Pilih Golongan Darah --</option>
                            @foreach ($bloodType::cases() as $val)
                            <option value="{{ $val->value }}" class="bg-secondary" {{ old('blood_type') === $val->value ? 'selected' : '' }}>
                                {{ $val->label() }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-2 pt-4 border-t border-textTertiary/20">
                <button type="button" @click="citizen.openCreate = false" x-bind:disabled="submitting"
                    class="px-4 py-2 text-sm font-medium transition-colors border rounded-lg text-textPrimary bg-secondary border-textTertiary/40 hover:bg-tertiary focus:outline-none disabled:opacity-50 disabled:cursor-not-allowed">
                    Batal
                </button>
                <button type="submit" x-bind:disabled="submitting"
                    class="flex items-center justify-center gap-2 px-4 py-2 text-sm font-medium text-secondary transition-colors bg-primary rounded-lg shadow-sm hover:opacity-90 focus:outline-none disabled:opacity-70 disabled:cursor-not-allowed min-w-[140px]">
                    <svg x-show="submitting" x-cloak class="w-4 h-4 animate-spin" viewBox="0 0 24 24"
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
