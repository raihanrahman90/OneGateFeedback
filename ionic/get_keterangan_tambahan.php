<?php
    require('header.php');
    $id_aduan = $_GET['id_aduan'];
    $data = mysqli_query($koneksi, "SELECT * FROM tb_keterangan_tambahan where id_aduan=$id_aduan");
    $keterangan_tambahan = array();
    foreach($data as $row){
        array_push(
            $keterangan_tambahan, 
            array(
                'id_keterangan'=>$row['id_keterangan'],
                'id_aduan'=>$row['id_aduan'],
                'id_akun'=>$row['id_akun'],
                'pertanyaan'=>$row['pertanyaan'],
                'jawaban'=>$row['jawaban'],
                'bukti'=>$row['bukti']
            )
        );
    }
    echo json_encode(array('success'=>true, 'data'=>$keterangan_tambahan));

?>