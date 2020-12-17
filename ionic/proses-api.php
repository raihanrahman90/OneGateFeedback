<?php
	include "header.php";
	if($postjson==null){
		echo json_encode(array('success'=>false));
	}elseif($postjson['aksi']=='login'){
	    $password = $koneksi->real_escape_string($postjson['password']);
	    $email = $koneksi->real_escape_string($postjson['email']);
		$query=mysqli_query($koneksi, "SELECT * FROM tb_akun 
			WHERE Email='$email' AND password=md5('$password')") or die(mysqli_error($koneksi));
		$check = mysqli_num_rows($query);
		if($check>0){
          $data = mysqli_fetch_array($query);
          $datauser = array(
            'id_akun' => $data['Id_akun'],
            'Email' => $data['Email'],
            'id_unit'=> $data['id_unit'],
            'id_departemen'=>$data['id_departemen'],
            'status' =>$data['status'],
            'hak_akses' =>$data['hak_akses']
          );
          if($email=='bpn.ph@ap1.co.id'){
              $result = json_encode(array('success'=>true, 'status'=>'customer','kondisi'=>'Aktif','result'=>$datauser, 'msg'=>'Login Berhasil'));
          }else{
            $result = json_encode(array('success'=>true,'status'=>'akun', 'result'=>$datauser));
          }
        }else{
        	$query=mysqli_query($koneksi, "SELECT * FROM tb_customer 
			WHERE Email='$email' AND password=md5('$password')") or die(mysqli_error($koneksi));
			$check = mysqli_num_rows($query);
			if($check>0){
			    $data = mysqli_fetch_array($query);
				if($data['status']==1){
				    $datauser = array(
                        'id_customer' => $data['id_customer'],
                        'email' => $data['email']
                    );
					$result= json_encode(array('success'=>true, 'status'=>'customer','kondisi'=>'Aktif','result'=>$datauser, 'msg'=>'Login Berhasil'));
				} elseif($data['status']==2){
				    $datauser = array(
                        'id_customer' => $data['id_customer'],
                        'email' => $data['email']
                    );
					$result= json_encode(array('success'=>true, 'status'=>'customer','kondisi'=>"Tidak Aktif",'result'=>$datauser, 'msg'=>'Akun telah dinonaktifkan, mohon verivikasi kembali'));
				}else {
          		    $result = json_encode(array('success'=>false, 'status'=>'customer', 'msg'=>'Maaf akun anda belum aktif, mohon tunggu proses verifikasi'));          		
				}
          	}else{
          		$result = json_encode(array('success'=>false, 'msg'=>'Akun tidak ditemukan, pastikan Email dan Password sudah benar'));          		
          	}
        }
        echo $result;
	}  elseif($postjson['aksi']=='insert-aduan-customer'){
	    $id_customer = $koneksi ->real_escape_string($postjson['id_customer']);
	    $id_detail_lokasi = $koneksi ->real_escape_string($postjson['id_detail_lokasi']);
	    $jenis = $koneksi ->real_escape_string($postjson['jenis']);
	    $perihal = $koneksi ->real_escape_string($postjson['perihal']);
	    $pelapor = $koneksi ->real_escape_string($postjson['pelapor']);
	    $keterangan = $koneksi ->real_escape_string($postjson['keterangan']);
		$query = mysqli_query($koneksi, "INSERT INTO tb_aduan VALUES(
			0,
			NULL, 
			$id_customer, 
			NULL, 
			$id_detail_lokasi],
			'$jenis',
			'$perihal',
			'$pelapor',
			'$keterangan',
			'Request',
			now(),
			NULL,
			0)") or die(mysqli_query($koneksi));
		if($query) $result=json_encode(array('success'=>true));
		else $result =json_encode(array('success'=>false));
		echo $result;
	} elseif($postjson['aksi']=='insert-akun'){
		$status = $koneksi -> real_escape_string($postjson['status']);
		$nama = $koneksi -> real_escape_string($postjson['nama']);
		$email = $koneksi -> real_escape_string($postjson['email']);
		$password = $koneksi -> real_escape_string($postjson['password']);
		$no_telp = $koneksi -> real_escape_string($postjson['no_telp']);
		$hak_akses = $koneksi -> real_escape_string($postjson['hak_akses']);
		if($status== 'Senior Manager'){
			$id_unit = NULL;
			$id_departemen = $koneksi -> real_escape_string($postjson['id_departemen']);
		} elseif($status=="General Manager" || $status=="AOC Head"){
			$id_unit = NULL;
			$id_departemen = NULL;
		} else {
			$id_unit=$koneksi -> real_escape_string($postjson['id_unit']);
			$id_departemen = $koneksi -> real_escape_string($postjson['id_departemen']);
		}
		$query = mysqli_query($koneksi, "INSERT INTO tb_akun VALUES(
			0,
			$id_departemen,
			$id_unit,
			'$nama',
			'$email',
			md5('$password'),
			'$no_telp',
			'$status',
			'$hak_akses',
			NULL
			)");
		if($query) $result=json_encode(array('success'=>true));
		else $result =json_encode(array('success'=>false));
		echo $result;
	}elseif($postjson['aksi']=='refresh-session'){
	    $dataakun = array();
	    $id_akun = $koneksi -> real_escape_string($postjson['id_akun']);
	    $query = mysqli_query($koneksi, "SELECT * FROM tb_akun where id_akun='$id_akun'") or die(mysqli_error($koneksi));
	    if($row=mysqli_fetch_array($query)){
	        $dataakun = array(
            'id_akun' => $row['Id_akun'],
            'email' => $row['Email'],
            'id_unit'=> $row['id_unit'],
            'id_departemen'=>$row['id_departemen'],
            'status' =>$row['status'],
            'hak_akses' =>$row['hak_akses']
	        );
	        $berhasil = true;
	    }else{
	        $msg='Akun tidak ditemukan';
	        $berhasil = false;
	    }
	    if($query && $berhasil) $result = json_encode(array('success'=>true, 'result'=>$dataakun));
	    else $result = json_encode(array('success'=>false, 'msg'=>$msg));
	    echo $result;
	}elseif($postjson['aksi']=='insert-token'){
	    $token = $koneksi -> real_escape_string($postjson['token']);
	    $status = $koneksi -> real_escape_string($postjson['status']);
	    $id = $koneksi -> real_escape_string($postjson['id']);
	    $cari_token = mysqli_query($koneksi, "SELECT * FROM tb_token where token = '$token'");
	    if(mysqli_num_rows($cari_token)==0){
	        $insert = mysqli_query($koneksi, "INSERT INTO tb_token value('$status', '$id', '$token')") or die(mysqli_error($koneksi));
	    }else{
	        $insert = mysqli_query($koneksi, "UPDATE tb_token set id='$id', status='$status' where token='$token'");
	    }
	    if($insert) $result = json_encode(array('success'=>true));
	    else $result = json_encode(array('success'=>false));
	    echo $result;
	}elseif($postjson['aksi']=='logout'){
	    $token = $koneksi->real_escape_string($postjson['token']);
	    $delete = mysqli_query($koneksi, "DELETE from tb_token where token='$token'") or die(mysqli_error($koneksi));
	    if($delete) $result = json_encode(array('success'=>true));
	    else $result = json_encode(array('success'=>false));
	    echo $result;
	}
	
?>