<?php
    include '../koneksi.php';
    $id = $_GET['id'];
    mysqli_query($koneksi,"UPDATE tb_customer set status=1 where id_customer=$id") or die(mysqli_error($koneksi));
?>