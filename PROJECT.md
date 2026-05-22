# 🏡 Desa Cantik App - Database & Project Specification

Dokumen ini berfungsi sebagai cetak biru (_blueprint_) arsitektur data, kamus data (_Data Dictionary_), aturan bisnis, serta peta jalan pengembangan aplikasi **Desa Cantik App**. Gunakan file ini sebagai context utama saat berdiskusi dengan AI Assistant/LLM agar instruksi pembuatan kode program tetap konsisten.

---

## 📌 1. Gambaran Umum Proyek

**Desa Cantik App** adalah sistem informasi manajemen berbasis wilayah yang mengintegrasikan data kependudukan (demografi), kondisi sosial ekonomi, unit usaha produktif (UMKM), inventarisasi sarana fisik, serta visualisasi pemetaan geografis (GIS).

---

## 🗂️ 2. Skema Tabel & Kamus Data (Database Schema)

### A. Master Data: Territories (Master Wilayah)
Menyimpan data hierarki administratif terkecil di tingkat desa (Dusun, RW, RT).

- **Nama Tabel:** `territories`
- **Struktur:**
  | Field | Tipe Data | Constraint | Default | Keterangan |
  | :--- | :--- | :--- | :--- | :--- |
  | `id` | INT | PK, Auto Increment | | ID unik wilayah |
  | `sub_village` | VARCHAR(100) | NOT NULL | | Nama Dusun (Contoh: Pahing) |
  | `area_name` | VARCHAR(100) | NULLABLE | NULL | Nama Spesifik Tempat/Blok |
  | `rw` | VARCHAR(5) | NOT NULL | | Nomor RW |
  | `rt` | VARCHAR(5) | NOT NULL | | Nomor RT |

### B. Master Data: Citizens (Data Demografi)
Menyimpan identitas personal dasar bagi setiap warga desa.

- **Nama Tabel:** `citizens`
- **Struktur:**
  | Field | Tipe Data | Constraint | Default | Keterangan |
  | :--- | :--- | :--- | :--- | :--- |
  | `id` | INT | PK, Auto Increment | | ID internal sistem |
  | `id_number` | VARCHAR(16) | UNIQUE, NOT NULL | | NIK (Nomor Induk Kependudukan) |
  | `family_card_number` | VARCHAR(16) | NOT NULL | | Nomor Kartu Keluarga (KK) |
  | `full_name` | VARCHAR(255) | NOT NULL | | Nama Lengkap Penduduk |
  | `family_role` | ENUM | NOT NULL | 'member' | Hubungan dalam keluarga (Lihat Bab 3) |
  | `gender` | ENUM | NOT NULL | | Jenis Kelamin (Lihat Bab 3) |
  | `birth_place` | VARCHAR(100) | NOT NULL | | Tempat Lahir |
  | `birth_date` | DATE | NOT NULL | | Tanggal Lahir (Wajib untuk statistik umur) |
  | `blood_type` | VARCHAR(5) | NULLABLE | NULL | **[Dashboard]** Golongan Darah |
  | `religion` | VARCHAR(50) | NOT NULL | 'islam' | **[Dashboard]** Agama (Lihat Bab 3) |
  | `marital_status` | VARCHAR(50) | NOT NULL | 'single' | Status Pernikahan (Lihat Bab 3) |
  | `sub_village_id` | INT | FK, NOT NULL | | Link ke `territories.id` |
  | `disability_type` | ENUM | NOT NULL | 'none' | **[Dashboard]** Jenis Disabilitas (Lihat Bab 3) |
  | `is_pregnant` | BOOLEAN | NOT NULL | false | **[Dashboard]** Status Kehamilan Aktif |
  | `created_at` | TIMESTAMP | NOT NULL | CURRENT_TIMESTAMP| Waktu data dibuat |
  | `updated_at` | TIMESTAMP | NOT NULL | | Waktu data diperbarui |
  | `deleted_at` | TIMESTAMP | NULLABLE | NULL | Timestamp untuk fitur Soft Delete |

### C. Core Data: Social Economics (Sosial Ekonomi)
Menyimpan profil tingkat kesejahteraan, pendidikan, ketenagakerjaan, jaminan kesehatan, bantuan pemerintah, serta aset fisik dan utilitas tempat tinggal.

- **Nama Tabel:** `social_economics`
- **Struktur:**
  | Field | Tipe Data | Constraint | Default | Keterangan |
  | :--- | :--- | :--- | :--- | :--- |
  | `id` | INT | PK, Auto Increment | | ID unik |
  | `citizen_id` | INT | FK, UNIQUE, NOT NULL| | Link ke `citizens.id` (Relasi 1-to-1) |
  | `education_level` | VARCHAR(100) | NOT NULL | 'none' | **[Dashboard]** Jenjang Pendidikan Saat Ini (Lihat Bab 3) |
  | `highest_diploma` | VARCHAR(100) | NOT NULL | 'none' | **[Dashboard]** Ijazah Terakhir Yang Dimiliki (Lihat Bab 3) |
  | `school_participation` | ENUM | NOT NULL | 'no' | **[Dashboard]** Status Partisipasi Sekolah (Lihat Bab 3) |
  | `occupation` | VARCHAR(100) | NOT NULL | 'unemployed'| **[Dashboard]** Pekerjaan Utama / Profesi |
  | `job_sector` | ENUM | NOT NULL | 'other' | **[Dashboard]** Sektor Usaha Tempat Bekerja (Lihat Bab 3) |
  | `employment_status` | ENUM | NOT NULL | 'unpaid_worker'| **[Dashboard]** Kedudukan/Status Kerja (Lihat Bab 3) |
  | `monthly_income` | DECIMAL(15,2) | NULLABLE | 0.00 | Estimasi Pendapatan Bulanan |
  | `is_welfare_recipient`| BOOLEAN | NOT NULL | false | **[Dashboard]** Status Aktif Penerima Bansos |
  | `assistance_type` | VARCHAR(255) | NULLABLE | NULL | **[Dashboard]** Jenis Bantuan (cth: PKH, BLT) |
  | `kb_method` | ENUM | NOT NULL | 'none' | **[Dashboard]** Metode KB yang Digunakan (Lihat Bab 3) |
  | `bpjs_status` | ENUM | NOT NULL | 'none' | **[Dashboard]** Status Kepesertaan BPJS (Lihat Bab 3) |
  | `house_ownership` | ENUM | NOT NULL | 'owned' | **[Dashboard]** Status Penguasaan/Kepemilikan Rumah (Lihat Bab 3) |
  | `house_condition` | ENUM | NOT NULL | 'proper' | Kelayakan Kondisi Fisik Rumah (Lihat Bab 3) |
  | `economic_status` | ENUM | Opsional | | Klasifikasi Tingkat Ekonomi (Lihat Bab 3) |
  | `floor_material` | ENUM | NOT NULL | 'cement_brick' | **[Dashboard]** Jenis Material Lantai Terluas (Lihat Bab 3) |
  | `wall_material` | ENUM | NOT NULL | 'masonry_brick'| **[Dashboard]** Jenis Material Dinding Terluas (Lihat Bab 3) |
  | `roof_material` | ENUM | NOT NULL | 'clay_tile' | **[Dashboard]** Jenis Material Atap Terluas (Lihat Bab 3) |
  | `water_source` | ENUM | NOT NULL | 'sumur_terlindung'| **[Dashboard]** Sumber Air Bersih Utama (Lihat Bab 3) |
  | `sanitation_type` | ENUM | NOT NULL | 'leher_angsa_sendiri'| **[Dashboard]** Fasilitas BAB / Sanitasi (Lihat Bab 3) |
  | `cooking_fuel` | ENUM | NOT NULL | 'lpg_gas' | **[Dashboard]** Bahan Bakar / Energi Memasak (Lihat Bab 3) |
  | `electricity_source` | ENUM | NOT NULL | 'pln_meteran' | **[Dashboard]** Sumber Penerangan Utama (Lihat Bab 3) |
  | `electricity_capacity`| ENUM | NOT NULL | '900va' | **[Dashboard]** Daya Listrik Terpasang (Lihat Bab 3) |

### D. Core Data: MSMEs (Data UMKM)
Mencatat data kepemilikan usaha mikro, kecil, dan menengah, ekosistem digitalisasi, legalitas, serta kemitraan usaha mikro desa.

- **Nama Tabel:** `msmes`
- **Struktur:**
  | Field | Tipe Data | Constraint | Default | Keterangan |
  | :--- | :--- | :--- | :--- | :--- |
  | `id` | INT | PK, Auto Increment | | ID unik usaha |
  | `business_name` | VARCHAR(255) | NOT NULL | | Nama Toko / Badan Usaha |
  | `owner_id` | INT | FK, NOT NULL | | ID Warga Pemilik, terhubung ke `citizens.id` |
  | `business_category` | VARCHAR(100) | NOT NULL | | **[Dashboard]** Kategori / Sektor Usaha (Lihat Bab 3) |
  | `legal_entity_type` | ENUM | NOT NULL | 'unregistered' | **[Dashboard]** Badan Hukum / Legalitas Usaha (Lihat Bab 3) |
  | `license_number` | VARCHAR(100) | UNIQUE, NULLABLE | NULL | **[Dashboard]** Nomor Izin Usaha / Kepemilikan NIB |
  | `employee_count` | INT | NOT NULL | 0 | Jumlah Tenaga Kerja |
  | `monthly_revenue` | DECIMAL(15,2) | NULLABLE | 0.00 | **[Dashboard]** Omset Bulanan Usaha |
  | `uses_digital_payment`| BOOLEAN | NOT NULL | false | **[Dashboard]** Penggunaan Transaksi Digital / Cashless |
  | `digital_platform_type`| ENUM | NOT NULL | 'none' | **[Dashboard]** Ekosistem Platform Digital (Lihat Bab 3) |
  | `capital_source` | ENUM | NOT NULL | 'personal' | **[Dashboard]** Asal Sumber Modal Utama (Lihat Bab 3) |
  | `is_environmentally_friendly`| BOOLEAN | NOT NULL | false | **[Dashboard]** Pengelolaan Limbah Ramah Lingkungan |
  | `bumdes_partnership_status`| ENUM | NOT NULL | 'none' | **[Dashboard]** Status Kemitraan BUM Desa (Lihat Bab 3) |

### E. Asset Data: Infrastructures (Data Infrastruktur)
Mengelola data logistik, sarana fisik prasarana, dan inventaris fasilitas publik milik desa.

- **Nama Tabel:** `infrastructures`
- **Struktur:**
  | Field | Tipe Data | Constraint | Default | Keterangan |
  | :--- | :--- | :--- | :--- | :--- |
  | `id` | INT | PK, Auto Increment | | ID unik aset infrastruktur |
  | `facility_name` | VARCHAR(255) | NOT NULL | | Nama Sarana (Contoh: Jembatan Ciherang) |
  | `facility_type` | VARCHAR(100) | NOT NULL | | Jenis Fasilitas (Lihat Bab 3) |
  | `condition` | ENUM | NOT NULL | 'good' | Kondisi Kelayakan Fisik (Lihat Bab 3) |
  | `construction_year` | YEAR | NULLABLE | NULL | Tahun Selesai Pembangunan |
  | `funding_source` | VARCHAR(100) | NULLABLE | 'Village Fund'| Sumber Pendanaan Konstruksi |

### F. Spatial Data: Spatial Data (Data Geografis / GIS)
Menyimpan data titik koordinat peta spasial secara dinamis terintegrasi.

- **Nama Tabel:** `spatial_data`
- **Struktur:**
  | Field | Tipe Data | Constraint | Default | Keterangan |
  | :--- | :--- | :--- | :--- | :--- |
  | `id` | INT | PK, Auto Increment | | ID unik peta |
  | `feature_id` | INT | NOT NULL | | ID Entitas Asal (ID Warga / ID Infrastruktur) |
  | `feature_type` | ENUM | NOT NULL | 'resident' | Indikator Jenis Objek Peta (Lihat Bab 3) |
  | `latitude` | DECIMAL(10,8) | NOT NULL | | Koordinat Garis Lintang |
  | `longitude` | DECIMAL(11,8) | NOT NULL | | Koordinat Garis Bujur |
  | `geojson` | TEXT / JSON | NULLABLE | NULL | Geometri Poligon Batas (Opsional) |

---

## 📐 3. Aturan Ketentuan Nilai Terkunci (Enum Values)
Seluruh proses manipulasi data (`INSERT` / `UPDATE`), pembuatan komponen _Dropdown Selection_ di UI, maupun validasi input **wajib** menggunakan nilai konstanta huruf kecil (_lowercase_) sesuai ketentuan baku di bawah ini:

- **`gender`**: `('male', 'female')`
- **`family_role`**: `('head_of_family', 'spouse', 'child', 'parent', 'other_relative')`
- **`marital_status`**: `('single', 'married', 'divorced', 'widowed')`
- **`religion`**: `('islam', 'protestant', 'catholic', 'hindu', 'buddha', 'confucian', 'other')`
- **`disability_type`**: `('none', 'physical', 'intellectual', 'mental', 'sensory')`
- **`education_level`** & **`highest_diploma`**: `('none', 'elementary_school', 'middle_school', 'high_school', 'associate_degree', 'bachelor_degree', 'postgraduate')`
- **`school_participation`**: `('belum_sekolah', 'sedang_sekolah', 'tidak_sekolah_lagi')`
- **`job_sector`**: `('agriculture', 'manufacturing', 'trade_services', 'government', 'other')`
- **`employment_status`**: `('employee', 'employer_assisted', 'employer_unassisted', 'self_employed', 'casual_worker', 'unpaid_worker')`
- **`kb_method`**: `('none', 'suntik', 'pil', 'kondom', 'implan', 'iud', 'mow', 'mop')`
- **`bpjs_status`**: `('none', 'pbi', 'non_pbi_mandiri', 'non_pbi_pekerja')`
- **`house_ownership`**: `('owned', 'rented', 'free_rent', 'official_house')`
- **`house_condition`**: `('proper', 'unfit')`
- **`economic_status`**: `('very_poor', 'poor', 'near_poor', 'middle_income', 'high_income')`
- **`floor_material`**: `('marble_granite', 'ceramic_tile', 'cement_brick', 'wood_timber', 'bamboo', 'dirt_earth')`
- **`wall_material`**: `('masonry_brick', 'reinforced_concrete', 'wood_plank', 'bamboo_woven', 'logs_thatch')`
- **`roof_material`**: `('concrete_tile', 'clay_tile', 'metal_sheet', 'asbestos', 'thatch_palm')`
- **`water_source`**: `('pdam', 'sumur_terlindung', 'sumur_bor', 'mata_air', 'sungai_hujan')`
- **`sanitation_type`**: `('leher_angsa_sendiri', 'leher_angsa_bersama', 'plengsengan', 'bukan_jamban')`
- **`cooking_fuel`**: `('electricity', 'lpg_gas', 'kerosene', 'biogas', 'wood_charcoal')`
- **`electricity_source`**: `('pln_meteran', 'pln_non_meteran', 'non_pln', 'bukan_listrik')`
- **`electricity_capacity`**: `('non_electric', '450va', '900va', '1300va', '2200va', 'above_2200va')`
- **`business_category`**: `('culinary', 'fashion', 'agriculture', 'services', 'craft', 'trade', 'other')`
- **`legal_entity_type`**: `('unregistered', 'po_perorangan', 'cv', 'pt', 'koperasi')`
- **`digital_platform_type`**: `('none', 'social_media', 'ecommerce', 'delivery_app', 'ride_hailing')`
- **`capital_source`**: `('personal', 'bank_loan', 'kur_subsidy', 'government_grant', 'family_relative')`
- **`bumdes_partnership_status`**: `('none', 'consignment_product', 'raw_material_supply', 'capital_investment', 'marketing_cooperation')`
- **`facility_type`**: `('road', 'bridge', 'irrigation', 'education', 'health', 'worship', 'government')`
- **`condition`**: `('good', 'damaged_light', 'damaged_severe')`
- **`feature_type`**: `('resident_house', 'public_facility', 'village_boundary', 'msme_location')`

---

## 🔗 4. Kardinalitas & Tata Hubungan Relasi (ERD Rules)
1. **`territories` (1) ➡️ `citizens` (N):** Hubungan via `citizens.sub_village_id`. Satu RT/RW menampung banyak warga.
2. **`citizens` (1) ➡️ `social_economics` (1):** Relasi _One-to-One_. Menggunakan aturan `UNIQUE` pada `social_economics.citizen_id` agar tiap individu warga hanya memiliki tepat 1 profil ekonomi kesejahteraan.
3. **`citizens` (1) ➡️ `msmes` (N):** Hubungan via `msmes.owner_id`. Satu warga dapat mendaftarkan beberapa unit usaha produktif miliknya.
4. **`spatial_data` (Polimorfik / Dinamis):** Nilai `feature_id` merujuk ke `citizens.id` jika kolom `feature_type = 'resident_house'`. Jika `feature_type = 'public_facility'`, maka `feature_id` otomatis merujuk ke target `infrastructures.id`.

---

## 💻 5. Spesifikasi Fitur Utama Sistem

### A. Panel Manajemen Data (CRUD Engine)
- Antarmuka administrasi standar manual wajib tersedia untuk operator input data harian di setiap modul entitas.
- **Mekanisme Soft Delete:** Modul penghapusan pada tabel `citizens` tidak boleh menghapus baris fisik dari database secara langsung, melainkan mengupdate nilai `deleted_at`. Hal ini guna melindungi konsistensi agregasi riwayat visualisasi spasial, statistik usaha, dan laporan grafik historis.

### B. Fitur Bulk Import via Excel (Sistem Impor Massal)
- **Tujuan:** Mempermudah migrasi data awal kependudukan berskala ribuan warga tanpa input manual satu per satu.
- **Alur Penanganan Validasi Backend:**
    1. Sistem mengurai file `.xlsx` / `.csv` yang diunggah baris demi baris.
    2. Sistem melakukan pengecekan `id_number` (NIK) terlebih dahulu untuk menangkal terjadinya error `Duplicate Entry`.
    3. Sistem melakukan _auto-transform string data_ menjadi format huruf kecil (_lowercase_) agar lolos sensor aturan validasi `ENUM` database di seksi (3). Jika ditemukan teks yang benar-benar tidak terdefinisi (misal agama tertulis: 'Lainnya'), proses baris tersebut wajib ditolak (_rollback/skip_) dan menampilkan log pesan kesalahan bagi pengguna.
    4. Grafik dan pie chart statistik pada halaman dashboard utama (seperti jaminan kesehatan, data KB, status air/sanitasi, utilitas rumah tangga, bahan bakar, ketenagakerjaan, ekosistem UMKM, digital payment, dan partisipasi sekolah) wajib otomatis ter-update mengikuti kalkulasi data baru pasca proses impor selesai dilakukan.

---

## 🚀 6. Alur Urutan Pengerjaan Proyek (Development Roadmap)
Guna menghindari pengerjaan kode pemrograman yang tercampur-campur dan berantakan, proses pengembangan aplikasi **wajib** mengikuti urutan fase bertahap berikut:

### 🛑 FASE 1: Fondasi Database Utama (Master Data Foundation)
- **Target:** Membuka fondasi data induk kependudukan wilayah terpusat.
- **Komponen:** Tabel `territories` dan `citizens`.
- **Aturan Kerja:** Dilarang merancang kode modul ekonomi atau UMKM sebelum skema tabel master ini berhasil dibuat dan lolos uji coba menggunakan 3-5 data simulasi warga tiruan (_dummy data_).

### 🛠️ FASE 2: Integrasi Profil Kesejahteraan Warga (Social Economics Integration)
- **Target:** Menghubungkan records data kependudukan ke arah profil jaminan sosial dan pemenuhan seluruh komponen filter dashboard statistik sosial & ekonomi makro.
- **Komponen:** Tabel `social_economics`.
- **Aturan Kerja:** Lakukan pengujian ketat pada _constraint_ relasi 1-to-1 agar tidak ada duplikasi data jaminan sosial ganda pada NIK warga yang sama. Pastikan semua opsi ENUM sosial (seperti jaminan kesehatan, sanitasi, material bangunan, daya listrik, bahan bakar, dan edukasi-pekerjaan) terintegrasi sempurna.

### 💼 FASE 3: Pendataan Sektor Produktif Ekonomi & Digitalisasi (MSMEs Module)
- **Target:** Memetakan produktivitas ekonomi usaha mikro lokal desa serta metrik digitalisasi finansial.
- **Komponen:** Tabel `msmes`.
- **Aturan Kerja:** Buat uji coba fungsionalitas di mana sistem sanggup menampilkan relasi agregat pemilik, badan hukum, dan sistem transaksi digital merchant mitra BUM Desa secara akurat.

### 🏗️ FASE 4: Manajemen Logistik Aset Fisik Desa (Infrastructures Asset)
- **Target:** Inventarisasi seluruh sarana fasilitas umum.
- **Komponen:** Tabel `infrastructures`.
- **Aturan Kerja:** Modul ini bersifat mandiri (independen dari data warga). Cukup pastikan nilai default `'good'` bekerja otomatis saat input data aset tanpa keterangan kondisi prasarana dilakukan.

### 🗺️ FASE 5: Pemetaan Koordinat Spasial Geografis (Spatial Data / GIS Component)
- **Target:** Mengunci visualisasi peta digital interaktif dari seluruh data yang ada.
- **Komponen:** Tabel `spatial_data`.
- **Aturan Kerja:** Mengaktifkan query kondisional polimorfik untuk menghubungkan koordinat rumah penduduk (`resident_house`) dan fasilitas umum (`public_facility`).

---

## 💡 7. Cara Menggunakan File Ini (Prompt Template untuk AI)
_Gunakan salinan teks di bawah ini sebagai pesan pembuka setiap kali Anda berdiskusi dengan AI dalam sesi obrolan baru:_

> - "Halo AI, merujuk pada file README.md aplikasi Desa Cantik App, sekarang saya ingin fokus mengerjakan FASE 3 (MSMEs Module). Tolong buatkan saya kode untuk [Sebutkan framework Anda] dan script SQL untuk memperbarui tabel msmes lengkap dengan relasi Foreign Key-nya ke tabel citizens agar semua kebutuhan chart di dashboard statistik UMKM dan digitalisasi usaha terpenuhi sesuai ketentuan spesifikasi."

---

## 📊 8. Panduan Pemetaan Data Dashboard (Dashboard Query Mapping Guide)
Bagian ini menjelaskan logika penarikan data (_Query Logic_) untuk menghasilkan grafik/pie-chart pada menu "PILIH JENIS AGREGAT" di setiap sub-dashboard.

### 🏛️ A. SUB-DASHBOARD: SOSIAL
| Tombol Filter           | Tabel Utama        | Strategi Query & Kombinasi Kolom                                                                                                                        |
| :---------------------- | :----------------- | :------------------------------------------------------------------------------------------------------------------------------------------------------ |
| **Agama**               | `citizens`         | `SELECT religion, COUNT(id) FROM citizens GROUP BY religion`                                                                                            |
| **Partisipasi Sekolah** | `social_economics` | `SELECT school_participation, COUNT(id) FROM social_economics GROUP BY school_participation`                                                            |
| **Jenjang Pendidikan**  | `social_economics` | `SELECT education_level, COUNT(id) FROM social_economics GROUP BY education_level`                                                                      |
| **Ijazah Terakhir**     | `social_economics` | `SELECT highest_diploma, COUNT(id) FROM social_economics GROUP BY highest_diploma`                                                                      |
| **Golongan Darah**      | `citizens`         | `SELECT blood_type, COUNT(id) FROM citizens GROUP BY blood_type`                                                                                        |
| **Disabilitas**         | `citizens`         | `SELECT disability_type, COUNT(id) FROM citizens GROUP BY disability_type`                                                                              |
| **Kehamilan**           | `citizens`         | `SELECT is_pregnant, COUNT(id) FROM citizens WHERE gender = 'female' GROUP BY is_pregnant`                                                              |
| **Keluarga Berencana**  | `social_economics` | `SELECT se.kb_method, COUNT(se.id) FROM social_economics se JOIN citizens c ON se.citizen_id = c.id WHERE c.gender = 'female' GROUP BY se.kb_method`    |
| **BPJS Kesehatan**      | `social_economics` | `SELECT bpjs_status, COUNT(id) FROM social_economics GROUP BY bpjs_status`                                                                              |
| **Bantuan Sosial**      | `social_economics` | **Kondisional:**<br>- Jika Umum: `GROUP BY is_welfare_recipient`<br>- Jika Spesifik Jenis: `WHERE is_welfare_recipient = true GROUP BY assistance_type` |
| **Sumber Air**          | `social_economics` | `SELECT water_source, COUNT(id) FROM social_economics GROUP BY water_source`                                                                            |
| **Penerangan**          | `social_economics` | `SELECT electricity_source, COUNT(id) FROM social_economics GROUP BY electricity_source`                                                                |
| **Fasilitas BAB**       | `social_economics` | `SELECT sanitation_type, COUNT(id) FROM social_economics GROUP BY sanitation_type`                                                                      |

---

### 💼 B. SUB-DASHBOARD: EKONOMI MAKRO
| Tombol Filter        | Tabel Utama        | Strategi Query & Kombinasi Kolom                                                             |
| :------------------- | :----------------- | :------------------------------------------------------------------------------------------- |
| **Pekerjaan Utama**  | `social_economics` | `SELECT occupation, COUNT(id) FROM social_economics GROUP BY occupation`                     |
| **Sektor Usaha**     | `social_economics` | `SELECT job_sector, COUNT(id) FROM social_economics GROUP BY job_sector`                     |
| **Kedudukan Kerja**  | `social_economics` | `SELECT employment_status, COUNT(id) FROM social_economics GROUP BY employment_status`       |
| **Status Rumah**     | `social_economics` | `SELECT house_ownership, COUNT(id) FROM social_economics GROUP BY house_ownership`           |
| **Material Lantai**  | `social_economics` | `SELECT floor_material, COUNT(id) FROM social_economics GROUP BY floor_material`             |
| **Material Dinding** | `social_economics` | `SELECT wall_material, COUNT(id) FROM social_economics GROUP BY wall_material`               |
| **Material Atap**    | `social_economics` | `SELECT roof_material, COUNT(id) FROM social_economics GROUP BY roof_material`               |
| **Energi Masak**     | `social_economics` | `SELECT cooking_fuel, COUNT(id) FROM social_economics GROUP BY cooking_fuel`                 |
| **Daya Listrik**     | `social_economics` | `SELECT electricity_capacity, COUNT(id) FROM social_economics GROUP BY electricity_capacity` |

---

### 🛍️ C. SUB-DASHBOARD: UMKM
| Tombol Filter          | Tabel Utama | Strategi Query & Kombinasi Kolom                                                                                                                                                          |
| :--------------------- | :---------- | :---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| **Sektor Usaha**       | `msmes`     | `SELECT business_category, COUNT(id) FROM msmes GROUP BY business_category`                                                                                                               |
| **Usia Pemilik**       | `msmes`     | **Join ke Demografi:**<br>`SELECT STRFTIME('%Y', 'now') - STRFTIME('%Y', c.birth_date) AS age` lalu kelompokkan menggunakan `CASE WHEN age < 30 THEN 'Muda' ...`                          |
| **Pendidikan Pemilik** | `msmes`     | **Join ke Sosial Ekonomi:**<br>`SELECT se.highest_diploma, COUNT(m.id) FROM msmes m JOIN social_economics se ON m.owner_id = se.citizen_id GROUP BY se.highest_diploma`                   |
| **Lokasi Usaha**       | `msmes`     | **Join ke Master Wilayah:**<br>`SELECT t.sub_village, COUNT(m.id) FROM msmes m JOIN citizens c ON m.owner_id = c.id JOIN territories t ON c.sub_village_id = t.id GROUP BY t.sub_village` |
| **Badan Hukum**        | `msmes`     | `SELECT legal_entity_type, COUNT(id) FROM msmes GROUP BY legal_entity_type`                                                                                                               |
| **Kepemilikan NIB**    | `msmes`     | **Kondisional:**<br>`SELECT CASE WHEN license_number IS NULL THEN 'no_nib' ELSE 'has_nib' END, COUNT(id) FROM msmes GROUP BY ...`                                                         |
| **Omset/Bulan**        | `msmes`     | **Grouping Range (Rekomendasi Frontend/Backend):**<br>Kelompokkan `monthly_revenue` menggunakan `CASE WHEN` (misal: `< 1jt`, `1jt - 5jt`, `> 5jt`)                                        |
| **Transaksi Digital**  | `msmes`     | `SELECT uses_digital_payment, COUNT(id) FROM msmes GROUP BY uses_digital_payment`                                                                                                         |
| **Platform Digital**   | `msmes`     | `SELECT digital_platform_type, COUNT(id) FROM msmes GROUP BY digital_platform_type`                                                                                                       |
| **Sumber Modal**       | `msmes`     | `SELECT capital_source, COUNT(id) FROM msmes GROUP BY capital_source`                                                                                                                     |
| **Ramah Lingkungan**   | `msmes`     | `SELECT is_environmentally_friendly, COUNT(id) FROM msmes GROUP BY is_environmentally_friendly`                                                                                           |
| **Kemitraan BUM Desa** | `msmes`     | `SELECT bumdes_partnership_status, COUNT(id) FROM msmes GROUP BY bumdes_partnership_status`                                                                                               |
