<?php 
    include '../koneksi.php';
    if(isset($_POST['user_hak_akses'])){
        if($_POST['user_hak_akses']=='Super Admin'){
            $id_lokasi = $koneksi -> real_escape_string($_POST['id_lokasi']);
            $nama_lokasi = $koneksi -> real_escape_string($_POST['nama_lokasi']);
            $query = mysqli_query($koneksi, "UPDATE tb_lokasi SET nama_lokasi='$nama_lokasi' where id_lokasi='$id_lokasi'") or die(mysqli_error($koneksi));
            
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