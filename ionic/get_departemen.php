<?php
	include "../koneksi.php";
	$data = mysqli_query($koneksi,"SELECT * FROM tb_departemen") or die(mysqli_error($koneksi));
	$departemen = array();
	foreach ($data as $row) {
		array_push($departemen, array('id_departemen'=>$row['id_departemen'], 'nama_departemen'=>$row['Departemen']));
	}
	$result = json_encode(array('success'=>true, 'data'=>$departemen));
	echo $result;
?>