<?php
$koneksi = mysqli_connect("localhost","root","Airport2020","customer_service");
//mysqli_connect(server, user, password, database)
// Check connection
//https://github.com/kingsakti87/bandara
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
 
?>