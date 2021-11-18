<?php
    include '../koneksi.php';
    if(isset($_POST)){
        $id_aduan = $_GET['id'];
        if(isset($_POST['id_customer']) || $_POST['email']=='bpn.ph@ap1.co.id'){
            $id_customer = $_POST['id_customer'];
            $query = mysqli_query($koneksi, "SELECT * FROM tb_aduan where id_aduan='$id_aduan'") or die(mysqli_error($koneksi));
            if($row = mysqli_fetch_array($query)){
                if($row['level']!=-1){
                    $_SESSION['status_jalan']='level 0';
                    header('Location:../customer/tampil_antri.php?id='.$id_aduan);
                }else{
                    if($id_customer==$row['id_customer']){
                        mysqli_query($koneksi, "UPDATE tb_aduan set level=0 where id_aduan='$id_aduan'") or die(mysqli_error($koneksi));
                        include "../pesan/kirim_pesan_admin1.php";
                        header('Location:../customer/tampil_antri.php?id='.$id_aduan);
                    }else{
                        $result = json_encode(array('success'=>false, 'msg'=>'Status hanya bisa diakses oleh pengirim feedback'));
                        echo $result;
                    }
                }
            }    
        }else{
            $result = json_encode(array('success'=>false, 'msg'=>'Tidak memiliki akses'));
            echo $result;
        }
    }else{
        $result = json_encode(array('success'=>false, 'msg'=>'Tidak memiliki akses'));
        echo $result;
    }
?>