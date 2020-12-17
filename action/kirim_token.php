<?php
    session_start();
    include "../koneksi.php";
    $token = $koneksi-> real_escape_string($_POST['token']);
    $data = mysqli_query($koneksi, "SELECT * FROM tb_forgot_password where token='$token' and end>now()") or die(mysqli_error($koneksi));
    if(mysqli_num_rows($data)>0){
        $data = mysqli_fetch_array($data);
        $email = $data['email'];
        if($data['status_akun']=='admin'){
            $data = mysqli_query($koneksi, "SELECT * FROM tb_akun 
                LEFT JOIN tb_unit on tb_akun.id_unit = tb_unit.id_unit 
                LEFT JOIN tb_departemen on tb_departemen.id_departemen = tb_akun.id_departemen 
                where email='$email'") or die(mysqli_error($koneksi));
           	$data1 = mysqli_fetch_array($data);
    		$_SESSION['departemen'] = $data1['Departemen'];
    		$_SESSION['id_departemen'] = $data1['id_departemen'];
    		$_SESSION['id_unit'] = $data1['id_unit'];
    		$_SESSION['nama_unit'] = $data1['nama_unit'];
    		$_SESSION['status_akun'] = $data1['status'];
    		$_SESSION['hak_akses'] = $data1['hak_akses'];
        	$_SESSION['status'] = "akun";
        	$_SESSION['id_ganti'] = $data1['Id_akun'];
    		header("Location:../Admin");
        } else {
            $data = mysqli_query($koneksi,"SELECT * FROM tb_customer WHERE Email='$email'") or die(mysqli_error($koneksi));
        	$cek= mysqli_num_rows($data);
        	if($cek > 0){
        		$data = mysqli_fetch_array($data);
        		if($data['status']==1){
        			$_SESSION['id_ganti'] = $data['id_customer'];
			        $_SESSION['status'] = "customer";
        			header("Location:../customer/ganti_password.php");
        		} else {
        			$_SESSION['status']='tidak aktif';
        			header("Location:../index.php");
        		}		
        	}
        }
    } else {
        $_SESSION['status_jalan']="Token tidak ditemukan";
        header("location:../customer/kirim_token.php");
    }
?>