<?php
	include '../koneksi.php';
	$id_akun = $_POST['id_akun'];
	
	$check_box_3_hari = isset($_POST['hari']);
	$tanggal_kejadian = $koneksi -> real_escape_string($_POST['tanggal_kejadian']);
	$tanggal_kejadian = date_create_from_format('d/m/Y', $tanggal_kejadian);
	$tanggal_kejadian = date_format($tanggal_kejadian, 'Y-m-d');
	if(!$check_box_3_hari){
		$keterangan_kejadian = "'".($koneksi -> real_escape_string($_POST['keterangan_kejadian']))."'";
	}else{
		$keterangan_kejadian = "NULL";
	}
	$jenis = $koneksi -> real_escape_string($_POST['jenis']);
	$perihal = $koneksi -> real_escape_string($_POST['perihal']);
	$keterangan = $koneksi -> real_escape_string(htmlspecialchars($_POST['keterangan']));
	$pengguna = $koneksi -> real_escape_string($_POST['pengguna']);
	$perihalUrgent = $koneksi ->real_escape_string($_POST['perihalUrgent']);
	/**Setting Urgensi */
	if($perihalUrgent=='Tidak Urgent'){
		$urgensi = 0;
		$perihal = $koneksi -> real_escape_string($_POST['perihal']);
	}else{
		$urgensi = 1;
		$perihal = $perihalUrgent;
	}
	/**Setting Urgensi */

	if($jenis=="Keluhan"){
	    $status = 'Request';
	} else {
	    $status = 'Closed';
	}
	/**setting lokasi */
	$lokasi = $koneksi -> real_escape_string($_POST['lokasi']);
	$detail_lokasi = $koneksi -> real_escape_string($_POST['detail_lokasi']);
	/**Setting Lokasi */
	$data = mysqli_query($koneksi,"INSERT INTO tb_aduan VALUES(
	0,#id_aduan
	'$id_akun',#id_akun
	NULL,#id_customer
	NULL,#id_unit
	NULL,#nama_unit
	NULL,#nama_departemen
	'$detail_lokasi',#nama_detail_lokasi
	'$lokasi',#nama_lokasi
	'$jenis',#jenis
	$urgensi,#urgensi
	'$perihal',#perihal
	'$pengguna',#pelapor
	'$keterangan',#keterangan
	'$status',#status
	now(),#waktu untuk level
	now(),#waktu kirim
	'$tanggal_kejadian',#tanggal_kejadian
	$keterangan_kejadian,#keterangan_kejadian
	NULL,#foto
	-1)") or die(mysqli_error($koneksi)); #level
	
	$id = mysqli_insert_id($koneksi);
if(is_uploaded_file($_FILES['foto']['tmp_name'])){
	$nama = $_FILES['foto']['name'];
	$x = explode('.', $nama);
	$ekstensi = strtolower(end($x));
	$tipe_file = $_FILES['foto']['type'];
	$tmp_file = $_FILES['foto']['tmp_name'];
	// menyeleksi data ke dalam tb_aduan
	
	$id = mysqli_insert_id($koneksi);
	$id1 = $id.".".$ekstensi;
	// menghitung jumlah data yang ditemukan
	$cek = mysqli_query($koneksi,"UPDATE tb_aduan SET foto='$id1' WHERE id_aduan = '$id'") or die(mysqli_error($koneksi));
	move_uploaded_file($tmp_file, "../gambar/aduan/".$id1);
}
$tambahTanggalPengiriman = mysqli_query($koneksi, "INSERT INTO tb_progress value(0,NULL,$id,'feedback dikirim oleh Admin CS (bpn.os@injourneyairports.id)', NULL, now())") or die(mysqli_error($koneksi));

$result = json_encode(array('success'=>true));
echo $result;
?>