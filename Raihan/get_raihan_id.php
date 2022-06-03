<?php
    include '../koneksi.php';
    $getAcount = mysqli_query($koneksi, "SELECT id_akun FROM tb_akun where email ='11181061@student.itk.ac.id'");
    if($akun = mysqli_fetch_array($getAcount)){
        echo $akun['id_akun'];
    }else{
        echo "akunnya kehapus";
    }
?>