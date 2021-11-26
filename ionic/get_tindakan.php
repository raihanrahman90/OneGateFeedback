<?php
    require('header.php');
    $id_aduan = $_GET['id_aduan'];
    $data_progress = mysqli_query($koneksi, "SELECT Nama, tindakan, bukti, tb_akun.id_akun, waktu, id_progress FROM tb_progress
    left join tb_akun on tb_akun.id_akun = tb_progress.id_akun
    where id_aduan = '$id_aduan'") or die(mysqli_error($koneksi));
    $data = array();
    foreach($data_progress as $row){
        if(file_exists('../gambar/bukti/'.$row['id_progress'].'.pdf')){
            $laporan = $row['id_progress'].'.pdf';
        }else{
            $laporan = null;
        }
        array_push(
            $data,
            array(
                'id_progress'=>$row['id_progress'],
                'tindakan'=>$row['tindakan'],
                'bukti'=>$row['bukti'],
                'laporan'=>$laporan,
                'id_akun'=>$row['id_akun'],
                'nama'=>$row['Nama'],
                'waktu'=>$row['waktu']
            )
        );
    }
    echo json_encode(array('success'=>true, 'data'=>$data));
?>