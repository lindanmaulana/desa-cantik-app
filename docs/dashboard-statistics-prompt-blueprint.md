Bertindaklah sebagai Senior Laravel & Tailwind/Alpine.js Developer. Tugas Anda adalah membangun modul statistik baru, yaitu "Modul Statistik UMKM & Usaha Desa" di dalam aplikasi Desa Cantik Sukaraja.

Sebagai acuan mutlak mengenai arsitektur, pola query, kontrak data, interaktivitas frontend, dan standar kode yang harus diikuti, saya telah menyediakan file dokumentasi arsitektur lengkap pada file "dashboard-statistics-system-blueprint.md". Buka, baca, dan patuhi seluruh regulasi serta cetak biru (Code Blueprints) yang ada di dalam file tersebut secara verbatim.

Spesifikasi modul UMKM yang harus Anda buat:
1. Target Modul: Modul Statistik UMKM & Usaha Desa.
2. Enum Domain: Buat file `App\Enums\UmkmType` yang menampung indikator-indikator berikut sesuai kebutuhan UI:
   - BUSINESS_SECTOR (Sektor Usaha)
   - OWNER_AGE (Usia Pemilik)
   - OWNER_EDUCATION (Pendidikan Pemilik)
   - BUSINESS_LOCATION (Lokasi Usaha)
   - LEGAL_STATUS (Badan Hukum)
   - NIB_OWNERSHIP (Kepemilikan NIB)
   - MONTHLY_TURNOVER (Omzet/Bulan)
   - DIGITAL_TRANSACTION (Transaksi Digital)
   - DIGITAL_PLATFORM (Platform Digital)
   - CAPITAL_SOURCE (Sumber Modal)
   - ECO_FRIENDLY (Ramah Lingkungan)
   - BUMDES_PARTNERSHIP (Kemitraan BUM Desa)

3. Struktur Database & Logic Service:
   - Hubungkan data dengan tabel profil usaha/UMKM (misal: `business_profiles`) yang terhubung ke data warga (`citizens`) dan wilayah (`territories`).
   - Implementasikan teknik Cross-Tabulation Pivot SQL di `UmkmService` untuk menghitung agregasi berdasarkan wilayah (RW/RT) dengan proteksi overcounting yang ketat.

4. Komposisi UI (Blade & Alpine.js):
   - Gunakan pola split-layout yang adaptif sesuai panduan di Bab 6 & 7.
   - Pada file `partials/filter-aggregate.blade.php`, petakan tombol filter menggunakan RemixIcon yang presisi untuk ke-12 menu di atas (contoh: 'ri-apps-2-line' untuk Sektor Usaha, 'ri-qr-code-line' untuk Transaksi Digital, dst).
   - Pastikan grafik ApexCharts (`partials/chart.blade.php`) membaca tipe chart (Bar untuk kategori seperti Omzet/Sektor Usaha, dan Donut untuk proporsi seperti Kepemilikan NIB/Ramah Lingkungan) secara otomatis dari backend.
   - Seluruh inisialisasi skrip Alpine.js pada komponen tabel dan chart wajib dilindungi oleh flag pengecekan window (guardrails) untuk mencegah registrasi ganda saat partial dimuat ulang.

Langkah Kerja Anda:
1. Tulis komponen Backend terlebih dahulu (Request, Enum, Service, Controller).
2. Tulis komponen Frontend secara komplit (Main Index Blade dan seluruh file Partials di dalam folder `dashboard/statistics/umkm/partials/`).

Berikan kode yang bersih, aman dari race-condition, matang, dan siap pakai tanpa ada bagian yang terpotong atau sekadar placeholder. Jalankan tugas ini secara berurutan.
