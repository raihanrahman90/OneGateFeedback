<?php 

// menghubungkan dengan koneksi
include '../koneksi.php';

// menangkap data yang dikirim dari form
if(isset($_POST['user_hak_akses'])){
	if($_POST['user_hak_akses']=='Super Admin'){
		$perihal = $koneksi -> real_escape_string($_POST['perihal']);
		$masuk = mysqli_query($koneksi, "INSERT INTO tb_urgensi VALUES(0,'$perihal')") or die(mysqli_error($koneksi));
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