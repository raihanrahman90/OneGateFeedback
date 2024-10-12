
<!------ Include the above in your HEAD tag ---------->
<?php
// Always start this first
session_start();
if(isset($_SESSION['status'])){
    if($_SESSION['status']=='login'){
      if($_SESSION['e-mail']=='bpn.ph@ap1.co.id'){
        header("Location:customer/customer_service.php");
      } else{
        header("Location:Admin");
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
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="assets/css/custom.css" rel="stylesheet" />
  <link rel="icon" href="./assets/logo.png">
</head>

<body class="login">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center items-align-center w-100">

      <div class="col-xl-6 col-lg-6 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Silahkan Masuk</h1>
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
                  </div>
                  <form action="action/cek_login.php" class="user" method="post" onsubmit="return validasi()">
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Alamat E-mail" name="E-mail" id="E-mail" required>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" placeholder="Kata Sandi" name="Password" id="Password" required>
                    </div>
                    <input type="submit" value="Masuk" class="btn btn-primary btn-user btn-block">
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="customer/forgot_password.php">Lupa Kata Sandi?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="register">Buat Akun!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="assets/js/sb-admin-2.min.js"></script>

</body> 
</html>
