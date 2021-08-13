<?php
include "../koneksi.php";
	$data = mysqli_query($koneksi,"SELECT * FROM tb_departemen") or die(mysqli_error($koneksi));
	foreach ($data as $row) {
		echo "<option value='".$row['id_departemen']."'>".$row['Departemen']."</option>";
	}
?>