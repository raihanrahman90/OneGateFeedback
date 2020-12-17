
### Folder
/register 
    halaman yang diakses customer ketika akan melakukan registrasi

/pesan
    Fungsi fungsi pengirim email

/ionic
    API dari aplikasi Android

/cronjob
    /cek_level.php
        mengecek apakah sudah saatnya aduan naik level
    /cek_masa_berlaku
        menonaktifkan akun jika sudah melewati masa aktif

/customer
    Halaman yang akan kustomer akses setelah login

/Admin
    Halaman yang akan diakses oleh admin setelah login

/gambar
    gambar yang disimpan dari proses

### Pemasangan website
### Koneksi database
Untuk mengubah koneksi database ubah pada file koneksi.php

### Link pada email
pada link.php ubah domain sesuai dengan domain website agar saat mengirim email link yang digunakan benar

### Pengiriman Email
Untuk mengatur pengiriman email, bisa dilakukan pada halaman /pesan/header.php
Ubah data pada /pesan/header.php sesuai dengan email pengirim pesan