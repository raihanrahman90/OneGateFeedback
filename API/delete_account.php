<?php

include 'header.php';
if(isset($TOKEN)){
	if($TOKEN['hak_akses']!='Super Admin'){
		$result= json_encode(array('success'=>false,'message'=>'Anda Tidak memilih akses ke halaman ini'));
	} else {
		$id = $_GET['id'];
		mysqli_query($koneksi, "DELETE FROM tb_akun WHERE id_akun='$id'") or die(mysqli_error($koneksi));
		$result = json_encode(array('success'=>true));
	}
} else {
	$result= json_encode(array('success'=>false,'message'=>'Anda Tidak memilih akses ke halaman ini'));
}
?>