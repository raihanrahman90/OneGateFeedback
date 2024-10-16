<?php
  session_start();
  include '../koneksi.php';
  $id_akun = $_SESSION['id_akun'];
  $cek_hak_akses = mysqli_query($koneksi, "SELECT hak_akses, id_unit, status, id_departemen from tb_akun where Id_akun = '$id_akun'") or die(mysqli_error($koneksi));
  $data = mysqli_fetch_array($cek_hak_akses);
  $_SESSION['hak_akses'] = $data['hak_akses'];
  $_SESSION['status_akun'] = $data['status'];
  $_SESSION['id_unit'] = $data['id_unit'];
  $_SESSION['id_departemen'] = $data['id_departemen'];
  if(!isset($_SESSION['status'])){
    if(isset($_GET['id'])){
        $_SESSION['id_aduan'] = $_GET['id'];
        $_SESSION['detail'] = $detail;
    }
    header("Location:../index.php");
  }else if($_SESSION['e-mail']=='bpn.ph@ap1.co.id' || $_SESSION['e-mail']){
      header("Location:../customer/customer_service.php");
  }else if($_SESSION['status']!='login'){
    $_SESSION['status']='nerobos';
    header("Location:../index.php");
  }
?>