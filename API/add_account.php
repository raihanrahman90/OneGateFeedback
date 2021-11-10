<?php 
// menghubungkan dengan koneksi
include 'header.php';

if(isset($TOKEN['hak_akses'])){
	if($TOKEN['hak_akses']=='Super Admin'){
        // menangkap data yang dikirim dari form
        $nama = $koneksi -> real_escape_string($_POST['Nama']);
        $email = $koneksi -> real_escape_string($_POST['E-mail']);
        $telp = $koneksi -> real_escape_string($_POST['Telp']);
        $status = $koneksi -> real_escape_string($_POST['status']);
        $departemen = $koneksi -> real_escape_string($_POST['departemen']);
        $unit = $koneksi -> real_escape_string($_POST['unit']);
        $hak_akses = $koneksi -> real_escape_string($_POST['hak_akses']);
        $password = $_POST['password'];
        // menyeleksi data admin dengan username dan password yang sesuai
        $data = mysqli_query($koneksi,"select * from tb_akun where Email='$email'");
        // menghitung jumlah data yang ditemukan
        $cek = mysqli_num_rows($data);
        if($cek>0){
			$result= json_encode(array('success'=>false,'message'=>'Email telah digunakan'));
        } else {
        	if($status=='Senior Manager'){
        	$data = mysqli_query($koneksi, "INSERT INTO tb_akun VALUES(
        			0,
        			'$departemen',
        			NULL,
        			'$nama',
        			'$email',
        			md5('$password'),
        			'$telp',
        			'$status',
        			'$hak_akses')") or die(mysqli_error($koneksi));
        	} else if( $status == 'Manager' || $status == 'Unit'){
        		$data = mysqli_query($koneksi, "INSERT INTO tb_akun VALUES(
        			0,
        			'$departemen',
        			$unit,
        			'$nama',
        			'$email',
        			md5('$password'),
        			'$telp',
        			'$status',
        			'$hak_akses')") or die(mysqli_error($koneksi));
        	} else {
        		$data = mysqli_query($koneksi, "INSERT INTO tb_akun VALUES(
        			0,
        			NULL,
        			NULL,
        			'$nama',
        			'$email',
        			md5('$password'),
        			'$telp',
        			'$status',
        			'$hak_akses')") or die(mysqli_error($koneksi));
        	}
        
			$result= json_encode(array('success'=>true));
        }
	}else {
		$result= json_encode(array('success'=>false,'message'=>'Halaman ini tidak dapat diakses oleh akun anda'));
    }
}else {
	$result= json_encode(array('success'=>false,'message'=>'Halaman ini tidak dapat diakses oleh akun anda'));
}
echo $result;

?>