<?php
    require '../koneksi.php';
    $id_aduan = $koneksi -> real_escape_string($_POST['id_aduan']);
    $nilai = $koneksi -> real_escape_string($_POST['nilai']);
    $ulasan = $koneksi -> real_escape_string($_POST['ulasan']);
    $query = mysqli_query($koneksi, "SELECT id_customer from tb_aduan where id_aduan='$id_aduan'") or die(mysqli_error($koneksi));
    if($row = mysqli_fetch_array($query)){
        if($row['id_customer']!=$_POST['id_customer']){
            $result = json_encode(array('success'=>false, 'msg'=>'Tidak memiliki akses'));
            echo $result;
        }else{
            $query = mysqli_query($koneksi, "INSERT INTO tb_penilaian value('$id_aduan','$nilai', '$ulasan',0)") or die(mysqli_error($koneksi));
            $result = json_encode(array('success'=>true));
            echo $result;
        }
    }else{
		$result = json_encode(array('success'=>false, 'msg'=>'ID tidak ditemukan'));
		echo $result;
    }
?>