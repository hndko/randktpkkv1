# 🆔 IDENTITY GENERATOR (KTP & KK)

[![PHP](https://img.shields.io/badge/PHP-7.4%2B-blue?style=for-the-badge&logo=php)](https://www.php.net/)
[![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)](LICENSE)

> [!WARNING] > **EDUCATIONAL & TESTING PURPOSES ONLY**
> Tols ini dikembangkan khusus untuk keperluan testing software (software testing) dan pendidikan. Data yang dihasilkan adalah **DUMMY DATA** yang dibuat secara algoritmik/matematis dan **BUKAN** data asli penduduk.
>
> **DILARANG KERAS** menggunakan tools ini untuk tindakan Kriminal, Penipuan, atau Aktivitas Ilegal lainnya. Penalahgunaan tanggung jawab pengguna sepenuhnya.

## 🔥 Fitur Utama

- **Unlimited Generator**: Menghasilkan NIK & KK secara algoritmik tanpa batas (bukan database statis).
- **Valid Format**: Struktur nomor sesuai dengan standar administrasi (Provinsi, Kota, Tanggal Lahir, dll).
- **Region Support**: Mendukung berbagai kode wilayah (Aceh, Jakarta, Jawa Barat, dll).
- **Bulk Mode**: Generate ribuan data dalam sekali klik untuk kebutuhan stress test.
- **Lightweight**: Script PHP murni tanpa dependensi berat.

## 🚀 Cara Install & Penggunaan

1.  **Clone Repository**

    ```bash
    git clone https://github.com/hndko/randktpkkv1
    cd randktpkkv1
    ```

2.  **Jalankan Tools**

    ```bash
    php ktpkk.php
    ```

3.  **Pilih Menu**
    - `1` : Generate 1 Pasang (Detailed Info)
    - `2` : Generate Banyak (Bulk/Massal)

## 📋 Struktur Data

Data yang dihasilkan memiliki pola:

- **NIK**: `[KodeProv][KodeKota][KodeKec][TglLahir][NoUrut]`
- **KK**: `[KodeProv][KodeKota][KodeKec][TglTerbit][NoUrut]`

## 📞 Support & Community

- **Email**: uklteam22@gmail.com
- **Facebook Group**: [LocalHeart Community](https://www.facebook.com/groups/localheart/)
- **YouTube**: [LocalHeart Channel](https://youtube.com/localheart)

---

_Created by Z3R0-K x Mari Partner for Educational Purposes_
