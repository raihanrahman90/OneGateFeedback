<?php 

// menghubungkan dengan koneksi
include '../koneksi.php';

// menangkap data yang dikirim dari form
if(isset($_POST['user_hak_akses'])){
	if($_POST['user_hak_akses']=='Super Admin'){
	    $id = $koneksi -> real_escape_string($_POST['id']);
		$unit = $koneksi -> real_escape_string($_POST['nama_unit']);
		$masuk = mysqli_query($koneksi, "INSERT INTO tb_unit VALUES(0,'$id', '$unit')") or die(mysqli_error($koneksi));
		$result = json_encode(array('success'=>true));
		echo $result;
	}else{
		
		$result = json_encode(array('success'=>false, 'msg'=>'Tidak memiliki akses'));
		echo $result;
	}
} else {
	$result = json_encode(array('success'=>false, 'msg'=>'Tidak memiliki akses'));
	echo $result;
}
?>