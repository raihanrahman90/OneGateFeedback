<?php
    include '../../koneksi.php';
    $timezone = $_GET['timezone'];
    mysqli_query($koneksi, "SET GLOBAL time_zone = '-$timezone:00'");   
    $query = mysqli_query($koneksi, "select now() as data");
    while($data = mysqli_fetch_array($query)){
        echo $data['data'];
    }
?>