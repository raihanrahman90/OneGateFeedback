<?php
    session_start();
    require '../koneksi.php';
    $id_aduan = $koneksi -> real_escape_string($_POST['id_aduan']);
    $nilai = $koneksi -> real_escape_string($_POST['nilai']);
    $ulasan = $koneksi -> real_escape_string($_POST['ulasan']);
    $query = mysqli_query($koneksi, "SELECT id_customer from tb_aduan where id_aduan='$id_aduan'") or die(mysqli_error($koneksi));
    if($row = mysqli_fetch_array($query)){
        if($row['id_customer']!=$_SESSION['id_customer']){
            echo 'Anda tidak memiliki akses ke halaman ini';
        }else{
            $query = mysqli_query($koneksi, "INSERT INTO tb_penilaian value('$id_aduan','$nilai', '$ulasan')") or die(mysqli_error($koneksi));
            header('Location:../customer/tampil_antri.php?id='.$id_aduan);
        }
    }else{
        echo 'Id Aduan tidak ditemukan';
    }
?>