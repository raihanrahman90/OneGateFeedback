
<!------ Include the above in your HEAD tag ---------->
<?php
// Always start this first
  require_once('header_2.php');
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
                    <h1 class="h4 text-gray-900 mb-4">Ingin melakukan penghapusan Akun?</h1> 
                  </div>
                  <form class="user" method="post" onsubmit="return validasi()">
                    <div class="form-group">
                      <p>
                        Kirim email ke alamat nawang.ayunanda@ap1.co.id untuk meminta penghapusan Akun
                      </p>
                    </div>
                  </form>
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
