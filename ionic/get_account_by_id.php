<?php
    require('header.php');
    if(isset($_POST['user_hak_akses'])){
        $id_akun = $_GET['id_akun'];
        $hak_akses = $_POST['user_hak_akses'];
        
        $data = mysqli_query($koneksi, "SELECT Nama, tb_departemen.id_departemen, tb_unit.id_unit, 
                                                status,hak_akses, Email, Id_akun, No_Telp, nama_unit, Departemen 
                                                FROM tb_akun 
                                                left join tb_unit on tb_unit.id_unit = tb_akun.id_unit 
                                                left join tb_departemen on tb_departemen.id_departemen = tb_unit.id_departemen 
                                                WHERE id_akun ='$id_akun'") or die(mysqli_error($koneksi));
        if($hak_akses=='Super Admin'){
            if($akun = mysqli_fetch_array($data)){
                $data = array(
                    'nama'=>$akun['Nama'],
                    'id_departemen'=>$akun['id_departemen'],
                    'id_unit'=>$akun['id_unit'],
                    'status'=>$akun['status'],
                    'hak_akses'=>$akun['hak_akses'],
                    'Email'=>$akun['Email'],
                    'id_akun'=>$akun['id_akun'],
                    'no_telp'=>$akun['No_Telp'],
                    'nama_unit'=>$akun['nama_unit'],
                    'nama_departemen'=>$akun['nama_departemen']
                );

                echo json_encode(array('success'=>true, 'data'=>$data));
            }
        }else{
            echo json_encode(array('success'=>false, 'msg'=>'Anda tidak memiliki akses ke halaman ini'));   
        }
    }else{
        echo json_encode(array('success'=>false, 'msg'=>'Anda tidak memiliki akses ke halaman ini'));
    }
    
?>