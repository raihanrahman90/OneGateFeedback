<?php 
include('header.php');
?>
		                <div class="card wizard-card" data-color="blue" id="wizardProfile">
		                    <form method="post" action="../action/register.php" onsubmit="return validasi();" enctype="multipart/form-data">
		                <!--        You can switch " data-color="orange" "  with one of the next bright colors: "blue", "green", "orange", "red", "azure"          -->

		                    	<div class="wizard-header text-center">
		                        	<h3 class="wizard-title">Buat Akun</h3>
		                        	<?php
		                        		if(isset($_SESSION['status'])){
		                        			if($_SESSION['status']=='Email telah digunakan'){
		                        				echo '<div class="alert alert-warning alert-dismissible ">
													Email telah digunakan
												</div>';
												$_SESSION['status']='';
		                        			} else if($_SESSION['status']=='daftar'){
		                        				echo '<div class="alert alert-success alert-dismissible ">
                              							Kami akan konfirmasi data diri anda, silahkan tunggu e-mail konfirmasi
                          							</div>';
                          						$_SESSION['status']='';
		                        			}
		                        		} else {

		                        		}
		                        	?>
		                    	</div>

								<div class="wizard-navigation">
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
											<div class="col-sm-12">
												<div class="form-group">
													<label>Nama Perusahaan<small>(required)</small></label>
													<input name="nama_perusahaan" type="text" class="form-control" placeholder="Nama Perusahaan" required>
												</div>
												<div class="form-group">
													<label>Gerai<small>(required)</small></label>
													<input name="gerai" type="text" class="form-control" placeholder="Gerai Perusahaan" required>
												</div>
											</div>
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
											<div class="col-sm-12 text-center pull-right">
												<a href="../">Sudah memiliki Akun? Silahkan Login</a>
											</div><div class="col-sm-12 text-center pull-right">
												<a href="../customer/forgot_password.php">Lupa Password?</a>
											</div>
										</div>
		                            </div>
		                            <div class="tab-pane" id="account">
		                                <div class="row">

											<div class="col-sm-4 col-sm-offset-1">
												<div class="picture-container">
													<div class="picture">
														<img src="../assets/img/default-avatar.jpg" class="picture-src" id="wizardPicturePreview2" title="" />
														
													</div>
													<h6>Foto Anda</h6>
													<input type="file" id="wizard-picture2"name='foto' required>
												</div>
											</div>	
		                                    <div class="col-sm-6">
		                                        <div class="form-group">
		                                        	<label>Email</label>
		                                        	<input type="email" name="email" placeholder="Email" class="form-control" required>
		                                        </div>
		                                    </div>
		                                    <div class="col-sm-6">
		                                        <div class="form-group">
		                                        	<label>Nama</label>
		                                        	<input type="text" name="nama" placeholder="Nama Lengkap" class="form-control" required>
		                                        </div>
		                                    </div>
		                                    <div class="col-sm-6 col-sm-offset-5">
		                                        <div class="form-group">
		                                        	<label>No Telpon</label>
		                                        	<input type="text" name="no_telp" class="form-control" required>
		                                        </div>
		                                    </div>
		                                    <div class="col-sm-6 col-sm-offset-5">
		                                        <div class="form-group">
		                                        	<label>Password</label>
		                                        	<input type="password" name="password" class="form-control" id="password1" required>
		                                        </div>
		                                    </div>
		                                    <div class="col-sm-6 col-sm-offset-5">
		                                        <div class="form-group">
		                                        	<label>Ketik Ulang Password</label>
		                                        	<input type="password" name="password2" class="form-control float-right" id="password2" required>
		                                        </div>
		                                    </div>
		                                    
		                                </div>
		                            </div>
		                        </div>
		                        <div class="wizard-footer">
		                            <div class="pull-right">
		                                <input type='button' class='btn btn-next btn-fill btn-primary btn-wd' name='next' value='Next' id="next" onmouseenter="validasi_pass_bandara()"/>
		                                <input type='submit' class='btn btn-finish btn-fill btn-primary btn-wd' name='finish' value='Finish' />
		                            </div>

		                            <div class="pull-left">
		                                <input type='button' class='btn btn-previous btn-default btn-wd' name='previous' value='Previous' />
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
