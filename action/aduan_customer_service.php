<?php

	session_start();
	include '../koneksi.php';
	$id_akun = $_SESSION['id_akun'];
	$jenis = $koneksi -> real_escape_string($_POST['jenis']);
	$perihal = $koneksi -> real_escape_string($_POST['perihal']);
	$keterangan = $koneksi -> real_escape_string($_POST['keterangan']);
	$pengguna = $koneksi -> real_escape_string($_POST['pengguna']);
	$pelapor = $koneksi -> real_escape_string($_SESSION['id_perusahaan']);
	$id_detail_lokasi = $koneksi -> real_escape_string($_POST['detail-lokasi']);
	if($jenis=="Keluhan"){
	    $status = 'Request';
	} else {
	    $status = 'Closed';
	}
	echo $id_akun;
	$data = mysqli_query($koneksi,"INSERT INTO tb_aduan VALUES(
	0,
	'$id_akun',
	NULL,
	NULL,
	'$id_detail_lokasi',
	'$jenis',
	'$perihal',
	'$pengguna',
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
header("Location:../customer/tampil_antri.php?id=$id");
?>