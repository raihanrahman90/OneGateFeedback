<?php
include "../koneksi.php";
$id=$_POST['Departemen'];
$status =$_POST['status'];
if($status=='Unit' || $status=='Manager'){
$data = mysqli_query($koneksi,"SELECT * FROM tb_unit WHERE id_departemen='$id'") or die(mysqli_error($koneksi));
	foreach ($data as $row) {
		echo "<option value='".$row['id_unit']."'>".$row['nama_unit']."</option>";
	}
} else if($status=='Senior Manager'){
	$data = mysqli_query($koneksi,"SELECT * FROM tb_departemen WHERE id_departemen='$id'") or die(mysqli_error($koneksi));
	foreach ($data as $row) {
		echo "<option value='".$row['id_departemen']."' selected>".$row['Departemen']."</option>";
	}
} else {
	echo "<option value='0'>--</option>";
}