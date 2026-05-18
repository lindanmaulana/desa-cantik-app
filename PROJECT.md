# 🏡 Desa Cantik App - Database & Project Specification

Dokumen ini berfungsi sebagai cetak biru (*blueprint*) arsitektur data, kamus data (*Data Dictionary*), aturan bisnis, serta peta jalan pengembangan aplikasi **Desa Cantik App**. Gunakan file ini sebagai context utama saat berdiskusi dengan AI Assistant/LLM agar instruksi pembuatan kode program tetap konsisten.

---

## 📌 1. Gambaran Umum Proyek
**Desa Cantik App** adalah sistem informasi manajemen berbasis wilayah yang mengintegrasikan data kependudukan (demografi), kondisi sosial ekonomi, unit usaha produktif (UMKM), inventarisasi sarana fisik, serta visualisasi pemetaan geografis (GIS).

---

## 🗂️ 2. Skema Tabel & Kamus Data (Database Schema)

### A. Master Data: Territories (Master Wilayah)
Menyimpan data hierarki administratif terkecil di tingkat desa (Dusun, RW, RT).
* **Nama Tabel:** `territories`
* **Struktur:**
  | Field | Tipe Data | Constraint | Default | Keterangan |
  | :--- | :--- | :--- | :--- | :--- |
  | `id` | INT | PK, Auto Increment | | ID unik wilayah |
  | `sub_village` | VARCHAR(100) | NOT NULL | | Nama Dusun (Contoh: Pahing) |
  | `area_name` | VARCHAR(100) | NULLABLE | NULL | Nama Spesifik Tempat/Blok |
  | `rw` | VARCHAR(5) | NOT NULL | | Nomor RW |
  | `rt` | VARCHAR(5) | NOT NULL | | Nomor RT |

### B. Master Data: Citizens (Data Demografi)
Menyimpan identitas personal dasar bagi setiap warga desa.
* **Nama Tabel:** `citizens`
* **Struktur:**
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
  | `blood_type` | VARCHAR(5) | NULLABLE | NULL | Golongan Darah |
  | `religion` | VARCHAR(50) | NOT NULL | 'islam' | Agama (Lihat Bab 3) |
  | `marital_status` | VARCHAR(50) | NOT NULL | 'single' | Status Pernikahan (Lihat Bab 3) |
  | `sub_village_id` | INT | FK, NOT NULL | | Link ke `territories.id` |
  | `created_at` | TIMESTAMP | NOT NULL | CURRENT_TIMESTAMP| Waktu data dibuat |
  | `updated_at` | TIMESTAMP | NOT NULL | | Waktu data diperbarui |
  | `deleted_at` | TIMESTAMP | NULLABLE | NULL | Timestamp untuk fitur Soft Delete |

### C. Core Data: Social Economics (Sosial Ekonomi)
Menyimpan profil tingkat kesejahteraan, pendidikan, pekerjaan, dan bantuan dari pemerintah.
* **Nama Tabel:** `social_economics`
* **Struktur:**
  | Field | Tipe Data | Constraint | Default | Keterangan |
  | :--- | :--- | :--- | :--- | :--- |
  | `id` | INT | PK, Auto Increment | | ID unik |
  | `citizen_id` | INT | FK, UNIQUE, NOT NULL| | Link ke `citizens.id` (Relasi 1-to-1) |
  | `education_level` | VARCHAR(100) | NOT NULL | 'none' | Tingkat Pendidikan Resmi (Lihat Bab 3) |
  | `occupation` | VARCHAR(100) | NOT NULL | 'unemployed'| Jenis Pekerjaan / Profesi |
  | `monthly_income` | DECIMAL(15,2) | NULLABLE | 0.00 | Estimasi Pendapatan Bulanan |
  | `is_welfare_recipient`| BOOLEAN | NOT NULL | false | Status Aktif Penerima Bansos |
  | `assistance_type` | VARCHAR(255) | NULLABLE | NULL | Jenis Bantuan (cth: PKH, BLT) jika bernilai true |
  | `house_condition` | ENUM | NOT NULL | 'proper' | Kelayakan Tempat Tinggal (Lihat Bab 3) |
  | `economic_status` | ENUM | Opsional | | Klasifikasi Tingkat Ekonomi (Lihat Bab 3) |

### D. Core Data: MSMEs (Data UMKM)
Mencatat data kepemilikan usaha mikro, kecil, dan menengah di lingkungan desa.
* **Nama Tabel:** `msmes`
* **Struktur:**
  | Field | Tipe Data | Constraint | Default | Keterangan |
  | :--- | :--- | :--- | :--- | :--- |
  | `id` | INT | PK, Auto Increment | | ID unik usaha |
  | `business_name` | VARCHAR(255) | NOT NULL | | Nama Toko / Badan Usaha |
  | `owner_id` | INT | FK, NOT NULL | | ID Warga Pemilik, terhubung ke `citizens.id` |
  | `business_category` | VARCHAR(100) | NOT NULL | | Kategori Usaha (Lihat Bab 3) |
  | `license_number` | VARCHAR(100) | UNIQUE, NULLABLE | NULL | Nomor Izin Usaha / NIB |
  | `employee_count` | INT | NOT NULL | 0 | Jumlah Tenaga Kerja |
  | `monthly_revenue` | DECIMAL(15,2) | NULLABLE | 0.00 | Omset Bulanan Usaha |

### E. Asset Data: Infrastructures (Data Infrastruktur)
Mengelola data logistik, sarana fisik prasarana, dan inventaris fasilitas publik milik desa.
* **Nama Tabel:** `infrastructures`
* **Struktur:**
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
* **Nama Tabel:** `spatial_data`
* **Struktur:**
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

Seluruh proses manipulasi data (`INSERT` / `UPDATE`), pembuatan komponen *Dropdown Selection* di UI, maupun validasi input **wajib** menggunakan nilai konstanta huruf kecil (*lowercase*) sesuai ketentuan baku di bawah ini:

* **`gender`**: `('male', 'female')`
* **`family_role`**: `('head_of_family', 'spouse', 'child', 'parent', 'other_relative')`
* **`marital_status`**: `('single', 'married', 'divorced', 'widowed')`
* **`religion`**: `('islam', 'protestant', 'catholic', 'hindu', 'buddha', 'confucian', 'other')`
* **`education_level`**: `('none', 'elementary_school', 'middle_school', 'high_school', 'associate_degree', 'bachelor_degree', 'postgraduate')`
* **`house_condition`**: `('proper', 'unfit')`
* **`economic_status`**: `('very_poor', 'poor', 'near_poor', 'middle_income', 'high_income')`
* **`business_category`**: `('culinary', 'fashion', 'agriculture', 'services', 'craft', 'trade', 'other')`
* **`facility_type`**: `('road', 'bridge', 'irrigation', 'education', 'health', 'worship', 'government')`
* **`condition`**: `('good', 'damaged_light', 'damaged_severe')`
* **`feature_type`**: `('resident_house', 'public_facility', 'village_boundary', 'msme_location')`

---

## 🔗 4. Kardinalitas & Tata Hubungan Relasi (ERD Rules)
1. **`territories` (1) ➡️ `citizens` (N):** Hubungan via `citizens.sub_village_id`. Satu RT/RW menampung banyak warga.
2. **`citizens` (1) ➡️ `social_economics` (1):** Relasi *One-to-One*. Menggunakan aturan `UNIQUE` pada `social_economics.citizen_id` agar tiap individu warga hanya memiliki tepat 1 profil ekonomi kesejahteraan.
3. **`citizens` (1) ➡️ `msmes` (N):** Hubungan via `msmes.owner_id`. Satu warga dapat mendaftarkan beberapa unit usaha produktif miliknya.
4. **`spatial_data` (Polimorfik / Dinamis):** Nilai `feature_id` merujuk ke `citizens.id` jika kolom `feature_type = 'resident_house'`. Jika `feature_type = 'public_facility'`, maka `feature_id` otomatis merujuk ke target `infrastructures.id`.

---

## 💻 5. Spesifikasi Fitur Utama Sistem

### A. Panel Manajemen Data (CRUD Engine)
* Antarmuka administrasi standar manual wajib tersedia untuk operator input data harian di setiap modul entitas.
* **Mekanisme Soft Delete:** Modul penghapusan pada tabel `citizens` tidak boleh menghapus baris fisik dari database secara langsung, melainkan mengupdate nilai `deleted_at`. Hal ini guna melindungi konsistensi agregasi riwayat visualisasi spasial, statistik usaha, dan laporan grafik historis.

### B. Fitur Bulk Import via Excel (Sistem Impor Massal)
* **Tujuan:** Mempermudah migrasi data awal kependudukan berskala ribuan warga tanpa input manual satu per satu.
* **Alur Penanganan Validasi Backend:**
  1. Sistem mengurai file `.xlsx` / `.csv` yang diunggah baris demi baris.
  2. Sistem melakukan pengecekan `id_number` (NIK) terlebih dahulu untuk menangkal terjadinya error `Duplicate Entry`.
  3. Sistem melakukan *auto-transform string data* menjadi format huruf kecil (*lowercase*) agar lolos sensor aturan validasi `ENUM` database di seksi (3). Jika ditemukan teks yang benar-benar tidak terdefinisi (misal agama tertulis: 'Lainnya'), proses baris tersebut wajib ditolak (*rollback/skip*) dan menampilkan log pesan kesalahan bagi pengguna.
  4. Grafik dan pie chart statistik pada halaman dashboard utama wajib otomatis ter-update mengikuti kalkulasi data baru pasca proses impor selesai dilakukan.

---

## 🚀 6. Alur Urutan Pengerjaan Proyek (Development Roadmap)

Guna menghindari pengerjaan kode pemrograman yang tercampur-campur dan berantakan, proses pengembangan aplikasi **wajib** mengikuti urutan fase bertahap berikut:

### 🛑 FASE 1: Fondasi Database Utama (Master Data Foundation)
* **Target:** Membuka fondasi data induk kependudukan wilayah terpusat.
* **Komponen:** Tabel `territories` dan `citizens`.
* **Aturan Kerja:** Dilarang merancang kode modul ekonomi atau UMKM sebelum skema tabel master ini berhasil dibuat dan lolos uji coba menggunakan 3-5 data simulasi warga tiruan (*dummy data*).

### 🛠️ FASE 2: Integrasi Profil Kesejahteraan Warga (Social Economics Integration)
* **Target:** Menghubungkan records data kependudukan ke arah profil jaminan sosial.
* **Komponen:** Tabel `social_economics`.
* **Aturan Kerja:** Lakukan pengujian ketat pada *constraint* relasi 1-to-1 agar tidak ada duplikasi data jaminan sosial ganda pada NIK warga yang sama.

### 💼 FASE 3: Pendataan Sektor Produktif Ekonomi (MSMEs Module)
* **Target:** Memetakan produktivitas ekonomi usaha mikro lokal desa.
* **Komponen:** Tabel `msmes`.
* **Aturan Kerja:** Buat uji coba fungsionalitas di mana sistem sanggup menampilkan relasi agregat (misal: satu orang nama pemilik terbukti memiliki 2 jenis bidang usaha berbeda di database).

### 🏗️ FASE 4: Manajemen Logistik Aset Fisik Desa (Infrastructures Asset)
* **Target:** Inventarisasi seluruh sarana fasilitas umum.
* **Komponen:** Tabel `infrastructures`.
* **Aturan Kerja:** Modul ini bersifat mandiri (independen dari data warga). Cukup pastikan nilai default `'good'` bekerja otomatis saat input data aset tanpa keterangan kondisi prasarana dilakukan.

### 🗺️ FASE 5: Pemetaan Koordinat Spasial Geografis (Spatial Data / GIS Component)
* **Target:** Mengunci visualisasi peta digital interaktif dari seluruh data yang ada.
* **Komponen:** Tabel `spatial_data`.
* **Aturan Kerja:** Mengaktifkan query kondisional polimorfik untuk menghubungkan koordinat rumah penduduk (`resident_house`) dan fasilitas umum (`public_facility`).

---

## 💡 7. Cara Menggunakan File Ini (Prompt Template untuk AI)
*Gunakan salinan teks di bawah ini sebagai pesan pembuka setiap kali Anda berdiskusi dengan AI dalam sesi obrolan baru:*

> * "Halo AI, merujuk pada file README.md aplikasi Desa Cantik App, sekarang saya ingin fokus mengerjakan FASE 1 (Master Data Foundation).Tolong buatkan saya kode untuk [Sebutkan framework Anda, misal: Backend Node.js Express / Laravel PHP / Python FastAPI] dan script SQL untuk membuat tabel territories dan citizens lengkap dengan relasi Foreign Key-nya sesuai ketentuan spesifikasi data di file md."




[ Object LengthAwarePaginator ]
 _________________________________________________________________
|                                                                 |
|  -> items()            [Mengambil data asli / Kumpulan Wilayah] |
|  -> toArray()          [Mengubah seluruh objek menjadi array]   |
|                                                                 |
|  ==== SENSOR INFORMASI OTOMATIS (Mengembalikan Angka) ====     |
|  -> firstItem()        (Nomor urut data pertama di halaman ini) |
|  -> lastItem()         (Nomor urut data terakhir di halaman ini)|
|  -> total()            (Total seluruh baris data di database)   |
|  -> currentPage()      (Nomor halaman yang sedang dibuka)       |
|  -> perPage()          (Jumlah maksimal data per halaman)       |
|  -> count()            (Jumlah data yang tampil di halaman ini) |
|  -> lastPage()         (Nomor halaman terakhir / total halaman) |
|                                                                 |
|  ==== SENSOR KONDISI / STATUS (Mengembalikan True/False) ====   |
|  -> hasPages()         (True jika data banyak & butuh paginasi) |
|  -> onFirstPage()      (True jika user sedang di halaman 1)     |
|  -> hasMorePages()     (True jika masih ada halaman berikutnya) |
|  -> isEmpty()          (True jika hasil query kosong melongpong)|
|  -> isNotEmpty()       (True jika ada datanya / tidak kosong)   |
|                                                                 |
|  ==== REMOTE NAVIGASI HALAMAN (Mengembalikan URL/HTML) ====     |
|  -> links()            (Otomatis cetak tombol-tombol HTML)      |
|  -> nextPageUrl()      (Ambil string URL halaman berikutnya)    |
|  -> previousPageUrl()  (Ambil string URL halaman sebelumnya)    |
|  -> url($page)         (Bikin URL kustom, misal: url(5) ke hal 5)|
|  -> withQueryString()  (Menjaga keyword search/filter tidak hilng)|
|_________________________________________________________________|
