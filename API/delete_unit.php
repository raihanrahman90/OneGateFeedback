<?php
    require('header.php');
    $id = $_GET['id'];
    if(isset($TOKEN['hak_akses'])){
        if($TOKEN['hak_akses']!='Super Admin'){
            $result= json_encode(array('success'=>false,'message'=>'Anda Tidak memilih akses ke halaman ini'));
        } else {
            $data = mysqli_query($koneksi, "SELECT id_departemen from tb_unit where id_unit = '$id'") or die(mysqli_error($koneksi));
            $id_departemen = mysqli_fetch_array($data);
            $id_departemen = $id_departemen['id_departemen'];
            $hapus = mysqli_query($koneksi, "DELETE FROM tb_unit WHERE id_unit = '$id'") or die(mysqli_error($koneksi));
            $result= json_encode(array('success'=>true));
        }
    } else {
        #nerobos
		$result= json_encode(array('success'=>false,'message'=>'Anda Tidak memilih akses ke halaman ini'));
    }
    
?>