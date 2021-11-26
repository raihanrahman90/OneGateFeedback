<?php
    include '../koneksi.php';
    $id_customer = $koneksi -> real_escape_string($_POST['id_customer']);
    $masa_berlaku = $koneksi -> real_escape_string($_POST['masa_berlaku']);
    if(empty($masa_berlaku)){
    	$masa_berlaku=date('Y-m-d', strtotime('+1 year'));
    }
    $id_pass_bandara = $koneksi -> real_escape_string($_POST['id_pass_bandara']);
    if(!empty($_FILES)){
    	$tmp_file = $_FILES['pass_bandara']['tmp_name'];
    	// menyeleksi data ke dalam tb_aduan
    	$id = $id_customer;
    	$id1 = $id.".jpeg";
    	// menghitung jumlah data yang ditemukan
    	$cek = mysqli_query($koneksi,"UPDATE tb_customer SET pass_bandara='$id1', masa_berlaku='$masa_berlaku', id_pass_bandara='$id_pass_bandara', status='0' WHERE id_customer = '$id_customer'") or die(mysqli_error($koneksi));
    	if(file_exists("../gambar/bypass/".$id1)){
    	    if(!unlink("../gambar/bypass/".$id1)){
				$result = json_encode(array('success'=>false, 'msg'=>'Terjadi kesalahan'));
				echo $result;
    	    }
    	}
    	move_uploaded_file($tmp_file, "../gambar/bypass/".$id1);
    } else {
        $cek = mysqli_query($koneksi, "UPDATE tb_customer SET masa_berlaku='$masa_berlaku', id_pass_bandara='$id_pass_bandara', status='0' where id_customer = '$id_customer'") or die(mysqli_error($koneksi));
    }
    $cari = mysqli_query($koneksi, "SELECT nama, email from tb_customer where id_customer='$id_customer'") or die(mysqli_error($koneksi));
    $datacari = mysqli_fetch_array($cari);
    $_SESSION['status']= 'daftar';
	$to = $datacari['email'];
	$nama = $datacari['nama'];
	$subject = 'Konfirmasi Data Akun';
	include '../pesan/customer_register.php';
	$result = json_encode(array('success'=>true));
	echo $result;
?>