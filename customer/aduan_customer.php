<?php
	session_start();
	include('../koneksi.php');
	if(isset($_SESSION)){
		if($_SESSION['status']!='login customer' && $_SESSION['status']!='login'){
		    $_SESSION['status']='nerobos';
			header("Location:../");
		}
	} else {
	    $_SESSION['status']='nerobos';
		header("Location:../");
	}
include 'header.php';
?>
	<body class="login">
		<!-- Google Tag Manager (noscript) -->
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
							<noscript>
								<style type="text/css">
								form{
									display:none;
								}
								</style>
								<div  class="alert alert-danger alert-dismissible">
								Halaman web ini membutuhkan javascript untuk bekerja dengan baik, mohon aktifkan javascript pada peramban Anda. 
								</div>
							</noscript>
		                    <form method="post" action="../action/aduan_customer.php" onsubmit="return validasi();" enctype="multipart/form-data" id="myform">
		                <!--        You can switch " data-color="orange" "  with one of the next bright colors: "blue", "green", "orange", "red", "azure"          -->

		                    	<div class="wizard-header text-center">
		                        	<h3 class="wizard-title">Silahkan Isi Form</h3>
		                    	</div>

		                            <div class="tab-pane tab-content-baru" id="about">
		                            	<div class="row" style="padding-left: 15px;">
											<div class="col-sm-10 col-sm-offset-1">
												<label style="margin-bottom: 0px;">Jenis<small>(required)</small></label>
											</div>
		                            			<div class="col-sm-10 col-sm-offset-1">
													<div class='form-group'>
														<div class="col-sm-4">

																<input type="radio" name="jenis" value='Keluhan' required>
																<label>Keluhan</label>
														</div>
														<div class="col-sm-4">
																<input type="radio" name="jenis" value='Informasi'>
																<label>Informasi</label>
														</div>
														<div class="col-sm-4">
															<input type="radio" name="jenis" value='Saran'>
															<label>Saran</label>
														</div>
													</div>
												</div>
											</div>
											<div class="col-sm-10 col-sm-offset-1">
												<div class="form-group">
													<label>Jenis Urgency Feedback<small>(required)</small></label>
													<select  name="perihalUrgent" type="text" class="form-control" placeholder="Toilet" required id="perihalUrgent">
                                                        <?php
                                                            $getPerihal = mysqli_query($koneksi,"SELECT * FROM tb_urgensi");
                                                            foreach($getPerihal as $row){
                                                                echo '<option value="'.$row['perihal'].'">'.$row['perihal'].'</option>';
                                                            }
                                                        ?>
														<option value="Tidak Urgent">Lainnya</option>
                                                    </select>
													<input name="perihal" type="text" class="form-control d-none mt-3" placeholder="Isikan perihal anda" id="perihal">
												</div>
												<div class="form-group">
													<label>Keterangan<small>(required)</small></label>
													
													<textarea name="keterangan" rows="4" class="form-control" placeholder="Toilet pria mati air" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' required></textarea>
												</div>
												<div class="form-group">
												    <label>Lokasi<small>(required)</small></label>
												    <select name="lokasi" class="form-control" id="lokasi">
												        <?php
												            $query = mysqli_query($koneksi, "SELECT * from tb_lokasi") or die(mysqli_error($koneksi));
												            foreach($query as $row){
												                echo "<option value='".$row['nama_lokasi']."'>".$row['nama_lokasi']."</option>";
												            }
												        ?>
												    </select>
												</div>
												<div class="form-group">
												    <label>Detail Lokasi<small>(required)</small></label>
													<input name="detail_lokasi" type="text" class="form-control tm" placeholder="Detail Lokasi" 
														data-date-format="DD/MMM/YYYY" placeholder="dd/mm/yyyy"
														id="detail_lokasi" required>
												</div>
												<div class="form-group">
												    <label>Tanggal Kejadian<small>(required)</small></label><br/>
													<div class="form-group">
														<div class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input" name="hari" id='hari' checked />
															<label class="custom-control-label" for='hari'>3 Hari terakhir</label>
														</div>
													</div>
													<input name="tanggal_kejadian" type="text" class="form-control" 
													id="tanggal_kejadian" required />
												</div>
												<div class="form-group d-none" id="form_keterangan_kejadian">
												    <label>Keterangan Tanggal Kejadian<small>(required)</small></label><br/>
													<textarea name="keterangan_kejadian" id='keterangan_kejadian' rows="4" class="form-control" placeholder="alasan pelaporan lebih dari 3 hari" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
												</div>
												<div class="form-group">
													<label>Foto</label>
													<input name="foto" type="file">
												</div>
											</div>
										</div>
		                        <div class="wizard-footer">
		                            <div class="pull-right">
		                                <input type='submit' class='btn btn-finish btn-fill btn-primary btn-wd' name='finish' value='Kirim' />
		                            </div>
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
    <script type="text/javascript">
		function getDateString(date){
			dd = date.getDate()
			mm = date.getMonth()+1
			yy = date.getFullYear()
			if(mm<10){
				mm = "0"+mm
			}
			if(dd<10){
				dd = "0"+dd
			}
			return yy+"-"+mm+"-"+dd
		}
		$('#tanggal_kejadian').datepicker({'minDate':"-2D", 'maxDate':-0})
		$('#tanggal_kejadian').datepicker('option', 'dateFormat', 'dd/mm/yy')
	    $(document).ready(function(){
			$("#perihalUrgent").change(function(){
                 if($(this).val()=='Tidak Urgent'){
					 $('#perihal').removeClass('d-none')
					 $('#perihal').prop('required', true);
				 }else{
					$('#perihal').addClass('d-none')
					 $('#perihal').prop('required', false);
				 }
            })
			$('#hari').change(function(){
				if($('#hari').is(":checked")){
					$('#form_keterangan_kejadian').addClass('d-none')
					$('#keterangan_kejadian').prop('required', false)
					$('#tanggal_kejadian').datepicker('option', 'minDate', '-2D')
				}else{
					$('#form_keterangan_kejadian').removeClass('d-none')
					$('#keterangan_kejadian').prop('required', true)
					$('#tanggal_kejadian').datepicker('option', 'minDate', '-20Y')
				}
			})
	    });
	</script>
</body>
</html>
