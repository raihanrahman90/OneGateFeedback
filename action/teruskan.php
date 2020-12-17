<?php
	session_start();
	include '../koneksi.php';
	if($_SESSION['hak_akses']=='Super Admin' || $_SESSION['hak_akses']=='Admin1'){
		$id_aduan = $koneksi -> real_escape_string($_POST['id']);
		$id_unit = $koneksi -> real_escape_string($_POST['unit']);
		$id_akun = $_SESSION['id_akun'];
		$data = mysqli_query($koneksi, "UPDATE tb_aduan SET status = 'Open', id_unit='$id_unit',waktu=now(),id_akun='$id_akun', level=1 Where id_aduan='$id_aduan'") or die(mysqli_error($koneksi));
	    $tindakan = mysqli_query($koneksi, "INSERT INTO tb_progress values(0,'$id_akun' , '$id_aduan', 'Diterukan ke unit', NULL, now())");
		$_SESSION['terjadi']='meneruskan';
		$subject = 'Keluhan Baru Terhadap unit Anda';
		include "../pesan/kirim_email_unit.php";
		header('Location:../Admin/list_request.php');
			} else {
		echo "Anda tidak memiliki akses ke halaman ini";
	}
?>