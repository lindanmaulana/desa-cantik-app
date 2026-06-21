# 🔗 Desa Cantik App - Database Relations

Dokumen ini mendefinisikan aturan dan relasi antar tabel (konektivitas ORM Eloquent) di dalam Desa Cantik App.

---

## 🤝 Aturan Hubungan Data (Relationships)

1.  **`users.username`** (UUID) ➜ `citizens.id`
    * *Jenis:* One-to-One (HasOne / BelongsTo)
    * *Keterangan:* Hak akses user terikat langsung dengan identitas warga asli desa.

2.  **`users.territory_id`** (UUID) ➜ `territories.id`
    * *Jenis:* Many-to-One Optional (BelongsTo)
    * *Keterangan:* Membatasi wilayah yurisdiksi tugas operator tingkat RW/RT.

3.  **`territories`** (1) ➜ `families` (N)
    * *Jenis:* One-to-Many (HasMany / BelongsTo)
    * *Keterangan:* Satu wilayah RT/RW mencakup banyak Kartu Keluarga.

4.  **`families`** (1) ➜ `citizens` (N)
    * *Jenis:* One-to-Many (HasMany / BelongsTo)
    * *Keterangan:* Satu KK menampung banyak anggota keluarga (warga).

5.  **`families`** (1) ➜ `housing_profiles` (1)
    * *Jenis:* One-to-One (HasOne / BelongsTo)
    * *Keterangan:* Profil kondisi fisik rumah tangga melekat langsung pada satu KK.

6.  **`citizens`** (1) ➜ `education_profiles` (1)
    * *Jenis:* One-to-One Optional (HasOne / BelongsTo)
    * *Keterangan:* Setiap warga dapat memiliki satu profil riwayat pendidikan.

7.  **`citizens`** (1) ➜ `employment_profiles` (1)
    * *Jenis:* One-to-One Optional (HasOne / BelongsTo)
    * *Keterangan:* Setiap warga usia produktif dapat memiliki satu profil ekonomi/pekerjaan.

8.  **`citizens`** (1) ➜ `health_profiles` (1)
    * *Jenis:* One-to-One (HasOne / BelongsTo)
    * *Keterangan:* Setiap warga memiliki satu profil rekam kesehatan dasar.

9.  **`citizens`** (1) ➜ `msmes` (N)
    * *Jenis:* One-to-Many Optional (HasMany / BelongsTo)
    * *Keterangan:* Satu warga diperbolehkan mengelola/memiliki lebih dari satu unit usaha UMKM.

10. **`citizens`** (1) ➜ `child_growth_logs` (N)
    * *Jenis:* One-to-Many Optional (HasMany / BelongsTo)
    * *Keterangan:* Satu balita memiliki catatan riwayat pemantauan tumbuh kembang berkala yang banyak dari posyandu.

11. **`spatial_data`** (N) ➜ Polymorphic Target Models (`msmes` / `infrastructures` / `territories`)
    * *Jenis:* Polymorphic Relation (MorphTo / MorphMany)
    * *Keterangan:* Satu data spasial (koordinat/GeoJSON) dapat dimiliki oleh berbagai model entitas yang berbeda melalui kolom `feature_type` dan `feature_id`.
