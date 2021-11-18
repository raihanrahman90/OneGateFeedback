<?php
    include '../koneksi.php';
    if(isset($_POST['user_hak_akses'])){
        if($_POST['user_hak_akses']=='Super Admin'){
            $id_unit = $koneksi -> real_escape_string($_POST['id_unit']);
            $nama_unit = $koneksi -> real_escape_string($_POST['nama_unit']);
            $query_edit_aduan = mysqli_query($koneksi, "UPDATE tb_aduan SET nama_unit='$nama_unit' where id_unit='$id_unit'") or die(mysqli_error($koneksi));
            $query = mysqli_query($koneksi, "UPDATE tb_unit SET nama_unit='$nama_unit' where id_unit='$id_unit'") or die(mysqli_error($koneksi));
            $result = json_encode(array('success'=>true));
            echo $result;
        }else{
                
            $result = json_encode(array('success'=>false, 'msg'=>'Tidak memiliki akses'));
            echo $result;
        }
    }else{
		$result = json_encode(array('success'=>false, 'msg'=>'Tidak memiliki akses'));
		echo $result;
    }
?>