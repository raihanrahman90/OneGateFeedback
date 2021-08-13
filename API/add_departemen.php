<?php 
    include "header.php";

// menangkap data yang dikirim dari form
if(isset($TOKEN['hak_akses'])){
	if($TOKEN['hak_akses']=='Super Admin'){
		$Departemen = $koneksi -> real_escape_string($_POST['Departemen']);
		$masuk = mysqli_query($koneksi, "INSERT INTO tb_departemen VALUES(0,'$Departemen')") or die(mysqli_error($koneksi));
		$nomor = mysqli_insert_id($koneksi);
		foreach ($_POST['unit'] as $row) {
			$data = mysqli_query($koneksi, "INSERT INTO tb_unit VALUES (0, '$nomor','$row')") or die(mysqli_error($koneksi));
		}
		$result= json_encode(array('success'=>true));
	}else {
		$result= json_encode(array('success'=>false,'message'=>'Halaman ini tidak dapat diakses oleh akun anda'));
    }
} else {
	$result= json_encode(array('success'=>false,'message'=>'Halaman ini tidak dapat diakses oleh akun anda'));
}
echo $result;
?>