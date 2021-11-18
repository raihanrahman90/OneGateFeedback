<?php
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
			$result = json_encode(array(
								'success'=>false, 
								'id'=>$data['Id_akun'], 
								'status_akun'=>$data1['status'], 
								'hak_akses'=>$data1['hak_akses'],
								'nama_departemen'=>$data1['Departemen'],
								'id_departemen'=>$data1['id_departemen'],
								'id_unit'=>$data1['id_unit'],
								'nama_unit'=>$data1['nama_unit'],
							));
			echo $result;
        } else {
            $data = mysqli_query($koneksi,"SELECT * FROM tb_customer WHERE Email='$email'") or die(mysqli_error($koneksi));
        	$cek= mysqli_num_rows($data);
        	if($cek > 0){
        		$data = mysqli_fetch_array($data);
        		if($data['status']==1){
					$result = json_encode(array('success'=>false, 'id'=>$data['id_customer'], 'status'=>"customer"));
					echo $result;
        		} else {
					$result = json_encode(array('success'=>false, 'msg'=>'Akun anda belum diaktivasi oleh admin'));
					echo $result;
        		}		
        	}
        }
    } else {
		$result = json_encode(array('success'=>false, 'msg'=>'Token tidak ditemukan'));
		echo $result;
    }
?>