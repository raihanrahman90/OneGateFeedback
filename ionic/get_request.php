<?php
    require('../koneksi.php');
    $hak_akses = $_POST['user_hak_akses'];
    $status_akun = $_POST['user_status_akun'];
    $aduan = array();
    $data = mysqli_query($koneksi, "SELECT * from tb_aduan WHERE (status = 'Request' or status='Returned') and level > -1 ORDER BY waktu DESC") or die(mysqli_error($koneksi));
    foreach($data as $row){
        array_push(
            $aduan, 
            array(
                'id_aduan'=>$row['id_aduan'],
                'perihal'=>$row['perihal'],
                'jenis'=>$row['jenis'],
                'urgensi'=>$row['urgensi'],
                'status'=>$row['status'],
            )
        );
    }
    echo json_encode(array('success'=>true, 'data'=>$aduan));
?>