<?php

include '../koneksi.php';
if(isset($_POST)){
	if($_POST['user_hak_akses']!='Super Admin'){
		$result = json_encode(array('success'=>false, 'msg'=>'Tidak memiliki akses'));
		echo $result;
	} else {
		if(!isset($_GET)){
			$result = json_encode(array('success'=>false, 'msg'=>'Data tidak valid'));
			echo $result;
		} else {
			$id = $_GET['id'];
			mysqli_query($koneksi, "DELETE FROM tb_akun WHERE id_akun='$id'") or die(mysqli_error($koneksi));
			$result = json_encode(array('success'=>true));
			echo $result;
		}
	}
} else {
	$result = json_encode(array('success'=>false, 'msg'=>'Tidak memiliki akses'));
	echo $result;
}
?>