# SiJak21-Feature
> Fitur untuk Layanan Pemotongan Pajak PPh 21 dilengkapi dengan Dashboard Admin.

[![CodeIgniter Version](https://img.shields.io/badge/CodeIgniter-4-orange?style=flat-square)](https://codeigniter4.github.io/CodeIgniter4/)
[![PHP Version](https://img.shields.io/badge/PHP-8-blueviolet?style=flat-square)](https://www.php.net/)

Deskripsi singkat tentang apa yang dapat dilakukan produk Anda.

![Header](header.png)

## Persiapan Sebelum Instalasi

Sebelum Anda mulai menginstal SiJak21-Feature, pastikan Anda telah melakukan langkah-langkah persiapan berikut:

1. Pastikan Anda menggunakan CodeIgniter 4 dan PHP versi 8.
2. Salin file `env` dan beri nama `.env`. Atur konfigurasi database sesuai dengan pengaturan lokal Anda.
3. Buat database baru untuk SiJak21-Feature.

## Instalasi

1. Instal paket menggunakan Composer:

    ```sh
    composer install
    ```

2. hapus migrasi database dengan menjalankan perintah di terminal (opsional):

    ```sh
    php spark migrate:rollback
    ```
3. Lakukan migrasi database dengan menjalankan perintah di terminal:

    ```sh
    php spark migrate
    ```

## Contoh Penggunaan

Beberapa contoh penggunaan yang memotivasi dan berguna tentang bagaimana produk Anda dapat digunakan. Berikan beberapa blok kode dan mungkin beberapa tangkapan layar.

_Untuk lebih banyak contoh dan penggunaan, silakan lihat [Wiki][wiki]._

## Pengaturan Pengembangan

Jelaskan cara menginstal semua dependensi pengembangan dan cara menjalankan rangkaian uji otomatis.

```sh
composer install
vendor/bin/phpunit
```

## Riwayat Rilis

* 0.2.1
    * PERUBAHAN: Perbarui dokumen (kode modul tetap tidak berubah)
* 0.2.0
    * PERUBAHAN: Hapus `setDefaultXYZ()`
    * TAMBAH: Tambah `init()`
* 0.1.1
    * PERBAIKAN: Crash saat memanggil `baz()` (Terima kasih @GenerousContributorName!)
* 0.1.0
    * Rilis pertama yang sesuai
    * PERUBAHAN: Ganti nama `foo()` menjadi `bar()`
* 0.0.1
    * Sedang dalam pengembangan

## Meta

Your Name – [@YourTwitter](https://twitter.com/dbader_org) – YourEmail@example.com

Didistribusikan di bawah lisensi XYZ. Lihat `LICENSE` untuk informasi lebih lanjut.

[https://github.com/yourname/github-link](https://github.com/yourname/)