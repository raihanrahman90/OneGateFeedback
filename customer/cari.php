<?php
	session_start();
    include 'header.php';
?>
	<style>
		.search_icon {
			float: right;border-radius: 50%;width:40px;height: 40px
			}
		.search_icon:hover{
			color:white;
		}

		.search_icon:active{
			color:blue;
		}
		.search_input {
			padding: 0 10px;
			width: 75%;
			caret-color:red;
			color: white;
			border: 0;
			outline: 0;
			background: none;
			line-height: 40px;
			caret-color:white;
		}
		.searchbar {
			margin-bottom: auto;
			margin-top: auto;
			height: 60px;
			background-color: #353b48;
			border-radius: 30px;
			padding: 10px;
		}
	</style>

	<body class="login">
	    <!--   Big container   -->
	    <div class="container">
	        <div class="row">
		        <div class="col-sm-6 col-sm-offset-3">

		            <!--      Wizard container        -->
		            <div class="wizard-container pt-0">
		                <div class="card wizard-card-baru" data-color="blue" id="wizardProfile">
		                <!--        You can switch " data-color="orange" "  with one of the next bright colors: "blue", "green", "orange", "red", "azure"          -->
							<div class="wizard-header text-center">
								<h3 class="wizard-title">Feedback</h3>
							</div>
							<div class="tab-pane tab-content-baru" id="about">
								<div class="row" style="padding-left: 15px;">
									<div class="col-sm-12 col-sm-offset-0">	
									<form method="get" action="tampil_antri.php">
										<div class="searchbar">
											<input class="search_input" type="text" name="id" placeholder="No Antrian">
											<button class="search_icon fa fa-search"></button>
										</div>
										
									</form>
									</div>
								</div>
							</div>
							<div class="wizard-footer-baru">
								<div class="pull-left">
									<a href="index.php" class='btn btn-finish btn-fill btn-secondary btn-wd'>Kembali<a>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
		            </div> <!-- wizard container -->
		        </div>
	    	</div><!-- end row -->
		</div> <!--  big container -->

	</body>
</html>
