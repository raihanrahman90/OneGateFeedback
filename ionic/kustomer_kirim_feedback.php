<?php
	include '../koneksi.php';
	$id_akun = $_POST['id_customer'];
	$jenis = $koneksi -> real_escape_string($_POST['jenis']);
	$tanggal_kejadian = $koneksi -> real_escape_string($_POST['tanggal_kejadian']);
	$tanggal_kejadian = date_create_from_format('d/m/Y', $tanggal_kejadian);
	$tanggal_kejadian = date_format($tanggal_kejadian, 'Y-m-d');
	if(empty($_POST['keterangan_kejadian'])){
		$keterangan_kejadian = "NULL";
	}else{
		$keterangan_kejadian = "'".($koneksi -> real_escape_string($_POST['keterangan_kejadian']))."'";
	}
	$keterangan = $koneksi -> real_escape_string(htmlspecialchars($_POST['keterangan']));
	if($jenis=="Keluhan"){
	    $status = 'Request';
	} else {
	    $status = 'Closed';
	}
	$urgensi = $koneksi ->real_escape_string($_POST['perihal_urgent']);
	$perihal = $koneksi -> real_escape_string($_POST['perihal']);
	
	/**setting lokasi */
	$lokasi = $koneksi -> real_escape_string($_POST['lokasi']);
	$detail_lokasi = $koneksi -> real_escape_string($_POST['detail_lokasi']);
	/**Setting Lokasi */
	$data = mysqli_query($koneksi,"INSERT INTO tb_aduan VALUES(
	0,#id_aduan
	NULL,#id_akun
	'$id_akun',#id_customer
	NULL,#id_unit
	NULL,#nama_unit
	NULL,#nama_departemen
	'$detail_lokasi',#detail_lokasi
	'$lokasi',#lokasi
	'$jenis',#jenis
	$urgensi,#urgensi
	'$perihal',#perihal
	'Mitra',#pelapor
	'$keterangan',#keterangan
	'$status',#status
	now(),#waktu untuk level
	now(),#waktu_kirim
	'$tanggal_kejadian',#waktu_kejadian
	$keterangan_kejadian,#keterangan_kejadian
	NULL,#foto
	-1)") or die(mysqli_error($koneksi));#level
	$id = mysqli_insert_id($koneksi);
if(is_uploaded_file($_FILES['gambar']['tmp_name'])){
	$nama = $_FILES['gambar']['name'];
	$x = explode('.', $nama);
	$ekstensi = strtolower(end($x));
	$tipe_file = $_FILES['gambar']['type'];
	$tmp_file = $_FILES['gambar']['tmp_name'];
	// menyeleksi data ke dalam tb_aduan
	
	$id = mysqli_insert_id($koneksi);
	$id1 = $id.".".$ekstensi;
	// menghitung jumlah data yang ditemukan
	$cek = mysqli_query($koneksi,"UPDATE tb_aduan SET foto='$id1' WHERE id_aduan = '$id'") or die(mysqli_error($koneksi));
	move_uploaded_file($tmp_file, "../gambar/aduan/".$id1);
}
$tambahTanggalPengiriman = mysqli_query($koneksi, "INSERT INTO tb_progress value(0,NULL,$id,'Feedback dikirim oleh Mitra', NULL, now())") or die(mysyqli_error($koneksi));
$query = mysqli_query($koneksi, "SELECT * FROM tb_customer WHERE id_customer='$id_akun'") or die(mysqli_error($koneksi));
$query = mysqli_fetch_array($query);
$id_keluhan = $id;
$email = $query['email'];
$nama = $query['nama'];
include "../pesan/aduan_customer.php";
$result = json_encode(array('success'=>true, 'id_aduan'=>$id_keluhan));
echo $result;
?>