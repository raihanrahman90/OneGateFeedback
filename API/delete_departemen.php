<?php
    require('header.php');
    $id = $_GET['id'];
    if(isset($TOKEN['hak_akses'])){
        if($TOKEN['hak_akses']!='Super Admin'){
            $result= json_encode(array('success'=>false,'message'=>'Anda Tidak memilih akses ke halaman ini'));
        } else {
            $hapus = mysqli_query($koneksi, "DELETE FROM tb_departemen WHERE id_departemen = '$id'") or die(mysqli_error($koneksi));
            $result= json_encode(array('success'=>true));
        }    
    } else {
		$result= json_encode(array('success'=>false,'message'=>'Anda Tidak memilih akses ke halaman ini'));
    }
    
?>