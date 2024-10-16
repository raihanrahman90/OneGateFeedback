<?php
	session_start();
	include('../koneksi.php');
	if(isset($_SESSION)){
		if($_SESSION['status']!='login customer' && $_SESSION['status']!='login'){
		    $_SESSION['status']='nerobos';
			header("Location:../");
		}else if($_SESSION['e-mail']=='bpn.ph@ap1.co.id' || $_SESSION['e-mail']=='bpn.os@injourneyairports.id'){
		    header("Location:../customer/customer_service.php");
		}
	} else {
	    $_SESSION['status']='nerobos';
		header("Location:../");
	}
	require_once './new-header.php';
?>
	<form>
		<h1 class="new-h1">Selamat Datang di Layanan One Gate Feedback Solution Bandara SAMS Sepinggan Balikpapan</h1>
        <div class="w-100 mb-3">
          Silahkan pilih menu<br/>
          Pilih <span class="text-new-primary">Kirim Feedback</span> untuk memberikan saran, informasi, atau keluhan. <br/>
          Pilih <span class="text-new-primary">Cari Feedback</span> untuk mengetahui progres dari keluhan yang anda kirimkan
        </div>
        <a href="./aduan_customer.php" class="button-application mb-3 w-100">
          <div class="col-6 col-md-2 row align-items-center text-new-primary">
			      <i class="fa-solid fa-file-export w-100 h1"></i>
          </div>
          <div class="col d-flex flex-column justify-content-center">
            <h2 class="text-new-primary new-h1">Kirim Feeback</h2>
            <p class="text-new-dark">
				      Berikan Saran, Infomasi, atau Keluhan
            </p>
          </div>
        </a>
        <a href="./cari.php" class="button-application mb-3 w-100">
          <div class="col-6 col-md-2 row align-items-center text-new-primary">
		  	<i class="fa-solid fa-search w-100 h1"></i>
          </div>
          <div class="col d-flex flex-column justify-content-center">
            <h2 class="h-4 text-new-primary">Cari Keluhan</h2>
            <p class="text-new-dark">
				Cari keluhan
            </p>
          </div>
        </a>
		<a href="../action/logout.php" class="button-application w-100">
          <div class="col-6 col-md-2 row align-items-center text-new-primary">
			<i class="fa-solid fa-right-from-bracket w-100 h1"></i>
          </div>
          <div class="col d-flex flex-column justify-content-center">
            <h2 class="h-4 text-new-primary">Log Out</h2>
            <p class="text-new-dark">
				Keluar dari akun Anda dengan aman. Semua sesi aktif akan dihentikan, dan Anda akan diarahkan ke halaman login
            </p>
          </div>
        </a>
	</form>
<?php require_once("./footer.php"); ?>