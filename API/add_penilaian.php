<?php
    require 'header.php';
    $id_aduan = $koneksi -> real_escape_string($_POST['id_aduan']);
    $nilai = $koneksi -> real_escape_string($_POST['nilai']);
    $ulasan = $koneksi -> real_escape_string($_POST['ulasan']);
    $query = mysqli_query($koneksi, "SELECT id_customer from tb_aduan where id_aduan='$id_aduan'") or die(mysqli_error($koneksi));
    if($row = mysqli_fetch_array($query)){
        if($row['id_customer']!=$TOKEN['id_customer']){
            $result= json_encode(array('success'=>false,'message'=>'Halaman ini tidak dapat diakses oleh akun anda'));
        }else{
            $query = mysqli_query($koneksi, "INSERT INTO tb_penilaian value('$id_aduan','$nilai', '$ulasan',0)") or die(mysqli_error($koneksi));
            $result= json_encode(array('success'=>true,'id_aduan'=>$id_aduan));
        }
    }else{
		$result= json_encode(array('success'=>false,'message'=>'Id Aduan tidak ditemukan'));
    }
    echo $result;
?>