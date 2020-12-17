<?php
session_start();

include '../koneksi.php';
if(isset($_SESSION)){
	if($_SESSION['hak_akses']!='Super Admin'){
		echo "Maaf, Anda tidak memiliki akses ke halaman ini";
	} else {
		if(!isset($_GET)){
			echo"data tidak valid";
		} else {
			$id = $_GET['id'];
			$data = mysqli_query($koneksi, "SELECT * FROM tb_customer where id_customer='$id'") or die(mysqli_error($koneksi));
			$data = mysqli_fetch_array($data);
			$foto = $data['foto'];
			$email_customer = $data['email'];
			$nama_customer = $data['nama'];
			if(file_exists('../gambar/foto/'.$foto)){
    			unlink('../gambar/foto/'.$foto);
			}
			if($data['pass_bandara'] && file_exists('../gambar/bypass/'.$data['pass_bandara'])){
			    unlink('../gambar/bypass/'.$data['pass_bandara']);
			}
			mysqli_query($koneksi, "DELETE FROM tb_customer WHERE id_customer='$id'") or die(mysqli_error($koneksi));
	    	mysqli_query($koneksi, "DELETE from tb_notif where email='$email_customer'");
	    	include '../pesan/delete_customer.php';
			header("Location:../Admin/list_customer.php");
		}
	}
} else {
	#masuk tanpa login
	$_SESSION['status']='nerobos';
	header("Location:../index.php");
}
?>