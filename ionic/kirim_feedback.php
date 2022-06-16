<?php
    include '../koneksi.php';
    if(isset($_POST)){
        $id_aduan = $_POST['id_aduan'];
        if(isset($_POST['id_customer']) || $_POST['email']=='bpn.ph@ap1.co.id'){
            $id_customer = $_POST['id_customer'];
            $query = mysqli_query($koneksi, "SELECT * FROM tb_aduan where id_aduan='$id_aduan'") or die(mysqli_error($koneksi));
            if($row = mysqli_fetch_array($query)){
                if($row['level']!=-1){
                    $result = json_encode(array('success'=>true));
                    echo $result;
                }else{
                    if($id_customer==$row['id_customer'] || $id_customer == 0){
                        mysqli_query($koneksi, "UPDATE tb_aduan set level=0 where id_aduan='$id_aduan'") or die(mysqli_error($koneksi));
                        $level = 1;
                        $id = $id_aduan;
                        include "../pesan/kirim_pesan_admin1.php";
                        $result = json_encode(array('success'=>true));
                        echo $result;
                    }else{
                        $result = json_encode(array('success'=>false, 'msg'=>'Feedback hanya bisa dikirim oleh pengirim feedback'));
                        echo $result;
                    }
                }
            }    
        }else{
            $result = json_encode(array('success'=>false, 'msg'=>'Anda tidak memiliki akses'));
            echo $result;
        }
    }else{
        $result = json_encode(array('success'=>false, 'msg'=>'Anda tidak memiliki akses'));
        echo $result;
    }
?>