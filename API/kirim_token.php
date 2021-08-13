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
    		$TOKEN['departemen'] = $data1['Departemen'];
    		$TOKEN['id_departemen'] = $data1['id_departemen'];
    		$TOKEN['id_unit'] = $data1['id_unit'];
    		$TOKEN['nama_unit'] = $data1['nama_unit'];
    		$TOKEN['status_akun'] = $data1['status'];
    		$TOKEN['hak_akses'] = $data1['hak_akses'];
        	$TOKEN['status'] = "akun";
        	$TOKEN['id_ganti'] = $data1['Id_akun'];
    		header("Location:../Admin");
        } else {
            $data = mysqli_query($koneksi,"SELECT * FROM tb_customer WHERE Email='$email'") or die(mysqli_error($koneksi));
        	$cek= mysqli_num_rows($data);
        	if($cek > 0){
        		$data = mysqli_fetch_array($data);
        		if($data['status']==1){
        			$TOKEN['id_ganti'] = $data['id_customer'];
			        $TOKEN['status'] = "customer";
        			header("Location:../customer/ganti_password.php");
        		} else {
        			$TOKEN['status']='tidak aktif';
        			header("Location:../index.php");
        		}		
        	}
        }
    } else {
        $TOKEN['status_jalan']="Token tidak ditemukan";
        header("location:../customer/kirim_token.php");
    }
?>