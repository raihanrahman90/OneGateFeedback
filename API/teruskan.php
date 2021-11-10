<?php
	require_once 'header.php';
	if($TOKEN['hak_akses']=='Super Admin' || $TOKEN['hak_akses']=='Admin1'){
		$id_aduan = $koneksi -> real_escape_string($_POST['id']);
		$id_unit = $koneksi -> real_escape_string($_POST['unit']);
		$keterangan = $koneksi -> real_escape_string($_POST['keterangan']);
		$nama = $koneksi -> real_escape_string($_POST['nama']);
		$id_akun = $TOKEN['id_akun'];
		/** get nama departemen dan unit */
		$data_departemen = mysqli_query($koneksi, "SELECT * FROM tb_departemen 
										inner join tb_unit on tb_unit.id_departemen = tb_departemen.id_departemen 
										where id_unit=$id_unit") or die(mysqli_error($koneksi));
		$data_departemen = mysqli_fetch_array($data_departemen);
		$nama_departemen = $data_departemen['Departemen'];
		$nama_unit = $data_departemen['nama_unit'];
		/** get nama departemen dan unit */
		if(empty($keterangan)){
			$keterangan = "Diteruskan ke unit $nama_unit oleh ".$nama;
		}else{
			$keterangan = "Diteruskan ke unit $nama_unit, $keterangan oleh ".$nama;
		}
		$data = mysqli_query($koneksi, "UPDATE tb_aduan SET status = 'Open', id_unit='$id_unit',waktu=now(),id_akun='$id_akun', level=1, nama_departemen='$nama_departemen', nama_unit='$nama_unit'
										Where id_aduan='$id_aduan'") or die(mysqli_error($koneksi));
	    $tindakan = mysqli_query($koneksi, "INSERT INTO tb_progress values(0,'$id_akun' , '$id_aduan', '$keterangan', NULL, now())") or die(mysqli_error($koneksi));
		$subject = 'Keluhan Baru Terhadap unit Anda';
		include "../pesan/kirim_email_unit.php";
		$result= json_encode(array('success'=>true));
	} else {
		$result= json_encode(array('success'=>false,'message'=>'Anda Tidak memilih akses ke halaman ini'));
	}
?>