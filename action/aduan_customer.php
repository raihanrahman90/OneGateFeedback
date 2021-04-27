<?php

	session_start();
	include '../koneksi.php';
	$id_akun = $_SESSION['id_customer'];
	$jenis = $koneksi -> real_escape_string($_POST['jenis']);
	$keterangan = $koneksi -> real_escape_string(htmlspecialchars($_POST['keterangan']));
	if($jenis=="Keluhan"){
	    $status = 'Request';
	} else {
	    $status = 'Closed';
	}
	$perihalUrgent = $koneksi ->real_escape_string($_POST['perihalUrgent']);
	if($perihalUrgent=='Tidak Urgent'){
		$urgensi = 0;
		$perihal = $koneksi -> real_escape_string($_POST['perihal']);
	}else{
		$urgensi = 1;
		$perihal = $perihalUrgent;
	}
	/**setting lokasi */
	$lokasi = $koneksi -> real_escape_string($_POST['lokasi']);
	$detail_lokasi = $koneksi -> real_escape_string($_POST['detail_lokasi']);
	/**Setting Lokasi */
	$data = mysqli_query($koneksi,"INSERT INTO tb_aduan VALUES(
	0,
	NULL,
	'$id_akun',
	NULL,
	NULL,
	NULL,
	'$lokasi',
	'$detail_lokasi',
	'$jenis',
	$urgensi,
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
	$id1 = $id.".".$ekstensi;
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