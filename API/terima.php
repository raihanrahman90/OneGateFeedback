<?php
    session_start();
    include '../koneksi.php';
    if(isset($TOKEN)){
        $id_aduan = $_GET['id'];
        if(isset($TOKEN['id_customer']) || $TOKEN['email']=='bpn.ph@ap1.co.id'){
            $id_customer = $TOKEN['id_customer'];
            $query = mysqli_query($koneksi, "SELECT * FROM tb_aduan where id_aduan='$id_aduan'") or die(mysqli_error($koneksi));
            if($row = mysqli_fetch_array($query)){
                if($row['level']!=-1){
                    $TOKEN['status_jalan']='level 0';
                    header('Location:../customer/tampil_antri.php?id='.$id_aduan);
                }else{
                    if($id_customer==$row['id_customer']){
                        mysqli_query($koneksi, "UPDATE tb_aduan set level=0 where id_aduan='$id_aduan'") or die(mysqli_error($koneksi));
                        include "../pesan/kirim_pesan_admin1.php";
                        header('Location:../customer/tampil_antri.php?id='.$id_aduan);
                    }else{
                        $TOKEN['status_jalan'] = 'bukan pengirim';        
                        header('Location:../customer/tampil_antri.php?id='.$id_aduan);
                    }
                }
            }    
        }else{
            echo 'Mohon login sebagai customer';
        }
    }else{
        $TOKEN['status'] = 'nerobos';
        header('Location:../');
    }
?>