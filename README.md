# Perpustakaan PHP
Sistem perpustakaan sederhana untuk SMK Karya Bhakti Brebes.

## Ringkasan
Aplikasi ini berisi:
- Halaman utama dengan pilihan login anggota dan login admin
- Portal anggota untuk melihat buku, meminjam, dan melihat riwayat
- Portal admin untuk menambah dan melihat data anggota
- Koneksi database menggunakan PDO
- Bootstrap di-load dari CDN

## Struktur Folder
```
perpusatakaan-php/
├── index.php
├── koneksi.php
├── login/
│   ├── login-anggota.php
│   ├── login-admin.php
│   └── logout.php
├── anggota/
│   ├── dashboard.php
│   ├── data_buku.php
│   ├── form_pinjam.php
│   ├── pinjam_buku.php
│   └── history_peminjaman.php
└── admin/
    ├── dashboard.php
    ├── input_anggota.php
    ├── data_anggota.php
    └── logout.php
```

## Koneksi Database
File koneksi berada di `koneksi.php` dan menggunakan PDO:
```php
$koneksi = new PDO(
    "mysql:host=$host;dbname=$database;charset=utf8mb4",
    $username,
    $password,
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
);
```

## Tabel Database yang Dibutuhkan
Contoh struktur database:

### `anggota`
- `id_anggota` INT AUTO_INCREMENT PRIMARY KEY
- `nis` VARCHAR(50)
- `nama_anggota` VARCHAR(100)
- `username` VARCHAR(50)
- `password` VARCHAR(255)
- `kelas` VARCHAR(50)

### `admin`
- `id_admin` INT AUTO_INCREMENT PRIMARY KEY
- `nama_admin` VARCHAR(100)
- `username` VARCHAR(50)
- `password` VARCHAR(255)

Contoh admin default:
```sql
INSERT INTO admin (nama_admin, username, password) VALUES ('Admin', 'admin', 'admin123');
```

### `buku`
- `id_buku` INT AUTO_INCREMENT PRIMARY KEY
- `judul_buku` VARCHAR(255)
- `pengarang` VARCHAR(100)
- `penerbit` VARCHAR(100)
- `tahun_terbit` YEAR
- `status` VARCHAR(20)

### `transaksi`
- `id_trasnsaksi` INT AUTO_INCREMENT PRIMARY KEY
- `id_anggota` INT
- `id_buku` INT
- `tgl_pinjam` DATE
- `tgl_kembali` DATE
- `status_transaksi` VARCHAR(50)

> Pastikan `id_anggota` dan `id_buku` diisi sesuai dengan data di tabel `anggota` dan `buku`.

## Cara Install
1. Letakkan seluruh folder proyek di web server lokal (misalnya `htdocs` atau `www`).
2. Buat database MySQL `perpustakaan_smk`.
3. Sesuaikan kredensial di `koneksi.php` jika diperlukan.
4. Import atau buat tabel sesuai struktur di atas.
5. Akses `index.php` melalui browser.

## Cara Pakai
1. Buka `index.php`
2. Pilih `Login Anggota`, `Daftar Anggota`, atau `Login Admin`
3. Untuk anggota baru, klik `Daftar Anggota` lalu buat akun
4. Login dengan akun yang sudah terdaftar
5. Anggota bisa melihat daftar buku, meminjam, dan melihat riwayat peminjaman
6. Admin bisa menambah anggota dan melihat data anggota

## Catatan
- Bootstrap dan Bootstrap Icons menggunakan CDN, sehingga tidak memerlukan file CSS lokal.
- Semua query database diupgrade ke PDO dengan prepared statements.
- Untuk keamanan lebih baik, sebaiknya password disimpan dalam bentuk hash (`password_hash` / `password_verify`).

