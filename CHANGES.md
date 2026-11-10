# Ringkasan Perubahan Project

Dokumen ini merangkum perubahan fitur dan penyempurnaan yang telah dikerjakan pada project **Desa Cantik App / Pandawa**. Urutannya dimulai dari penyempurnaan statistik, kemudian fitur Buku Tamu dan SOP, hingga pengelolaan Logo Resmi serta Banner Utama.

## 1. Penyempurnaan Statistik Agregat

- Menyempurnakan tampilan statistik agregat agar lebih mudah dibaca.
- Menyesuaikan tampilan tabel dan kartu statistik supaya informasi lebih teratur.
- Memperbaiki penyajian data pada beberapa bagian statistik tanpa mengubah tujuan utama fitur.
- Menjaga agar perubahan tampilan tetap konsisten dengan layout dashboard yang sudah ada.
- Menambahkan penyesuaian pengalaman pengguna pada tampilan statistik desa dan wilayah.

## 2. Fitur Buku Tamu Desa

- Menambahkan halaman Buku Tamu untuk masyarakat.
- Menambahkan kartu Buku Tamu pada halaman Beranda.
- Menempatkan kartu Buku Tamu sebelum kartu Akses Data Lengkap pada tampilan mobile.
- Menyesuaikan tampilan desktop agar kartu Buku Tamu:
  - berada di tengah halaman;
  - menggunakan area penuh pada barisnya;
  - memiliki isi yang terpusat;
  - tetap menjaga ukuran dan posisi kartu lain.
- Memusatkan logo, judul, deskripsi, dan tombol pada kartu Buku Tamu.
- Menambahkan header dengan gradient pada halaman Buku Tamu.
- Menjaga urutan dan kenyamanan tampilan pada perangkat mobile.

## 3. Halaman Informasi SOP

- Menambahkan halaman publik `/sop`.
- Menambahkan menu SOP pada navbar desktop, navbar mobile, dan footer.
- Menyusun halaman SOP agar berisi:
  - pengantar layanan;
  - dasar atau regulasi;
  - tahapan alur layanan;
  - prinsip pelayanan;
  - ketentuan permohonan;
  - area untuk menampilkan diagram SOP.
- SOP dibuat sebagai halaman informasi publik, bukan sebagai formulir permintaan data.

## 4. Diagram SOP dan Pengelolaan Data Asset

Diagram SOP dapat dikelola oleh admin langsung dari halaman SOP:

- Admin dapat memilih dan mengunggah diagram.
- File harus berupa gambar JPG, PNG, atau WEBP.
- Ukuran file dibatasi maksimal 8 MB.
- Preview muncul sebelum upload dikonfirmasi.
- Tombol Batal dapat membatalkan pilihan file.
- Notifikasi keberhasilan ditampilkan setelah upload berhasil.
- Admin dapat menghapus diagram yang sudah tersimpan.
- Saat diagram diperbarui, file diagram lama ikut dihapus.
- Saat diagram dihapus:
  - file fisiknya dihapus dari penyimpanan aplikasi;
  - referensi file pada pengaturan desa ikut dikosongkan;
  - cache pengaturan desa diperbarui.

Untuk mendukung fitur ini, pengaturan desa mendapatkan tempat penyimpanan khusus untuk lokasi file diagram. Dengan begitu, aplikasi tidak hanya menghapus tampilan diagram, tetapi juga membersihkan file dan referensinya agar tidak meninggalkan data yang sudah tidak digunakan.

## 5. Logo Resmi Desa

Pengelolaan Logo Resmi ditambahkan pada halaman Pengaturan Desa.

- Admin dapat memilih file Logo Resmi.
- Preview ditampilkan sebelum perubahan diterapkan.
- Memilih file tidak langsung mengubah Logo yang sedang digunakan.
- Tombol Perbarui pada modal menjadi satu-satunya tombol untuk menerapkan perubahan.
- Tombol Batal menutup preview dan membatalkan file yang dipilih.
- Preview Logo menggunakan area crop berbentuk kotak 1:1.
- Bagian gambar yang berada di luar area crop tidak ikut digunakan.
- Gambar dapat digeser di dalam area crop untuk menentukan bagian Logo yang ingin dipakai.
- Setelah konfirmasi, hasil crop diproses menjadi file Logo baru.
- Saat Logo diperbarui, file Logo lama dihapus dari penyimpanan.
- Tombol Hapus Logo tetap tersedia.
- Saat Logo dihapus:
  - file Logo dihapus dari penyimpanan;
  - data lokasi Logo pada pengaturan desa dikosongkan;
  - Logo tidak lagi ditampilkan sebagai asset aktif.

Format Logo yang didukung meliputi JPG, JPEG, PNG, SVG, dan WEBP, dengan batas ukuran maksimal 2 MB.

## 6. Banner Utama

Pengelolaan Banner Utama juga ditambahkan pada halaman Pengaturan Desa.

- Admin dapat memilih file Banner.
- Preview ditampilkan dalam modal kecil agar tidak menutupi tombol aksi.
- Area preview dibuat tetap dan gambar tidak keluar dari batas area.
- Memilih file belum mengubah Banner yang sedang digunakan.
- Perubahan baru diterapkan setelah tombol Perbarui pada modal ditekan.
- Tombol Batal menutup preview dan membatalkan pilihan file.
- Tombol Hapus Banner tetap tersedia.
- Saat Banner diperbarui, file Banner lama dihapus.
- Saat Banner dihapus:
  - file Banner dihapus dari penyimpanan;
  - data lokasi Banner pada pengaturan desa dikosongkan;
  - Banner tidak lagi digunakan pada halaman publik.

Format Banner yang didukung adalah JPG, JPEG, PNG, dan WEBP, dengan batas ukuran maksimal 4 MB.

## 7. Konsistensi Pengaturan Desa

Perubahan Logo, Banner, dan Diagram SOP dibuat melalui alur pengelolaan yang sama agar data aplikasi tetap konsisten:

- file lama dibersihkan ketika asset diganti atau dihapus;
- data pengaturan desa ikut diperbarui setelah operasi berhasil;
- cache pengaturan desa dibersihkan agar perubahan segera terlihat;
- operasi penyimpanan menggunakan transaksi sehingga perubahan tidak berhenti di tengah proses;
- error dicatat dan admin menerima notifikasi ketika proses gagal.

Dengan alur ini, penghapusan asset tidak hanya menghilangkan gambar dari tampilan, tetapi juga membersihkan file penyimpanan dan informasi asset yang tersimpan pada pengaturan desa.

## 8. Keamanan dan Hak Akses

- Pengelolaan Diagram SOP, Logo, dan Banner hanya tersedia bagi admin yang sudah login.
- Route pengelolaan asset dilindungi autentikasi dan pembatasan peran admin.
- File divalidasi berdasarkan jenis dan ukuran sebelum disimpan.
- Proses hapus menggunakan route khusus agar tidak dilakukan melalui request update biasa.
- Kegagalan proses dicatat untuk membantu pemeriksaan aplikasi.

## 9. Validasi Perubahan

Validasi yang telah dijalankan selama pengembangan:

```powershell
php artisan migrate --force
php artisan view:cache
php artisan route:list --path=settings
php artisan route:list --path=sop
php -l app\Http\Controllers\Dashboard\Admin\VillageSettingController.php
php -l app\Services\Admin\VillageSettingService.php
git diff --check
npm run build
```

Validasi tersebut mencakup pemeriksaan migration, Blade view, route, syntax PHP, format perubahan, dan build asset frontend.