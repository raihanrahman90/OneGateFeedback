<?php
    include '../koneksi.php';
    $data = mysqli_query($koneksi, "SELECT * FROM tb_akun 
                                LEFT JOIN tb_unit on tb_akun.id_unit = tb_unit.id_unit 
                                LEFT JOIN tb_departemen on tb_departemen.id_departemen = tb_akun.id_departemen");
    foreach($data as $row){
        echo $row['Email'].$row['Password'].'</br>';
    }
?>