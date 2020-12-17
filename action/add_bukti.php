<?php 
// mengaktifkan session php
session_start();

// menghubungkan dengan koneksi
include '../koneksi.php';

// menangkap data yang dikirim dari form
$username = $koneksi -> real_escape_string($_POST['Email']);
$password = $koneksi -> real_escape_string($_POST['Password1']);
$nama = $koneksi -> real_escape_string($_POST['nama']);
$telp = $koneksi -> real_escape_string($_POST['No_Telp']);
$gender = $koneksi -> real_escape_string($_POST['Gender']);
$bypass = $koneksi -> real_escape_string($_POST['Bypass']);
$nama_file = $_FILES['Bypass']['name'];
$ukuran_file = $_FILES['Bypass']['size'];
$tipe_file = $_FILES['Bypass']['type'];
$tmp_file = $_FILES['Bypass']['tmp_name'];
$path = "gambar/bypass/".$nama_file;	

// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($koneksi,"select * from tb_akun where Email='$username'");

// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);

if($cek > 0){
	$_SESSION['status']='Email telah digunakan';
	header("location:../register.php?");
}else{
	$data = mysqli_query($koneksi,"INSERT INTO tb_akun VALUES(
		0,
		NULL, 
		'$username', 
		MD5('$password'),
		'$gender', 
		'$telp',
		''
	)") or die(mysqli_query($koneksi));
}
?>