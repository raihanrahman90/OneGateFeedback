
<!------ Include the above in your HEAD tag ---------->
<?php
// Always start this first
session_start();
if(isset($_SESSION['status'])){
    if($_SESSION['status']=='login'){
      if($_SESSION['e-mail']=='bpn.ph@ap1.co.id' || $_SESSION['e-mail'] == 'bpn.os@injourneyairports.id'){
        header("Location:customer/customer_service.php");
      } else{
        header("Location:./Admin/index.php");
      }
    }
  }
?>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/css/new-bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/new-custom.css" rel="stylesheet" />
  <link rel="icon" href="./assets/logo.png">
</head>
  <body>
    <div class="row position-relative vh-100 vw-100 ml-0 mr-0">
      <div class="col-md-4 col-12 bg-new-primary p-5 order-2 order-md-1 h-md-50">
        <img class="logo-top-left" src="./assets/img/logo-white.png"/>
        <div class="bottom-left text-white p-3-rem">
          <h3 class="mb-3 h4">Open Gate Feedback Solution (OGFS) - SAMS Sepinggan Airport</h3>
          <p class="font-size-1">
            All in one solution untuk meningkatkan kenyamanan Anda di Bandara SAMS Sepinggan Balikpapan
          </p>
        </div>
      </div>
      <div class="col-md col-12 p-md-5 pt-5 p-3 d-flex flex-column align-items-center justify-content-center order-1 order-md-2 content-centered">
          <div id="loading-screen">
            <div id="loading-spinner">Loading...</div>
          </div>
          <div class="logo-injourney">
            <img src="./assets/img/logo-injourney.png" class="w-100 h-100"/>
          </div>
          <form action="action/cek_login.php" 
            class="col-12 col-md-8 h-fit-content d-flex flex-column" 
            method="post" 
            onsubmit="return validasi()">
            <h1 class="new-h1 mb-3">Silahkan Masuk</h1>
            <?php 
              if(isset($_SESSION['status'])){
                if($_SESSION['status'] == "gagal login"){
                echo '<div class="alert alert-warning alert-dismissible fade show">
                      Email atau Password yang anda masukkan salah
                  </div>';
                  $_SESSION['status'] = "";
                }else if($_SESSION['status'] == "logout"){
                  echo '<div class="alert alert-info alert-dismissible fade show">
                      Anda berhasil Log out
                  </div>';
                  $_SESSION['status'] = "";
                } else if($_SESSION['status'] == 'nerobos'){
                  echo '<div class="alert alert-info alert-dismissible fade show">
                  Mohon login terlebih dahulu sebelum mengakses halaman
                  </div>';
                  $_SESSION['status'] = "";
                }else if($_SESSION['status'] == 'tidak aktif'){
                  echo '<div class="alert alert-info alert-dismissible fade show">
                  Akun anda belum dikonfirmasi oleh customer service
                  </div>';
                  $_SESSION['status'] = "";
                }else if($_SESSION['status'] == 'Forgot Password'){
                  echo '<div class="alert alert-info alert-dismissible fade show">
                  Silahkan check email anda untuk mengubah password
                  </div>';
                  $_SESSION['status'] = "";
                }else if($_SESSION['status'] == 'daftar'){
                  echo '<div class="alert alert-info alert-dismissible fade show">
                  Data anda sedang kami konfirmasi, akun anda akan aktif dalam 1x24 jam hari kerja
                  </div>';
                  $_SESSION['status'] = "";
                }
              }
            ?>
            <div class="form-group">
              <label>Email</label>
              <input type="email" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Alamat E-mail" name="E-mail" id="E-mail" required>
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" class="form-control form-control-user" placeholder="Kata Sandi" name="Password" id="Password" required>
            </div>
            <div class="row justify-content-end mr-0 mb-2">
              <a href="./customer/forgot_password.php" class="text-end text-new-primary">
                Forgot Password?
              </a>
            </div>
            <input type="submit" value="Masuk" class="btn bg-new-primary btn-user btn-block text-white">
            <p class="text-center mt-3">
              Belum punya akun? 
              <a href="./customer/register.php" class="text-new-primary">Daftar</a>
            </p>
          </form>
        </div>
      </div>
    </div>
  </body> 
</html>
