
<!------ Include the above in your HEAD tag ---------->
<?php
// Always start this first
session_start();
if(isset($_SESSION['status'])){
    if($_SESSION['status']=='login'){
      if($_SESSION['e-mail']=='bpn.ph@ap1.co.id'){
        header("Location:../customer/customer_service.php");
      } else{
        header("Location:../Admin");
      }
    }
  }
  require_once('new-header.php')
?>
                  <form action="../action/kirim_token.php" class="user" method="post">
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
                    <div class="form-group">
                      <input type="token" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Masukkan Token" name="token" id="token" required>
                    </div>
                    <input type="submit" value="Gunakan Token" class="btn btn-new-primary btn-user btn-block">
                    <div class="text-center mt-3 text-new-primary">
                      <a class="large" href="../">Login?</a>
                    </div>
                    <div class="text-center mt-3 text-new-primary">
                      <a class="large" href="../register">Buat Akun!</a>
                    </div>
                  </form>
<?php 
  require_once("./footer.php");