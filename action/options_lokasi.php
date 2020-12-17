<?php
include "../koneksi.php";
$id=$_POST['lokasi'];
$data = mysqli_query($koneksi,"SELECT * FROM tb_detail_lokasi WHERE id_lokasi='$id'") or die(mysqli_error($koneksi));
	foreach ($data as $row) {
		echo "<option value='".$row['id_detail_lokasi']."'>".$row['nama_detail_lokasi']."</option>";
	}
?>