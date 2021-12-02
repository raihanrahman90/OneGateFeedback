<?php
    require('header.php');
    
    $token = $koneksi -> real_escape_string($_POST['token']);
    $status = $koneksi -> real_escape_string($_POST['status']);
    $id = $koneksi -> real_escape_string($_POST['id']);
    $cari_token = mysqli_query($koneksi, "SELECT * FROM tb_token where token = '$token'");
    if(mysqli_num_rows($cari_token)==0){
        $insert = mysqli_query($koneksi, "INSERT INTO tb_token value('$status', '$id', '$token')") or die(mysqli_error($koneksi));
    }else{
        $insert = mysqli_query($koneksi, "UPDATE tb_token set id='$id', status='$status' where token='$token'");
    }
    if($insert) $result = json_encode(array('success'=>true));
    else $result = json_encode(array('success'=>false, 'msg'=>'Terjadi kesalahan'));
    echo $result;
?>