<?php

	session_start();
    include '../koneksi.php';
    if(isset($_SESSION['hak_akses'])){
        if($_SESSION['hak_akses']=='Super Admin'){
            $id_urgensi = $koneksi -> real_escape_string($_POST['id_urgensi']);
            $perihal = $koneksi -> real_escape_string($_POST['perihal']);
            $query = mysqli_query($koneksi, "UPDATE tb_urgensi SET perihal='$perihal' where id_urgensi='$id_urgensi'") or die(mysqli_error($koneksi));
            header('Location:../Admin/list_urgensi.php');
        }
    }else{
        echo 'Anda tidak memiliki akses untuk merubah data';
    }
?>