# 💻 Desa Cantik App - Technical Target & Tech Stack

Dokumen spesifikasi teknis untuk implementasi pengembangan sistem Desa Cantik App.

## 🛠️ Spesifikasi Teknologi
*   **Framework:** Laravel 11
*   **Database:** MySQL
*   **ORM:** Eloquent (Menggunakan strategi `HasUuids` untuk semua Primary Key)

## ⚙️ Aturan Umum Basis Data
*   Semua tabel master dan profil wajib menyediakan fitur *soft delete* (`deleted_at`).
*   Id unik menggunakan standar UUID v4 untuk mempermudah sinkronisasi dan keamanan data wilayah.
