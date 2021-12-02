<?php
    include "../koneksi.php";
    $id_ganti = $_POST['id'];

    $password = $koneksi -> real_escape_string($_POST['password']);
    if($_POST['status']=='customer'){
        $update = mysqli_query($koneksi, "Update tb_customer set password=md5('".$password."') where id_customer ='".$id_ganti."'") or die(mysqli_error($koneksi));
    } else {
        $update = mysqli_query($koneksi, "UPDATE tb_akun SET password=md5('".$password."')
        where id_akun = '$id_ganti'") or die(mysqli_query($koneksi));
    }
    echo json_encode(array('success'=>true))
?>