
<?php
    include('../koneksi.php');
	session_start();
    $id_aduan = $_GET['id'];
	if(isset($_SESSION)){
		if($_SESSION['status']!='login customer' && $_SESSION['status']!='login'){
		    $_SESSION['status']='nerobos';
			header("Location:../");
		} else {
		    $query=mysqli_query($koneksi, "Select *, now() as sekarang, tb_aduan.id_detail_lokasi as detail_lokasi_id, tb_detail_lokasi.id_lokasi as lokasi_id 
		    from tb_aduan 
		    inner join tb_detail_lokasi on tb_detail_lokasi.id_detail_lokasi = tb_aduan.id_detail_lokasi
		    inner join tb_lokasi on tb_lokasi.id_lokasi = tb_detail_lokasi.id_lokasi
		    where id_aduan='".$id_aduan."'") or die(mysqli_error($koneksi));
		    if($row1 = mysqli_fetch_array($query)){
		        if($_SESSION['id_customer']!=$row1['id_customer']){
		            $_SESSION['status']='nerobos';
			        header("Location:../");
		        }
		    }else{
		        $status=false;
		    }
		}
	} else {
	    $_SESSION['status']='nerobos';
		header("Location:../");
	}
	include('header.php');
?>
<!doctype html>
	<body class="login">
	<div class="image-container set-full-height">
	    <!--   Big container   -->
	    <div class="container">
	        <div class="row">
		        <div class="col-sm-6 col-sm-offset-3">

		            <!--      Wizard container        -->
		            <div class="wizard-container">
		                <div class="card wizard-card-baru" data-color="blue" id="wizardProfile">
		                    <form method="post" action="../action/edit_aduan.php" onsubmit="return validasi();" enctype="multipart/form-data" id="myform">
		                        <?php
		                        $id_aduan = $_GET['id'];
		                        $data1 = mysqli_query($koneksi, "SELECT *, tb_aduan.status as status_progress from tb_aduan 
		                        left join tb_progress on tb_aduan.id_aduan = tb_progress.id_aduan
		                        where tb_aduan.id_aduan = '$id_aduan'") or die(mysqli_error($koneksi));
		                        $data = mysqli_fetch_array($data1);
		                        ?>
    		                    <div class="wizard-header text-center">
		                        	<h3 class="wizard-title">Edit Antrian</h3>
		                    	</div>
		                    	<div class="col-sm-10 col-sm-offset-1">
		                    	<?php
		                    	    if(mysqli_num_rows($data1)==0){
		                    	        echo '<div class="form-group">
		                    					    <div class="alert alert-warning text-center">Data tidak ditemukan</div>
		                    					</div>';
		                    	    } else{
		                    	        ?>
		                    	        
											<div class="col-sm-12">
												<label style="margin-bottom: 0px;">Jenis<small>(required)</small></label>
											</div>
		                            			<div class="col-sm-10 col-sm-offset-1">
													<div class='form-group'>
														<div class="col-sm-4">
																<input type="radio" name="jenis" value='Keluhan' <?php if($row1['jenis']=='Keluhan') echo 'checked'; ?> required >
																<label>Keluhan</label>
														</div>
														<div class="col-sm-4">
																<input type="radio" name="jenis" value='Informasi' <?php if($row1['jenis']=='Informasi') echo 'checked'; ?> >
																<label>Informasi</label>
														</div>
														<div class="col-sm-4">
															<input type="radio" name="jenis" value='Saran' <?php if($row1['jenis']=='Saran') echo 'checked';?> >
															<label>Saran</label>
														</div>
													</div>
												</div>
											<div class="col-sm-12">
												<div class="form-group">
													<label>Jenis Urgensitas Feedback<small>(required)</small></label>
													<select  name="perihalUrgent" type="text" class="form-control" placeholder="Toilet" required id="perihalUrgent">
                                                        <?php
                                                            $getPerihal = mysqli_query($koneksi,"SELECT * FROM tb_urgensi");
                                                            foreach($getPerihal as $row){
																#jika urgent salah, maka semua yang di dalam tb_urgensitas tidak memiliki nilai selected
																#jika urgent, maka salah satu dari $row adalah selected
																if($row['urgensi']==1 && $row['perihal']==$row1['perihal']){
																	echo '<option value="'.$row['perihal'].'" selected>'.$row['perihal'].'</option>';
																}else{
																	echo '<option value="'.$row['perihal'].'">'.$row['perihal'].'</option>';
																}
															}
															#memerika apakah perihal adalah urgent
															if($row1['urgensi']==0){
																echo '<option value="Tidak Urgent" selected>Lainnya</option>';
															}else{
																echo '<option value="Tidak Urgent">Lainnya</option>';
															}
                                                        ?>
                                                    </select>
													<?php
														if($row1['urgensi']==0){
															echo '<input name="perihal" type="text" class="form-control mt-3 placholder="Isikan Perihal Anda" id="perihal" value="'.$row1['perihal'].'">';
														}else{
															echo '<input name="perihal" type="text" class="form-control d-none mt-3 placholder="Isikan Perihal Anda" id="perihal">';	
														}
													?>
												</div>
												<div class="form-group">
													<label>Keterangan<small>(required)</small></label>
													<input name="keterangan" type="text" class="form-control" placeholder="Toilet pria mati air" value=<?php echo '"'.$row1['ket'].'"'?> required>
												</div>
												<div class="form-group">
												    <label>Lokasi<small>(required)</small></label>
												    <select name="lokasi" class="form-control" id="lokasi">
												        <?php
												            $query = mysqli_query($koneksi, "SELECT * from tb_lokasi") or die(mysqli_error($koneksi));
												            foreach($query as $row){
												                if($row['id_lokasi']==$row1['lokasi_id']){
												                    echo "<option value='".$row['id_lokasi']."' selected>".$row['nama_lokasi']."</option>";
												                }else {
												                    echo "<option value='".$row['id_lokasi']."'>".$row['nama_lokasi']."</option>";
												                }
												            }
												        ?>
												    </select>
												</div>
												<div class="form-group">
												    <label>Detail Lokasi<small>(required)</small></label>
												    <select name="detail-lokasi" class="form-control" id="detail-lokasi">
												        <?php
                                                        $departemen = mysqli_query($koneksi, "Select * from tb_detail_lokasi where id_lokasi='".$row1['lokasi_id']."'");
                                                        foreach($departemen as $row){
                                                          if($row['id_detail_lokasi']==$row1['detail_lokasi_id']){
												                    echo "<option value='".$row['id_detail_lokasi']."' selected>".$row['nama_detail_lokasi']."</option>";
												                }else {
												                    echo "<option value='".$row['id_detail_lokasi']."'>".$row['nama_detail_lokasi']."</option>";
												                }
                                                        }
                                                      ?>
												    </select>
												</div>
												<div class="form-group">
													<label>Foto</label>
													<input name="foto" type="file">
												</div>
											</div>
		                    	            <input type='hidden' name='id_aduan' value=<?php echo '"'.$id_aduan.'"'?>
		                    	        </div>
		                    	        <?php
		                    	    }
		                    	?>
		                    	</div>
		                    <div class="wizard-footer">
		                            
		                            <?php
		                            echo "<div class='pull-left'>
		                                <a href='tampil_antri.php?id=".$id_aduan."' class='btn btn-finish btn-fill btn-secondary btn-wd'>Batal</a>
		                            </div>";
    		                              $d1 = new DateTime($row1['waktu_kirim']);
                                          $d2 = new DateTime($row1['sekarang']);
                                          $interval = $d2->diff($d1);
                                          $interval = $interval->h;
                                          if($interval<1 && $data['id_customer']==$_SESSION['id_customer']){
                                          echo"<div class='pull-right'>
            		                                <button type='submit' class='btn btn-finish btn-fill btn-warning btn-wd'>Simpan</button>
            		                            </div>";
                                          } 
		                            ?>
		                            <div class="clearfix"></div>
		                        </div>
		                
		                    </form>
		            </div> <!-- wizard container -->
		        </div>
	    	</div><!-- end row -->

			<script type="text/javascript">
	    $(document).ready(function(){
	       $("#lokasi" ).change(function () {    
              var data = $('#myform').serialize();
              $.ajax({
                type: 'POST',
                url: "../action/options_lokasi.php",
                data: data,
                success: function(response) {
                  $("#detail-lokasi").html(response) ;
                }
              }); 
            }); 
			$("#perihalUrgent").change(function(){
                 if($(this).val()=='Tidak Urgent'){
					 $('#perihal').removeClass('d-none')
					 $('#perihal').prop('required', true);
				 }else{
					$('#perihal').addClass('d-none')
					 $('#perihal').prop('required', false);
				 }
            })
	    });
	</script>
</body>
</html>

