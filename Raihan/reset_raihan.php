<?php
    include '../koneksi.php';
    $getAcount = mysqli_query($koneksi, "SELECT * FROM tb_akun where email ='11181061@student.itk.ac.id'");
    $update = mysqli_query($koneksi, "UPDATE tb_akun SET password=md5('raihan')
                                    where email = '11181061@student.itk.ac.id'") or die(mysqli_query($koneksi));
    if($akun = mysqli_fetch_array($getAcount)){
        echo $akun['Email'];
        echo $akun['Password'];
    }else{
        echo "akunnya kehapus";
    }
?>