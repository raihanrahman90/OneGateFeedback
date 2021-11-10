<?php 
// menghubungkan dengan koneksi
include 'header.php';

// menangkap data yang dikirim dari form
if(isset($TOKEN['hak_akses'])){
	if($TOKEN['hak_akses']=='Super Admin'){
		$perihal = $koneksi -> real_escape_string($_POST['perihal']);
		$masuk = mysqli_query($koneksi, "INSERT INTO tb_urgensi VALUES(0,'$perihal')") or die(mysqli_error($koneksi));
		$result= json_encode(array('success'=>true));
	}else{
		$result= json_encode(array('success'=>false,'message'=>'Halaman ini tidak dapat diakses oleh akun anda'));
	}
} else {
	$result= json_encode(array('success'=>false,'message'=>'Halaman ini tidak dapat diakses oleh akun anda'));
}
echo $result;
?>