<?php 
// mengaktifkan session php
session_start();

// menghubungkan dengan koneksi
include '../koneksi.php';

// menangkap data yang dikirim dari form
$id_akun = $_SESSION['id_akun'];
$pelapor = $koneksi -> real_escape_string($_POST['pelapor']);
$unit = $koneksi -> real_escape_string($_POST['unit']);
$keterangan = $koneksi -> real_escape_string($_POST['Keterangan']);
$perihal = $koneksi -> real_escape_string($_POST['perihal']);
$data = mysqli_query($koneksi,"INSERT INTO tb_aduan VALUES(
	0,
	$id_akun,
	NULL,
	$unit,
	'Keluhan',
	'$perihal',
	'$pelapor',
	'$keterangan',
	'Open',now(),'',1)") or die(mysqli_error($koneksi));
if(is_uploaded_file($_FILES['myfile']['tmp_name'])){
	$nama = $_FILES['Bukti']['name'];
	$x = explode('.', $nama);
	$ekstensi = strtolower(end($x));
	$tipe_file = $_FILES['Bukti']['type'];
	$tmp_file = $_FILES['Bukti']['tmp_name'];
	// menyeleksi data ke dalam tb_aduan
	

	$id = mysqli_insert_id($koneksi);
	$id1 = $id.".".$ekstensi;
	// menghitung jumlah data yang ditemukan
	$cek = mysqli_query($koneksi,"UPDATE tb_aduan SET foto='$id1' WHERE id_aduan = '$id'") or die(mysqli_error($koneksi));
	move_uploaded_file($tmp_file, "../gambar/aduan/".$id1);
}
$tindakan = mysqli_query($koneksi, "INSERT INTO tb_progress values(0, '$id1', 'Request', NULL, now())");
header("Location:../Admin");
?>