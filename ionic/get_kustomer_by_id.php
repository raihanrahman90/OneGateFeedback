<?php
    require('header.php');

    if(isset($_POST['user_hak_akses'])){
        if($_POST['user_hak_akses']=='Super Admin'){
            $id = $_POST['id_customer'];
            $data = mysqli_query($koneksi, "SELECT nama_perusahaan,gerai, nama, email, no_telp, pass_bandara, foto, status, 
                                                    id_pass_bandara, masa_berlaku, kontrak, tanggal_pembuatan
                                            from tb_customer where tb_customer.id_customer ='$id'") or die(mysqli_error($koneksi));
            if($kustomer = mysqli_fetch_array($data)){
                echo json_encode(array(
                    'success'=>true,
                    'data'=>array(
                        'nama_perusahaan'=>$kustomer['nama_perusahaan'],
                        'gerai'=>$kustomer['gerai'],
                        'nama'=>$kustomer['nama'],
                        'email'=>$kustomer['email'],
                        'no_telp'=>$kustomer['no_telp'],
                        'pass_bandara'=>$kustomer['pass_bandara'],
                        'foto'=>$kustomer['foto'],
                        'status'=>$kustomer['status'],
                        'id_pass_bandara'=>$kustomer['id_pass_bandara'],
                        'masa_berlaku'=>$kustomer['masa_berlaku'],
                        'kontrak'=>$kustomer['kontrak'],
                        'tanggal_pembuatan'=>$kustomer['tanggal_pembuatan']
                        )
                    ));
            }
        }else{
            echo json_encode(array('success'=>false, 'msg'=>'Anda tidak memiliki akses ke halaman ini'));
        }
    }else{
        echo json_encode(array('success'=>false, 'msg'=>'Anda tidak memiliki akses ke halaman ini'));
    }
?>