
<?php
	session_start();
	if(isset($_SESSION)){
		if($_SESSION['status']!='login' || $_SESSION['e-mail']!="bpn.ph@ap1.co.id"){
			header("Location:../");
		}
	} else {
		header("Location:../");
	}
	include 'header.php';
?>	
<!doctype html>
	<body class="login">
	<div class="image-container set-full-height">
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
		                <!--        You can switch " data-color="orange" "  with one of the next bright colors: "blue", "green", "orange", "red", "azure"          -->

		                    	<div class="wizard-header text-center">
		                        	<h3 class="wizard-title">Feedback</h3>
		                    	</div>

		                            <div class="tab-pane tab-content-baru" id="about">
		                            	<div class="row" style="padding-left: 15px;">
											<div class="col-sm-12 col-sm-offset-0">
		                                        <div class="col-sm-6">
		                                            <div class="choice" data-toggle="wizard-checkbox">
		                                                <a href="aduan_customer_service.php" style="text-decoration:none;">
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
		                        <div class="wizard-footer">
		                            <div class="pull-left">
		                                <a href="../action/logout.php" class='btn btn-finish btn-fill btn-secondary btn-wd'>Log Out<a>
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
