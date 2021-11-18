<?php
	include "../koneksi.php";
	$id_departemen = $_GET['id_departemen'];
	$data = mysqli_query($koneksi,"SELECT * FROM tb_unit where id_departemen='$id_departemen'") or die(mysqli_error($koneksi));
	$unit = array();
	foreach ($data as $row) {
		array_push($unit, array('id_unit'=>$row['id_unit'], 'nama_unit'=>$row['nama_unit']));
	}
	$result = json_encode(array('success'=>true, 'data'=>$unit));
	echo $result;
?>