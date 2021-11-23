<?php 

	// menghubungkan dengan koneksi
	include '../koneksi.php';
	// menangkap data yang dikirim dari form
	$id_aduan = $koneksi -> real_escape_string($_POST['id_aduan']);
	$jenis = $koneksi -> real_escape_string($_POST['jenis']);
	$tanggal_kejadian = $koneksi -> real_escape_string($_POST['tanggal_kejadian']);
	$tanggal_kejadian = date_create_from_format('d/m/Y', $tanggal_kejadian);
	$tanggal_kejadian = date_format($tanggal_kejadian, 'Y-m-d');
	if(empty($_POST['keterangan_kejadian'])){
		$keterangan_kejadian = "NULL";
	}else{
		$keterangan_kejadian = "'".($koneksi -> real_escape_string($_POST['keterangan_kejadian']))."'";
	}
	$keterangan = $koneksi -> real_escape_string(htmlspecialchars($_POST['keterangan']));
	/**setting lokasi */
	$lokasi = $koneksi -> real_escape_string($_POST['lokasi']);
	$detail_lokasi = $koneksi -> real_escape_string($_POST['detail_lokasi']);
	/**Setting Lokasi */
	$urgensi = $koneksi ->real_escape_string($_POST['perihal_urgent']);
	$perihal = $koneksi -> real_escape_string($_POST['perihal']);
	$data = mysqli_query($koneksi, "SELECT * FROM tb_aduan where id_aduan='$id_aduan'") or die(mysqli_error($koneksi));
	if($jenis=='Keluhan'){
		$status ='Request';
	}else{
		$status='Closed';
	}
	$data = mysqli_fetch_array($data);
	if(isset($_FILES['gambar'])&&is_uploaded_file($_FILES['gambar']['tmp_name'])){
		$nama = $_FILES['gambar']['name'];
		$x = explode('.', $nama);
		$ekstensi = strtolower(end($x));
		$tipe_file = $_FILES['gambar']['type'];
		$tmp_file = $_FILES['gambar']['tmp_name'];
		// menyeleksi data ke dalam tb_aduan
		$id = $data['id_aduan'];
		$id1 = $id.".".$ekstensi;
		$datahapus = mysqli_query($koneksi, "SELECT foto from tb_aduan where id_aduan=$id_aduan");
		$datahapus = mysqli_fetch_array($datahapus);
		if(file_exists('../gambar/aduan/'.$datahapus['foto'])){
			unlink('../gambar/aduan/'.$datahapus['foto']);
		}
		move_uploaded_file($tmp_file, "../gambar/aduan/".$id1);
		$cek = mysqli_query($koneksi,"UPDATE tb_aduan SET foto='$id1' WHERE id_aduan = '$id_aduan'") or die(mysqli_error($koneksi));
	}
    $cek = mysqli_query($koneksi,"UPDATE tb_aduan SET jenis='$jenis', ket='$keterangan', perihal='$perihal', status='$status', urgensi='$urgensi',
									nama_lokasi='$lokasi', nama_detail_lokasi='$detail_lokasi', waktu_kejadian='$tanggal_kejadian', keterangan_kejadian=$keterangan_kejadian
									WHERE id_aduan = '$id_aduan'") or die(mysqli_error($koneksi));
	echo json_encode(array('success'=>true));
?>