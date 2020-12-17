<?php
	session_start();
	include('../koneksi.php');
	if(isset($_SESSION)){
		if($_SESSION['status']!='login customer' && $_SESSION['status']!='login'){
			header("Location:../register");
		}
	} else {
		header("Location:../");
	}
?>
<!doctype html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png" />
	<link rel="icon" type="image/png" href="assets/img/favicon.png" />
	<title>Aduan</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
	<!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="../assets/css/paper-bootstrap-wizard.css" rel="stylesheet" />

	<link href="../assets/css/themify-icons.css" rel="stylesheet">

	</head>

	<body>
	<div class="image-container set-full-height" style="background-image: linear-gradient(180deg, #7395fa 10%, #224abe 100%);">
	    <!--   Creative Tim Branding   -->
	    

		<!--  Made With Paper Kit  -->
	    <!--   Big container   -->
	    <div class="container">
	        <div class="row">
		        <div class="col-sm-6 col-sm-offset-3">

		            <!--      Wizard container        -->
		            <div class="wizard-container">
		            	
		                <div class="card wizard-card" data-color="blue" id="wizardProfile">
		                    <form method="post" action="../action/register.php" onsubmit="return validasi();">
		                    	<?php
		                    	$id = $_GET['id'];
		                    	$data = mysqli_query($koneksi, "SELECT * FROM tb_aduan LEFT JOIN tb_progress ON tb_aduan.id_aduan = tb_progress.id_progress LEFT JOIN tb_customer on tb_customer.id_customer=tb_aduan.id_akun WHERE tb_aduan.id_aduan = '$id'") or die(mysqli_error($koneksi));
		                    	$data = mysqli_fetch_all($data, MYSQLI_NUM);
		                    	?>

		                    	<div class="wizard-header text-center">
		                        	<h3 class="wizard-title">Detail Antrian</h3>
		                    	</div>
		                            <div class="tab-pane tab-content-baru" id="about">
		                    		<div class="col-sm-10 col-sm-offset-1">
		                    			<div class="form-group">
												<label>Status</label></div>
		                            		<div class="col-sm-10 col-sm-offset-1">
												<div class='form-group'>
													<label>Data anda sudah kami terima,mohon menunggu proses konfirmasi. 
													Setelah konfirmasi selesai, anda akan diberitahu melalui Email dalam kurun waktu 1x24 jam(hari kerja)</label>
												</div>
											</div>
										</div>
									</div>
		                        <div class="wizard-footer">
		                            <div class="pull-left">
		                                <a href="index.php" class='btn btn-finish btn-fill btn-secondary btn-wd'>Kembali<a>
		                            </div>
		                            <div class="clearfix"></div>
		                        </div>
		                    </form>
		                </div>
		            </div> <!-- wizard container -->
		        </div>
	    	</div><!-- end row -->
		</div> <!--  big container -->
	</div>

</body>
</html>
