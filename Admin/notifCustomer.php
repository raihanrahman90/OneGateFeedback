<?php
        include '../koneksi.php';
        $jumlah_customer = mysqli_query($koneksi, "SELECT * FROM tb_customer where status ='0'") or die(mysqli_error($koneksi));
        $jumlah_customer = mysqli_num_rows($jumlah_customer);
        if($jumlah_customer > 0){
            $jumlah_customer = '<span class="badge badge-warning">'.$jumlah_customer.'</span>';
        }else{
            $jumlah_customer = '';
        }
        echo 'Customer '.$jumlah_customer;
?>