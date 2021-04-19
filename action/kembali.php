<?php
session_start();
include('../koneksi.php');
$id = $koneksi-> real_escape_string($_POST['id']);
$id_akun = $_SESSION['id_akun'];
$keterangan = $koneksi-> real_escape_string($_POST['keterangan']);
$penjelasan = $koneksi-> real_escape_string($_POST['penjelasan']);
if($keterangan=='Kurang Data'){
    $keterangan = 'Unit kekurangan data, '.$penjelasan;
}
$data = mysqli_query($koneksi, "UPDATE tb_aduan SET  status ='Returned', id_unit=NULL, nama_departemen=NULL, nama_unit=NULL WHERE id_aduan ='$id'") or die(mysqli_error($koneksi));
$data1 = mysqli_query($koneksi, "INSERT INTO tb_progress VALUES(0,$id_akun,$id,'Dikembalikan ke cs dengan keterangan $keterangan',NULL,now())") or die(mysqli_error($koneksi));
include('../pesan/kembali.php');
header("location:../Admin");
?>