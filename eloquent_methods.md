# Cheat Sheet: Method-Method Eloquent Laravel yang Wajib Diketahui

Dokumen ini berisi rangkuman method-method bawaan Eloquent ORM di Laravel yang sering digunakan dalam pengembangan aplikasi, mulai dari pengambilan data (retrieval), manipulasi data (CRUD), hingga agregasi.

---

## 1. Pengambilan Data (Retrieval)

### `all()`
Mengambil seluruh baris data dari sebuah tabel dalam bentuk Laravel *Collection*.
```php
$citizens = Citizen::all();
```

### `get()`
Mengeksekusi query yang sedang dibangun dan mengambil hasilnya (bisa dikombinasikan dengan `where`, `orderBy`, dll).
```php
$activeCitizens = Citizen::where('status', 'active')->get();
```

### `first()`
Mengambil **satu baris data pertama** yang ditemukan dari hasil query. Mengembalikan sebuah *Object/Model* tunggal.
```php
$firstCitizen = Citizen::where('gender', 'male')->first();
```

### `find($id)`
Mencari satu baris data berdasarkan Primary Key (`id`). Jika tidak ditemukan, akan mengembalikan `null`.
```php
$citizen = Citizen::find(1);
```

### `findOrFail($id)`
Sama seperti `find()`, tetapi jika data tidak ditemukan, Laravel akan otomatis melemparkan `404 Not Found Error`. Sangat bagus untuk *clean code*.
```php
$citizen = Citizen::findOrFail($id);
```

### `firstWhere($column, $value)`
Cara cepat untuk menggabungkan `where()` dan `first()`.
```php
// Menggantikan Citizen::where('nik', '12345')->first();
$citizen = Citizen::firstWhere('nik', '12345');
```

---

## 2. Pembuatan & Perubahan Data (Write / Update)

### `create(array $attributes)`
Memasukkan data baru ke database. Pastikan properti `$fillable` atau `$guarded` sudah diatur di dalam Model.
```php
$newCitizen = Citizen::create([
    'name' => 'John Doe',
    'gender' => 'male',
]);
```

### `save()`
Method universal untuk menyimpan model baru atau meng-update data yang sudah diubah ke database.
```php
// Untuk Update
$citizen = Citizen::find(1);
$citizen->name = 'Alex';
$citizen->save();
```

### `update(array $attributes)`
Mengubah data secara massal berdasarkan kondisi query tertentu.
```php
Citizen::where('status', 'pending')
    ->update(['status' => 'active']);
```

### `updateOrCreate(array $attributes, array $values)`
Mencari data berdasarkan parameter pertama. Jika ketemu, lakukan **update**. Jika tidak ketemu, buat data **baru**.
```php
$citizen = Citizen::updateOrCreate(
    ['nik' => '3201xxxx'], // Kondisi pencarian
    ['name' => 'Ahmad', 'gender' => 'male'] // Data yang di-update/dibuat
);
```

---

## 3. Penghapusan Data (Delete)

### `delete()`
Menghapus instance model yang sedang aktif dari database.
```php
$citizen = Citizen::find(5);
$citizen->delete();
```

### `destroy($ids)`
Menghapus data langsung menggunakan ID tanpa perlu mencari datanya terlebih dahulu menggunakan `find()`.
```php
Citizen::destroy(5);
Citizen::destroy([1, 2, 3]); // Bisa pakai array ID
```

---

## 4. Metode Agregasi (Perhitungan)

Method-method ini langsung mengembalikan nilai angka (*integer/float*), bukan objek model.

### `count()`
Menghitung total baris data yang sesuai dengan kriteria.
```php
$totalMale = Citizen::where('gender', 'male')->count();
```

### `sum($column)`
Menjumlahkan nilai dari kolom tertentu.
```php
$totalIncome = Financial::sum('amount');
```

### `avg($column)` / `average($column)`
Menghitung nilai rata-rata dari kolom tertentu.
```php
$averageAge = Citizen::avg('age');
```

### `max($column)` & `min($column)`
Mencari nilai tertinggi atau terendah pada kolom tertentu.
```php
$highestPrice = Msme::max('product_price');
```

---

## 5. Seleksi & Pengondisian Tingkat Lanjut

### `select($columns)`
Membatasi kolom apa saja yang ingin diambil dari database demi menghemat memori server.
```php
$citizens = Citizen::select('id', 'name', 'nik')->get();
```

### `selectRaw($expression)`
Menuliskan perintah SQL mentah secara langsung di dalam fungsi SELECT (seperti trik kondisional agregasi kita).
```php
$stats = Citizen::selectRaw("COUNT(*) as total, SUM(CASE WHEN gender='male' THEN 1 ELSE 0 END) as males")->first();
```

### `whereIn($column, array $values)`
Mencari data yang nilainya ada di dalam list array yang ditentukan (mirip seperti `OR` beruntun).
```php
$damaged = Infrastructure::whereIn('condition', ['damaged_light', 'damaged_severe'])->get();
```

### `whereNull($column)` & `whereNotNull($column)`
Mencari data yang kolomnya bernilai kosong (`NULL`) atau tidak kosong.
```php
$anonymous = Citizen::whereNull('email')->get();
```

---

## 6. Pengurutan & Batasan (Ordering & Paging)

### `orderBy($column, $direction)`
Mengurutkan data berdasarkan kolom tertentu secara `asc` (terkecil ke terbesar) atau `desc` (terbesar ke terkecil).
```php
$newestCitizens = Citizen::orderBy('created_at', 'desc')->get();
```

### `latest()` & `oldest()`
Cara cepat untuk mengurutkan berdasarkan waktu pembuatan (`created_at`).
```php
$newest = Citizen::latest()->get(); // Sama dengan orderBy('created_at', 'desc')
```

### `limit($value)` / `take($value)`
Membatasi jumlah baris data yang ditarik dari database.
```php
$topFiveMsmes = Msme::latest()->take(5)->get();
```

### `paginate($perPage)`
Membuat fitur halaman (paginasi) otomatis. Laravel akan langsung memotong data dan mengatur tautan halaman di Blade.
```php
$citizens = Citizen::paginate(10); // 10 data per halaman
```
