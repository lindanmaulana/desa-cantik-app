# Panduan Langkah Solusi: Jika Projek Tidak Terbaca Pasca-Clone

Saat pertama kali melakukan `git clone`, folder `vendor`, `node_modules`, dan file `.env` tidak akan ikut terunduh karena masuk ke dalam daftar `.gitignore`. Hal ini menyebabkan folder `/var/www/public` di laptop menjadi kosong, sehingga Nginx gagal membaca dan menjalankan aplikasi.

Jalankan runtutan perintah berikut secara berurutan di terminal folder projekmu untuk mengisi kembali dependensi tersebut:

### Langkah 1: Gandakan File Environment
Buat file konfigurasi lokal baru dari template yang disediakan:


```bash
cp .env.example .env
```

### Langkah 2: Instal Dependensi Backend (PHP/Vendor)
```
docker compose run --rm app composer install
```


### Langkah 3: Instal Dependensi Frontend & Kompilasi Aset
```
docker compose run --rm app npm install
docker compose run --rm app npm run build
```

### Langkah 4: Buat Kunci Enkripsi Aplikasi (App Key)
```
docker compose run --rm app php artisan key:generate
```

### Langkah 5: Langkah 5: Muat Ulang Kontainer Docker
```
docker compose down && docker compose up -d
```





# Panduan2

## Langkah 1:
```
docker compose build
```

## Langkah 2:
```
docker compose up -d
```
