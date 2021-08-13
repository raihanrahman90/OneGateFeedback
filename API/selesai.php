<?php 
// mengaktifkan session php
require('header.php');

// menangkap data yang dikirim dari form
if($TOKEN['hak_akses']=='Super Admin' || $TOKEN['hak_akses']=='Admin2'){
	$id_aduan = $_POST['id'];
	$id_akun = $TOKEN['id_akun'];
	$nama = $koneksi ->real_escape_string($_POST['nama']);
	$data = mysqli_query($koneksi, "UPDATE tb_aduan SET status = 'Closed' WHERE id_aduan ='$id_aduan'") or die(mysqli_error($koneksi));
	$data = mysqli_query($koneksi, "SELECT nama, email from tb_aduan 
									inner join tb_customer on tb_customer.id_customer = tb_aduan.id_customer where id_aduan='$id_aduan'")or die(mysqli_error($koneksi));
	$tindakan = mysqli_query($koneksi, "INSERT INTO tb_progress values(0,'$id_akun','$id_aduan','Closed oleh $nama', NULL, now())") or die(mysqli_error($koneksi));
	$data1 = mysqli_fetch_array($data);
	$nama = $data1['nama'];
	$email = $data1['email'];
	$subject = 'Feedback Customer Service Bandara SAMS Sepinggan Balikpapan';
	include '../pesan/closed_aduan.php';
	$result = json_encode(array('success'=>true));
} else {
	$result = json_encode(array('success'=>false,'message'=>"Akun Anda tidak memiliki akses ke halaman tersebut"));
}
echo $result;
?>