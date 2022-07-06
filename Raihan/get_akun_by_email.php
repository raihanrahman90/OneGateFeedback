<?php
    include '../koneksi.php';
    $email = $_GET['email'];
    $getAcount = mysqli_query($koneksi, "SELECT id_akun FROM tb_akun where email ='$email'");
    if($akun = mysqli_fetch_array($getAcount)){
        echo $akun['id_akun'];
    }else{
        echo "akunnya kehapus";
    }
?>