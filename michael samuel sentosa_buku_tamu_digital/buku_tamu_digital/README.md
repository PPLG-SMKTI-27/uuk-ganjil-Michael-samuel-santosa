# Buku Tamu Digital (SMK TI Airlangga)

Project tugas sekolah: Buku Tamu Digital.

## Struktur tugas untuk di-push ke GitHub
Buat repository di GitHub, lalu dalam repository buat folder dengan format:

`<nama_murid>_study_kasus`

Contoh: `andi_pratama_study_kasus`

Masukkan seluruh isi project ke dalam folder tersebut.

## Persiapan database
1. Jalankan MySQL/MariaDB dan buat database dengan mengimpor file SQL:

```powershell
# dari root project
mysql -u root -p < database\init.sql
```

2. File `database/init.sql` akan membuat database `buku_tamu_digital`, tabel `users` dan `tamu`, serta menambahkan user admin dengan username `admin` dan password `admin123` (disimpan sebagai MD5 untuk seed).

> Catatan: Aplikasi mendukung password modern (`password_hash`) dan juga fallback ke MD5 untuk kompatibilitas seed.

## Menjalankan aplikasi (development)
1. Pastikan PHP terinstal (CLI) dan berjalan. Dari folder project root jalankan:

```powershell
php -S localhost:8000 -t public
```

2. Buka browser ke `http://localhost:8000`.

## Folder penting
- `app/controllers/` — Controller (MVC)
- `app/models/` — Models (DB logic)
- `app/views/` — Views (HTML/PHP tampilan)
- `public/` — Document root (index.php, css)
- `database/init.sql` — Migration + seed

## Perubahan & catatan teknis
- Autoload dan require paths telah diperbaiki agar files di `app/controllers`, `app/models`, dan `config` dapat di-load.
- Model `User` sekarang mendukung `password_verify` dan juga fallback MD5 untuk akun seed.
- Aksi `delete` pada `TamuController` dibatasi hanya untuk `admin`.
- UI telah diperbarui dengan stylesheet modern di `public/css/style.css`.

## Langkah berikutnya yang saya bisa bantu
- Buat akun admin baru dengan `password_hash` (lebih aman).
- Tambah validasi input pada form dan sanitasi server-side.
- Tambah fitur export CSV / PDF untuk data tamu.
- Siapkan PWA atau langkah membungkus ke APK via Capacitor.

Sebutkan `nama_murid` yang ingin kamu gunakan untuk folder GitHub, maka saya akan buat contoh `README_GITHUB.md` yang berisi instruksi push ke folder tersebut.
