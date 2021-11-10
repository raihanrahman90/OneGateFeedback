<?php
include "../koneksi.php";
$id=$_POST['Departemen'];
$data = mysqli_query($koneksi,"SELECT * FROM tb_unit WHERE id_departemen='$id'") or die(mysqli_error($koneksi));
	foreach ($data as $row) {
		echo "<option value='".$row['id_unit']."'>".$row['nama_unit']."</option>";
	}

?>