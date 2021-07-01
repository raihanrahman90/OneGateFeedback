<?php
    include '../koneksi.php';
    mysqli_query($koneksi, "SET GLOBAL time_zone = '+8:00'");   
    $query = mysqli_query($koneksi, "select now() as data");
    while($data = mysqli_fetch_array($query)){
        echo $data['data'];
    }
?>