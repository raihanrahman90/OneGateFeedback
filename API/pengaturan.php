<?php
	require_once('header.php');
	$id_akun = $TOKEN['id_akun'];
	$nama = $koneksi-> real_escape_string($_POST['Nama']);
	$email = $koneksi-> real_escape_string($_POST['E-mail']);
	$no_telp = $koneksi-> real_escape_string($_POST['Telp']);
	$password = $koneksi -> real_escape_string($_POST['password']);
	$query = mysqli_query($koneksi, "SELECT * FROM tb_akun WHERE Email='$email'") or die(mysqli_error($koneksi));
	$jumlah_data = mysqli_num_rows($query);
	$data_email_akun = mysqli_fetch_array($query);
	if($data_email_akun['Id_akun']!=$id_akun && $jumlah_data>0){
    	$TOKEN['status_jalan']='Email telah digunakan';
	} else {
    	if($_POST['default']){
    		$data = mysqli_query($koneksi, "UPDATE tb_akun SET Nama='$nama', Email='$email', No_Telp='$no_telp', password=md5('$password') where id_akun='$id_akun'")or die(mysqli_error($koneksi));
		} else {
    	    $data = mysqli_query($koneksi, "UPDATE tb_akun SET Nama='$nama', Email='$email', No_Telp='$no_telp' where id_akun='$id_akun'")or die(mysqli_error($koneksi));
    	}
		$TOKEN['email'] = $email;
		$TOKEN['nama'] = $nama;
	}
	echo json_encode(array('success'=>true));
?>