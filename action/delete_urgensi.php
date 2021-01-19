<?php
    session_start();
    include "../koneksi.php";
    $id = $_GET['id'];
    if(isset($_SESSION['hak_akses'])){
        if($_SESSION['hak_akses']!='Super Admin'){
            echo"Anda tidak memiliki akses ke halaman ini, mohon login sebagai Super Admin";
        } else {
            $hapus = mysqli_query($koneksi, "DELETE FROM tb_urgensi WHERE id_urgensi = '$id'") or die(mysqli_error($koneksi));
        header("Location:../Admin/list_urgensi.php");
        }
    } else {
        #nerobos
        $_SESSION['status']='nerobos';
        header("location:../");
    }
    
?>