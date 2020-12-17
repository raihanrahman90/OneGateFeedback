<?php
    session_start();
    include "../koneksi.php";
    $id = $_GET['id'];
    if(isset($_SESSION['hak_akses'])){
        if($_SESSION['hak_akses']!='Super Admin'){
            echo"Anda tidak memiliki akses ke halaman ini, mohon login sebagai Super Admin";
        } else {
            $hapus_detail = mysqli_query($koneksi, "DELETE FROM tb_detail_lokasi WHERE id_lokasi = '$id'") or die(mysqli_error($koneksi));
            $hapus = mysqli_query($koneksi, "DELETE FROM tb_lokasi WHERE id_lokasi = '$id'") or die(mysqli_error($koneksi));
        header("Location:../Admin/list_lokasi.php");
        }    
    } else {
    	#masuk tanpa login
    	$_SESSION['status']='nerobos';
    	header("Location:../index.php");
    }
    
?>