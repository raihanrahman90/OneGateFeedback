<?php 
	// menghubungkan dengan koneksi
	include '../koneksi.php';
	// menangkap data yang dikirim dari form
	// menyeleksi data admin dengan username dan password yang sesuai
	$email = $koneksi -> real_escape_string($_POST['email']);
	$data = mysqli_query($koneksi,"SELECT id_customer, status FROM tb_customer WHERE Email='$email'");
	$data1 = mysqli_query($koneksi, "SELECT id_akun FROM tb_akun WHERE Email='$email'");
	// menghitung jumlah data yang ditemukan
	if(is_uploaded_file($_FILES['foto']['tmp_name'])){
		$nama = $_FILES['foto']['name'];
		$x = explode('.', $nama);
		$ekstensiFoto = strtolower(end($x));
	}
	if(is_uploaded_file($_FILES['pass_bandara']['tmp_name'])){
		$nama = $_FILES['pass_bandara']['name'];
		$x = explode('.', $nama);
		$ekstensiPassBandara = strtolower(end($x));
	}
	if($ekstensiPassBandara!='jpg'&&$ekstensiPassBandara!='jpeg'&&$ekstensiPassBandara!='png'){	
		$result = json_encode(array('success'=>false, 'msg'=>'Upload gambar dengan ekstensi jpg, jpeg, atau png'));
		echo $result;
	}elseif($ekstensiFoto!='jpg'&&$ekstensiFoto!='jpeg'&&$ekstensiFoto!='png'){
		$result = json_encode(array('success'=>false, 'msg'=>'Upload gambar dengan ekstensi jpg, jpeg, atau png'));
		echo $result;
	}else{
			
		$cek1 = mysqli_num_rows($data1);
		if($cek = mysqli_fetch_array($data)){
			if($cek['status']!=1){
				$nama_perusahaan = $koneksi -> real_escape_string($_POST['nama_perusahaan']);
				$gerai = $koneksi -> real_escape_string($_POST['gerai']);
				$password = $koneksi -> real_escape_string($_POST['password']);
				$id_pass_bandara = $koneksi -> real_escape_string($_POST['id_pass_bandara']);
				$nama = $koneksi -> real_escape_string($_POST['nama']);
				$telp = $koneksi -> real_escape_string($_POST['no_telp']);
				$masa_berlaku = $koneksi -> real_escape_string($_POST['masa_berlaku']);
				$kontrak = (isset($_POST['kontrak'])?$koneksi -> real_escape_string($_POST['kontrak']):null);
				if(empty($masa_berlaku)){
					$masa_berlaku=date('Y-m-d', strtotime('+1 year'));
				}
				$path_bandara = "../gambar/bypass/";
				$path_foto = "../gambar/foto/";
			
				$data = mysqli_query($koneksi,"Update tb_customer set
					nama_perusahaan='$nama_perusahaan', 
					gerai='$gerai', 
					nama='$nama',
					Email='$email',
					no_telp= '$telp',
					password=MD5('$password'),
					status='0',
					masa_berlaku='$masa_berlaku', 
					kontrak='$kontrak',
					id_pass_bandara='$id_pass_bandara',
					pass_bandara=NULL,
					foto=NULL,
					tanggal_pembuatan=now()
					WHERE Email ='$email' 
				") or die(mysqli_error($koneksi));
				$id = $cek['id_customer'];
				if(is_uploaded_file($_FILES['foto']['tmp_name'])){
					$tmp_foto = $_FILES['foto']['tmp_name'];
					$nama = $_FILES['foto']['name'];
					$x = explode('.', $nama);
					$ekstensi = strtolower(end($x));
					// menyeleksi data ke dalam tb_aduan
					
					$id_foto = $id.".".$ekstensi;
					$cek = mysqli_query($koneksi,"UPDATE tb_customer SET foto='$id_foto' WHERE id_customer = '$id'") or die(mysqli_error($koneksi));
					if(file_exists($path_foto.$id_foto)){
						unlink($path_foto.$id_foto);
					}
					move_uploaded_file($tmp_foto, $path_foto.$id_foto);
				}
				if(is_uploaded_file($_FILES['pass_bandara']['tmp_name'])){
					$tmp_pass = $_FILES['pass_bandara']['tmp_name'];
					$nama = $_FILES['pass_bandara']['name'];
					$x = explode('.', $nama);
					$ekstensi = strtolower(end($x));
					$id_pass = $id.".".$ekstensi;
					$cek = mysqli_query($koneksi,"UPDATE tb_customer SET pass_bandara='$id_pass' WHERE id_customer = '$id'") or die(mysqli_error($koneksi));
					if(file_exists($path_bandara.$id_pass)){
						unlink($path_bandara.$id_pass);
					}
					move_uploaded_file($tmp_pass, $path_bandara.$id_pass);
				}
				$cek_notif = mysqli_query($koneksi, "SELECT waktu FROM tb_notif WHERE email='$email'");
				if($row = mysqli_fetch_array($cek_notif)){
					mysqli_query($koneksi, "UPDATE tb_notif SET waktu=NOW() + INTERVAL 1 DAY WHERE email='$email'");
				}else{
					mysqli_query($koneksi, "INSERT INTO tb_notif value('".$email."', NOW() + INTERVAL 1 DAY)");
				}
				$_SESSION['status']= 'daftar';
				$to = $email;
				$nama_penerima = $nama;
				$subject = 'Konfirmasi Data Akun';
				include '../pesan/customer_register.php';
				$result = json_encode(array('success'=>true));
				echo $result;
			}else{
				$result = json_encode(array('success'=>false, 'msg'=>'Email telah digunakan'));
				echo $result; 
			}
		}else if($cek1 > 0){
			$result = json_encode(array('success'=>false, 'msg'=>'Email telah digunakan'));
			echo $result;
		}else{
			$nama_perusahaan = $koneksi -> real_escape_string($_POST['nama_perusahaan']);
			$gerai = $koneksi -> real_escape_string($_POST['gerai']);
			$password = $koneksi -> real_escape_string($_POST['password']);
			$id_pass_bandara = $koneksi -> real_escape_string($_POST['id_pass_bandara']);
			$nama = $koneksi -> real_escape_string($_POST['nama']);
			$telp = $koneksi -> real_escape_string($_POST['no_telp']);
			$masa_berlaku = $koneksi -> real_escape_string($_POST['masa_berlaku']);
			$kontrak = (isset($_POST['kontrak'])?$koneksi -> real_escape_string($_POST['kontrak']):null);
			if(empty($masa_berlaku)){
				$masa_berlaku=date('Y-m-d', strtotime('+1 year'));
			}
			$path_bandara = "../gambar/bypass/";
			$path_foto = "../gambar/foto/";
			
			$data = mysqli_query($koneksi,"INSERT INTO tb_customer VALUES(
				0,
				'$nama_perusahaan', 
				'$gerai', 
				'$nama',
				'$email',
				'$telp',
				MD5('$password'),
				'0',
				'$masa_berlaku', 
				'$kontrak',
				'$id_pass_bandara',
				NULL,
				NULL,
				now()
			)") or die(mysqli_error($koneksi));
			$id = mysqli_insert_id($koneksi);
			if(is_uploaded_file($_FILES['foto']['tmp_name'])){
				$tmp_foto = $_FILES['foto']['tmp_name'];
				$nama = $_FILES['foto']['name'];
				$x = explode('.', $nama);
				$ekstensi = strtolower(end($x));
				// menyeleksi data ke dalam tb_aduan
				
				$id_foto = $id.".".$ekstensi;
				$cek = mysqli_query($koneksi,"UPDATE tb_customer SET foto='$id_foto' WHERE id_customer = '$id'") or die(mysqli_error($koneksi));
				move_uploaded_file($tmp_foto, $path_foto.$id_foto);
			}
			if(is_uploaded_file($_FILES['pass_bandara']['tmp_name'])){
				$tmp_pass = $_FILES['pass_bandara']['tmp_name'];
				$nama = $_FILES['pass_bandara']['name'];
				$x = explode('.', $nama);
				$ekstensi = strtolower(end($x));
				$id_pass = $id.".".$ekstensi;
				$cek = mysqli_query($koneksi,"UPDATE tb_customer SET pass_bandara='$id_pass' WHERE id_customer = '$id'") or die(mysqli_error($koneksi));
				move_uploaded_file($tmp_pass, $path_bandara.$id_pass);
			}
			mysqli_query($koneksi, "INSERT INTO tb_notif value('".$email."', NOW() + INTERVAL 1 DAY)");
			$_SESSION['status']= 'daftar';
			$to = $email;
			$nama_penerima = $nama;
			$subject = 'Konfirmasi Data Akun';
			include '../pesan/customer_register.php';
			$result = json_encode(array('success'=>true));
			echo $result;
		}
	}

?>