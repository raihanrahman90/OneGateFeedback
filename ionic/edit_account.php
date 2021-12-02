<?php
	include '../koneksi.php';
	
if(isset($_POST['user_hak_akses'])){
	if($_POST['user_hak_akses']=='Super Admin'){
        	$id_akun = $koneksi-> real_escape_string($_POST['id_akun']);
        	$status = $koneksi-> real_escape_string($_POST['status']);
        	$id_unit = $koneksi-> real_escape_string($_POST['id_unit']);
        	$id_departemen = $koneksi-> real_escape_string($_POST['id_departemen']);
        	$nama = $koneksi-> real_escape_string($_POST['Nama']);
        	$email = $koneksi-> real_escape_string($_POST['E-mail']);
        	$no_telp = $koneksi-> real_escape_string($_POST['Telp']);
			if(isset($_POST['password'])){
				$password = $koneksi -> real_escape_string($_POST['password']);
			}
        	$hak_akses = $koneksi -> real_escape_string($_POST['hak_akses']);
        	$data_email_akun = mysqli_query($koneksi, "SELECT * FROM tb_akun WHERE Email='$email'") or die(mysqli_error($koneksi));
        	$data_email_akun = mysqli_fetch_array($data_email_akun);
        	if(isset($data_email_akun['Id_akun']) && $data_email_akun['Id_akun']!=$id_akun ){
				$result = json_encode(array('success'=>false, 'msg'=>'Email telah digunakan'));
				echo $result;
        	} else {
            	if($status=='Senior Manager'){
            		if(isset($_POST['default'])){
            		    $data = mysqli_query($koneksi, "UPDATE tb_akun SET id_unit=NULL, id_departemen='$id_departemen', Nama='$nama', Email='$email', No_Telp='$no_telp', password=md5('$password'), status = '$status', hak_akses='$hak_akses' where id_akun='$id_akun'")or die(mysqli_error($koneksi));
            		} else {
            		    $data = mysqli_query($koneksi, "UPDATE tb_akun SET id_unit=NULL, id_departemen='$id_departemen', Nama='$nama', Email='$email', No_Telp='$no_telp', status = '$status', hak_akses='$hak_akses' where id_akun='$id_akun'")or die(mysqli_error($koneksi));
            		}
            	} else if($status == 'Manager' || $status == 'Unit'){
            		if(isset($_POST['default'])){
            		    $data = mysqli_query($koneksi, "UPDATE tb_akun SET id_unit='$id_unit', id_departemen='$id_departemen', Nama='$nama', Email='$email', No_Telp='$no_telp', status = '$status', hak_akses='$hak_akses', password=md5('$password') where id_akun='$id_akun'")or die(mysqli_error($koneksi));
            		} else {
            		    $data = mysqli_query($koneksi, "UPDATE tb_akun SET id_unit='$id_unit', id_departemen='$id_departemen', Nama='$nama', Email='$email', No_Telp='$no_telp', status = '$status', hak_akses='$hak_akses' where id_akun='$id_akun'")or die(mysqli_error($koneksi));
            		}
            	} else{
            		if(isset($_POST['default'])){
            		    $data = mysqli_query($koneksi, "UPDATE tb_akun SET id_unit=NULL, id_departemen=NULL, Nama='$nama', Email='$email', No_Telp='$no_telp', status = '$status', hak_akses='$hak_akses', password=md5('$password') where id_akun='$id_akun'")or die(mysqli_error($koneksi));
            		} else {
            		    $data = mysqli_query($koneksi, "UPDATE tb_akun SET id_unit=NULL, id_departemen=NULL, Nama='$nama', Email='$email', No_Telp='$no_telp', status = '$status', hak_akses='$hak_akses' where id_akun='$id_akun'")or die(mysqli_error($koneksi));
            		}
            	}
				$result = json_encode(array('success'=>true));
				echo $result;
        	}
	}else{
		$result = json_encode(array('success'=>false, 'msg'=>'Tidak memiliki akses'));
		echo $result;
	}
}else{
	$result = json_encode(array('success'=>false, 'msg'=>'Tidak memiliki akses'));
	echo $result;
}
?>