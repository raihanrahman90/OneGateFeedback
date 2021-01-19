<?php
	include 'header.php';// menangkap data yang dikirim dari form
	$jenis = $koneksi -> real_escape_string($_POST['jenis']);
	$perihal = $koneksi -> real_escape_string($_POST['perihal']);
	$keterangan = $koneksi -> real_escape_string($_POST['keterangan']);		
	$perihalUrgent = $koneksi ->real_escape_string($_POST['perihalUrgent']);
	if($perihalUrgent=='Tidak Urgent'){
		$urgensi = 0;
		$perihal = $koneksi -> real_escape_string($_POST['perihal']);
	}else{
		$urgensi = 1;
		$perihal = $perihalUrgent;
	}
	/**setting lokasi */
	$id_lokasi = $koneksi -> real_escape_string($_POST['lokasi']);
	$id_detail_lokasi = $koneksi -> real_escape_string($_POST['detail-lokasi']);
	$data_lokasi = mysqli_query($koneksi, "SELECT nama_lokasi, nama_detail_lokasi from tb_lokasi
											inner join tb_detail_lokasi on tb_lokasi.id_lokasi = tb_detail_lokasi.id_lokasi
											where tb_lokasi.id_lokasi=$id_lokasi and tb_detail_lokasi.id_detail_lokasi=$id_detail_lokasi") or die(mysqli_error($koneksi));
	$data_lokasi = mysqli_fetch_array($data_lokasi);
	$nama_lokasi = $data_lokasi['nama_lokasi'];
	$nama_detail_lokasi = $data_lokasi['nama_detail_lokasi'];
	/**Setting Lokasi */
	if($jenis=="Keluhan"){
	    $status = 'Request';
	} else {
	    $status = 'Closed';
	}
	if($_POST['aksi']=='insert'){
	    $pelapor = $koneksi -> real_escape_string($_POST['pelapor']);
		$id_akun = $koneksi -> real_escape_string($_POST['id_customer']);
        if($_POST['email']=='bpn.ph@ap1.co.id'){
            $sintax = "INSERT INTO tb_aduan VALUES(
        	0,
        	NULL,
        	NULL,
        	NULL,
        	'$id_detail_lokasi',
			'$nama_lokasi',
			'$nama_detail_lokasi',
        	'$jenis',
        	'$perihal',
        	'$pelapor',
        	'$keterangan',
        	'$status',
        	now(),
        	now(),
        	NULL,
        	-1)";
        }else{
            $sintax = "INSERT INTO tb_aduan VALUES(
        	0,
        	NULL,
        	'$id_akun',
        	NULL,
        	'$id_detail_lokasi',
        	'$jenis',
        	'$perihal',
        	'$pelapor',
        	'$keterangan',
        	'$status',
        	now(),
        	now(),
        	NULL,
        	-1)";
        }
		$data = mysqli_query($koneksi,$sintax);
    	$id = mysqli_insert_id($koneksi);
        if(!empty($_FILES)){
        	$nama = $_FILES['Bukti']['name'];
        	$x = explode('.', $nama);
        	$ekstensi = strtolower(end($x));
        	$tipe_file = $_FILES['Bukti']['type'];
        	$tmp_file = $_FILES['Bukti']['tmp_name'];
        	// menyeleksi data ke dalam tb_aduan
        	
        	$id = mysqli_insert_id($koneksi);
        	$id1 = $id.".jpeg";
        	// menghitung jumlah data yang ditemukan
        	$cek = mysqli_query($koneksi,"UPDATE tb_aduan SET foto='$id1' WHERE id_aduan = '$id'");
        	if(file_exists("../gambar/aduan/".$id1)){
        	    unlink("../gambar/aduan/".$id1);
        	}
        	move_uploaded_file($tmp_file, "../gambar/aduan/".$id1);
        }
        
        if($_POST['email']!='bpn.ph@ap1.co.id'){
            $query = mysqli_query($koneksi, "SELECT * FROM tb_customer WHERE id_customer='$id_akun'");
            $query = mysqli_fetch_array($query);
            $id_keluhan = $id;
            $email = $query['email'];
            $nama = $query['nama'];
            $subject = 'Feedback Angkasa Pura';
            include "../pesan/aduan_customer.php";
            if($data && $query&& $pesan) $result = json_encode(array('success'=>true, 'id_aduan'=>$id));
            else $result = json_encode(array('success'=>false, 'msg'=>'Gagal mengirim feedback', 'sintax'=>$sintax));
        }else{
            if($data) $result = json_encode(array('success'=>true, 'id_aduan'=>$id));
            else $result = json_encode(array('success'=>false, 'msg'=>'Gagal mengirim feedback', 'sintax'=>$sintax));
        }
        echo $result;
	}else{
	    $id_aduan = $koneksi -> real_escape_string($_POST['id_aduan']);
	    $sintax = "UPDATE tb_aduan SET 
	    jenis='$jenis', 
	    ket='$keterangan', 
	    perihal='$perihal', 
	    status='$status', 
	    id_detail_lokasi='$id_detail_lokasi' 
	    WHERE id_aduan = '$id_aduan'";
	    $data = mysqli_query($koneksi, $sintax);
	    $cek = true;
    	if(is_uploaded_file($_FILES['Bukti']['tmp_name'])){
        	$nama = $_FILES['Bukti']['name'];
        	$x = explode('.', $nama);
        	$ekstensi = strtolower(end($x));
        	$tipe_file = $_FILES['Bukti']['type'];
        	$tmp_file = $_FILES['Bukti']['tmp_name'];
        	// menyeleksi data ke dalam tb_aduan
        	$id = $data['id_aduan'];
        	$id1 = $id.".jpeg";
        	// menghitung jumlah data yang ditemukan
        	if(file_exists("../gambar/aduan/".$id1)){
        	    unlink("../gambar/aduan/".$id1);
        	}
        	move_uploaded_file($tmp_file, "../gambar/aduan/".$id1);
        	$cek = mysqli_query($koneksi,"UPDATE tb_aduan SET foto='$id1' WHERE id_aduan = '$id_aduan'") or die(mysqli_error($koneksi));
    	}
    	if( $data && $cek) $result = json_encode(array('success'=>true, 'id_aduan'=>$id_aduan));
    	else if($data) $result=json_encode(array('success'=>false, 'msg'=>'Maaf, terjadi kesalahan saat mengupload foto'));
    	else $result = json_encode(array('success'=>false, 'msg'=>$sintax));
    	echo $result;
	}
?>