<?php 
// mengaktifkan session php

// menghubungkan dengan koneksi
include '../koneksi.php';

// menangkap data yang dikirim dari form
if(isset($_POST['user_hak_akses'])){
	if($_POST['user_hak_akses']=='Super Admin'){
		$nama_lokasi = $koneksi -> real_escape_string($_POST['nama_lokasi']);
		$masuk = mysqli_query($koneksi, "INSERT INTO tb_lokasi VALUES(0,'$nama_lokasi')") or die(mysqli_error($koneksi));
		$result = json_encode(array('success'=>true));
		echo $result;
	}else {
		$result = json_encode(array('success'=>false, 'msg'=>'Hak akses kosong'));
		echo $result;
    }
} else {
    $result = json_encode(array('success'=>false, 'msg'=>'Hak akses kosong'));
    echo $result;
}
?>