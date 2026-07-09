# 🏡 Desa Cantik App - Database & Project Specification

Dokumen ini berfungsi sebagai cetak biru (_blueprint_) arsitektur data, kamus data (_Data Dictionary_), aturan bisnis, serta peta jalan pengembangan aplikasi **Desa Cantik App**. Gunakan file ini sebagai context utama saat berdiskusi dengan AI Assistant/LLM agar instruksi pembuatan kode program tetap konsisten.

---

# 📌 1. Gambaran Umum Proyek

**Desa Cantik App** adalah sistem informasi manajemen berbasis wilayah yang mengintegrasikan data kependudukan (demografi), kondisi sosial ekonomi, unit usaha produktif (UMKM), inventarisasi sarana fisik, pemantauan tumbuh kembang anak (stunting), serta visualisasi pemetaan geografis (GIS).

---

# 🗂️ 2. Skema Tabel & Kamus Data (Database Schema)

## A. Authentication: Users

Menyimpan data pengguna yang memiliki hak akses untuk mengelola sistem aplikasi.

### Nama Tabel: `users`

| Field          | Tipe Data    | Constraint   | Default      | Keterangan                                                    |
| :------------- | :----------- | :----------- | :----------- | :------------------------------------------------------------ |
| `id`           | UUID         | PK, NOT NULL |              | ID unik user (UUID v4)                                        |
| `username`     | UUID         | FK, NOT NULL |              | Relasi ke `citizens.id` (Warga yang menjadi user)             |
| `password`     | VARCHAR(255) | NOT NULL     | `'resident'` | Password akun terenkripsi                                     |
| `full_name`    | VARCHAR(255) | NOT NULL     |              | Nama lengkap pengguna                                         |
| `territory_id` | UUID         | FK, NULLABLE | `null`       | Relasi ke `territories.id` (Batasan wilayah tugas)            |
| `role`         | ENUM         | NULLABLE     |              | Opsi: `'admin'`, `'operator'`, `'head_of_rw'`, `'head_of_rt'` |
| `created_at`   | TIMESTAMP    | NOT NULL     |              |                                                               |
| `updated_at`   | TIMESTAMP    | NOT NULL     |              |                                                               |
| `deleted_at`   | TIMESTAMP    | NULLABLE     | `null`       | Fitur _soft delete_                                           |

---

## B. Master Data: Territoties

Menyimpan data hierarki administratif terkecil di tingkat desa (Dusun, RW, RT).

### Nama Tabel: `territoties` _(Catatan: Mengikuti penamaan skema)_

| Field         | Tipe Data    | Constraint   | Default | Keterangan                 |
| :------------ | :----------- | :----------- | :------ | :------------------------- |
| `id`          | UUID         | PK, NOT NULL |         | ID unik wilayah (UUID v4)  |
| `sub_village` | VARCHAR(100) | NOT NULL     |         | Nama Dusun                 |
| `area_name`   | VARCHAR(100) | NULLABLE     |         | Nama blok / area / kampung |
| `rw`          | VARCHAR(5)   | NOT NULL     |         | Nomor RW                   |
| `rt`          | VARCHAR(5)   | NOT NULL     |         | Nomor RT                   |
| `created_at`  | TIMESTAMP    | NOT NULL     |         |                            |
| `updated_at`  | TIMESTAMP    | NOT NULL     |         |                            |
| `deleted_at`  | TIMESTAMP    | NULLABLE     | `null`  | Fitur _soft delete_        |

---

## C. Master Data: Families

Menyimpan data Kartu Keluarga (KK) sebagai basis rumah tangga desa.

### Nama Tabel: `families`

| Field                | Tipe Data   | Constraint   | Default | Keterangan                       |
| :------------------- | :---------- | :----------- | :------ | :------------------------------- |
| `id`                 | UUID        | PK, NOT NULL |         | ID unik keluarga (UUID v4)       |
| `territory_id`       | UUID        | FK, NOT NULL |         | Relasi ke `territoties.id`       |
| `family_card_number` | VARCHAR(16) | NOT NULL     |         | Nomor Kartu Keluarga (16 digit)  |
| `address_detail`     | TEXT        | NULLABLE     |         | Detail alamat fisik rumah tangga |
| `created_at`         | TIMESTAMP   | NOT NULL     |         |                                  |
| `updated_at`         | TIMESTAMP   | NOT NULL     |         |                                  |
| `deleted_at`         | TIMESTAMP   | NULLABLE     | `null`  | Fitur _soft delete_              |

---

## D. Master Data: Citizens

Menyimpan identitas dasar seluruh individu warga desa (termasuk bayi/balita).

### Nama Tabel: `citizens`

| Field            | Tipe Data    | Constraint   | Default    | Keterangan                                                                                     |
| :--------------- | :----------- | :----------- | :--------- | :--------------------------------------------------------------------------------------------- |
| `id`             | UUID         | PK, NOT NULL |            | ID unik warga (UUID v4)                                                                        |
| `family_id`      | UUID         | FK, NOT NULL |            | Relasi ke `families.id`                                                                        |
| `id_number`      | VARCHAR(16)  | NOT NULL     |            | NIB / NIK warga                                                                                |
| `full_name`      | VARCHAR(255) | NOT NULL     |            | Nama lengkap sesuai KTP                                                                        |
| `family_role`    | ENUM         | NOT NULL     |            | Opsi: `'head_of_family'`, `'spouse'`, `'child'`, `'parent'`, `'other_relative'`                |
| `gender`         | ENUM         | NOT NULL     | `'male'`   | Opsi: `'male'`, `'female'`                                                                     |
| `birth_place`    | VARCHAR(100) | NOT NULL     |            | Tempat lahir                                                                                   |
| `birth_date`     | DATE         | NULLABLE     |            | Tanggal lahir (Basis hitung umur stunting)                                                     |
| `blood_type`     | VARCHAR(5)   | NULLABLE     | `null`     | Golongan darah (A, B, AB, O, dll)                                                              |
| `religion`       | ENUM         | NOT NULL     |            | Opsi: `'islam'`, `'protestant'`, `'catholic'`, `'hindu'`, `'buddha'`, `'confucian'`, `'other'` |
| `marital_status` | ENUM         | NOT NULL     | `'single'` | Opsi: `'single'`, `'married'`, `'divorced'`, `'widowed'`                                       |
| `created_at`     | TIMESTAMP    | NOT NULL     |            |                                                                                                |
| `updated_at`     | TIMESTAMP    | NOT NULL     |            |                                                                                                |
| `deleted_at`     | TIMESTAMP    | NULLABLE     | `null`     | Fitur _soft delete_                                                                            |

---

## E. Education Profiles

Menyimpan profil kualifikasi pendidikan warga.

### Nama Tabel: `education_profiles`

| Field                  | Tipe Data | Constraint   | Default  | Keterangan                                                                                                                             |
| :--------------------- | :-------- | :----------- | :------- | :------------------------------------------------------------------------------------------------------------------------------------- |
| `id`                   | UUID      | PK, NOT NULL |          | ID unik profil pendidikan                                                                                                              |
| `citizen_id`           | UUID      | FK, NOT NULL |          | Relasi ke `citizens.id`                                                                                                                |
| `education_level`      | ENUM      | NOT NULL     | `'none'` | Opsi: `'none'`, `'elementary_school'`, `'middle_school'`, `'high_school'`, `'associate_degree'`, `'bachelor_degree'`, `'postgraduate'` |
| `highest_diploma`      | ENUM      | NOT NULL     | `'none'` | Opsi sama dengan `education_level`                                                                                                     |
| `school_participation` | ENUM      | NOT NULL     |          | Opsi: `'not_yet_in_school'`, `'currently_in_school'`, `'no_longer_in_school'`                                                          |
| `created_at`           | TIMESTAMP | NOT NULL     |          |                                                                                                                                        |
| `updated_at`           | TIMESTAMP | NOT NULL     |          |                                                                                                                                        |
| `deleted_at`           | TIMESTAMP | NULLABLE     | `null`   | Fitur _soft delete_                                                                                                                    |

---

## F. Employment Profiles

Menyimpan data kondisi pekerjaan dan ekonomi warga angkatan kerja.

### Nama Tabel: `employment_profiles`

| Field                  | Tipe Data     | Constraint   | Default           | Keterangan                                                                                                                  |
| :--------------------- | :------------ | :----------- | :---------------- | :-------------------------------------------------------------------------------------------------------------------------- |
| `id`                   | UUID          | PK, NOT NULL |                   | ID unik profil ekonomi                                                                                                      |
| `citizen_id`           | UUID          | FK, NOT NULL |                   | Relasi ke `citizens.id`                                                                                                     |
| `occupation`           | VARCHAR(100)  | NOT NULL     |                   | Jenis pekerjaan spesifik                                                                                                    |
| `job_sector`           | ENUM          | NOT NULL     | `'other'`         | Opsi: `'agriculture'`, `'manufacturing'`, `'trade_services goverment'`, `'other'` _(Catatan: ada typo bawaan skema)_        |
| `employment_status`    | ENUM          | NOT NULL     | `'unpaid_worker'` | Opsi: `'employee'`, `'employer_assisted'`, `'employer_unassisted'`, `'self_employed'`, `'casual_worker'`, `'unpaid_worker'` |
| `monthly_income`       | DECIMAL(15,2) | NULLABLE     |                   | Nominal pendapatan bulanan                                                                                                  |
| `economic_status`      | ENUM          | NOT NULL     |                   | Opsi: `'very_poor'`, `'poor'`, `'near_poor'`, `'middle_income'`, `'high_income'`                                            |
| `is_welfare_recipient` | BOOLEAN       | NOT NULL     | `false`           | Status penerima jaring pengaman sosial/bansos                                                                               |
| `assistance_type`      | VARCHAR(255)  | NULLABLE     | `null`            | Nama program bantuan yang diterima                                                                                          |
| `created_at`           | TIMESTAMP     | NOT NULL     |                   |                                                                                                                             |
| `updated_at`           | TIMESTAMP     | NOT NULL     |                   |                                                                                                                             |
| `deleted_at`           | TIMESTAMP     | NULLABLE     | `null`            | Fitur _soft delete_                                                                                                         |

---

## G. Health Profiles

Menyimpan data kesehatan dasar, disabilitas, dan jaminan sosial individu warga.

### Nama Tabel: `health_profiles`

| Field             | Tipe Data | Constraint   | Default  | Keterangan                                                                                                              |
| :---------------- | :-------- | :----------- | :------- | :---------------------------------------------------------------------------------------------------------------------- |
| `id`              | UUID      | PK, NOT NULL |          | ID unik profil kesehatan                                                                                                |
| `citizen_id`      | UUID      | FK, NOT NULL |          | Relasi ke `citizens.id`                                                                                                 |
| `disability_type` | ENUM      | NOT NULL     | `'none'` | Opsi: `'none'`, `'physical'`, `'intellectual'`, `'mental'`, `'sensory'`                                                 |
| `is_pregnant`     | BOOLEAN   | NOT NULL     | `false`  | Status kehamilan                                                                                                        |
| `kb_method`       | ENUM      | NOT NULL     | `'none'` | Opsi: `'none'`, `'injection'`, `'pill'`, `'condom'`, `'implant'`, `'iud'`, `'tubal_ligation'`, `'vasectomy'`            |
| `bpjs_status`     | ENUM      | NOT NULL     | `'none'` | Opsi: `'none'`, `'goverment_subsidized'`, `'independent_member'`, `'company_member'` _(Catatan: ada typo bawaan skema)_ |
| `created_at`      | TIMESTAMP | NOT NULL     |          |                                                                                                                         |
| `updated_at`      | TIMESTAMP | NOT NULL     |          |                                                                                                                         |
| `deleted_at`      | TIMESTAMP | NULLABLE     | `null`   | Fitur _soft delete_                                                                                                     |

---

## H. Housing Profiles

Menyimpan kondisi fisik hunian dan utilitas domestik pada tingkat rumah tangga.

### Nama Tabel: `housing_profiles`

| Field                  | Tipe Data | Constraint   | Default                  | Keterangan                                                                                                |
| :--------------------- | :-------- | :----------- | :----------------------- | :-------------------------------------------------------------------------------------------------------- |
| `id`                   | UUID      | PK, NOT NULL |                          | ID unik profil rumah                                                                                      |
| `family_id`            | UUID      | FK, NOT NULL |                          | Relasi ke `families.id` (1 KK = 1 Rumah)                                                                  |
| `house_ownership`      | ENUM      | NULLABLE     | `null`                   | Opsi: `'owned'`, `'rented'`, `'free_rent'`, `'official_house'`                                            |
| `house_condition`      | ENUM      | NOT NULL     |                          | Opsi: `'proper'`, `'unfit'`                                                                               |
| `floor_material`       | ENUM      | NOT NULL     | `'cement_brick'`         | Opsi: `'marble_granite'`, `'ceramic_tile'`, `'cement_brick'`, `'wood_timber'`, `'bamboo'`, `'dirt_earth'` |
| `wall_material`        | ENUM      | NOT NULL     | `'mansory_brick'`        | Opsi: `'mansory_brick'`, `'reinforced_concrete'`, `'wood_plank'`, `'bamboo_woven'`, `'logs_thatch'`       |
| `roof_material`        | ENUM      | NOT NULL     | `'clay_tile'`            | Opsi: `'concrete_tile'`, `'clay_tile'`, `'metal_sheet'`, `'asbestos'`, `'thatch_palm'`                    |
| `water_source`         | ENUM      | NOT NULL     | `'protected_well'`       | Opsi: `'piped_water'`, `'protected_well'`, `'bore_well'`, `'spring_water'`, `'river_rainwater'`           |
| `sanitation_type`      | ENUM      | NOT NULL     | `'private_flush_toilet'` | Opsi: `'private_flush_toilet'`, `'shared_flush_toilet'`, `'pit_latrine'`, `'no_toilet'`                   |
| `cooking_fuel`         | ENUM      | NOT NULL     | `'lpg_gas'`              | Opsi: `'electricity'`, `'lpg_gas'`, `'kerosene'`, `'biogas'`, `'wood_charcoal'`                           |
| `electricity_source`   | ENUM      | NOT NULL     | `'pln_metered'`          | Opsi: `'pln_metered'`, `'pln_unmetered'`, `'non_pln'`, `'no_electricity'`                                 |
| `electricity_capacity` | ENUM      | NOT NULL     | `'900va'`                | Opsi: `'non_electricity'`, `'450va'`, `'900va'`, `'1300va'`, `'2200va'`, `'above_2200va'`                 |
| `created_at`           | TIMESTAMP | NOT NULL     |                          |                                                                                                           |
| `updated_at`           | TIMESTAMP | NOT NULL     |                          |                                                                                                           |
| `deleted_at`           | TIMESTAMP | NULLABLE     | `null`                   | Fitur _soft delete_                                                                                       |

---

## I. MSMEs

Menyimpan data unit ekonomi produktif/UMKM yang dimiliki warga desa.

### Nama Tabel: `msmes`

| Field                         | Tipe Data     | Constraint       | Default          | Keterangan                                                                                                                                       |
| :---------------------------- | :------------ | :--------------- | :--------------- | :----------------------------------------------------------------------------------------------------------------------------------------------- |
| `id`                          | UUID          | PK, NOT NULL     |                  | ID unik usaha                                                                                                                                    |
| `citizen_id`                  | UUID          | FK, NOT NULL     |                  | Relasi ke `citizens.id` (Pemilik Usaha)                                                                                                          |
| `business_name`               | VARCHAR(255)  | NOT NULL         |                  | Nama unit usaha                                                                                                                                  |
| `business_category`           | ENUM          | NOT NULL         |                  | Opsi: `'culinary'`, `'fashion'`, `'agriculture'`, `'services'`, `'craft'`, `'trade'`, `'other'`                                                  |
| `license_number`              | VARCHAR(100)  | UNIQUE, NULLABLE | `null`           | Nomor NIB / Izin usaha                                                                                                                           |
| `employee_count`              | INTEGER       | NOT NULL         | `0`              | Jumlah pekerja                                                                                                                                   |
| `monthly_revenue`             | DECIMAL(15,2) | NULLABLE         | `0.00`           | Omset bulanan                                                                                                                                    |
| `legal_entity_type`           | ENUM          | NOT NULL         | `'unregistered'` | Opsi: `'unregistered'`, `'sole_proprietorship'`, `'limited_partnership'`, `'limited_company'`, `'cooperative'`                                   |
| `uses_digital_payment`        | BOOLEAN       | NOT NULL         | `false`          | Pemanfaatan pembayaran digital                                                                                                                   |
| `digita_platform_type`        | ENUM          | NOT NULL         | `'none'`         | Opsi: `'none'`, `'social_media'`, `'ecommerce'`, `'delivery_app'`, `'ride_hailing'` _(Catatan: Typo bawaan skema)_                               |
| `capital_source`              | ENUM          | NOT NULL         | `'personal'`     | Opsi: `'personal'`, `'bank_loan'`, `'goverment_credit'`, `'goverment_grant'`, `'family_relative'` _(Catatan: Typo bawaan skema)_                 |
| `is_environmentally_friendly` | BOOLEAN       | NOT NULL         | `false`          | Standar ramah lingkungan                                                                                                                         |
| `bumdes_partnership_status`   | ENUM          | NOT NULL         | `'none'`         | Opsi: `'none'`, `'consigment_product'`, `'raw_material_supply'`, `'capital_invesment'`, `'marketing_cooperation'` _(Catatan: Typo bawaan skema)_ |
| `created_at`                  | TIMESTAMP     | NOT NULL         |                  |                                                                                                                                                  |
| `updated_at`                  | TIMESTAMP     | NOT NULL         |                  |                                                                                                                                                  |
| `deleted_at`                  | TIMESTAMP     | NULLABLE         | `null`           | Fitur _soft delete_                                                                                                                              |

---

## J. Infrastructures

Menyimpan data aset fisik fasilitas umum dan sarana infrastruktur desa.

### Nama Tabel: `infrastructures`

| Field               | Tipe Data    | Constraint       | Default  | Keterangan                                                                                                                       |
| :------------------ | :----------- | :--------------- | :------- | :------------------------------------------------------------------------------------------------------------------------------- |
| `id`                | UUID         | PK, NOT NULL     |          | ID unik sarana fisik                                                                                                             |
| `facility_name`     | VARCHAR(255) | NOT NULL         |          | Nama fasilitas publik                                                                                                            |
| `facility_type`     | ENUM         | NOT NULL         |          | Opsi: `'road'`, `'bridge'`, `'irrigation'`, `'education'`, `'health'`, `'worship'`, `'goverment'` _(Catatan: Typo bawaan skema)_ |
| `condition`         | ENUM         | NOT NULL         | `'good'` | Opsi: `'good'`, `'damaged_light'`, `'damaged_severe'`                                                                            |
| `construction_year` | YEAR         | UNIQUE, NULLABLE | `null`   | Tahun pembangunan fisik                                                                                                          |
| `funding_source`    | VARCHAR(100) | NOT NULL         | `'0'`    | Asal sumber dana pembangunan                                                                                                     |
| `created_at`        | TIMESTAMP    | NOT NULL         |          |                                                                                                                                  |
| `updated_at`        | TIMESTAMP    | NOT NULL         |          |                                                                                                                                  |
| `deleted_at`        | TIMESTAMP    | NULLABLE         | `null`   | Fitur _soft delete_                                                                                                              |

---

## K. Child Growth Logs (New Module)

Tabel khusus bersifat modular untuk melacak riwayat tumbuh kembang berkala balita (0-5 tahun) di Posyandu sebagai dasar perhitungan statistik stunting.

### Nama Tabel: `child_growth_logs`

| Field                | Tipe Data    | Constraint   | Default       | Keterangan                                                                   |
| :------------------- | :----------- | :----------- | :------------ | :--------------------------------------------------------------------------- |
| `id`                 | UUID         | PK, NOT NULL |               | ID unik berkas log                                                           |
| `citizen_id`         | UUID         | FK, NOT NULL |               | Relasi ke `citizens.id` (Entitas Balita terkait)                             |
| `measured_at`        | DATE         | NOT NULL     |               | Tanggal pelaksanaan pengukuran fisik                                         |
| `weight`             | DECIMAL(5,2) | NOT NULL     |               | Berat badan (kg), contoh: `9.40`                                             |
| `height`             | DECIMAL(5,2) | NOT NULL     |               | Tinggi atau panjang badan (cm), contoh: `76.50`                              |
| `measurement_method` | ENUM         | NOT NULL     | `'recumbent'` | Opsi posisi: `'recumbent'` (telentang), `'standing'` (berdiri)               |
| `vit_a_received`     | BOOLEAN      | NOT NULL     | `false`       | Status pemberian vitamin A bulan ini                                         |
| `stunting_status`    | ENUM         | NOT NULL     | `'normal'`    | Hasil hitung otomatis Z-Score: `'normal'`, `'stunted'`, `'severely_stunted'` |
| `recorded_by`        | UUID         | FK, NULLABLE | `null`        | Relasi ke `users.id` (Kader/Operator penginput data)                         |
| `notes`              | TEXT         | NULLABLE     | `null`        | Catatan perkembangan (Contoh: "Sedang demam/diare")                          |
| `created_at`         | TIMESTAMP    | NOT NULL     |               |                                                                              |
| `updated_at`         | TIMESTAMP    | NOT NULL     |               |                                                                              |

---

## K. Child Growth Logs (New Module)

Tabel khusus bersifat modular untuk melacak riwayat tumbuh kembang berkala balita (0-5 tahun) di Posyandu sebagai dasar perhitungan statistik stunting.

### Nama Tabel: `child_growth_logs`

| Field                | Tipe Data    | Constraint   | Default       | Keterangan                                                                   |
| :------------------- | :----------- | :----------- | :------------ | :--------------------------------------------------------------------------- |
| `id`                 | UUID         | PK, NOT NULL |               | ID unik berkas log                                                           |
| `citizen_id`         | UUID         | FK, NOT NULL |               | Relasi ke `citizens.id` (Entitas Balita terkait)                             |
| `measured_at`        | DATE         | NOT NULL     |               | Tanggal pelaksanaan pengukuran fisik                                         |
| `weight`             | DECIMAL(5,2) | NOT NULL     |               | Berat badan (kg), contoh: `9.40`                                             |
| `height`             | DECIMAL(5,2) | NOT NULL     |               | Tinggi atau panjang badan (cm), contoh: `76.50`                              |
| `measurement_method` | ENUM         | NOT NULL     | `'recumbent'` | Opsi posisi: `'recumbent'` (telentang), `'standing'` (berdiri)               |
| `vit_a_received`     | BOOLEAN      | NOT NULL     | `false`       | Status pemberian vitamin A bulan ini                                         |
| `stunting_status`    | ENUM         | NOT NULL     | `'normal'`    | Hasil hitung otomatis Z-Score: `'normal'`, `'stunted'`, `'severely_stunted'` |
| `recorded_by`        | UUID         | FK, NULLABLE | `null`        | Relasi ke `users.id` (Kader/Operator penginput data)                         |
| `notes`              | TEXT         | NULLABLE     | `null`        | Catatan perkembangan (Contoh: "Sedang demam/diare")                          |
| `created_at`         | TIMESTAMP    | NOT NULL     |               |                                                                              |
| `updated_at`         | TIMESTAMP    | NOT NULL     |               |                                                                              |

---

# 📐 3. Nilai Enum (Enum Values Summary)

- **Users (`role`)**: `['admin', 'operator', 'head_of_rw', 'head_of_rt']`
- **Citizens (`family_role`)**: `['head_of_family', 'spouse', 'child', 'parent', 'other_relative']`
- **Citizens (`gender`)**: `['male', 'female']`
- **Citizens (`religion`)**: `['islam', 'protestant', 'catholic', 'hindu', 'buddha', 'confucian', 'other']`
- **Citizens (`marital_status`)**: `['single', 'married', 'divorced', 'widowed']`
- **Education Profiles (`education_level` / `highest_diploma`)**: `['none', 'elementary_school', 'middle_school', 'high_school', 'associate_degree', 'bachelor_degree', 'postgraduate']`
- **Education Profiles (`school_participation`)**: `['not_yet_in_school', 'currently_in_school', 'no_longer_in_school']`
- **Employment Profiles (`job_sector`)**: `['agriculture', 'manufacturing', 'trade_services goverment', 'other']`
- **Employment Profiles (`employment_status`)**: `['employee', 'employer_assisted', 'employer_unassisted', 'self_employed', 'casual_worker', 'unpaid_worker']`
- **Employment Profiles (`economic_status`)**: `['very_poor', 'poor', 'near_poor', 'middle_income', 'high_income']`
- **Health Profiles (`disability_type`)**: `['none', 'physical', 'intellectual', 'mental', 'sensory']`
- **Health Profiles (`kb_method`)**: `['none', 'injection', 'pill', 'condom', 'implant', 'iud', 'tubal_ligation', 'vasectomy']`
- **Health Profiles (`bpjs_status`)**: `['none', 'goverment_subsidized', 'independent_member', 'company_member']`
- **Housing Profiles (`house_ownership`)**: `['owned', 'rented', 'free_rent', 'official_house']`
- **Housing Profiles (`house_condition`)**: `['proper', 'unfit']`
- **Housing Profiles (`floor_material`)**: `['marble_granite', 'ceramic_tile', 'cement_brick', 'wood_timber', 'bamboo', 'dirt_earth']`
- **Housing Profiles (`wall_material`)**: `['mansory_brick', 'reinforced_concrete', 'wood_plank', 'bamboo_woven', 'logs_thatch']`
- **Housing Profiles (`roof_material`)**: `['concrete_tile', 'clay_tile', 'metal_sheet', 'asbestos', 'thatch_palm']`
- **Housing Profiles (`water_source`)**: `['piped_water', 'protected_well', 'bore_well', 'spring_water', 'river_rainwater']`
- **Housing Profiles (`sanitation_type`)**: `['private_flush_toilet', 'shared_flush_toilet', 'pit_latrine', 'no_toilet']`
- **Housing Profiles (`cooking_fuel`)**: `['electricity', 'lpg_gas', 'kerosene', 'biogas', 'wood_charcoal']`
- **Housing Profiles (`electricity_source`)**: `['pln_metered', 'pln_unmetered', 'non_pln', 'no_electricity']`
- **Housing Profiles (`electricity_capacity`)**: `['non_electricity', '450va', '900va', '1300va', '2200va', 'above_2200va']`
- **MSMEs (`business_category`)**: `['culinary', 'fashion', 'agriculture', 'services', 'craft', 'trade', 'other']`
- **MSMEs (`legal_entity_type`)**: `['unregistered', 'sole_proprietorship', 'limited_partnership', 'limited_company', 'cooperative']`
- **MSMEs (`digita_platform_type`)**: `['none', 'social_media', 'ecommerce', 'delivery_app', 'ride_hailing']`
- **MSMEs (`capital_source`)**: `['personal', 'bank_loan', 'goverment_credit', 'goverment_grant', 'family_relative']`
- **MSMEs (`bumdes_partnership_status`)**: `['none', 'consigment_product', 'raw_material_supply', 'capital_invesment', 'marketing_cooperation']`
- **Infrastructures (`facility_type`)**: `['road', 'bridge', 'irrigation', 'education', 'health', 'worship', 'goverment']`
- **Infrastructures (`condition`)**: `['good', 'damaged_light', 'damaged_severe']`
- **Child Growth Logs (`measurement_method`)**: `['recumbent', 'standing']`
- **Child Growth Logs (`stunting_status`)**: `['normal', 'stunted', 'severely_stunted']`

---

# 🔗 4. Tata Hubungan Data (Database Relations)

1. **`users.username`** (UUID) ➜ `citizens.id` (Relasi 1-ke-1 terikat identitas warga asli)
2. **`users.territory_id`** (UUID) ➜ `territoties.id` (Membatasi wilayah tugas operator RW/RT)
3. **`territoties`** (1) ➜ `families` (N) (Satu RT/RW mencakup banyak Kartu Keluarga)
4. **`families`** (1) ➜ `citizens` (N) (Satu KK menampung anggota keluarga/warga)
5. **`families`** (1) ➜ `housing_profiles` (1) (Profil rumah tangga melekat pada KK)
6. **`citizens`** (1) ➜ `education_profiles` (1) (Setiap warga memiliki opsional profil pendidikan)
7. **`citizens`** (1) ➜ `employment_profiles` (1) (Setiap warga dewasa memiliki opsional profil ekonomi)
8. **`citizens`** (1) ➜ `health_profiles` (1) (Setiap warga memiliki profil kesehatan)
9. **`citizens`** (1) ➜ `msmes` (N) (Satu warga bisa memiliki banyak unit UMKM)
10. **`citizens`** (1) ➜ `child_growth_logs` (N) (Satu balita memiliki banyak riwayat timbangan berkala - _One-to-Many Optional_)

---

# 🚀 5. Alur Rencana Rilis (Development Roadmap)

## FASE 1 — Inti Kependudukan & Autentikasi

- `users`
- `territoties`
- `families`
- `citizens`

## FASE 2 — Profiling Tematik Individu & Rumah Tangga (Alur UI Modular)

- `education_profiles`
- `employment_profiles`
- `health_profiles`
- `housing_profiles`

## FASE 3 — Kesehatan Khusus & Pemantauan Stunting

- `child_growth_logs`
- Dashboard Analisis Intervensi Stunting Balita

## FASE 4 — Potensi Ekonomi & Sarana Publik Desa

- `msmes`
- `infrastructures`

---

# 📊 6. Panduan Pemetaan Dashboard (Dashboard Mapping Guide)

### Dashboard Sosial & Demografi

| Statistik                  | Sumber Tabel         | Kolom Pendukung                       |
| :------------------------- | :------------------- | :------------------------------------ |
| **Agama**                  | `citizens`           | `religion`                            |
| **Pendidikan Terakhir**    | `education_profiles` | `education_level` / `highest_diploma` |
| **Partisipasi Sekolah**    | `education_profiles` | `school_participation`                |
| **Penerima BPJS**          | `health_profiles`    | `bpjs_status`                         |
| **Metode KB Warga**        | `health_profiles`    | `kb_method`                           |
| **Penyandang Disabilitas** | `health_profiles`    | `disability_type`                     |
| **Jumlah Ibu Hamil**       | `health_profiles`    | `is_pregnant`                         |

### Dashboard Pemantauan Stunting (New)

| Statistik                       | Sumber Tabel                                                          | Kolom Pendukung                                                               |
| :------------------------------ | :-------------------------------------------------------------------- | :---------------------------------------------------------------------------- |
| **Total Angka Stunting**        | `child_growth_logs`                                                   | `stunting_status` (Hitung tren per bulan terbaru)                             |
| **Korelasi Ekonomi & Stunting** | `child_growth_logs` ➜ `citizens` ➜ `families` ➜ `employment_profiles` | Mencocokkan `stunting_status` balita dengan `economic_status` kepala keluarga |
| **Sebaran Stunting per RT/RW**  | `child_growth_logs` ➜ `citizens` ➜ `families` ➜ `territoties`         | Mengelompokkan total balita stunting berdasarkan `rt` dan `rw`                |
| **Cakupan Vitamin A Bulanan**   | `child_growth_logs`                                                   | `vit_a_received`                                                              |
| **Tren Tumbuh Kembang Anak**    | `child_growth_logs`                                                   | Grafik garis (`height` & `weight` berdasarkan urutan `measured_at`)           |

### Dashboard Ekonomi & Kesejahteraan

| Statistik                       | Sumber Tabel          | Kolom Pendukung                            |
| :------------------------------ | :-------------------- | :----------------------------------------- |
| **Mata Pencaharian**            | `employment_profiles` | `occupation` / `job_sector`                |
| **Rata-rata Pendapatan**        | `employment_profiles` | `monthly_income`                           |
| **Status Ekonomi Warga**        | `employment_profiles` | `economic_status`                          |
| **Penerima Bantuan Sosial**     | `employment_profiles` | `is_welfare_recipient` / `assistance_type` |
| **Kepemilikan & Kondisi Rumah** | `housing_profiles`    | `house_ownership` / `house_condition`      |
| **Sanitasi & Air Bersih**       | `housing_profiles`    | `sanitation_type` / `water_source`         |

### Dashboard UMKM & Potensi Desa

| Statistik                   | Sumber Tabel      | Kolom Pendukung                                 |
| :-------------------------- | :---------------- | :---------------------------------------------- |
| **Kategori & Sektor Usaha** | `msmes`           | `business_name` / `business_category`           |
| **Legalitas Usaha (NIB)**   | `msmes`           | `legal_entity_type` / `license_number`          |
| **Adopsi Pasar Digital**    | `msmes`           | `uses_digital_payment` / `digita_platform_type` |
| **Permodalan & Kemitraan**  | `msmes`           | `capital_source` / `bumdes_partnership_status`  |
| **Kondisi Fasilitas Umum**  | `infrastructures` | `facility_type` / `condition`                   |

---

## 💻 Target Teknis Implementasi

- Framework: Laravel 11
- Database: MySQL
- ORM: Eloquent (HasUuids)
- Desain UI: Modular Profile Page dengan Tombol Aksi Mandiri (`➕ Tambah Profil`)
