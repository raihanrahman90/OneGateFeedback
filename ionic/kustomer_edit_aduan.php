<?php 

// menghubungkan dengan koneksi
include '../koneksi.php';
// menangkap data yang dikirim dari form
$id_aduan = $koneksi -> real_escape_string($_POST['id_aduan']);
$tanggal_kejadian = $koneksi-> real_escape_string($_POST['waktu_kejadian']);
$tanggal_kejadian = date_create_from_format('d/m/Y', $tanggal_kejadian);
$tanggal_kejadian = date_format($tanggal_kejadian, 'Y-m-d');
if(!isset($_POST['hari'])){
	$keterangan_kejadian = "'".$koneksi->real_escape_string($_POST['keterangan_kejadian'])."'";
}else{
	$keterangan_kejadian = "NULL";
}
$keterangan = $koneksi -> real_escape_string(htmlspecialchars($_POST['keterangan']));
$jenis = $koneksi -> real_escape_string($_POST['jenis']);
/**setting lokasi */
$lokasi = $koneksi -> real_escape_string($_POST['lokasi']);
$detail_lokasi = $koneksi -> real_escape_string($_POST['detail_lokasi']);
/**Setting Lokasi */
$perihalUrgent = $koneksi ->real_escape_string($_POST['perihalUrgent']);
if($perihalUrgent=='Tidak Urgent'){
	$urgensi = 0;
	$perihal = $koneksi -> real_escape_string($_POST['perihal']);
}else{
	$urgensi = 1;
	$perihal = $perihalUrgent;
}
$data = mysqli_query($koneksi, "SELECT * FROM tb_aduan where id_aduan='$id_aduan'") or die(mysqli_error($koneksi));
if($jenis=='Keluhan'){
    $status ='Request';
}else{
    $status='Closed';
}
$data = mysqli_fetch_array($data);
if(is_uploaded_file($_FILES['foto']['tmp_name'])){
	$nama = $_FILES['foto']['name'];
	$x = explode('.', $nama);
	$ekstensi = strtolower(end($x));
	$tipe_file = $_FILES['foto']['type'];
	$tmp_file = $_FILES['foto']['tmp_name'];
	// menyeleksi data ke dalam tb_aduan
	$id = $data['id_aduan'];
	$id1 = $id.".".$ekstensi;
	// menghitung jumlah data yang ditemukan
	unlink('../gambar/aduan/'.$id1);
	move_uploaded_file($tmp_file, "../gambar/aduan/".$id1);
	$cek = mysqli_query($koneksi,"UPDATE tb_aduan SET foto='$id1' WHERE id_aduan = '$id_aduan'") or die(mysqli_error($koneksi));
}
    $cek = mysqli_query($koneksi,"UPDATE tb_aduan SET jenis='$jenis', ket='$keterangan', perihal='$perihal', status='$status', urgensi='$urgensi',
									nama_lokasi='$lokasi', nama_detail_lokasi='$detail_lokasi', waktu_kejadian='$tanggal_kejadian', keterangan_kejadian=$keterangan_kejadian
									WHERE id_aduan = '$id_aduan'") or die(mysqli_error($koneksi));
	echo json_encode(array('success'=>true));
?>