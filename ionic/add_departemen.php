<?php 

// menghubungkan dengan koneksi
include '../koneksi.php';

// menangkap data yang dikirim dari form
if(isset($_POST['user_hak_akses'])){
	if($_POST['user_hak_akses']=='Super Admin'){
		$Departemen = $koneksi -> real_escape_string($_POST['nama_departemen']);
		$masuk = mysqli_query($koneksi, "INSERT INTO tb_departemen VALUES(0,'$Departemen')") or die(mysqli_error($koneksi));
		$nomor = mysqli_insert_id($koneksi);
		$result = json_encode(array('success'=>true, 'id_departemen'=>$nomor));
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