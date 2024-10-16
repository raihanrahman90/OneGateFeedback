<?php
    $dataCustomer = mysqli_query($koneksi,"SELECT id_customer, status FROM tb_customer WHERE Email='$email'");
    $dataAdmin = mysqli_query($koneksi, "SELECT id_akun FROM tb_akun WHERE Email='$email'");
    if(mysqli_num_rows($dataCustomer) > 0){
        
    }
?>