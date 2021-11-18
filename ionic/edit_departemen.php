<?php

    include '../koneksi.php';
    if(isset($_POST['user_hak_akses'])){
        if($_POST['user_hak_akses']=='Super Admin'){
            $id_departemen = $koneksi -> real_escape_string($_POST['id_departemen']);
            $nama_departemen = $koneksi -> real_escape_string($_POST['nama_departemen']);
            $query_edit_aduan = mysqli_query($koneksi, "UPDATE tb_aduan INNER JOIN tb_unit on tb_unit.id_unit=tb_aduan.id_aduan 
                                                        SET nama_departemen='$nama_departemen' where id_departemen='$id_departemen'") or die(mysqli_error($koneksi));
            $query = mysqli_query($koneksi, "UPDATE tb_departemen SET Departemen='$nama_departemen' where id_departemen='$id_departemen'") or die(mysqli_error($koneksi));
            
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