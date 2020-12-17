<?php
        session_start();
        include '../koneksi.php';
        $jumlah_request = mysqli_query($koneksi, "SELECT id_aduan from tb_aduan where status='Request' and level='0'") or die(mysqli_error($koneksi));
        $jumlah_request = mysqli_num_rows($jumlah_request);
        if($jumlah_request>0){
            $jumlah_request = '<span class="badge badge-primary">'.$jumlah_request.'</span>';
        }else{
            $jumlah_request = '';
        }
        $jumlah_return = mysqli_query($koneksi, "SELECT id_aduan from tb_aduan where status='Returned'") or die(mysqli_error($koneksi));
        $jumlah_return = mysqli_num_rows($jumlah_return);
        if($jumlah_return>0){
            $jumlah_return = '<span class="badge badge-danger">'.$jumlah_return.'</span>';
        }else{
            $jumlah_return = '';
        }
            echo 'Request 
                    '.$jumlah_request.' 
                    '.$jumlah_return.'';
?>