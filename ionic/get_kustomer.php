<?php
    require('header.php');
    if(isset($_POST['user_hak_akses'])){
        if($_POST['user_hak_akses']=='Super Admin'){
            $data = mysqli_query($koneksi, "SELECT * FROM tb_customer order by status ASC");
            $kustomer = array();
            foreach($data as $row){
                array_push(
                    $kustomer,
                    array(
                        'id_customer'=>$row['id_customer'],
                        'nama'=>$row['nama'],
                        'nama_perusahaan'=>$row['nama_perusahaan'],
                        'masa_berlaku'=>$row['masa_berlaku'],
                        'tanggal_pembuatan'=>$row['tanggal_pembuatan'],
                        'status'=>$row['status']
                    )
                    );
            }
            echo json_encode(array('success'=>true, 'data'=>$kustomer));
        }else{
            echo json_encode(array('success'=>false, 'msg'=>'Anda tidak memiliki akses ke halaman ini'));
        }
    }else{
        echo json_encode(array('success'=>false, 'msg'=>'Anda tidak memiliki akses ke halaman ini'));
    }
?>