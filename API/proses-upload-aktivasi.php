<?php
    include 'header.php';
    $id_customer = $koneksi -> real_escape_string($_POST['id_customer']);
    $masa_berlaku = $koneksi -> real_escape_string($_POST['masa_berlaku']);
    if(empty($masa_berlaku)){
    	$masa_berlaku=date('Y-m-d', strtotime('+1 year'));
    }
    $id_pass_bandara = $koneksi -> real_escape_string($_POST['id_pass_bandara']);
    if(is_uploaded_file($_FILES['pass_bandara']['tmp_name'])){
    	$nama = $_FILES['pass_bandara']['name'];
    	$tipe_file = $_FILES['pass_bandara']['type'];
    	$tmp_file = $_FILES['pass_bandara']['tmp_name'];
    	// menyeleksi data ke dalam tb_aduan
    	$id1 = $id_customer.".jpeg";
    	// menghitung jumlah data yang ditemukan
    	$update = mysqli_query($koneksi,"UPDATE tb_customer SET pass_bandara='$id1', masa_berlaku='$masa_berlaku', id_pass_bandara='$id_pass_bandara', status='0' WHERE id_customer = '$id_customer'") or die(mysqli_error($koneksi));
    	if(file_exists("../gambar/bypass/".$id1)){
    	    unlink("../gambar/bypass/".$id1);
    	}
    	move_uploaded_file($tmp_file, "../gambar/bypass/".$id1);
    } else {
        $update = mysqli_query($koneksi,"UPDATE tb_customer SET pass_bandara=NULL, masa_berlaku='$masa_berlaku', id_pass_bandara='$id_pass_bandara', status='0' where id_customer = '$id_customer'") or die(mysqli_error($koneksi));
    }
    $cari = mysqli_query($koneksi, "SELECT nama, email from tb_customer where id_customer='$id_customer'") or die(mysqli_error($koneksi));
    $data_cari = mysqli_fetch_array($cari);
	$to = $data_cari['Email'];
	$nama_penerima = $data_cari['Nama'];
	$subject = 'Konfirmasi Data Akun';
	$nama = $nama_penerima;
	include '../pesan/customer_register.php';
	if($update) $result = json_encode(array('success'=>true));
	else $result = json_encode(array('success'=>false, 'msg'=>'Terjadi Kesalahan'));
	echo $result;
?>