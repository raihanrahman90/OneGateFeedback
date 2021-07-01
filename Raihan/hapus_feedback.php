<?php
    include '../koneksi.php';
    $id = $_GET['id'];
    $query = mysqli_query($koneksi, "DELETE FROM tb_aduan where id_aduan=$id");
?>