<?php 
// mengaktifkan session php
session_start();

// menghubungkan dengan koneksi
include '../koneksi.php';

// menangkap data yang dikirim dari form
if(isset($_SESSION['hak_akses'])){
	if($_SESSION['hak_akses']=='Super Admin'){
		$perihal = $koneksi -> real_escape_string($_POST['perihal']);
		$masuk = mysqli_query($koneksi, "INSERT INTO tb_urgensi VALUES(0,'$perihal')") or die(mysqli_error($koneksi));
		header("location:../Admin/list_urgensi.php");
	}
} else {
    $_SESSION['status']='nerobos';
    header("location:../");
}
?>