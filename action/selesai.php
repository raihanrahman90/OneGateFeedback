<?php 
// mengaktifkan session php
session_start();

// menghubungkan dengan koneksi
include '../koneksi.php';

// menangkap data yang dikirim dari form
if($_SESSION['hak_akses']=='Super Admin' || $_SESSION['hak_akses']=='Admin2'){
	$id_aduan = $_POST['id'];
	$id_akun = $_SESSION['id_akun'];
	$data = mysqli_query($koneksi, "UPDATE tb_aduan SET status = 'Closed' WHERE id_aduan ='$id_aduan'") or die(mysqli_error($koneksi));
	$data = mysqli_query($koneksi, "SELECT nama, email from tb_aduan 
									inner join tb_customer on tb_customer.id_customer = tb_aduan.id_customer where id_aduan='$id_aduan'")or die(mysqli_error($koneksi));
	$tindakan = mysqli_query($koneksi, "INSERT INTO tb_progress values(0,'$id_akun','$id_aduan','Closed', NULL, now())") or die(mysqli_error($koneksi));
	$data1 = mysqli_fetch_array($data);
	$nama = $data1['nama'];
	$email = $data1['email'];
	$subject = 'Feedback Customer Service Bandara SAMS Sepinggan Balikpapan';
	include '../pesan/closed_aduan.php';
	header("Location:../Admin/");
} else {
	//menyatakan tidak memiliki hak akses untuk mengubah
	$_SESSION['langgar']='nerobos';
	header("Location:../index.php");
}
?>