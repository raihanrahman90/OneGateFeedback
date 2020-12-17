<?php

	session_start();
    include '../koneksi.php';
    if(isset($_SESSION['hak_akses'])){
        if($_SESSION['hak_akses']=='Super Admin'){
            $id_departemen = $koneksi -> real_escape_string($_POST['id_departemen']);
            $nama_departemen = $koneksi -> real_escape_string($_POST['nama_departemen']);
            $query = mysqli_query($koneksi, "UPDATE tb_departemen SET Departemen='$nama_departemen' where id_departemen='$id_departemen'") or die(mysqli_error($koneksi));
            header('Location:../Admin/detail_departemen.php?id='.$id_departemen);
        }
    }else{
        echo 'Anda tidak memiliki akses untuk merubah data';
    }
?>