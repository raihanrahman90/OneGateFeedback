<?php

	session_start();
	include '../koneksi.php';
	$id_akun = $_SESSION['id_customer'];
	$jenis = $koneksi -> real_escape_string($_POST['jenis']);
	$perihal = $koneksi -> real_escape_string($_POST['perihal']);
	$keterangan = $koneksi -> real_escape_string($_POST['keterangan']);
	$id_detail_lokasi = $koneksi -> real_escape_string($_POST['detail-lokasi']);
	if($jenis=="Keluhan"){
	    $status = 'Request';
	} else {
	    $status = 'Closed';
	}
	$data = mysqli_query($koneksi,"INSERT INTO tb_aduan VALUES(
	0,
	NULL,
	'$id_akun',
	NULL,
	'$id_detail_lokasi',
	'$jenis',
	'$perihal',
	'Mitra',
	'$keterangan',
	'$status',
	now(),
	now(),
	NULL,
	-1)") or die(mysqli_error($koneksi));
	
	
	$id = mysqli_insert_id($koneksi);
if(is_uploaded_file($_FILES['foto']['tmp_name'])){
	$nama = $_FILES['foto']['name'];
	$x = explode('.', $nama);
	$ekstensi = strtolower(end($x));
	$tipe_file = $_FILES['foto']['type'];
	$tmp_file = $_FILES['foto']['tmp_name'];
	// menyeleksi data ke dalam tb_aduan
	
	$id = mysqli_insert_id($koneksi);
	$id1 = $id.".jpeg";
	// menghitung jumlah data yang ditemukan
	$cek = mysqli_query($koneksi,"UPDATE tb_aduan SET foto='$id1' WHERE id_aduan = '$id'") or die(mysqli_error($koneksi));
	move_uploaded_file($tmp_file, "../gambar/aduan/".$id1);
}
$query = mysqli_query($koneksi, "SELECT * FROM tb_customer WHERE id_customer='$id_akun'") or die(mysqli_error($koneksi));
$query = mysqli_fetch_array($query);
$id_keluhan = $id;
$email = $query['email'];
$nama = $query['nama'];
include "../pesan/aduan_customer.php";
$_SESSION['status_jalan']="baru mengirim";
header("location:../customer/tampil_antri.php?id=".$id_keluhan);
?>