<div x-show="openCreate" class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto transition-opacity duration-300 bg-gray-900 bg-opacity-50 backdrop-blur-sm">

    <div class="w-full max-w-3xl overflow-hidden transition-all duration-300 transform scale-95 bg-white border border-gray-100 shadow-xl rounded-2xl">

        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gray-50">
            <div class="flex items-center gap-2">
                <div class="p-2 text-teal-600 rounded-lg bg-teal-50">
                    <x-heroicon-o-identification class="w-5 h-5" />
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Sensus Penduduk Baru</h3>
                    <p class="text-xs text-gray-500">Formulir terpadu data warga & profil kesejahteraan.</p>
                </div>
            </div>
            <button @click="openCreate = false" class="p-1 text-gray-400 transition-colors rounded-lg hover:text-gray-600 hover:bg-gray-100">
                <x-heroicon-o-x-mark class="w-5 h-5" />
            </button>
        </div>

        <!-- Progress Steps Indicator -->
        <div class="flex items-center justify-between px-6 py-3 text-xs font-semibold text-gray-500 border-b bg-teal-50/40 border-teal-50">
            <button type="button" @click="stepCreate = 1" :class="stepCreate === 1 ? 'text-teal-600 font-bold' : ''" class="flex items-center gap-1 focus:outline-none">
                <span class="w-5 h-5 rounded-full flex items-center justify-center text-[10px] border" :class="stepCreate === 1 ? 'bg-teal-600 text-white border-teal-600' : 'bg-white border-gray-300'">1</span> Identitas
            </button>
            <div class="h-0.5 bg-gray-200 flex-1 mx-2"></div>
            <button type="button" @click="stepCreate = 2" :class="stepCreate === 2 ? 'text-teal-600 font-bold' : ''" class="flex items-center gap-1 focus:outline-none">
                <span class="w-5 h-5 rounded-full flex items-center justify-center text-[10px] border" :class="stepCreate === 2 ? 'bg-teal-600 text-white border-teal-600' : 'bg-white border-gray-300'">2</span> Pendidikan
            </button>
            <div class="h-0.5 bg-gray-200 flex-1 mx-2"></div>
            <button type="button" @click="stepCreate = 3" :class="stepCreate === 3 ? 'text-teal-600 font-bold' : ''" class="flex items-center gap-1 focus:outline-none">
                <span class="w-5 h-5 rounded-full flex items-center justify-center text-[10px] border" :class="stepCreate === 3 ? 'bg-teal-600 text-white border-teal-600' : 'bg-white border-gray-300'">3</span> Ekonomi
            </button>
            <div class="h-0.5 bg-gray-200 flex-1 mx-2"></div>
            <button type="button" @click="stepCreate = 4" :class="stepCreate === 4 ? 'text-teal-600 font-bold' : ''" class="flex items-center gap-1 focus:outline-none">
                <span class="w-5 h-5 rounded-full flex items-center justify-center text-[10px] border" :class="stepCreate === 4 ? 'bg-teal-600 text-white border-teal-600' : 'bg-white border-gray-300'">4</span> Kesehatan
            </button>
            <div class="h-0.5 bg-gray-200 flex-1 mx-2"></div>
            <button type="button" @click="stepCreate = 5" :class="stepCreate === 5 ? 'text-teal-600 font-bold' : ''" class="flex items-center gap-1 focus:outline-none">
                <span class="w-5 h-5 rounded-full flex items-center justify-center text-[10px] border" :class="stepCreate === 5 ? 'bg-teal-600 text-white border-teal-600' : 'bg-white border-gray-300'">5</span> Hunian
            </button>
        </div>

        <form action="{{ route('citizens.store') }}" method="POST" class="p-6 space-y-4 max-h-[70vh] overflow-y-auto">
            @csrf

            <!-- STEP 1: Data Identitas Dasar -->
            <div x-show="stepCreate === 1" class="space-y-4">
                <h4 class="pb-1 text-sm font-bold text-teal-700 border-b">Bagian 1: Identitas Kependudukan</h4>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label for="id_number" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Nomor Induk Kependudukan (NIK) <span class="text-red-500">*</span></label>
                        <input type="text" id="id_number" name="id_number" required maxlength="16" minlength="16" placeholder="16 digit NIK"
                            class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                    </div>

                    <div>
                        <label for="family_id" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Hubungkan Ke Keluarga (KK) <span class="text-red-500">*</span></label>
                        <select id="family_id" name="family_id" required
                            class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                            <option value="">-- Pilih Nomor KK --</option>
                            @foreach($families as $fam)
                                <option value="{{ $fam->id }}">
                                    {{ $fam->family_card_number }} ({{ $fam->address_detail }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label for="full_name" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" id="full_name" name="full_name" required placeholder="Contoh: Budi Santoso"
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label for="gender" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Jenis Kelamin <span class="text-red-500">*</span></label>
                        <select id="gender" name="gender" required
                            class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            @foreach($gender::cases() as $val)
                                <option value="{{ $val->value }}">{{ $val->label() }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="family_role" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Hubungan Keluarga <span class="text-red-500">*</span></label>
                        <select id="family_role" name="family_role" required
                            class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                            <option value="">-- Pilih Hubungan --</option>
                            @foreach($familyRole::cases() as $val)
                                <option value="{{ $val->value }}">{{ $val->label() }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label for="birth_place" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Tempat Lahir <span class="text-red-500">*</span></label>
                        <input type="text" id="birth_place" name="birth_place" required placeholder="Contoh: Cirebon"
                            class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                    </div>

                    <div>
                        <label for="birth_date" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Tanggal Lahir</label>
                        <input type="date" id="birth_date" name="birth_date"
                            class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                    <div>
                        <label class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Agama <span class="text-red-500">*</span></label>
                        <select name="religion" required
                            class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                            <option value="">-- Pilih Agama --</option>
                            @foreach($religion::cases() as $val)
                                <option value="{{ $val->value }}">{{ $val->label() }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Status Pernikahan <span class="text-red-500">*</span></label>
                        <select name="marital_status" required
                            class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                            <option value="">-- Pilih Status --</option>
                            @foreach($maritalStatus::cases() as $val)
                                <option value="{{ $val->value }}">{{ $val->label() }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="blood_type" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Golongan Darah</label>
                        <input type="text" id="blood_type" name="blood_type" maxlength="5" placeholder="Contoh: O, AB"
                            class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                    </div>
                </div>
            </div>

            <!-- STEP 2: Profil Pendidikan -->
            <div x-show="stepCreate === 2" class="space-y-4">
                <h4 class="pb-1 text-sm font-bold text-teal-700 border-b">Bagian 2: Profil Pendidikan</h4>
                <div>
                    <label for="education_level" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Jenjang Pendidikan <span class="text-red-500">*</span></label>
                    <select id="education_level" name="education_level" required
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                        @foreach($educationLevel::cases() as $val)
                            <option value="{{ $val->value }}">{{ $val->label() }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="highest_diploma" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Ijazah Tertinggi Yang Dimiliki <span class="text-red-500">*</span></label>
                    <select id="highest_diploma" name="highest_diploma" required
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                        @foreach($educationLevel::cases() as $val)
                            <option value="{{ $val->value }}">{{ $val->label() }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="school_participation" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Status Partisipasi Sekolah <span class="text-red-500">*</span></label>
                    <select id="school_participation" name="school_participation" required
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                        @foreach($schoolParticipation::cases() as $val)
                            <option value="{{ $val->value }}">{{ $val->label() }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- STEP 3: Pekerjaan & Kesejahteraan Ekonomi -->
            <div x-show="stepCreate === 3" class="space-y-4" x-data="{ isWelfare: '0' }">
                <h4 class="pb-1 text-sm font-bold text-teal-700 border-b">Bagian 3: Profil Pekerjaan & Ekonomi</h4>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label for="occupation" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Pekerjaan Utama <span class="text-red-500">*</span></label>
                        <input type="text" id="occupation" name="occupation" required placeholder="Contoh: Petani, Ibu Rumah Tangga, Swasta"
                            class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                    </div>
                    <div>
                        <label for="job_sector" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Sektor Pekerjaan <span class="text-red-500">*</span></label>
                        <select id="job_sector" name="job_sector" required
                            class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                            @foreach($jobSector::cases() as $val)
                                <option value="{{ $val->value }}">{{ $val->label() }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label for="employment_status" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Status Hubungan Kerja <span class="text-red-500">*</span></label>
                        <select id="employment_status" name="employment_status" required
                            class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                            @foreach($employmentStatus::cases() as $val)
                                <option value="{{ $val->value }}">{{ $val->label() }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="monthly_income" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Pendapatan Bulanan (Rupiah)</label>
                        <input type="number" id="monthly_income" name="monthly_income" min="0" placeholder="0"
                            class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label for="economic_status" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Klasifikasi Kesejahteraan <span class="text-red-500">*</span></label>
                        <select id="economic_status" name="economic_status" required
                            class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                            @foreach($economicStatus::cases() as $val)
                                <option value="{{ $val->value }}">{{ $val->label() }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="is_welfare_recipient" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Menerima Bansos / Bantuan Pemerintah? <span class="text-red-500">*</span></label>
                        <select id="is_welfare_recipient" name="is_welfare_recipient" x-model="isWelfare" required
                            class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                            <option value="0">Tidak</option>
                            <option value="1">Ya</option>
                        </select>
                    </div>
                </div>

                <div x-show="isWelfare === '1'" x-transition class="p-3 border rounded-lg bg-amber-50 border-amber-100">
                    <label for="assistance_type" class="block mb-1 text-xs font-semibold tracking-wider uppercase text-amber-800">Jenis Bantuan Yang Diterima <span class="text-red-500">*</span></label>
                    <input type="text" id="assistance_type" name="assistance_type" :required="isWelfare === '1'" placeholder="Contoh: PKH, BPNT, BLT-DD"
                        class="w-full px-3 py-2 text-sm transition-all bg-white border rounded-lg border-amber-200 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500">
                </div>
            </div>

            <!-- STEP 4: Profil Kesehatan & Disabilitas -->
            <div x-show="stepCreate === 4" class="space-y-4">
                <h4 class="pb-1 text-sm font-bold text-teal-700 border-b">Bagian 4: Data Kesehatan & Layanan Sosial</h4>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label for="disability_type" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Jenis Disabilitas <span class="text-red-500">*</span></label>
                        <select id="disability_type" name="disability_type" required
                            class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                            @foreach($disabilityType::cases() as $val)
                                <option value="{{ $val->value }}">{{ $val->label() }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="is_pregnant" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Sedang Hamil? <span class="text-red-500">*</span></label>
                        <select id="is_pregnant" name="is_pregnant" required
                            class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                            <option value="0">Tidak</option>
                            <option value="1">Ya</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label for="bpjs_status" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Kepesertaan BPJS <span class="text-red-500">*</span></label>
                        <select id="bpjs_status" name="bpjs_status" required
                            class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                            @foreach($bpjsStatus::cases() as $val)
                                <option value="{{ $val->value }}">{{ $val->label() }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="kb_method" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Metode KB Terpilih <span class="text-red-500">*</span></label>
                        <select id="kb_method" name="kb_method" required
                            class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                            @foreach($kbMethod::cases() as $val)
                                <option value="{{ $val->value }}">{{ $val->label() }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- STEP 5: Profil Hunian & Sanitasi -->
            <div x-show="stepCreate === 5" class="space-y-4">
                <h4 class="pb-1 text-sm font-bold text-teal-700 border-b">Bagian 5: Kelayakan Rumah & Utilasi</h4>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label for="house_ownership" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Status Kepemilikan Rumah <span class="text-red-500">*</span></label>
                        <select id="house_ownership" name="house_ownership" required
                            class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                            @foreach($houseOwnership::cases() as $val)
                                <option value="{{ $val->value }}">{{ $val->label() }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="house_condition" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Kondisi Fisik Rumah <span class="text-red-500">*</span></label>
                        <select id="house_condition" name="house_condition" required
                            class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                            @foreach($houseCondition::cases() as $val)
                                <option value="{{ $val->value }}">{{ $val->label() }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                    <div>
                        <label for="floor_material" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Material Lantai <span class="text-red-500">*</span></label>
                        <select id="floor_material" name="floor_material" required
                            class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                            @foreach($floorMaterial::cases() as $val)
                                <option value="{{ $val->value }}">{{ $val->label() }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="wall_material" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Material Dinding <span class="text-red-500">*</span></label>
                        <select id="wall_material" name="wall_material" required
                            class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                            @foreach($wallMaterial::cases() as $val)
                                <option value="{{ $val->value }}">{{ $val->label() }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="roof_material" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Material Atap <span class="text-red-500">*</span></label>
                        <select id="roof_material" name="roof_material" required
                            class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                            @foreach($roofMaterial::cases() as $val)
                                <option value="{{ $val->value }}">{{ $val->label() }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                    <div>
                        <label for="water_source" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Sumber Air Bersih <span class="text-red-500">*</span></label>
                        <select id="water_source" name="water_source" required
                            class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                            @foreach($waterSource::cases() as $val)
                                <option value="{{ $val->value }}">{{ $val->label() }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="sanitation_type" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Jenis Sanitasi / WC <span class="text-red-500">*</span></label>
                        <select id="sanitation_type" name="sanitation_type" required
                            class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                            @foreach($sanitationType::cases() as $val)
                                <option value="{{ $val->value }}">{{ $val->label() }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="cooking_fuel" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Bahan Bakar Memasak <span class="text-red-500">*</span></label>
                        <select id="cooking_fuel" name="cooking_fuel" required
                            class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                            @foreach($cookingFuel::cases() as $val)
                                <option value="{{ $val->value }}">{{ $val->label() }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label for="electricity_source" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Sumber Penerangan <span class="text-red-500">*</span></label>
                        <select id="electricity_source" name="electricity_source" required
                            class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                            @foreach($electricitySource::cases() as $val)
                                <option value="{{ $val->value }}">{{ $val->label() }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="electricity_capacity" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Daya Listrik Terpasang <span class="text-red-500">*</span></label>
                        <select id="electricity_capacity" name="electricity_capacity" required
                            class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                            @foreach($electricityCapacity::cases() as $val)
                                <option value="{{ $val->value }}">{{ $val->label() }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- BUTTON NAVIGASI MULTI-STEP -->
            <div class="flex items-center justify-between gap-2 pt-4 border-t border-gray-100">
                <div>
                    <button type="button" x-show="stepCreate > 1" @click="stepCreate--" class="px-4 py-2 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-200 rounded-lg hover:bg-gray-50 focus:outline-none">
                        Kembali
                    </button>
                </div>
                <div class="flex items-center gap-2">
                    <button type="button" @click="openCreate = false" class="px-4 py-2 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-200 rounded-lg hover:bg-gray-50 focus:outline-none">
                        Batal
                    </button>
                    <button type="button" x-show="stepCreate < 5" @click="stepCreate++" class="px-4 py-2 text-sm font-medium text-white transition-colors bg-teal-600 rounded-lg shadow-sm hover:bg-teal-700 focus:outline-none">
                        Lanjut
                    </button>
                    <button type="submit" x-show="stepCreate === 5" class="px-4 py-2 text-sm font-medium text-white transition-colors bg-teal-600 rounded-lg shadow-sm hover:bg-teal-700 focus:outline-none">
                        Simpan Sensus Penduduk
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
