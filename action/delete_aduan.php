<?php
session_start();

include '../koneksi.php';
if(isset($_SESSION)){
	if($_SESSION['hak_akses']!='Super Admin'){
		echo "Maaf, Anda tidak memiliki akses ke halaman ini";
	} else {
		if(!isset($_GET)){
			echo"data tidak valid";
		} else {
			$id = $_GET['id'];
			mysqli_query($koneksi, "DELETE FROM tb_aduan WHERE id_aduan='$id'") or die(mysqli_error($koneksi));
			header("Location:../Admin");
		}
	}
} else {
    $_SESSION['status']='nerobos';
    header("location:../");
}
?>