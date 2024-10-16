<?php
	include('./new-header.php');
	session_start();
	if(isset($_SESSION)){
	    if($_SESSION['status']!="aktivasi ulang"){
	        header("Location:../");
	    } else {
	        $id_customer = $_SESSION['id_customer'];
	    }
	}else{
	    header("Location:../");
	}
	
?>
		<form method="post" action="../action/aktivasi.php" onsubmit="return validasi();" enctype="multipart/form-data" id="form">
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
						<div class="col-12">
							<input type='submit' class='btn btn-new-primary btn-wd' name='finish' value='Kirim' onmouseenter="validasi_pass_bandara()" />
						</div>
					</div>
				</div>
		</form>
	</div>
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
<?php require_once("./footer.php"); ?>

