<?php
    require('header.php');
    if(isset($_POST['user_status_akun']) && isset($_POST['user_hak_akses'])){
        $status_akun = $_POST['user_status_akun'];
        $hak_akses = $_POST['user_hak_akses'];
        if(($status_akun=='AOC Head' || $status_akun=='General Manager') || $hak_akses!='Unit' && $hak_akses!='Pengawas Internal'){
            $data = mysqli_query($koneksi, "SELECT tb_penilaian.* from tb_penilaian
                                                inner join tb_aduan on tb_aduan.id_aduan=tb_penilaian.id_aduan  
                                                ORDER BY open") or die(mysqli_error($koneksi));
            $penilaian = array();
            foreach($data as $row){
                array_push(
                    $penilaian,
                    array(
                        'id_aduan'=>$row['id_aduan'],
                        'open'=>$row['open'],
                        'penilaian'=>$row['penilaian'],
                        'ulasan'=>$row['ulasan']
                    )
                    );

            }
            echo json_encode(array('success'=>true, 'data'=>$penilaian));
        }else{
            echo json_encode(array('success'=>false, 'msg'=>'Anda tidak memiliki akses ke halaman ini'));
        }
    }else{
        echo json_encode(array('success'=>false, 'msg'=>'Anda tidak memiliki akses ke halaman ini'));
    }
?>