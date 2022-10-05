<?php
    include '../koneksi.php';
    $id_aduan = $_GET['id'];
    $query = mysqli_query($koneksi, "UPDATE tb_aduan SET status = 'Open' WHERE id_aduan = '$id_aduan'") or die(mysqli_error($koneksi));
	$data = mysqli_query($koneksi, "SELECT max(id_progress) as id FROM tb_progress where id_aduan = '$id_aduan'") or die(mysqli_error($koneksi));
	$data1 = mysqli_fetch_array($data)['id'];
    $delete = mysqli_query($koneksi, "DELETE from tb_progress where id_progress = '$data1'") or die(mysqli_error($koneksi));
?>