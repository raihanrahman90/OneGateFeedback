<?php
    include '../koneksi.php';
    $getAcount = mysqli_query($koneksi, "SELECT * FROM tb_customer 
                                        where TIMESTAMPDIFF(DAY, masa_berlaku,now()) >= 0") or die(mysqli_error($koneksi));
    while($row = mysqli_fetch_array($getAcount)){
        echo $row['masa_berlaku']."</br>";
        echo $row['id_customer']."</br>";
    }
?>