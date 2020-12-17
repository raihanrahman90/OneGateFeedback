<?php 
// mengaktifkan session php
session_start();

// menghubungkan dengan koneksi
include '../koneksi.php';

// menangkap data yang dikirim dari form
if(isset($_SESSION['hak_akses'])){
	if($_SESSION['hak_akses']=='Super Admin'){
	    $id = $koneksi -> real_escape_string($_POST['id']);
		$unit = $koneksi -> real_escape_string($_POST['unit']);
		echo $unit;
		echo $id;
		$masuk = mysqli_query($koneksi, "INSERT INTO tb_unit VALUES(0,'$id', '$unit')") or die(mysqli_error($koneksi));
		header("location:../Admin/detail_departemen.php?id=$id");
	}
} else {
    $_SESSION['status']='nerobos';
    header("location:../");
}
?>