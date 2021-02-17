<?php
	session_start();
	include('../koneksi.php');
	if(isset($_SESSION)){
		if($_SESSION['status']!='login customer' && $_SESSION['status']!='login'){
		    $_SESSION['status']='nerobos';
			header("Location:../");
		}else if($_SESSION['email']=='bpn.ph@ap1.co.id'){
		    header("Location:../customer/customer_service.php");
		}
	} else {
	    $_SESSION['status']='nerobos';
		header("Location:../");
	}
	include 'header.php';
?>
<!doctype html>

	<body class="login">
	<div class="gambar-container set-full-height">
	    <!--   Creative Tim Branding   -->
	    
	    <!--   Big container   -->
	    <div class="container">
	        <div class="row">
		        <div class="col-sm-8 col-sm-offset-2">

		            <!--      Wizard container        -->
		            <div class="wizard-container">
		            	
		                <div class="card wizard-card" data-color="blue" id="wizardProfile">
		                    <form method="post" action="../action/register.php" onsubmit="return validasi();" enctype="multipart/form-data">
		                <!--        You can switch " data-color="orange" "  with one of the next bright colors: "blue", "green", "orange", "red", "azure"          -->
								<div class="wizard-navigation" hidden>
									<div class="progress-with-circle">
									     <div class="progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="3" style="width: 21%;"></div>
									</div>
									<ul>
			                            <li>
											<a href="#about" data-toggle="tab">
												<div class="icon-circle">
													<i class="ti-bag"></i>
												</div>
												Perusahaan
											</a>
										</li>
			                            <li>
											<a href="#account" data-toggle="tab">
												<div class="icon-circle">
													<i class="ti-user"></i>
												</div>
												Personal
											</a>
										</li>
			                        </ul>
								</div>
		                        <div class="tab-content">
		                            <div class="tab-pane" id="about">
		                            	<div class="row">
											<div class="col-sm-4 col-sm-offset-1">
												<div class="picture-container">
												    <img src="../assets/logo.png" class="col-sm-12" style="width:100%;padding-top:20%;" >
												</div>
											</div>
											<div class="col-sm-6 ">
												<div class="form-group">
												    <h2 style="width:100%;padding-top:20%;">Selamat Datang di Layanan One Gate Feedback Solution Bandara SAMS Sepinggan Balikpapan</h2>
												</div>
												<div class="form-group">
													<h4>Silahkan pilih next untuk memberikan saran, informasi, atau keluhan.</h4>
												</div>
											</div>
											
										</div>
		                            </div>
		                            <div class="tab-pane" id="account">
		                                <div class="row">
											<div class="col-sm-12 col-sm-offset-0">
											    <div class="col-sm-12 text-center">
											        <h1>Silahkan pilih menu</h1>
											        <h3>
											            Pilih kirim feedback untuk memberikan saran, informasi, atau keluhan. Pilih cari Feedback untuk mengetahui progres dari keluhan yang anda kirimkan
											        </h3>
											    </div>
		                                        <div class="col-sm-6">
		                                            <div class="choice" data-toggle="wizard-checkbox">
		                                                    <a href="aduan_customer.php" style="text-decoration:none;">
		                                                <div class="card card-checkboxes card-hover-effect">
		                                                    <i class="ti-export"></i>
															<p>Kirim Feedback</p>
		                                                </div>
		                                            </a>
		                                            </div>
		                                        </div>
		                                        <div class="col-sm-6">
		                                            <div class="choice" data-toggle="wizard-checkbox">
		                                                <a href="cari.php" style="text-decoration:none;">
		                                                <div class="card card-checkboxes card-hover-effect">
		                                                    <i class="ti-search"></i>
															<p>Cari Feedback</p>
		                                                </div>
		                                            </a>
		                                            </div>
		                                        </div>
		                                    </div>
										</div>
		                            </div>
		                        </div>
		                        <div class="wizard-footer">
		                            <div class="pull-right">
		                                <input type='button' class='btn btn-next btn-fill btn-primary btn-wd' name='next' value='Next' />
		                            </div>

		                            <div class="pull-left">
		                                <input type='button' class='btn btn-secondary btn-wd' value="Logout" name="logout" onclick="window.location='../action/logout.php';"/>
		                            </div>
		                            <div class="clearfix"></div>
		                        </div>
		                    </form>
		                </div>
		            </div> <!-- wizard container -->
		        </div>
	    	</div><!-- end row -->
		</div> <!--  big container -->
		<div class="footer">
	        <div class="container text-center">
	            Made with <i class="fa fa-heart heart"></i> by <a href="https://www.creative-tim.com">Creative Tim
	        </div>
	    </div>
	</div>

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

	<!--   Core JS Files   -->
	<script src="../assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>
	<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="../assets/js/jquery.bootstrap.wizard.js" type="text/javascript"></script>

	<!--  Plugin for the Wizard -->
	<script src="../assets/js/demo.js" type="text/javascript"></script>
	<script src="../assets/js/paper-bootstrap-wizard.js" type="text/javascript"></script>

	<!--  More information about jquery.validate here: https://jqueryvalidation.org/	 -->
	<script src="../assets/js/jquery.validate.min.js" type="text/javascript"></script>

</html>
