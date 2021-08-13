<?php 
	// menghubungkan dengan koneksi
	include 'header.php';

	// menangkap data yang dikirim dari form
	$username = $koneksi -> real_escape_string($_POST['E-mail']);
	$password = $koneksi -> real_escape_string($_POST['Password']);

	// menyeleksi data admin dengan username dan password yang sesuai
	$data = mysqli_query($koneksi,"SELECT * FROM tb_akun WHERE Email='$username' and Password=md5('$password')");
	$data1 = mysqli_fetch_array($data);
	// menghitung jumlah data yang ditemukan
	$cek = mysqli_num_rows($data);

	if($cek > 0){
		$payload = array();
		$payload['nama'] = $data1['Nama'];
		$payload['status'] = "login";
		$payload['id_akun'] = $data1['Id_akun'];
		$payload['email'] = $username;
		$payload['status_akun'] = $data1['status'];
		if($username!= 'bpn.ph@ap1.co.id'){
			$data = mysqli_query($koneksi,"SELECT * FROM tb_akun 
											LEFT JOIN tb_unit on tb_akun.id_unit = tb_unit.id_unit 
											LEFT JOIN tb_departemen on tb_departemen.id_departemen = tb_akun.id_departemen 
											WHERE Email='$username' and Password=md5('$password')");
			$data1 = mysqli_fetch_array($data);
			$payload['departemen'] = $data1['Departemen'];
			$payload['id_departemen'] = $data1['id_departemen'];
			$payload['id_unit'] = $data1['id_unit'];
			$payload['nama_unit'] = $data1['nama_unit'];
			$payload['status_akun'] = $data1['status'];
			$payload['hak_akses'] = $data1['hak_akses'];
			$jwt = encodeToken($payload);
			if(isset($_POST['id_aduan'])){
				$id_aduan = $_POST['id_aduan'];
				if($_POST['detail']=='Aduan'){
					$result= json_encode(array('success'=>true,'token'=>$jwt,'id_aduan'=>$id_aduan, 'halaman'=>'Aduan'));
				}else{
					$result= json_encode(array('success'=>true,'token'=>$jwt,'id_aduan'=>$id_aduan, 'halaman'=>'Request'));
				}
			}else{
				$result= json_encode(array('success'=>true,'token'=>$jwt));
			}
		} else {
			$payload['id_customer']=0;
			$result= json_encode(array('success'=>true,'token'=>$jwt));
		}
	}else{
		$data = mysqli_query($koneksi,"SELECT * FROM tb_customer WHERE Email='$username' and Password=md5('$password')") or die(mysqli_error($koneksi));
		$cek= mysqli_num_rows($data);
		if($cek > 0){
			$data = mysqli_fetch_array($data);
			$payload['email']=$username;
			if($data['status']==1){
				$status_sebelumnya = $payload['status'];
				$payload['id_customer'] = $data['id_customer'];
				$payload['status'] = "login customer";
				$jwt = encodeToken($payload);
				if(isset($_POST['id_aduan'])){
					$id_aduan = $_POST['id_aduan'];
					$result= json_encode(array('success'=>true,'token'=>$jwt,'id_aduan'=>$id_aduan, 'halaman'=>'Aduan'));
				}else{
					$result= json_encode(array('success'=>true,'token'=>$jwt));
				}
			} else if($data['status']==2){
				$payload['status'] == "Aktivasi ulang";
				$jwt = encodeToken($payload);
				$result= json_encode(array('success'=>true,'message'=>'Akun anda belum diaktivasi oleh Customer Service'));
			}else {
				$result= json_encode(array('success'=>false,'message'=>'Akun anda belum diaktivasi oleh Customer Service'));
			}		
		}else{
			$result= json_encode(array('success'=>false,'message'=>'Username atau password salah'));
		}
	}
	echo $result;
?>