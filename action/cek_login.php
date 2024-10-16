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
$query = mysqli_query($koneksi,"SELECT * FROM tb_akun WHERE Email='$username' and Password=md5('$password')");
$dataAkun = mysqli_fetch_array($query);
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($query);

if($cek > 0){
	$_SESSION['nama'] = $dataAkun['Nama'];
	$_SESSION['status'] = "login";
	$_SESSION['id_akun'] = $dataAkun['Id_akun'];
	$_SESSION['e-mail'] = $username;
	$_SESSION['status_akun'] = $dataAkun['status'];
	if($username!= 'bpn.ph@ap1.co.id' && $username!='bpn.os@injourneyairports.id'){
		$queryDepartemen = mysqli_query($koneksi,"SELECT * FROM tb_akun 
										LEFT JOIN tb_unit on tb_akun.id_unit = tb_unit.id_unit 
										LEFT JOIN tb_departemen on tb_departemen.id_departemen = tb_akun.id_departemen 
										WHERE Email='$username' and Password=md5('$password')");
		$dataDepartemen = mysqli_fetch_array($queryDepartemen);
		$_SESSION['departemen'] = $dataDepartemen['Departemen'];
		$_SESSION['id_departemen'] = $dataDepartemen['id_departemen'];
		$_SESSION['id_unit'] = $dataDepartemen['id_unit'];
		$_SESSION['nama_unit'] = $dataDepartemen['nama_unit'];
		$_SESSION['status_akun'] = $dataDepartemen['status'];
		$_SESSION['hak_akses'] = $dataDepartemen['hak_akses'];
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
	$queryCustomer = mysqli_query($koneksi,"SELECT * FROM tb_customer WHERE Email='$username' and Password=md5('$password')") or die(mysqli_error($koneksi));
	$countCustomer= mysqli_num_rows($queryCustomer);
	if($countCustomer > 0){
		$dataCustomer = mysqli_fetch_array($queryCustomer);
		$_SESSION['e-mail']=$username;
		if($dataCustomer['status']==1){
			$status_sebelumnya = $_SESSION['status'];
			$_SESSION['id_customer'] = $dataCustomer['id_customer'];
			$_SESSION['status'] = "login customer";
			if(isset($_SESSION['id_aduan'])){
				$id_aduan = $_SESSION['id_aduan'];
				unset($_SESSION['id_aduan']);
				header("Location:../customer/tampil_antri.php?id=".$id_aduan);
			}else{
				header("Location:../customer/");
			}
		} else if($dataCustomer['status']==2){
		    $_SESSION['status']='aktivasi ulang';
			$_SESSION['id_customer'] = $dataCustomer['id_customer'];
		    header("Location:../customer/aktivasi.php");
		}else {
			$_SESSION['status']='tidak aktif';
			header("Location:../ogfs.php");
		}		
	}else{
		$_SESSION['status']="gagal login";
		header("location:../ogfs.php");
	}
}