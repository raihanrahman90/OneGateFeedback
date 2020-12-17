<?php 
// mengaktifkan session php
session_start();

// menghubungkan dengan koneksi
include '../koneksi.php';

// menangkap data yang dikirim dari form
if(isset($_SESSION['hak_akses'])){
	if($_SESSION['hak_akses']=='Super Admin'){
		$Departemen = $koneksi -> real_escape_string($_POST['Departemen']);
		$masuk = mysqli_query($koneksi, "INSERT INTO tb_departemen VALUES(0,'$Departemen')") or die(mysqli_error($koneksi));
		$nomor = mysqli_insert_id($koneksi);
		foreach ($_POST['unit'] as $row) {
			$data = mysqli_query($koneksi, "INSERT INTO tb_unit VALUES (0, '$nomor','$row')") or die(mysqli_error($koneksi));
		}
		header("location:../Admin/list_departemen.php");
	}else {
        $_SESSION['status']='nerobos';
        header("location:../");
    }
} else {
    $_SESSION['status']='nerobos';
    header("location:../");
}
?>