<?php
    include "header.php";
    $email = $_POST['Email'];
    $pengecekan = mysqli_query($koneksi, "SELECT * FROM tb_customer WHERE Email='$email'") or die(mysqli_error($koneksi));
    if(mysqli_num_rows($pengecekan)>0){
        $status_akun = 'customer';
    } else {
        $pengecekan = mysqli_query($koneksi, "SELECT * FROM tb_akun WHERE Email='$email'") or die(mysqli_error($koneksi));
        if(mysqli_num_rows($pengecekan)>0){
            $status_akun = 'admin';
        } else {
            echo json_encode(array('success'=>false, 'msg'=>"Email tidak ditemukan"));
        }
    }
    if($status_akun){
        ///Mencari TOken
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            while(true){
                $randomString = '';
                for ($i = 0; $i < 6; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                $cari = mysqli_query($koneksi, "SELECT * FROM tb_forgot_password where token ='$randomString'") or die(mysqli_error($koneksi));
                if(mysqli_num_rows($cari)==0){
                    break;
                }
            }
        ///mencari token
        $token = $randomString;
        $insert = mysqli_query($koneksi, "INSERT INTO tb_forgot_password value(0,'$token','$email','$status_akun',now(),DATE_ADD(NOW(), INTERVAL 1 HOUR))") or die(mysqli_error($koneksi));
        $id = mysqli_insert_id($koneksi);
        $data = mysqli_query($koneksi, "SELECT * FROM tb_forgot_password where id='$id'") or die(mysqli_error($koneksi));
        $data = mysqli_fetch_array($data);
        if($status_akun=='admin'){
            $nama = mysqli_query($koneksi, "SELECT * FROM tb_akun where Id_akun=$id");
            if($nama = mysqli_fetch_array($nama)){
                $nama = $nama['Nama'];
            }else{
                $nama = "";
            }
        }else{
            $nama = mysqli_query($koneksi, "SELECT * FROM tb_customer where id_customer=$id");
            if($nama = mysqli_fetch_array($nama)){
                $nama = $nama['nama'];
            }else{
                $nama = "";
            }
        }
        $token = $data['token'];
        $email = $data['email'];
        $end = $data['end'];
        include "../pesan/forgot_password.php";
        echo json_encode(array('success'=>true));
    }
?>