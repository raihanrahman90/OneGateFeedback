<?php 
// mengaktifkan session php
session_start();

// menghubungkan dengan koneksi
include '../koneksi.php';

// menangkap data yang dikirim dari form
$tindakan = $koneksi -> real_escape_string($_POST['tindakan']);
$status = $koneksi -> real_escape_string($_POST['status']);
$id_aduan = $_POST['id_aduan'];
$id_akun = $_SESSION['id_akun'];
$nama = $_FILES['Bukti']['name'];
$x = explode('.', $nama);
$ekstensi = strtolower(end($x));
$tipe_file = $_FILES['Bukti']['type'];
$tmp_file = $_FILES['Bukti']['tmp_name'];
// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($koneksi,"INSERT INTO tb_progress VALUES(0,$id_akun,$id_aduan, '$tindakan','a',now())") or die(mysqli_error($koneksi));
$id = mysqli_insert_id($koneksi);
$id1 = $id.".".$ekstensi;
// menghitung jumlah data yang ditemukan
$cek = mysqli_query($koneksi,"UPDATE tb_progress SET bukti='$id1' WHERE id_progress = '$id'") or die(mysqli_error($koneksi));
$la = mysqli_query($koneksi,"UPDATE tb_aduan set status='$status' WHERE id_aduan='$id_aduan'") or die(mysqli_error($koneksi));
move_uploaded_file($tmp_file, "../gambar/bukti/".$id1);
if($_SESSION['status_akun']!='Unit' && $_SESSION['status_akun'] != 'Manager'){
    $subject = 'Perintah Tindakan Baru';
	include "../pesan/kirim_email_tindakan.php";
} else{
    $subject = 'Tidakan Baru Dilakukan';
    include '../pesan/kirim_email_selesai.php';
}
header("Location:../Admin");	
?>