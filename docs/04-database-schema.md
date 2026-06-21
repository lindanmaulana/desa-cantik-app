# 🗂️ Desa Cantik App - Database Schema & Data Dictionary

Dokumen ini berisi spesifikasi tabel, tipe data, serta nilai `ENUM` yang sah yang digunakan dalam aplikasi Desa Cantik App.

---

## 📌 Kamus Data Tabel

### A. Authentication: Users (Tabel `users`)
| Field | Tipe Data | Constraint | Default | Keterangan |
| :--- | :--- | :--- | :--- | :--- |
| `id` | UUID | PK, NOT NULL | | ID unik user (UUID v4) |
| `username` | UUID | FK, NOT NULL | | Relasi ke `citizens.id` (Warga yang menjadi user) |
| `password` | VARCHAR(255) | NOT NULL | `'resident'` | Password akun terenkripsi |
| `full_name` | VARCHAR(255) | NOT NULL | | Nama lengkap pengguna |
| `territory_id` | UUID | FK, NULLABLE | `null` | Relasi ke `territories.id` (Batasan wilayah tugas) |
| `role` | ENUM | NULLABLE | | Opsi: `'admin'`, `'operator'`, `'head_of_rw'`, `'head_of_rt'` |
| `created_at` | TIMESTAMP | NOT NULL | | |
| `updated_at` | TIMESTAMP | NOT NULL | | |
| `deleted_at` | TIMESTAMP | NULLABLE | `null` | Fitur _soft delete_ |

### B. Master Data: Territories (Tabel `territories`)
| Field | Tipe Data | Constraint | Default | Keterangan |
| :--- | :--- | :--- | :--- | :--- |
| `id` | UUID | PK, NOT NULL | | ID unik wilayah (UUID v4) |
| `sub_village` | VARCHAR(100) | NOT NULL | | Nama Dusun |
| `area_name` | VARCHAR(100) | NULLABLE | | Nama blok / area / kampung |
| `rw` | VARCHAR(5) | NOT NULL | | Nomor RW |
| `rt` | VARCHAR(5) | NOT NULL | | Nomor RT |
| `created_at` | TIMESTAMP | NOT NULL | | |
| `updated_at` | TIMESTAMP | NOT NULL | | |
| `deleted_at` | TIMESTAMP | NULLABLE | `null` | Fitur _soft delete_ |

### C. Master Data: Families (Tabel `families`)
| Field | Tipe Data | Constraint | Default | Keterangan |
| :--- | :--- | :--- | :--- | :--- |
| `id` | UUID | PK, NOT NULL | | ID unik keluarga (UUID v4) |
| `territory_id` | UUID | FK, NOT NULL | | Relasi ke `territories.id` |
| `family_card_number`| VARCHAR(16) | NOT NULL | | Nomor Kartu Keluarga (16 digit) |
| `address_detail` | TEXT | NULLABLE | | Detail alamat fisik rumah tangga |
| `created_at` | TIMESTAMP | NOT NULL | | |
| `updated_at` | TIMESTAMP | NOT NULL | | |
| `deleted_at` | TIMESTAMP | NULLABLE | `null` | Fitur _soft delete_ |

### D. Master Data: Citizens (Tabel `citizens`)
| Field | Tipe Data | Constraint | Default | Keterangan |
| :--- | :--- | :--- | :--- | :--- |
| `id` | UUID | PK, NOT NULL | | ID unik warga (UUID v4) |
| `family_id` | UUID | FK, NOT NULL | | Relasi ke `families.id` |
| `id_number` | VARCHAR(16) | NOT NULL | | NIB / NIK warga |
| `full_name` | VARCHAR(255) | NOT NULL | | Nama lengkap sesuai KTP |
| `family_role` | ENUM | NOT NULL | | Opsi: `'head_of_family'`, `'spouse'`, `'child'`, `'parent'`, `'other_relative'` |
| `gender` | ENUM | NOT NULL | `'male'` | Opsi: `'male'`, `'female'` |
| `birth_place` | VARCHAR(100) | NOT NULL | | Tempat lahir |
| `birth_date` | DATE | NULLABLE | | Tanggal lahir (Basis hitung umur stunting) |
| `blood_type` | VARCHAR(5) | NULLABLE | `null` | Golongan darah (A, B, AB, O, dll) |
| `religion` | ENUM | NOT NULL | | Opsi: `'islam'`, `'protestant'`, `'catholic'`, `'hindu'`, `'buddha'`, `'confucian'`, `'other'` |
| `marital_status` | ENUM | NOT NULL | `'single'` | Opsi: `'single'`, `'married'`, `'divorced'`, `'widowed'` |
| `created_at` | TIMESTAMP | NOT NULL | | |
| `updated_at` | TIMESTAMP | NOT NULL | | |
| `deleted_at` | TIMESTAMP | NULLABLE | `null` | Fitur _soft delete_ |

### E. Education Profiles (Tabel `education_profiles`)
| Field | Tipe Data | Constraint | Default | Keterangan |
| :--- | :--- | :--- | :--- | :--- |
| `id` | UUID | PK, NOT NULL | | ID unik profil pendidikan |
| `citizen_id` | UUID | FK, NOT NULL | | Relasi ke `citizens.id` |
| `education_level` | ENUM | NOT NULL | `'none'` | Opsi: `'none'`, `'elementary_school'`, `'middle_school'`, `'high_school'`, `'associate_degree'`, `'bachelor_degree'`, `'postgraduate'` |
| `highest_diploma` | ENUM | NOT NULL | `'none'` | Opsi sama dengan `education_level` |
| `school_participation`| ENUM | NOT NULL | | Opsi: `'not_yet_in_school'`, `'currently_in_school'`, `'no_longer_in_school'` |
| `created_at` | TIMESTAMP | NOT NULL | | |
| `updated_at` | TIMESTAMP | NOT NULL | | |
| `deleted_at` | TIMESTAMP | NULLABLE | `null` | Fitur _soft delete_ |

### F. Employment Profiles (Tabel `employment_profiles`)
| Field | Tipe Data | Constraint | Default | Keterangan |
| :--- | :--- | :--- | :--- | :--- |
| `id` | UUID | PK, NOT NULL | | ID unik profil ekonomi |
| `citizen_id` | UUID | FK, NOT NULL | | Relasi ke `citizens.id` |
| `occupation` | VARCHAR(100) | NOT NULL | | Jenis pekerjaan spesifik |
| `job_sector` | ENUM | NOT NULL | `'other'` | Opsi: `'agriculture'`, `'manufacturing'`, `'trade_services goverment'`, `'other'` |
| `employment_status` | ENUM | NOT NULL | `'unpaid_worker'`| Opsi: `'employee'`, `'employer_assisted'`, `'employer_unassisted'`, `'self_employed'`, `'casual_worker'`, `'unpaid_worker'` |
| `monthly_income` | DECIMAL(15,2)| NULLABLE | | Nominal pendapatan bulanan |
| `economic_status` | ENUM | NOT NULL | | Opsi: `'very_poor'`, `'poor'`, `'near_poor'`, `'middle_income'`, `'high_income'` |
| `is_welfare_recipient`| BOOLEAN | NOT NULL | `false` | Status penerima jaring pengaman sosial/bansos |
| `assistance_type` | VARCHAR(255) | NULLABLE | `null` | Nama program bantuan yang diterima |
| `created_at` | TIMESTAMP | NOT NULL | | |
| `updated_at` | TIMESTAMP | NOT NULL | | |
| `deleted_at` | TIMESTAMP | NULLABLE | `null` | Fitur _soft delete_ |

### G. Health Profiles (Tabel `health_profiles`)
| Field | Tipe Data | Constraint | Default | Keterangan |
| :--- | :--- | :--- | :--- | :--- |
| `id` | UUID | PK, NOT NULL | | ID unik profil kesehatan |
| `citizen_id` | UUID | FK, NOT NULL | | Relasi ke `citizens.id` |
| `disability_type` | ENUM | NOT NULL | `'none'` | Opsi: `'none'`, `'physical'`, `'intellectual'`, `'mental'`, `'sensory'` |
| `is_pregnant` | BOOLEAN | NOT NULL | `false` | Status kehamilan |
| `kb_method` | ENUM | NOT NULL | `'none'` | Opsi: `'none'`, `'injection'`, `'pill'`, `'condom'`, `'implant'`, `'iud'`, `'tubal_ligation'`, `'vasectomy'` |
| `bpjs_status` | ENUM | NOT NULL | `'none'` | Opsi: `'none'`, `'goverment_subsidized'`, `'independent_member'`, `'company_member'` |
| `created_at` | TIMESTAMP | NOT NULL | | |
| `updated_at` | TIMESTAMP | NOT NULL | | |
| `deleted_at` | TIMESTAMP | NULLABLE | `null` | Fitur _soft delete_ |

### H. Housing Profiles (Tabel `housing_profiles`)
| Field | Tipe Data | Constraint | Default | Keterangan |
| :--- | :--- | :--- | :--- | :--- |
| `id` | UUID | PK, NOT NULL | | ID unik profil rumah |
| `family_id` | UUID | FK, NOT NULL | | Relasi ke `families.id` (1 KK = 1 Rumah) |
| `house_ownership` | ENUM | NULLABLE | `null` | Opsi: `'owned'`, `'rented'`, `'free_rent'`, `'official_house'` |
| `house_condition` | ENUM | NOT NULL | | Opsi: `'proper'`, `'unfit'` |
| `floor_material` | ENUM | NOT NULL | `'cement_brick'`| Opsi: `'marble_granite'`, `'ceramic_tile'`, `'cement_brick'`, `'wood_timber'`, `'bamboo'`, `'dirt_earth'` |
| `wall_material` | ENUM | NOT NULL | `'mansory_brick'`| Opsi: `'mansory_brick'`, `'reinforced_concrete'`, `'wood_plank'`, `'bamboo_woven'`, `'logs_thatch'` |
| `roof_material` | ENUM | NOT NULL | `'clay_tile'` | Opsi: `'concrete_tile'`, `'clay_tile'`, `'metal_sheet'`, `'asbestos'`, `'thatch_palm'` |
| `water_source` | ENUM | NOT NULL | `'protected_well'`| Opsi: `'piped_water'`, `'protected_well'`, `'bore_well'`, `'spring_water'`, `'river_rainwater'` |
| `sanitation_type` | ENUM | NOT NULL | `'private_flush_toilet'`| Opsi: `'private_flush_toilet'`, `'shared_flush_toilet'`, `'pit_latrine'`, `'no_toilet'` |
| `cooking_fuel` | ENUM | NOT NULL | `'lpg_gas'` | Opsi: `'electricity'`, `'lpg_gas'`, `'kerosene'`, `'biogas'`, `'wood_charcoal'` |
| `electricity_source` | ENUM | NOT NULL | `'pln_metered'`| Opsi: `'pln_metered'`, `'pln_unmetered'`, `'non_pln'`, `'no_electricity'` |
| `electricity_capacity`| ENUM | NOT NULL | `'900va'` | Opsi: `'non_electricity'`, `'450va'`, `'900va'`, `'1300va'`, `'2200va'`, `'above_2200va'` |
| `created_at` | TIMESTAMP | NOT NULL | | |
| `updated_at` | TIMESTAMP | NOT NULL | | |
| `deleted_at` | TIMESTAMP | NULLABLE | `null` | Fitur _soft delete_ |

### I. MSMEs (Tabel `msmes`)
| Field | Tipe Data | Constraint | Default | Keterangan |
| :--- | :--- | :--- | :--- | :--- |
| `id` | UUID | PK, NOT NULL | | ID unik usaha |
| `citizen_id` | UUID | FK, NOT NULL | | Relasi ke `citizens.id` (Pemilik Usaha) |
| `business_name` | VARCHAR(255) | NOT NULL | | Nama unit usaha |
| `business_category` | ENUM | NOT NULL | | Opsi: `'culinary'`, `'fashion'`, `'agriculture'`, `'services'`, `'craft'`, `'trade'`, `'other'` |
| `license_number` | VARCHAR(100) | UNIQUE, NULLABLE| `null` | Nomor NIB / Izin usaha |
| `employee_count` | INTEGER | NOT NULL | `0` | Jumlah pekerja |
| `monthly_revenue` | DECIMAL(15,2)| NULLABLE | `0.00` | Omset bulanan |
| `legal_entity_type` | ENUM | NOT NULL | `'unregistered'`| Opsi: `'unregistered'`, `'sole_proprietorship'`, `'limited_partnership'`, `'limited_company'`, `'cooperative'` |
| `uses_digital_payment`| BOOLEAN | NOT NULL | `false` | Pemanfaatan pembayaran digital |
| `digita_platform_type`| ENUM | NOT NULL | `'none'` | Opsi: `'none'`, `'social_media'`, `'ecommerce'`, `'delivery_app'`, `'ride_hailing'` |
| `capital_source` | ENUM | NOT NULL | `'personal'` | Opsi: `'personal'`, `'bank_loan'`, `'goverment_credit'`, `'goverment_grant'`, `'family_relative'` |
| `is_environmentally_friendly`| BOOLEAN| NOT NULL | `false` | Standar ramah lingkungan |
| `bumdes_partnership_status`| ENUM| NOT NULL | `'none'` | Opsi: `'none'`, `'consigment_product'`, `'raw_material_supply'`, `'capital_invesment'`, `'marketing_cooperation'` |
| `created_at` | TIMESTAMP | NOT NULL | | |
| `updated_at` | TIMESTAMP | NOT NULL | | |
| `deleted_at` | TIMESTAMP | NULLABLE | `null` | Fitur _soft delete_ |

### J. Infrastructures (Tabel `infrastructures`)
| Field | Tipe Data | Constraint | Default | Keterangan |
| :--- | :--- | :--- | :--- | :--- |
| `id` | UUID | PK, NOT NULL | | ID unik sarana fisik |
| `facility_name` | VARCHAR(255) | NOT NULL | | Nama fasilitas publik |
| `facility_type` | ENUM | NOT NULL | | Opsi: `'road'`, `'bridge'`, `'irrigation'`, `'education'`, `'health'`, `'worship'`, `'goverment'` |
| `condition` | ENUM | NOT NULL | `'good'` | Opsi: `'good'`, `'damaged_light'`, `'damaged_severe'` |
| `construction_year` | YEAR | UNIQUE, NULLABLE| `null` | Tahun pembangunan fisik |
| `funding_source` | VARCHAR(100) | NOT NULL | `'0'` | Asal sumber dana pembangunan |
| `created_at` | TIMESTAMP | NOT NULL | | |
| `updated_at` | TIMESTAMP | NOT NULL | | |
| `deleted_at` | TIMESTAMP | NULLABLE | `null` | Fitur _soft delete_ |

### K. Child Growth Logs (Tabel `child_growth_logs`)
| Field | Tipe Data | Constraint | Default | Keterangan |
| :--- | :--- | :--- | :--- | :--- |
| `id` | UUID | PK, NOT NULL | | ID unik berkas log |
| `citizen_id` | UUID | FK, NOT NULL | | Relasi ke `citizens.id` (Entitas Balita terkait) |
| `measured_at` | DATE | NOT NULL | | Tanggal pelaksanaan pengukuran fisik |
| `weight` | DECIMAL(5,2)| NOT NULL | | Berat badan (kg), contoh: `9.40` |
| `height` | DECIMAL(5,2)| NOT NULL | | Tinggi atau panjang badan (cm), contoh: `76.50` |
| `measurement_method` | ENUM | NOT NULL | `'recumbent'` | Opsi posisi: `'recumbent'` (telentang), `'standing'` (berdiri) |
| `vit_a_received` | BOOLEAN | NOT NULL | `false` | Status pemberian vitamin A bulan ini |
| `stunting_status` | ENUM | NOT NULL | `'normal'` | Hasil hitung otomatis Z-Score: `'normal'`, `'stunted'`, `'severely_stunted'` |
| `recorded_by` | UUID | FK, NULLABLE | `null` | Relasi ke `users.id` (Kader/Operator penginput data) |
| `notes` | TEXT | NULLABLE | `null` | Catatan perkembangan |
| `created_at` | TIMESTAMP | NOT NULL | | |
| `updated_at` | TIMESTAMP | NOT NULL | | |

### L. Spatial Data (Tabel `spatial_data`)
| Field | Tipe Data | Constraint | Default | Keterangan |
| :--- | :--- | :--- | :--- | :--- |
| `id` | UUID | PK, NOT NULL | | ID unik data spasial (UUID v4) |
| `feature_type` | VARCHAR(255) | NOT NULL | | Nama Class Model Terkait (Contoh: `'App\Models\Msme'`, `'App\Models\Infrastructure'`, `'App\Models\Territory'`) |
| `feature_id` | UUID | NOT NULL | | ID unik entitas dari tabel asal yang dituju |
| `latitude` | DECIMAL(10,8) | NULLABLE | `null` | Titik koordinat lintang (Bisa null jika data berupa daerah/polygon murni) |
| `longitude` | DECIMAL(11,8) | NULLABLE | `null` | Titik koordinat bujur (Bisa null jika data berupa daerah/polygon murni) |
| `geojson` | JSON | NULLABLE | `null` | Data geometri kompleks format GeoJSON (Untuk bentuk jalan/garis pembatas RT/RW) |
| `created_at` | TIMESTAMP | NOT NULL | | |
| `updated_at` | TIMESTAMP | NOT NULL | | |
| `deleted_at` | TIMESTAMP | NULLABLE | `null` | Fitur _soft delete_ |

---

## 📐 Summary Aturan Nilai Enum
* **Users (`role`)**: `['admin', 'operator', 'head_of_rw', 'head_of_rt']`
* **Citizens (`family_role`)**: `['head_of_family', 'spouse', 'child', 'parent', 'other_relative']`
* **Citizens (`gender`)**: `['male', 'female']`
* **Citizens (`religion`)**: `['islam', 'protestant', 'catholic', 'hindu', 'buddha', 'confucian', 'other']`
* **Citizens (`marital_status`)**: `['single', 'married', 'divorced', 'widowed']`
* **Education Profiles (`education_level` / `highest_diploma`)**: `['none', 'elementary_school', 'middle_school', 'high_school', 'associate_degree', 'bachelor_degree', 'postgraduate']`
* **Education Profiles (`school_participation`)**: `['not_yet_in_school', 'currently_in_school', 'no_longer_in_school']`
* **Employment Profiles (`job_sector`)**: `['agriculture', 'manufacturing', 'trade_services goverment', 'other']`
* **Employment Profiles (`employment_status`)**: `['employee', 'employer_assisted', 'employer_unassisted', 'self_employed', 'casual_worker', 'unpaid_worker']`
* **Employment Profiles (`economic_status`)**: `['very_poor', 'poor', 'near_poor', 'middle_income', 'high_income']`
* **Health Profiles (`disability_type`)**: `['none', 'physical', 'intellectual', 'mental', 'sensory']`
* **Health Profiles (`kb_method`)**: `['none', 'injection', 'pill', 'condom', 'implant', 'iud', 'tubal_ligation', 'vasectomy']`
* **Health Profiles (`bpjs_status`)**: `['none', 'goverment_subsidized', 'independent_member', 'company_member']`
* **Housing Profiles (`house_ownership`)**: `['owned', 'rented', 'free_rent', 'official_house']`
* **Housing Profiles (`house_condition`)**: `['proper', 'unfit']`
* **Housing Profiles (`floor_material`)**: `['marble_granite', 'ceramic_tile', 'cement_brick', 'wood_timber', 'bamboo', 'dirt_earth']`
* **Housing Profiles (`wall_material`)**: `['mansory_brick', 'reinforced_concrete', 'wood_plank', 'bamboo_woven', 'logs_thatch']`
* **Housing Profiles (`roof_material`)**: `['concrete_tile', 'clay_tile', 'metal_sheet', 'asbestos', 'thatch_palm']`
* **Housing Profiles (`water_source`)**: `['piped_water', 'protected_well', 'bore_well', 'spring_water', 'river_rainwater']`
* **Housing Profiles (`sanitation_type`)**: `['private_flush_toilet', 'shared_flush_toilet', 'pit_latrine', 'no_toilet']`
* **Housing Profiles (`cooking_fuel`)**: `['electricity', 'lpg_gas', 'kerosene', 'biogas', 'wood_charcoal']`
* **Housing Profiles (`electricity_source`)**: `['pln_metered', 'pln_unmetered', 'non_pln', 'no_electricity']`
* **Housing Profiles (`electricity_capacity`)**: `['non_electricity', '450va', '900va', '1300va', '2200va', 'above_2200va']`
* **MSMEs (`business_category`)**: `['culinary', 'fashion', 'agriculture', 'services', 'craft', 'trade', 'other']`
* **MSMEs (`legal_entity_type`)**: `['unregistered', 'sole_proprietorship', 'limited_partnership', 'limited_company', 'cooperative']`
* **MSMEs (`digita_platform_type`)**: `['none', 'social_media', 'ecommerce', 'delivery_app', 'ride_hailing']`
* **MSMEs (`capital_source`)**: `['personal', 'bank_loan', 'goverment_credit', 'goverment_grant', 'family_relative']`
* **MSMEs (`bumdes_partnership_status`)**: `['none', 'consigment_product', 'raw_material_supply', 'capital_invesment', 'marketing_cooperation']`
* **Infrastructures (`facility_type`)**: `['road', 'bridge', 'irrigation', 'education', 'health', 'worship', 'goverment']`
* **Infrastructures (`condition`)**: `['good', 'damaged_light', 'damaged_severe']`
* **Child Growth Logs (`measurement_method`)**: `['recumbent', 'standing']`
* **Child Growth Logs (`stunting_status`)**: `['normal', 'stunted', 'severely_stunted']`
