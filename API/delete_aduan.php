<?php
session_start();

include '../koneksi.php';
if(isset($TOKEN)){
	if($TOKEN['hak_akses']!='Super Admin'){
		$result= json_encode(array('success'=>false,'message'=>'Anda Tidak memilih akses ke halaman ini'));
	} else {
		if(!isset($_GET)){
			$result= json_encode(array('success'=>false,'message'=>'Anda Tidak memilih akses ke halaman ini'));
		} else {
			$id = $_GET['id'];
			$result= json_encode(array('success'=>true));
		}
	}
} else {
	$result= json_encode(array('success'=>false,'message'=>'Anda Tidak memilih akses ke halaman ini'));
}
?>