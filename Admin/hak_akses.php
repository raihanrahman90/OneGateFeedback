<?php
  session_start();
  include '../koneksi.php';
  if(!isset($_SESSION['status'])){
    header("Location:../index.php");
  }else if($_SESSION['e-mail']=='bpn.ph@ap1.co.id'){
      header("Location:../customer/customer_service.php");
    }else if($_SESSION['status']!='login'){
    $_SESSION['status']='nerobos';
    header("Location:../index.php");
  }
?>