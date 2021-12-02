<?php
include '../koneksi.php';
$id_customer = $koneksi -> real_escape_string($_POST['id_customer']);
$query = mysqli_query($koneksi, "SELECT nama, email,status from tb_customer where id_customer='$id_customer'") or die(mysqli_error($koneksi));
$data = mysqli_fetch_array($query);
$nama_customer = $data['nama'];
$email_customer = $data['email'];
if(isset($_POST)){
	if($_POST['hak_akses']=='Super Admin'){
		if($data['status']=='0'){
			include '../pesan/aktifkan.php';
			##pengaktifan akun
			$aktif = mysqli_query($koneksi, "UPDATE tb_customer SET status=1 where id_customer = '$id_customer'") or die(mysqli_error($koneksi));
			mysqli_query($koneksi, "DELETE from tb_notif where email='$email_customer'");
            $result = json_encode(array('success'=>true));
            echo $result;
			##pengaktifan akun
		}else if($data['status']=='1'){
			##penonaktifan akun
			$perihal = "Penonaktifan Akun";
			include '../pesan/nonaktifkan.php';
			$nonaktifkan = mysqli_query($koneksi, "UPDATE tb_customer SET status=2 where id_customer = '$id_customer'") or die(mysqli_error($koneksi));
			mysqli_query($koneksi, "DELETE from tb_notif where email='$email_customer'");
            $result = json_encode(array('success'=>true));
            echo $result;
			
		}
	} else {
		$result = json_encode(array('success'=>false, 'msg'=>'Tidak memiliki akses'));
		echo $result;
	}
} else {
	$result = json_encode(array('success'=>false, 'msg'=>'Tidak memiliki akses'));
	echo $result;
}
?>