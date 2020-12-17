<?php
    include 'header.php';
    if($postjson==null){
		echo json_encode(array('success'=>false, 'msg'=>'Terjadi kesalahan'));
	}elseif($postjson['aksi']=='forgot-password'){
		$email = $koneksi -> real_escape_string($postjson['email']);
        $pengecekan = mysqli_query($koneksi, "SELECT * FROM tb_customer WHERE Email='$email'") or die(mysqli_error($koneksi));
        if(mysqli_num_rows($pengecekan)>0){
            $status_akun = 'customer';
        } else {
            $pengecekan = mysqli_query($koneksi, "SELECT * FROM tb_akun WHERE Email='$email'") or die(mysqli_error($koneksi));
            if(mysqli_num_rows($pengecekan)>0){
                $status_akun = 'admin';
            } else {
                echo json_encode(array('succeess'=>false,'msg'=>'Email tidak ditemukan'));
            }
        }
        if($status_akun){
            ///Mencari TOken
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                while(true){
                    $randomString = '';
                    for ($i = 0; $i < 6; $i++) {
                        $randomString .= $characters[rand(0, $charactersLength - 1)];
                    }
                    $cari = mysqli_query($koneksi, "SELECT * FROM tb_forgot_password where token ='$randomString'") or die(mysqli_error($koneksi));
                    if(mysqli_num_rows($cari)==0){
                        break;
                    }
                }
            ///mencari token
            $token = $randomString;
            $insert = mysqli_query($koneksi, "INSERT INTO tb_forgot_password value(0,'$token','$email','$status_akun',now(),DATE_ADD(NOW(), INTERVAL 1 HOUR))") or die(mysqli_error($koneksi));
            $id = mysqli_insert_id($koneksi);
            $data = mysqli_query($koneksi, "SELECT * FROM tb_forgot_password where id='$id'") or die(mysqli_error($koneksi));
            $data = mysqli_fetch_array($data);
            $token = $data['token'];
            $email = $data['email'];
            $end = $data['end'];
            include '../pesan/forgot_password.php';
            if($berhasil) $result = json_encode(array('success'=>true));
            else $result = json_encode(array('success'=>false, 'msg'=>'Gagal mengirim token'));
            echo $result;
        }
	}else if( $postjson['aksi']=="kirim-token"){
	    $token = $postjson['token'];
        $data = mysqli_query($koneksi, "SELECT * FROM tb_forgot_password where token='$token' and end>now()") or die(mysqli_error($koneksi));
        if(mysqli_num_rows($data)>0){
            $data = mysqli_fetch_array($data);
            $email = $data['email'];
            $dataakun = array();
            if($data['status_akun']=='admin'){
                $data = mysqli_query($koneksi, "SELECT * FROM tb_akun 
                    LEFT JOIN tb_unit on tb_akun.id_unit = tb_unit.id_unit 
                    LEFT JOIN tb_departemen on tb_departemen.id_departemen = tb_akun.id_departemen 
                    where email='$email") or die(mysqli_error($koneksi));
               	$data1 = mysqli_fetch_array($data);
               	$data_akun[] = array(
            		'departemen' => $data1['Departemen'],
            		'id_departemen' => $data1['id_departemen'],
            		'id_unit' => $data1['id_unit'],
            		'nama_unit' => $data1['nama_unit'],
            		'status_akun' => $data1['status'],
            		'hak_akses' => $data1['hak_akses'],
                	'status' => "akun",
                	'id_ganti' => $data1['Id_akun']
               	    );
            } else {
                $data = mysqli_query($koneksi,"SELECT * FROM tb_customer WHERE Email='$email'") or die(mysqli_error($koneksi));
            	$cek= mysqli_num_rows($data);
            	if($cek > 0){
            		$data = mysqli_fetch_array($data);
            		$id_customer = $data['id_customer'];
            		if($data['status']==1){
            			echo json_encode(array('success'=>true,'status'=>'customer','id_ganti'=>$id_customer));
            		} else {
            		    echo json_encode(array('success'=>false,'msg'=>'Akun anda sudah tidak aktif'));
            		}		
            	}
            }
        } else {
            echo json_encode(array('success'=>false,'msg'=>'Token tidak valid'));
        }
	} else if($postjson['aksi']=='ganti-password'){
	    $id_ganti = $postjson['id_ganti'];
	    $password = $koneksi -> real_escape_string($postjson['password']);
	    if($postjson['status']=='customer'){
	        $data = mysqli_query($koneksi, "UPDATE tb_customer set password=md5('$password') where id_customer='$postjson[id_ganti]'");
	    } else {
	        $data = mysqli_query($koneksi, "UPDATE tb_akun set password=md5('$password') where id_akun='$postjson[id_ganti]'");
	    }
	    if($data) $result=json_encode(array('success'=>true));
	    else $result =json_encode(array('success'=>false));
	    echo $result;
	}
   
?>