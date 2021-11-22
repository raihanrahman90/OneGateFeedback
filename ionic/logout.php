<?php
    require('../koneksi.php');
    $token = $_POST['token'];
    $hapus = mysqli_query($koneksi, "DELETE FROM tb_token where token='$token'") or die(mysqli_error($koneksi));
    if($hapus) echo json_encode(array('success'=>true));
    else echo json_encode(array('success'=>false, 'msg'=>'Terjadi kesalahan'));
?>