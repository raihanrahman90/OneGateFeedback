<?php 
// mengaktifkan session php
session_start();

// menghubungkan dengan koneksi
include '../koneksi.php';
// menangkap data yang dikirim dari form
$id_aduan = $koneksi -> real_escape_string($_POST['id_aduan']);
$keterangan = $koneksi -> real_escape_string(htmlspecialchars($_POST['keterangan']));
$jenis = $koneksi -> real_escape_string($_POST['jenis']);
/**setting lokasi */
$id_lokasi = $koneksi -> real_escape_string($_POST['lokasi']);
$id_detail_lokasi = $koneksi -> real_escape_string($_POST['detail-lokasi']);
$data_lokasi = mysqli_query($koneksi, "SELECT nama_lokasi, nama_detail_lokasi from tb_lokasi
										inner join tb_detail_lokasi on tb_lokasi.id_lokasi = tb_detail_lokasi.id_lokasi
										where tb_lokasi.id_lokasi=$id_lokasi and tb_detail_lokasi.id_detail_lokasi=$id_detail_lokasi") or die(mysqli_error($koneksi));
$data_lokasi = mysqli_fetch_array($data_lokasi);
$nama_lokasi = $data_lokasi['nama_lokasi'];
$nama_detail_lokasi = $data_lokasi['nama_detail_lokasi'];
/**Setting Lokasi */
$perihalUrgent = $koneksi ->real_escape_string($_POST['perihalUrgent']);
if($perihalUrgent=='Tidak Urgent'){
	$urgensi = 0;
	$perihal = $koneksi -> real_escape_string($_POST['perihal']);
}else{
	$urgensi = 1;
	$perihal = $perihalUrgent;
}
$data = mysqli_query($koneksi, "SELECT * FROM tb_aduan where id_aduan='$id_aduan'") or die(mysqli_error($koneksi));
if($jenis=='Keluhan'){
    $status ='Request';
}else{
    $status='Closed';
}
$data = mysqli_fetch_array($data);
if(is_uploaded_file($_FILES['foto']['tmp_name'])){
	$nama = $_FILES['foto']['name'];
	$x = explode('.', $nama);
	$ekstensi = strtolower(end($x));
	$tipe_file = $_FILES['foto']['type'];
	$tmp_file = $_FILES['foto']['tmp_name'];
	// menyeleksi data ke dalam tb_aduan
	$id = $data['id_aduan'];
	$id1 = $id.".jpeg";
	// menghitung jumlah data yang ditemukan
	unlink('../gambar/aduan/'.$id1);
	move_uploaded_file($tmp_file, "../gambar/aduan/".$id1);
	$cek = mysqli_query($koneksi,"UPDATE tb_aduan SET foto='$id1' WHERE id_aduan = '$id_aduan'") or die(mysqli_error($koneksi));
    
}
    $cek = mysqli_query($koneksi,"UPDATE tb_aduan SET jenis='$jenis', ket='$keterangan', perihal='$perihal', status='$status', urgensi='$urgensi',
									id_detail_lokasi='$id_detail_lokasi', nama_lokasi='$nama_lokasi', nama_detail_lokasi='$nama_detail_lokasi'
									WHERE id_aduan = '$id_aduan'") or die(mysqli_error($koneksi));
    header('Location:../customer/tampil_antri.php?id='.$id_aduan);
    die();
?>