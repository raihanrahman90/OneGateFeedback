<?php
	include "../koneksi.php";
	$data = mysqli_query($koneksi,"SELECT * FROM tb_urgensi") or die(mysqli_error($koneksi));
	$urgensi = array();
	foreach ($data as $row) {
		array_push($urgensi, array('id_urgensi'=>$row['id_urgensi'], 'perihal'=>$row['perihal']));
	}
	$result = json_encode(array('success'=>true, 'data'=>$urgensi));
	echo $result;
?>