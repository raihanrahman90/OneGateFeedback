<?php 
// mengaktifkan session php
session_start();

// menghubungkan dengan koneksi
include '../koneksi.php';

// menangkap data yang dikirim dari form
if(isset($_SESSION['hak_akses'])){
	if($_SESSION['hak_akses']=='Super Admin'){
		$nama_lokasi = $koneksi -> real_escape_string($_POST['nama_lokasi']);
		$masuk = mysqli_query($koneksi, "INSERT INTO tb_lokasi VALUES(0,'$nama_lokasi')") or die(mysqli_error($koneksi));
		$nomor = mysqli_insert_id($koneksi);
		foreach ($_POST['detail'] as $row) {
			$data = mysqli_query($koneksi, "INSERT INTO tb_detail_lokasi VALUES (0, '$nomor','$row')") or die(mysqli_error($koneksi));
		}
		header("location:../Admin/list_lokasi.php");
	}else {
        $_SESSION['status']='nerobos';
        header("location:../");
    }
} else {
    $_SESSION['status']='nerobos';
    header("location:../");
}
?>