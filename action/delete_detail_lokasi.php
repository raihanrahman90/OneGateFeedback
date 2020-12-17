<?php
    session_start();
    include "../koneksi.php";
    $id = $_GET['id'];
    if(isset($_SESSION['hak_akses'])){
        if($_SESSION['hak_akses']!='Super Admin'){
            echo"Anda tidak memiliki akses ke halaman ini, mohon login sebagai super admin";
        } else {
            $data = mysqli_query($koneksi, "SELECT id_lokasi from tb_detail_lokasi where id_detail_lokasi = '$id'") or die(mysqli_error($koneksi));
            $id_lokasi = mysqli_fetch_array($data);
            $id_lokasi = $id_lokasi['id_lokasi'];
            $hapus = mysqli_query($koneksi, "DELETE FROM tb_detail_lokasi WHERE id_detail_lokasi = '$id'") or die(mysqli_error($koneksi));
        header("Location:../Admin/detail_lokasi.php?id=$id_lokasi");
        }
    } else {
        #nerobos
        $_SESSION['status']='nerobos';
        header("location:../");
    }
?>