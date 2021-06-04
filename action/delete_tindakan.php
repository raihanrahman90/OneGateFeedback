<?php
    session_start();
    include "../koneksi.php";
    $id = $_GET['id'];
    if(isset($_SESSION['hak_akses'])){
        if($_SESSION['hak_akses']!='Super Admin'){
            echo"Anda tidak memiliki akses ke halaman ini, mohon login sebagai super admin";
        } else {
            $hapus = mysqli_query($koneksi, "DELETE FROM tb_progress WHERE id_progress = '$id'") or die(mysqli_error($koneksi));
            echo 'Berhasil dihapus';
        }
    } else {
        #nerobos
        $_SESSION['status']='nerobos';
        header("location:../");
    }
?>