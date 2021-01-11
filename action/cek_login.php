<?php 
// mengaktifkan session php
session_start();

// menghubungkan dengan koneksi
include '../koneksi.php';

// menangkap data yang dikirim dari form
$username = $koneksi -> real_escape_string($_POST['E-mail']);
$password = $koneksi -> real_escape_string($_POST['Password']);
$_SESSION['e-mail'] = $username;

// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($koneksi,"SELECT * FROM tb_akun WHERE Email='$username' and Password=md5('$password')");
$data1 = mysqli_fetch_array($data);
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);

if($cek > 0){
	$_SESSION['nama'] = $data1['Nama'];
	$_SESSION['status'] = "login";
	$_SESSION['id_akun'] = $data1['Id_akun'];
	$_SESSION['email'] = $username;
	$_SESSION['status_akun'] = $data1['status'];
	if($username!= 'bpn.ph@ap1.co.id'){
		$data = mysqli_query($koneksi,"SELECT * FROM tb_akun LEFT JOIN tb_unit on tb_akun.id_unit = tb_unit.id_unit LEFT JOIN tb_departemen on tb_departemen.id_departemen = tb_akun.id_departemen WHERE Email='$username' and Password=md5('$password')");
		$data1 = mysqli_fetch_array($data);
		$_SESSION['departemen'] = $data1['Departemen'];
		$_SESSION['id_departemen'] = $data1['id_departemen'];
		$_SESSION['id_unit'] = $data1['id_unit'];
		$_SESSION['nama_unit'] = $data1['nama_unit'];
		$_SESSION['status_akun'] = $data1['status'];
		$_SESSION['hak_akses'] = $data1['hak_akses'];
		if(isset($_SESSION['id_aduan'])){
			$id_aduan = $_SESSION['id_aduan'];
			if($_SESSION['detail']=='Aduan'){
				unset($_SESSION['detail']);
				unset($_SESSION['id_aduan']);
				header("Location:../Admin/detail_aduan.php?id=".$id_aduan);
			}else{
				unset($_SESSION['detail']);
				unset($_SESSION['id_aduan']);
				header("Location:../Admin/detail_request.php?id=".$id_aduan);
			}
		}else{
			header("Location:../Admin");
		}
	} else {
		$_SESSION['id_customer']=0;
		header("location:../customer");
	}
}else{
	$data = mysqli_query($koneksi,"SELECT * FROM tb_customer WHERE Email='$username' and Password=md5('$password')") or die(mysqli_error($koneksi));
	$cek= mysqli_num_rows($data);
	if($cek > 0){
		$data = mysqli_fetch_array($data);
		$_SESSION['email']=$username;
		if($data['status']==1){
			$status_sebelumnya = $_SESSION['status'];
			$_SESSION['id_customer'] = $data['id_customer'];
			$_SESSION['status'] = "login customer";
			echo $status_sebelumnya;
			if(isset($_SESSION['id_aduan'])){
				$id_aduan = $_SESSION['id_aduan'];
				unset($_SESSION['id_aduan']);
				header("Location:../customer/tampil_antri.php?id=".$id_aduan);
			}else{
				echo "yah dis ini";
				header("Location:../customer/");
			}
		} else if($data['status']==2){
		    $_SESSION['status']='aktivasi ulang';
			$_SESSION['id_customer'] = $data['id_customer'];
		    header("Location:../register/aktivasi.php");
		}else {
			$_SESSION['status']='tidak aktif';
			header("Location:../index.php");
		}		
	}else{
		$_SESSION['status']="gagal login";
		header("location:../index.php");
	}
}
?>