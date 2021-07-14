<?php
    include '../../koneksi.php';  
    $query = mysqli_query($koneksi, "SELECT @@global.time_zone as data");
    while($data = mysqli_fetch_array($query)){
        echo $data['data'];
    }
?>