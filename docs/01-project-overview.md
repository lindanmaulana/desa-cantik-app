# 🏡 Desa Cantik App - Project Overview & Roadmap

Dokumen ini berisi gambaran umum, peta jalan pengembangan, serta panduan pemetaan dashboard untuk aplikasi **Desa Cantik App**.

---

## 📌 1. Gambaran Umum Proyek

**Desa Cantik App** adalah sistem informasi manajemen berbasis wilayah yang mengintegrasikan data kependudukan (demografi), kondisi sosial ekonomi, unit usaha produktif (UMKM), inventarisasi sarana fisik, pemantauan tumbuh kembang anak (stunting), serta visualisasi pemetaan geografis (GIS).

---

## 🚀 2. Alur Rencana Rilis (Development Roadmap)

### FASE 1 — Inti Kependudukan & Autentikasi
*   `users`
*   `territoties`
*   `families`
*   `citizens`

### FASE 2 — Profiling Tematik Individu & Rumah Tangga (Alur UI Modular)
*   `education_profiles`
*   `employment_profiles`
*   `health_profiles`
*   `housing_profiles`

### FASE 3 — Kesehatan Khusus & Pemantauan Stunting
*   `child_growth_logs`
*   Dashboard Analisis Intervensi Stunting Balita

### FASE 4 — Potensi Ekonomi & Sarana Publik Desa
*   `msmes`
*   `infrastructures`

---

## 📊 3. Panduan Pemetaan Dashboard (Dashboard Mapping Guide)

### A. Dashboard Sosial & Demografi
| Statistik | Sumber Tabel | Kolom Pendukung |
| :--- | :--- | :--- |
| **Agama** | `citizens` | `religion` |
| **Pendidikan Terakhir** | `education_profiles` | `education_level` / `highest_diploma` |
| **Partisipasi Sekolah** | `education_profiles` | `school_participation` |
| **Penerima BPJS** | `health_profiles` | `bpjs_status` |
| **Metode KB Warga** | `health_profiles` | `kb_method` |
| **Penyandang Disabilitas**| `health_profiles` | `disability_type` |
| **Jumlah Ibu Hamil** | `health_profiles` | `is_pregnant` |

### B. Dashboard Pemantauan Stunting (New)
| Statistik | Sumber Tabel | Kolom Pendukung |
| :--- | :--- | :--- |
| **Total Angka Stunting** | `child_growth_logs` | `stunting_status` (Hitung tren per bulan terbaru) |
| **Korelasi Ekonomi & Stunting** | `child_growth_logs` ➜ `citizens` ➜ `families` ➜ `employment_profiles` | Mencocokkan `stunting_status` balita dengan `economic_status` kepala keluarga |
| **Sebaran Stunting per RT/RW** | `child_growth_logs` ➜ `citizens` ➜ `families` ➜ `territoties` | Mengelompokkan total balita stunting berdasarkan `rt` dan `rw` |
| **Cakupan Vitamin A Bulanan** | `child_growth_logs` | `vit_a_received` |
| **Tren Tumbuh Kembang Anak** | `child_growth_logs` | Grafik garis (`height` & `weight` berdasarkan urutan `measured_at`) |

### C. Dashboard Ekonomi & Kesejahteraan
| Statistik | Sumber Tabel | Kolom Pendukung |
| :--- | :--- | :--- |
| **Mata Pencaharian** | `employment_profiles` | `occupation` / `job_sector` |
| **Rata-rata Pendapatan** | `employment_profiles` | `monthly_income` |
| **Status Ekonomi Warga** | `employment_profiles` | `economic_status` |
| **Penerima Bantuan Sosial** | `employment_profiles` | `is_welfare_recipient` / `assistance_type` |
| **Kepemilikan & Kondisi Rumah**| `housing_profiles` | `house_ownership` / `house_condition` |
| **Sanitasi & Air Bersih** | `housing_profiles` | `sanitation_type` / `water_source` |

### D. Dashboard UMKM & Potensi Desa
| Statistik | Sumber Tabel | Kolom Pendukung |
| :--- | :--- | :--- |
| **Kategori & Sektor Usaha** | `msmes` | `business_name` / `business_category` |
| **Legalitas Usaha (NIB)** | `msmes` | `legal_entity_type` / `license_number` |
| **Adopsi Pasar Digital** | `msmes` | `uses_digital_payment` / `digita_platform_type` |
| **Permodalan & Kemitraan** | `msmes` | `capital_source` / `bumdes_partnership_status` |
| **Kondisi Fasilitas Umum** | `infrastructures` | `facility_type` / `condition` |

