
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
                        <h4 class="mb-5">Silahkan Perbarui password anda</h5>
                  </div>
                  <form action="../action/ganti_password.php" onsubmit="return validasi();" class="user" method="post">
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Masukkan Password Baru" name="password1" id="password1" required>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Masukkan Lagi Password" name="password2" id="password2" required>
                    </div>
                    <input type="submit" value="Ganti Password" class="btn btn-primary btn-user btn-block">
                  </form>
                  <hr>
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
<script type="text/javascript">
	function validasi(){
		var pass1 = document.getElementById("password1");
		var pass2 = document.getElementById("password2");
		if(pass1.value!=pass2.value){
			alert("Password tidak sama");
			pass1.focus();
			return false;
		}
		return true;
	}
</script>
</html>
