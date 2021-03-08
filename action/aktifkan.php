<?php
session_start();
include '../koneksi.php';
$id_customer = $koneksi -> real_escape_string($_POST['id']);
$query = mysqli_query($koneksi, "SELECT nama, email,status from tb_customer where id_customer='$id_customer'") or die(mysqli_error($koneksi));
$data = mysqli_fetch_array($query);
$nama_customer = $data['nama'];
$email_customer = $data['email'];
if(isset($_SESSION)){
	if($_SESSION['hak_akses']=='Super Admin'){
		if($data['status']=='0'){
			include '../pesan/aktifkan.php';
			##pengaktifan akun
			$aktif = mysqli_query($koneksi, "UPDATE tb_customer SET status=1 where id_customer = '$id_customer'") or die(mysqli_error($koneksi));
			mysqli_query($koneksi, "DELETE from tb_notif where email='$email_customer'");
			header("Location:../Admin/list_customer.php");
			##pengaktifan akun
		}else if($data['status']=='1'){
			##penonaktifan akun
			include '../pesan/nonaktifkan.php';
			$nonaktifkan = mysqli_query($koneksi, "UPDATE tb_customer SET status=2 where id_customer = '$id_customer'") or die(mysqli_error($koneksi));
			mysqli_query($koneksi, "DELETE from tb_notif where email='$email_customer'");
			header("Location:../Admin/list_customer.php");
			
		}
	} else {
		$_SESSION['status']='nerobos';
		header("location:../index.php");
	}
} else {
	$_SESSION['status']='nerobos';
	header("location:../index.php");
}
?>