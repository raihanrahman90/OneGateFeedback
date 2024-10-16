<?php
	include('./new-header.php');
	session_start();
	/*if(isset($_SESSION)){
	    if($_SESSION['status']!="aktivasi ulang"){
	        header("Location:../");
	    } else {
	        $id_customer = $_SESSION['id_customer'];
	    }
	}else{
	    header("Location:../");
	}*/
	
?>
		                <div class="card wizard-card" data-color="blue" id="wizardProfile" padding>
		                    <form method="post" action="../action/aktivasi.php" onsubmit="return validasi();" enctype="multipart/form-data">
		                <!--        You can switch " data-color="orange" "  with one of the next bright colors: "blue", "green", "orange", "red", "azure"          -->

		                    	<div class="wizard-header text-center">
		                        	<h3 class="wizard-title">Aktivasi</h3>
		                        	<div class="alert alert-warning alert-dismissible ">
                                        Akun anda telah dinonaktifkan, mohon aktivasi kembali
                                    </div>
		                    	</div>
                                
                                    <div class="tab-pane" style="padding-left:20px;padding-right:20px;">
		                            	<div class="row">
											<div class="col-sm-12">
												<div class="form-group">
												    <label>Masukkan Id sisi darat atau foto pass bandara</label>
												    <div class="row">
    												    <div class="col-sm-6">
    													    <input type="file" id="pass_bandara" accept="image/*" name='pass_bandara' required/>
            											</div>
            											<div class="col-sm-6">
            											    <input type="number" id="id_pass_bandara" name="id_pass_bandara" class="form-control" placeholder="Masukkan Id sisi darat" required>
        										        </div>
        										    </div>
        										</div>
        									</div>
        									<div class="col-sm-12">
        									    <div class="form-group">
        									        <label>Masa berlaku pass bandara</label>
        									        <input type="date" name="masa_berlaku" class="form-control">
        									    </div>
        									</div>        										    
        									<input type="hidden" value=<?php echo '"'.$id_customer.'"'?> name="id_customer">
										</div>
									</div>
		                        <div class="wizard-footer" style="bottom:0px;">
		                            <div class="pull-right">
		                                <input type='submit' class='btn btn-finish btn-fill btn-warning btn-wd' name='finish' value='Finish' onmouseenter="validasi_pass_bandara()" />
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
	var next = document.getElementById("next");
	var pass_bandara = document.getElementById("pass_bandara");
	var id_pass_bandara = document.getElementById("id_pass_bandara");
	//mengecek apakah user mengirim foto atau mengrim id pass bandara
	function validasi_pass_bandara(){
	   if(pass_bandara.files.length==0 && (id_pass_bandara.value==0||id_pass_bandara.value=='')){
	      pass_bandara.required = true;
	      id_pass_bandara.required = true;
	  } else{
	      pass_bandara.required = false;
	      id_pass_bandara.required = false;
	  }
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

