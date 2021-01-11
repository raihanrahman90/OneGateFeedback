
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

      <div class="col-xl-8 col-lg-8 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                        <h5>Masukkan Token Anda</h5>
                        <h6>Silahkan Perika Email Anda Untuk Mendapatkan Token</h6>
                        <?php
                            if(isset($_SESSION['status_jalan'])&&($_SESSION['status_jalan']=="Token tidak ditemukan")){
                                echo "<div class='alert alert-info alert-dismissible fade show'>Token yang anda masukkan tidak valid</div>";
                                $_SESSION['status_jalan']="";
                            }
                        ?>
                  </div>
                  <form action="../action/kirim_token.php" class="user" method="post">
                    <div class="form-group">
                      <input type="token" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Masukkan Token" name="token" id="token" required>
                    </div>
                    <input type="submit" value="Ganti password" class="btn btn-primary btn-user btn-block">
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="large" href="../">Login?</a>
                  </div>
                  <div class="text-center">
                    <a class="large" href="../register">Buat Akun!</a>
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
