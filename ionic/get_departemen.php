<?php
	include "../koneksi.php";
	$data = mysqli_query($koneksi,"SELECT tb_departemen.*, count(id_unit) as jumlah_unit
									FROM tb_departemen
									left join tb_unit on tb_unit.id_departemen = tb_departemen.id_departemen
									group by tb_departemen.id_departemen") or die(mysqli_error($koneksi));
	$departemen = array();
	foreach ($data as $row) {
		array_push($departemen, array('id_departemen'=>$row['id_departemen'], 'nama_departemen'=>$row['Departemen'],'jumlah_unit'=>$row['jumlah_unit']));
	}
	$result = json_encode(array('success'=>true, 'data'=>$departemen));
	echo $result;
?>