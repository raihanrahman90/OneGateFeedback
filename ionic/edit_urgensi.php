<?php
    include '../koneksi.php';
    if(isset($_POST['user_hak_akses'])){
        if($_POST['user_hak_akses']=='Super Admin'){
            $id_urgensi = $koneksi -> real_escape_string($_POST['id_urgensi']);
            $perihal = $koneksi -> real_escape_string($_POST['perihal']);
            $query = mysqli_query($koneksi, "UPDATE tb_urgensi SET perihal='$perihal' where id_urgensi='$id_urgensi'") or die(mysqli_error($koneksi));
            
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