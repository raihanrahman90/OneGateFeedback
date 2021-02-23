<?php

	session_start();
    include '../koneksi.php';
    if(isset($_SESSION['hak_akses'])){
        if($_SESSION['hak_akses']=='Super Admin'){
            $id_departemen = $koneksi -> real_escape_string($_POST['id_departemen']);
            $id_unit = $koneksi -> real_escape_string($_POST['id_unit']);
            $nama_unit = $koneksi -> real_escape_string($_POST['nama_unit']);
            $query_edit_aduan = mysqli_query($koneksi, "UPDATE tb_aduan SET nama_unit='$nama_unit' where id_unit='$id_unit'") or die(mysqli_error($koneksi));
            $query = mysqli_query($koneksi, "UPDATE tb_unit SET nama_unit='$nama_unit' where id_unit='$id_unit'") or die(mysqli_error($koneksi));
            header('Location:../Admin/detail_departemen.php?id='.$id_departemen);
        }
    }else{
        echo 'Anda tidak memiliki akses untuk merubah data';
    }
?>