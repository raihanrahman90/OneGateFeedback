<?php
    require('header.php');
    $id_customer = $_POST['id_customer'];
    $data_customer = mysqli_query($koneksi, "SELECT * FROM tb_customer where id_customer = '$id_customer'") or die(mysqli_error($koneksi));
    if($hasil = mysqli_fetch_array($data_customer)){
        echo json_encode(
            array(
                'success'=>true,
                'status'=>$hasil['status']
                )
            );
    }else{
        echo json_encode(
            array(
                'success'=>false,
                'msg'=>'Data tidak ditemukan'
            )
        );
    }
?>