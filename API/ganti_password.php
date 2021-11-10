<?php
    session_start();
    include "../koneksi.php";
    $id_ganti = $TOKEN['id_ganti'];

    $password = $koneksi -> real_escape_string($_POST['password1']);
    if($TOKEN['status']=='akun'){
        $update = mysqli_query($koneksi, "UPDATE tb_akun SET password=md5('".$password."')
        where id_akun = '$id_ganti'") or die(mysqli_query($koneksi));
    } else {
        $update = mysqli_query($koneksi, "Update tb_customer set password=md5('".$password."') where id_customer ='".$id_ganti."'") or die(mysqli_error($koneksi));
    }
    header("location:../");
?>