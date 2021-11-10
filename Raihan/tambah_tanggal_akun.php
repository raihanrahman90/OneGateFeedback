<?php
    include '../koneksi.php';
    $query = mysqli_query($koneksi, "ALTER TABLE tb_customer add column tanggal_pembuatan datetime") or die(mysqli_error($koneksi));
?>