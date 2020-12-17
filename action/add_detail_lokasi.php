<?php 
// mengaktifkan session php
session_start();

// menghubungkan dengan koneksi
include '../koneksi.php';

// menangkap data yang dikirim dari form
if(isset($_SESSION['hak_akses'])){
	if($_SESSION['hak_akses']=='Super Admin'){
	    $id_detail_lokasi = $koneksi -> real_escape_string($_POST['id']);
		$nama_detail_lokasi = $koneksi -> real_escape_string($_POST['nama_detail_lokasi']);
		$masuk = mysqli_query($koneksi, "INSERT INTO tb_detail_lokasi VALUES(0,'$id_detail_lokasi', '$nama_detail_lokasi')") or die(mysqli_error($koneksi));
		header("location:../Admin/detail_lokasi.php?id=$id_detail_lokasi");
	}else {
        $_SESSION['status']='nerobos';
        header("location:../");
    }
} else {
    $_SESSION['status']='nerobos';
    header("location:../");
}
?>