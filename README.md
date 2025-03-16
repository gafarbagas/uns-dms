# UNS Document Management System (UNS-DMS)

UNS-DMS adalah sistem manajemen dokumen berbasis web yang dibangun menggunakan Laravel. Ikuti langkah-langkah berikut untuk menginstal dan menjalankan proyek ini di lingkungan lokal Anda.

## 🚀 Instalasi

#### 1. Buat Database Baru
Buat sebuah database baru dengan nama sesuai keinginan Anda.

#### 2. Clone Repository
Buka terminal atau command prompt, lalu jalankan perintah berikut untuk meng-clone proyek ini:

```sh
git clone https://gitlab.com/hanandaiz23/uns-dms.git
```

Masuk ke direktori proyek:

```sh
cd uns-dms
```

#### 3. Konfigurasi Environment
Salin file .env.example menjadi .env:

```sh
cp .env.example .env
```

Buka file .env dan masukkan nama database yang telah dibuat pada bagian berikut:

```sh
DB_DATABASE=nama_database_anda
```

#### 4. Instalasi Dependensi

Jalankan perintah berikut untuk menginstal dependensi yang diperlukan:

```sh
composer install
```

#### 5. Generate Application Key
```sh
php artisan key:generate
```

#### 6. Migrasi dan Seeding Database
Jalankan perintah berikut untuk menjalankan migrasi dan seeding database:

```sh
php artisan migrate --seed
```

#### 7. Storage
Jalankan perintah berikut untuk menjalankan symlink storage:

```sh
php artisan storage:link
```

#### 8. Menjalankan Aplikasi
Gunakan perintah berikut untuk menjalankan server lokal Laravel:

```sh
php artisan serve
```

Akses aplikasi melalui browser dengan membuka:

```sh
http://127.0.0.1:8000
```

#### 🎯 Selesai!
Sekarang Anda sudah bisa menggunakan aplikasi UNS-DMS secara lokal. 🚀