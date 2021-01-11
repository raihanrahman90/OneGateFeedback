
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
require_once('header_2.php')
?>

<body class="bg-gradient-primary login">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-6 col-lg-6 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Silahkan Masukkan Email Anda Untuk Mengubah Password</h1> 
                  </div>
                  <form action="../action/forgot_password.php" class="user" method="post" onsubmit="return validasi()">
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Alamat E-mail" name="E-mail" id="E-mail" required>
                    </div>
                    <input type="submit" value="Masuk" class="btn btn-primary btn-user btn-block">
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="../">Sudah memiiliki Akun?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="../register">Buat Akun!</a>
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
  <script src="js/sb-admin-2.min.js"></script>

</body> 
</html>
