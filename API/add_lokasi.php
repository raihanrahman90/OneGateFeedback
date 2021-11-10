<?php 
    include "header.php";

	// menangkap data yang dikirim dari form
	if(isset($TOKEN['hak_akses'])){
		if($TOKEN['hak_akses']=='Super Admin'){
			$nama_lokasi = $koneksi -> real_escape_string($_POST['nama_lokasi']);
			$masuk = mysqli_query($koneksi, "INSERT INTO tb_lokasi VALUES(0,'$nama_lokasi')") or die(mysqli_error($koneksi));
			$result= json_encode(array('success'=>true));
		}else {
			$result= json_encode(array('success'=>false,'message'=>'Halaman ini tidak dapat diakses oleh akun anda'));
		}
	} else {
		$result= json_encode(array('success'=>false,'message'=>'Halaman ini tidak dapat diakses oleh akun anda'));
	}
	echo $result;
?>