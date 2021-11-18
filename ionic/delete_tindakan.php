<?php
    include "../koneksi.php";
    $id = $_GET['id'];
    if(isset($_POST['user_hak_akses'])){
        if($_POST['hak_akses']!='Super Admin'){
            $result = json_encode(array('success'=>false, 'msg'=>'Tidak memiliki akses'));
            echo $result;
        } else {
            $hapus = mysqli_query($koneksi, "DELETE FROM tb_progress WHERE id_progress = '$id'") or die(mysqli_error($koneksi));
            $result = json_encode(array('success'=>true));
            echo $result;
        }
    } else {
        $result = json_encode(array('success'=>false, 'msg'=>'Tidak memiliki akses'));
        echo $result;
    }
?>