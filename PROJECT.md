# 🏡 Desa Cantik App - Database & Project Specification

Dokumen ini berfungsi sebagai cetak biru (_blueprint_) arsitektur data, kamus data (_Data Dictionary_), aturan bisnis, serta peta jalan pengembangan aplikasi **Desa Cantik App**. Gunakan file ini sebagai context utama saat berdiskusi dengan AI Assistant/LLM agar instruksi pembuatan kode program tetap konsisten.

---

# 📌 1. Gambaran Umum Proyek

**Desa Cantik App** adalah sistem informasi manajemen berbasis wilayah yang mengintegrasikan data kependudukan (demografi), kondisi sosial ekonomi, unit usaha produktif (UMKM), inventarisasi sarana fisik, serta visualisasi pemetaan geografis (GIS).

---

# 🗂️ 2. Skema Tabel & Kamus Data (Database Schema)

## A. Master Data: Territories

Menyimpan data hierarki administratif terkecil di tingkat desa (Dusun, RW, RT).

### Nama Tabel: `territories`

| Field | Tipe Data | Constraint | Default | Keterangan |
| :--- | :--- | :--- | :--- | :--- |
| `id` | BIGINT | PK, Auto Increment | | ID unik wilayah |
| `sub_village` | VARCHAR(100) | NOT NULL | | Nama Dusun |
| `area_name` | VARCHAR(100) | NULLABLE | NULL | Nama blok / area |
| `rw` | VARCHAR(5) | NOT NULL | | Nomor RW |
| `rt` | VARCHAR(5) | NOT NULL | | Nomor RT |
| `created_at` | TIMESTAMP | NOT NULL | CURRENT_TIMESTAMP | |
| `updated_at` | TIMESTAMP | NOT NULL | CURRENT_TIMESTAMP | |

---

## B. Master Data: Citizens

Menyimpan identitas dasar warga desa.

### Nama Tabel: `citizens`

| Field | Tipe Data | Constraint | Default | Keterangan |
| :--- | :--- | :--- | :--- | :--- |
| `id` | BIGINT | PK, Auto Increment | | ID internal |
| `id_number` | VARCHAR(16) | UNIQUE, NOT NULL | | NIK |
| `family_card_number` | VARCHAR(16) | NOT NULL | | Nomor KK |
| `full_name` | VARCHAR(255) | NOT NULL | | Nama lengkap |
| `family_role` | ENUM | NOT NULL | `'child'` | Hubungan keluarga |
| `gender` | ENUM | NOT NULL | | Jenis kelamin |
| `birth_place` | VARCHAR(100) | NOT NULL | | Tempat lahir |
| `birth_date` | DATE | NOT NULL | | Tanggal lahir |
| `blood_type` | ENUM | NULLABLE | NULL | Golongan darah |
| `religion` | ENUM | NOT NULL | `'islam'` | Agama |
| `marital_status` | ENUM | NOT NULL | `'single'` | Status pernikahan |
| `territory_id` | BIGINT | FK, NOT NULL | | Relasi ke territories |
| `disability_type` | ENUM | NOT NULL | `'none'` | Jenis disabilitas |
| `is_pregnant` | BOOLEAN | NOT NULL | false | Status kehamilan |
| `created_at` | TIMESTAMP | NOT NULL | CURRENT_TIMESTAMP | |
| `updated_at` | TIMESTAMP | NOT NULL | CURRENT_TIMESTAMP | |
| `deleted_at` | TIMESTAMP | NULLABLE | NULL | Soft delete |

---

## C. Education Profiles

Menyimpan profil pendidikan warga.

### Nama Tabel: `education_profiles`

| Field | Tipe Data | Constraint | Default | Keterangan |
| :--- | :--- | :--- | :--- | :--- |
| `id` | BIGINT | PK, Auto Increment | | |
| `citizen_id` | BIGINT | FK, UNIQUE, NOT NULL | | Relasi ke citizens |
| `education_level` | ENUM | NOT NULL | `'none'` | Jenjang pendidikan |
| `highest_diploma` | ENUM | NOT NULL | `'none'` | Ijazah terakhir |
| `school_participation` | ENUM | NOT NULL | `'not_attending'` | Status sekolah |
| `created_at` | TIMESTAMP | NOT NULL | CURRENT_TIMESTAMP | |
| `updated_at` | TIMESTAMP | NOT NULL | CURRENT_TIMESTAMP | |

---

## D. Employment Profiles

Menyimpan data pekerjaan dan ekonomi warga.

### Nama Tabel: `employment_profiles`

| Field | Tipe Data | Constraint | Default | Keterangan |
| :--- | :--- | :--- | :--- | :--- |
| `id` | BIGINT | PK, Auto Increment | | |
| `citizen_id` | BIGINT | FK, UNIQUE, NOT NULL | | Relasi ke citizens |
| `occupation` | VARCHAR(100) | NOT NULL | `'unemployed'` | Pekerjaan |
| `job_sector` | ENUM | NOT NULL | `'other'` | Sektor kerja |
| `employment_status` | ENUM | NOT NULL | `'unpaid_worker'` | Status kerja |
| `monthly_income` | DECIMAL(15,2) | NULLABLE | 0.00 | Pendapatan bulanan |
| `economic_status` | ENUM | NULLABLE | NULL | Tingkat ekonomi |
| `is_welfare_recipient` | BOOLEAN | NOT NULL | false | Penerima bansos |
| `assistance_type` | VARCHAR(100) | NULLABLE | NULL | Jenis bantuan |
| `created_at` | TIMESTAMP | NOT NULL | CURRENT_TIMESTAMP | |
| `updated_at` | TIMESTAMP | NOT NULL | CURRENT_TIMESTAMP | |

---

## E. Health Profiles

Menyimpan data kesehatan dan jaminan sosial.

### Nama Tabel: `health_profiles`

| Field | Tipe Data | Constraint | Default | Keterangan |
| :--- | :--- | :--- | :--- | :--- |
| `id` | BIGINT | PK, Auto Increment | | |
| `citizen_id` | BIGINT | FK, UNIQUE, NOT NULL | | Relasi ke citizens |
| `bpjs_status` | ENUM | NOT NULL | `'none'` | Kepesertaan BPJS |
| `kb_method` | ENUM | NOT NULL | `'none'` | Metode KB |
| `created_at` | TIMESTAMP | NOT NULL | CURRENT_TIMESTAMP | |
| `updated_at` | TIMESTAMP | NOT NULL | CURRENT_TIMESTAMP | |

---

## F. Housing Profiles

Menyimpan kondisi rumah dan utilitas rumah tangga.

### Nama Tabel: `housing_profiles`

| Field | Tipe Data | Constraint | Default | Keterangan |
| :--- | :--- | :--- | :--- | :--- |
| `id` | BIGINT | PK, Auto Increment | | |
| `citizen_id` | BIGINT | FK, UNIQUE, NOT NULL | | Relasi ke citizens |
| `house_ownership` | ENUM | NOT NULL | `'owned'` | Kepemilikan rumah |
| `house_condition` | ENUM | NOT NULL | `'proper'` | Kondisi rumah |
| `floor_material` | ENUM | NOT NULL | `'cement_brick'` | Material lantai |
| `wall_material` | ENUM | NOT NULL | `'masonry_brick'` | Material dinding |
| `roof_material` | ENUM | NOT NULL | `'clay_tile'` | Material atap |
| `water_source` | ENUM | NOT NULL | `'protected_well'` | Sumber air |
| `sanitation_type` | ENUM | NOT NULL | `'private_toilet'` | Sanitasi |
| `cooking_fuel` | ENUM | NOT NULL | `'lpg_gas'` | Bahan bakar |
| `electricity_source` | ENUM | NOT NULL | `'state_electricity_metered'` | Sumber listrik |
| `electricity_capacity` | ENUM | NOT NULL | `'900va'` | Daya listrik |
| `created_at` | TIMESTAMP | NOT NULL | CURRENT_TIMESTAMP | |
| `updated_at` | TIMESTAMP | NOT NULL | CURRENT_TIMESTAMP | |

---

## G. MSMEs

Menyimpan data UMKM warga.

### Nama Tabel: `msmes`

| Field | Tipe Data | Constraint | Default | Keterangan |
| :--- | :--- | :--- | :--- | :--- |
| `id` | BIGINT | PK, Auto Increment | | |
| `owner_id` | BIGINT | FK, NOT NULL | | Pemilik usaha |
| `business_name` | VARCHAR(255) | NOT NULL | | Nama usaha |
| `business_category` | ENUM | NOT NULL | `'other'` | Kategori usaha |
| `legal_entity_type` | ENUM | NOT NULL | `'unregistered'` | Legalitas usaha |
| `license_number` | VARCHAR(100) | UNIQUE, NULLABLE | NULL | Nomor izin |
| `employee_count` | INT | NOT NULL | 0 | Jumlah pegawai |
| `monthly_revenue` | DECIMAL(15,2) | NULLABLE | 0.00 | Omset bulanan |
| `uses_digital_payment` | BOOLEAN | NOT NULL | false | Pembayaran digital |
| `digital_platform_type` | ENUM | NOT NULL | `'none'` | Platform digital |
| `capital_source` | ENUM | NOT NULL | `'personal'` | Sumber modal |
| `is_environmentally_friendly` | BOOLEAN | NOT NULL | false | Ramah lingkungan |
| `bumdes_partnership_status` | ENUM | NOT NULL | `'none'` | Kemitraan BUMDes |
| `created_at` | TIMESTAMP | NOT NULL | CURRENT_TIMESTAMP | |
| `updated_at` | TIMESTAMP | NOT NULL | CURRENT_TIMESTAMP | |

---

## H. Infrastructures

Menyimpan data sarana dan fasilitas umum desa.

### Nama Tabel: `infrastructures`

| Field | Tipe Data | Constraint | Default | Keterangan |
| :--- | :--- | :--- | :--- | :--- |
| `id` | BIGINT | PK, Auto Increment | | |
| `facility_name` | VARCHAR(255) | NOT NULL | | Nama fasilitas |
| `facility_type` | ENUM | NOT NULL | `'government'` | Jenis fasilitas |
| `condition` | ENUM | NOT NULL | `'good'` | Kondisi |
| `construction_year` | YEAR | NULLABLE | NULL | Tahun pembangunan |
| `funding_source` | VARCHAR(100) | NULLABLE | NULL | Sumber dana |
| `created_at` | TIMESTAMP | NOT NULL | CURRENT_TIMESTAMP | |
| `updated_at` | TIMESTAMP | NOT NULL | CURRENT_TIMESTAMP | |

---

## I. Spatial Data

Menyimpan data koordinat GIS.

### Nama Tabel: `spatial_data`

| Field | Tipe Data | Constraint | Default | Keterangan |
| :--- | :--- | :--- | :--- | :--- |
| `id` | BIGINT | PK, Auto Increment | | |
| `feature_id` | BIGINT | NOT NULL | | ID entitas |
| `feature_type` | ENUM | NOT NULL | `'resident_house'` | Jenis entitas |
| `latitude` | DECIMAL(10,8) | NOT NULL | | Latitude |
| `longitude` | DECIMAL(11,8) | NOT NULL | | Longitude |
| `geojson` | JSON | NULLABLE | NULL | Data polygon |
| `created_at` | TIMESTAMP | NOT NULL | CURRENT_TIMESTAMP | |
| `updated_at` | TIMESTAMP | NOT NULL | CURRENT_TIMESTAMP | |

---

# 📐 3. Enum Values

## Citizens

- `gender` = ['male', 'female']

- `family_role` = ['head_of_family', 'spouse', 'child', 'parent', 'other_relative']

- `marital_status` = ['single', 'married', 'divorced', 'widowed']

- `religion` = ['islam', 'protestant', 'catholic', 'hindu', 'buddha', 'confucian', 'other']

- `blood_type` = ['a', 'b', 'ab', 'o']

- `disability_type` = ['none', 'physical', 'intellectual', 'mental', 'sensory']

---

## Education Profiles

- `education_level` = ['none', 'elementary_school', 'middle_school', 'high_school', 'associate_degree', 'bachelor_degree', 'postgraduate']

- `highest_diploma` = ['none', 'elementary_school', 'middle_school', 'high_school', 'associate_degree', 'bachelor_degree', 'postgraduate']

- `school_participation` = ['not_yet_school', 'attending_school', 'not_attending']

---

## Employment Profiles

- `job_sector` = ['agriculture', 'manufacturing', 'trade_services', 'government', 'other']

- `employment_status` = ['employee', 'employer_assisted', 'employer_unassisted', 'self_employed', 'casual_worker', 'unpaid_worker']

- `economic_status` = ['very_poor', 'poor', 'near_poor', 'middle_income', 'high_income']

---

## Health Profiles

- `bpjs_status` = ['none', 'pbi', 'non_pbi_independent', 'non_pbi_employee']

- `kb_method` = ['none', 'injection', 'pill', 'condom', 'implant', 'iud', 'mow', 'mop']

---

## Housing Profiles

- `house_ownership` = ['owned', 'rented', 'free_rent', 'official_house']

- `house_condition` = ['proper', 'unfit']

- `floor_material` = ['marble_granite', 'ceramic_tile', 'cement_brick', 'wood_timber', 'bamboo', 'dirt_earth']

- `wall_material` = ['masonry_brick', 'reinforced_concrete', 'wood_plank', 'bamboo_woven', 'logs_thatch']

- `roof_material` = ['concrete_tile', 'clay_tile', 'metal_sheet', 'asbestos', 'thatch_palm']

- `water_source` = ['pdam', 'protected_well', 'bore_well', 'spring_water', 'river_rainwater']

- `sanitation_type` = ['private_toilet', 'shared_toilet', 'pit_latrine', 'no_toilet']

- `cooking_fuel` = ['electricity', 'lpg_gas', 'kerosene', 'biogas', 'wood_charcoal']

- `electricity_source` = ['state_electricity_metered', 'state_electricity_unmetered', 'non_state_electricity', 'no_electricity']

- `electricity_capacity` = ['non_electric', '450va', '900va', '1300va', '2200va', 'above_2200va']

---

## MSMEs

- `business_category` = ['culinary', 'fashion', 'agriculture', 'services', 'craft', 'trade', 'other']

- `legal_entity_type` = ['unregistered', 'sole_proprietorship', 'cv', 'pt', 'cooperative']

- `digital_platform_type` = ['none', 'social_media', 'ecommerce', 'delivery_app', 'ride_hailing']

- `capital_source` = ['personal', 'bank_loan', 'government_subsidy', 'government_grant', 'family_relative']

- `bumdes_partnership_status` = ['none', 'consignment_product', 'raw_material_supply', 'capital_investment', 'marketing_cooperation']

---

## Infrastructures

- `facility_type` = ['road', 'bridge', 'irrigation', 'education', 'health', 'worship', 'government']

- `condition` = ['good', 'damaged_light', 'damaged_severe']

---

## Spatial Data

- `feature_type` = ['resident_house', 'public_facility', 'village_boundary', 'msme_location']

---

# 🔗 4. Relasi Database

1. `territories` (1) ➜ `citizens` (N)

2. `citizens` (1) ➜ `education_profiles` (1)

3. `citizens` (1) ➜ `employment_profiles` (1)

4. `citizens` (1) ➜ `health_profiles` (1)

5. `citizens` (1) ➜ `housing_profiles` (1)

6. `citizens` (1) ➜ `msmes` (N)

7. `spatial_data` menggunakan relasi polimorfik terhadap:
   - `citizens`
   - `infrastructures`
   - `msmes`

---

# 🚀 5. Development Roadmap

## FASE 1 — Foundation

- territories
- citizens

## FASE 2 — Citizen Profiles

- education_profiles
- employment_profiles
- health_profiles
- housing_profiles

## FASE 3 — MSMEs Module

- msmes
- dashboard statistik UMKM

## FASE 4 — Infrastructure Module

- infrastructures

## FASE 5 — GIS & Spatial Module

- spatial_data
- integrasi peta digital

---

# 📊 6. Dashboard Mapping Guide

## Dashboard Sosial

| Statistik | Tabel |
| :--- | :--- |
| Agama | citizens |
| Pendidikan | education_profiles |
| BPJS | health_profiles |
| KB | health_profiles |
| Disabilitas | citizens |

---

## Dashboard Ekonomi

| Statistik | Tabel |
| :--- | :--- |
| Pekerjaan | employment_profiles |
| Sektor Kerja | employment_profiles |
| Pendapatan | employment_profiles |
| Status Rumah | housing_profiles |
| Sumber Air | housing_profiles |

---

## Dashboard UMKM

| Statistik | Tabel |
| :--- | :--- |
| Kategori Usaha | msmes |
| Legalitas | msmes |
| Platform Digital | msmes |
| Sumber Modal | msmes |
| Kemitraan BUMDes | msmes |

## 💻 Target Tech Stack
- Backend: Laravel 11
- Database: MySQL
- ORM: Eloquent

---
