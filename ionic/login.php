<?php 

// menghubungkan dengan koneksi
include '../koneksi.php';

// menangkap data yang dikirim dari form
$username = $koneksi -> real_escape_string($_POST['email']);
$password = $koneksi -> real_escape_string($_POST['password']);
// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($koneksi,"SELECT * FROM tb_akun WHERE Email='$username' and Password=md5('$password')");
$data1 = mysqli_fetch_array($data);
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);
$hasil = array();
if($cek > 0){
	$hasil['nama'] = $data1['Nama'];
	$hasil['status'] = "login";
	$hasil['id_akun'] = $data1['Id_akun'];
	$hasil['email'] = $username;
	$hasil['status_akun'] = $data1['status'];
	if($username!= 'bpn.ph@ap1.co.id'){
		$data = mysqli_query($koneksi,"SELECT * FROM tb_akun 
										LEFT JOIN tb_unit on tb_akun.id_unit = tb_unit.id_unit 
										LEFT JOIN tb_departemen on tb_departemen.id_departemen = tb_akun.id_departemen 
										WHERE Email='$username' and Password=md5('$password')");
		$data1 = mysqli_fetch_array($data);
		$hasil['departemen'] = $data1['Departemen'];
		$hasil['id_departemen'] = $data1['id_departemen'];
		$hasil['id_unit'] = $data1['id_unit'];
		$hasil['nama_unit'] = $data1['nama_unit'];
		$hasil['status_akun'] = $data1['status'];
		$hasil['hak_akses'] = $data1['hak_akses'];
		echo json_encode(
			array(
				'success'=>true, 
				'id_departemen'=>$hasil['id_departemen'],
				'msg'=>'admin',
				'departemen'=>$hasil['departemen'],
				'id_unit'=>$hasil['id_unit'],
				'nama_unit'=>$hasil['nama_unit'],
				'status_akun'=>$hasil['status_akun'],
				'hak_akses'=>$hasil['hak_akses'],
				'email'=>$hasil['email'],
				'status_akun'=>$hasil['status_akun'],
				'id_akun'=>$hasil['id_akun'],
				'nama'=>$hasil['nama']
			)
		);
	} else {
		echo json_encode(array('success'=>true, 'data'=>$hasil, 'msg'=>'kustomer'));
	}
}else{
	$data = mysqli_query($koneksi,"SELECT * FROM tb_customer WHERE Email='$username' and Password=md5('$password')") or die(mysqli_error($koneksi));
	$cek= mysqli_num_rows($data);
	if($cek > 0){
		$data = mysqli_fetch_array($data);
		$hasil['email']=$username;
		if($data['status']==1){
			$hasil['id_customer'] = $data['id_customer'];
			echo json_encode(
				array(
					'success'=>true, 
					'id_customer'=>$hasil['id_customer'],
					'email'=>$hasil['email'], 
					'status'=>$data['status'], 
					'msg'=>'kustomer'
				)
			);
		} else if($data['status']==2){
		    $hasil['status']='aktivasi ulang';
			$hasil['id_customer'] = 2;
			echo json_encode(array('success'=>false, 'data'=>$hasil, 'status'=>$data['status']));
		}else {
			$_SESSION['status']=0;
			echo json_encode(array('success'=>true, 'data'=>$hasil, 'status'=>$data['status'], 'msg'=>'kustomer'));
		}		
	}else{
		echo json_encode(array('success'=>false, 'msg'=>'Data yang anda masukkan tidak ditemukan'));
	}
}
?>