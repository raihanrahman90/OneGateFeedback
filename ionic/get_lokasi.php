<?php
	include "../koneksi.php";
	$data = mysqli_query($koneksi,"SELECT * FROM tb_lokasi") or die(mysqli_error($koneksi));
	$lokasi = array();
	foreach ($data as $row) {
		array_push($lokasi, array('id_lokasi'=>$row['id_lokasi'], 'nama_lokasi'=>$row['nama_lokasi']));
	}
	$result = json_encode(array('success'=>true, 'data'=>$lokasi));
	echo $result;
?>