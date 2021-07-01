<?php
session_start();
include('../koneksi.php');
$id = $koneksi-> real_escape_string($_POST['id']);
$id_akun = $_SESSION['id_akun'];
$keterangan = $koneksi-> real_escape_string($_POST['keterangan']);
$nama = $koneksi -> real_escape_string($_POST['nama']);
$data = mysqli_query($koneksi, "UPDATE tb_aduan SET  status ='Open', waktu=now(), level=1 WHERE id_aduan ='$id'") or die(mysqli_error($koneksi));
$data1 = mysqli_query($koneksi, "INSERT INTO tb_progress VALUES(0,$id_akun,$id,'Dikembalikan ke unit teknis dengan keterangan $keterangan, oleh $nama',NULL,now())") or die(mysqli_error($koneksi));
$data = mysqli_query($koneksi, "SELECT id_unit from tb_aduan where id_aduan='$id'") or die(mysqli_error($koneksi));
if($row = mysqli_fetch_array($data)){
    $id_unit = $row['id_unit'];
}
include('../pesan/kembali_ke_unit_teknis.php');
header("location:../Admin");
?>