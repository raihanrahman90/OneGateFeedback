<?php
    session_start();
    include "../koneksi.php";
    $id = $_GET['id'];
    if(isset($_SESSION['hak_akses'])){
        if($_SESSION['hak_akses']!='Super Admin'){
            echo"Anda tidak memiliki akses ke halaman ini, mohon login sebagai Super Admin";
        } else {
            $data = mysqli_query($koneksi, "SELECT id_departemen from tb_unit where id_unit = '$id'") or die(mysqli_error($koneksi));
            $id_departemen = mysqli_fetch_array($data);
            $id_departemen = $id_departemen['id_departemen'];
            $hapus = mysqli_query($koneksi, "DELETE FROM tb_unit WHERE id_unit = '$id'") or die(mysqli_error($koneksi));
        header("Location:../Admin/detail_departemen.php?id=$id_departemen");
        }
    } else {
        #nerobos
        $_SESSION['status']='nerobos';
        header("location:../");
    }
    
?>