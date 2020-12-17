<?php
include "../koneksi.php";
$status =$_POST['status'];
if($status=='Unit' || $status=='Manager' || $status=='Senior Manager'){
$a=0;
$data = mysqli_query($koneksi,"SELECT * FROM tb_departemen") or die(mysqli_error($koneksi));
	foreach ($data as $row) {
		if($a==0){
			echo "<option value='".$row['id_departemen']."' selected>".$row["Departemen"]."</option>";
			$a =1;
		} else {
			echo "<option value='".$row['id_departemen']."'>".$row["Departemen"]."</option>";
		}
	}
}  else {
	echo "<option value='0'>--</option>";
}

?>