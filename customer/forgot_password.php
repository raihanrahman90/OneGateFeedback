
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
  require_once('new-header.php')
?>
<form 
    id="form"
    action="../action/forgot_password.php" 
    class="col-12 col-md-8 content-centered" 
    method="post">  
    <h1 class="h4 text-gray-900 mb-4">Silahkan Masukkan Email Anda Untuk Mengubah Password</h1> 
  <div class="form-group w-100">
    <label>Email</label>
    <input type="email" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Alamat E-mail" name="E-mail" id="E-mail" required>
  </div>
  <input type="submit" value="Masuk" class="btn btn-new-primary btn-user btn-block">
  <p class="text-center mt-3">
    Sudah memiliki akun? 
    <a href="../ogfs.php" class="text-new-primary">Masuk</a>
  </p>
  <p class="text-center mt-3">
    Belum punya akun? 
    <a href="../customer/register.php" class="text-new-primary">Daftar</a>
  </p>
</form>
<?php
  require_once('./footer.php');
?>