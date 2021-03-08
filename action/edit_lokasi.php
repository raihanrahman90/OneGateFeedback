<?php 
	session_start();
    include '../koneksi.php';
    if(isset($_SESSION['hak_akses'])){
        if($_SESSION['hak_akses']=='Super Admin'){
            $id_lokasi = $koneksi -> real_escape_string($_POST['id_lokasi']);
            $nama_lokasi = $koneksi -> real_escape_string($_POST['nama_lokasi']);
            $query = mysqli_query($koneksi, "UPDATE tb_lokasi SET nama_lokasi='$nama_lokasi' where id_lokasi='$id_lokasi'") or die(mysqli_error($koneksi));
            header('Location:../Admin/list_lokasi.php');
        }
    }else{
        echo 'Anda tidak memiliki akses untuk merubah data';
    }
?>