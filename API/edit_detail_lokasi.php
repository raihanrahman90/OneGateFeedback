<?php

	session_start();
    include '../koneksi.php';
    if(isset($TOKEN['hak_akses'])){
        if($TOKEN['hak_akses']=='Super Admin'){
            $id_lokasi = $koneksi -> real_escape_string($_POST['id_lokasi']);
            $id_detail_lokasi = $koneksi -> real_escape_string($_POST['id_detail_lokasi']);
            $nama_detail_lokasi = $koneksi -> real_escape_string($_POST['nama_detail_lokasi']);
            $query = mysqli_query($koneksi, "UPDATE tb_detail_lokasi SET nama_detail_lokasi='$nama_detail_lokasi' where id_detail_lokasi='$id_detail_lokasi'") or die(mysqli_error($koneksi));
            header('Location:../Admin/detail_lokasi.php?id='.$id_lokasi);
        }
    }else{
        echo 'Anda tidak memiliki akses untuk merubah data';
    }
?>