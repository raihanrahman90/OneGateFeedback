
<?php
    include('../koneksi.php');
	session_start();
    $id_aduan = $_GET['id'];
	if(isset($_SESSION)){
		if($_SESSION['status']!='login customer' && $_SESSION['status']!='login'){
			$_SESSION['status']='nerobos';
			$_SESSION['id_aduan']=$id_aduan;
			header("Location:../");
		} else {
		    $query=mysqli_query($koneksi, "Select level from tb_aduan where id_aduan='".$id_aduan."'");
			$row = mysqli_fetch_array($query);
			if(isset($row['level'])){
				$level = $row['level'];
			}else{
				$level = -2;
			}
		}
	} else {
	    $_SESSION['status']='nerobos';
		header("Location:../");
	}
	include('./new-header.php');
?>
	
			<div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="d-flex h-100 w-100 d-flex">
					<div class="row align-self-center modal-dialog d-flex col-12 col-md-6" role="document">
						<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Ganti Nama Lokasi</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form action='../action/add_penilaian.php' method='post'>
							<div class="modal-body">
								<label>Berikan Penilaian</label><br/>
									<input type='hidden' value='0' id="nilai" name="nilai"/>
									<button id="nilai_1" type="button" class="btn penilaian"><span class='fa fa-star'></span></button>
									<button id="nilai_2" type="button" class="btn penilaian"><span class='fa fa-star'></span></button>
									<button id="nilai_3" type="button" class="btn penilaian"><span class='fa fa-star'></span></button>
									<button id="nilai_4" type="button" class="btn penilaian"><span class='fa fa-star'></span></button>
									<button id="nilai_5" type="button" class="btn penilaian"><span class='fa fa-star'></span></button>
									<br/>
									<label>Komentar</label>
									<input type='text' class='form-control' placeholder='Masukkan Komentar Anda' name='ulasan'>
									<?php echo '<input type="hidden" name="id_aduan" value="'.$id_aduan.'"/>';?>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
								<button type="submit" class="btn btn-new-primary">Kirim</button>
							</div>
						</form>
						</div>
					</div>
				</div>
			</div>
	    <!--   Big container   -->
	    <div class="container h-100 w-100 row justify-content-center align-items-center">
		        <div class="col-md-8">
		            <!--      Wizard container        -->
		                <div class="card py-3" data-color="blue" id="wizardProfile">
		                        <?php
		                        $id_aduan = $_GET['id'];
		                        $data1 = mysqli_query($koneksi, "SELECT *, tb_aduan.status as status_progress from tb_aduan 
                                		                        left join tb_progress on tb_aduan.id_aduan = tb_progress.id_aduan
																left join tb_penilaian on tb_penilaian.id_aduan = tb_aduan.id_aduan
                                		                        where tb_aduan.id_aduan = '$id_aduan'") or die(mysqli_error($koneksi));
		                        $data = mysqli_fetch_array($data1);
		                        ?>
								<h3 class="text-center">Detail Antrian</h3>
		                    	<div class="col-sm-12 col-sm-offset-1">
		                    	<?php
		                    	    if(mysqli_num_rows($data1)==0){
		                    	        echo '<div class="form-group">
		                    					    <div class="alert alert-warning text-center">Data tidak ditemukan</div>
		                    					</div>';
		                    	    } else{
		                    	        echo '<div class="form-group">';
		                    	        if(isset($_SESSION['status_jalan'])){
		                    	            if($_SESSION['status_jalan']=="baru mengirim"){
    		                    	            echo "<h5>Terima kasih atas feedback yang anda berikan, silahkan pantau tidak lanjutnya dengan nomor antrian berikut</h5>";
    		                    	            $_SESSION['status_jalan']="";
		                    	            }else if($_SESSION['status_jalan']=='bukan pengirim'){
		                    	             	echo '<div class="alert alert-warning ">Mohon login sebagai pengirim feedback untuk melakukan tindakan tersebut</div>';
    		                    	            $_SESSION['status_jalan']="";
		                    	            }else if($_SESSION['status_jalan']=='level 0'){
		                    	             	echo '<div class="alert alert-warning ">Feedback anda telah ditindak lanjutin oleh customer service</div>';
    		                    	            $_SESSION['status_jalan']="";
		                    	            }
		                    	        } else {
												if($data['status_progress'] == 'Request'){
													echo '<div class="alert alert-warning ">Terkirim</div>';
												} else if($data['status_progress']=='Closed'){
													echo '<div class="alert alert-success ">Selesai</div>';
												} else {
													echo '<div class="alert alert-info ">Diproses</div>';
												}
		                    	        }
												echo '</div>';
                                          	if($level==-1){
												/*Hanya tampil pada level -1*/
												if(!isset($data['id_customer'])||$data['id_customer']==$_SESSION['id_customer']){
													echo"<div class='form-group'>
														<label>Data aduan anda bisa diubah sampai dengan 30 menit setelah pengiriman atau klik kirim agar customer service bisa segera menindak lanjuti feedback anda</label>
													</div>";
												}
											}
		                    	        ?>
		                    	        <div class="row">
		                    	            <div class="form-group col-md-12">
		                    	                <label>No Antrian</label>
		                    	                <input class="form-control" type="text" value=<?php echo "'".$id_aduan."'"?> disabled>
		                    	            </div>
		                    	            <div class="form-group col-md-12">
		                    	                <label>Jenis</label>
		                    	                <input class="form-control" type="text" value=<?php echo "'".$data['jenis']."'"?> disabled>
		                    	            </div>
		                    	            <div class="form-group col-md-12">
		                    	                <label>Perihal</label>
		                    	                <input class="form-control" type="text" value=<?php echo "'".$data['perihal']."'"?> readonly>
		                    	            </div>
		                    	            <div class="form-group col-md-12">
		                    	                <label>Keterangan</label>
												<textarea name="keterangan" rows="4" class="form-control" placeholder="Toilet pria mati air" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' disabled><?php echo $data['ket']?></textarea>
		                    	            </div>
		                    	            <div class="form-group col-md-12">
		                    	                <label>Lokasi</label>
		                    	                <input class="form-control" type="text" value=<?php echo "'".$data['nama_lokasi']."'"?> readonly>
		                    	            </div>
		                    	            <div class="form-group col-md-12">
		                    	                <label>Lokasi Detail</label>
		                    	                <input class="form-control" type="text" value=<?php echo "'".$data['nama_detail_lokasi']."'"?> readonly>
		                    	            </div>
		                    	            <div class="form-group col-md-12">
		                    	                <label>Tanggal Kejadian</label>
												
		                    	                <input class="form-control" type="text" value=<?php echo "'".$data['waktu_kejadian']."'"?> readonly>
		                    	            </div>
											<?php
												if(!is_null($data['keterangan_kejadian'])){
													?>
													<div class="form-group col-md-12">
															<label>Keterangan Kejadian</label>
															<textarea name="keterangan_kejadian" rows="4" class="form-control" placeholder="Toilet pria mati air" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' disabled><?php echo $data['keterangan_kejadian']?></textarea>

														</div>
													<?php
												}
											?>
		                    	            <?php
		                    	                $query = mysqli_query($koneksi, "SELECT * FROM tb_keterangan_tambahan inner join tb_aduan on tb_aduan.id_aduan = tb_keterangan_tambahan.id_aduan where tb_keterangan_tambahan.id_aduan='$id_aduan'") or die(mysqli_error($koneksi));
    		                    	            while($row = mysqli_fetch_array($query)){
    		                    	                if($row['jawaban']==null){
    		                    	                    if(isset($_SESSION['id_customer']) && $row['id_customer']==$_SESSION['id_customer']){
                		                    	           echo' 
            		                    	            <div class="form-group col-md-12">
            		                    	                <label>Pertanyaan: '.$row['pertanyaan'].'</label><br>
                        		                                <a href="keterangan_tambahan.php?id='.$row['link'].'" class="btn btn-fill btn-new-primary btn-wd">Jawab</a>
                        		                          </div>';
                        		                        }else {echo' 
            		                    	            <div class="form-group col-md-12">
            		                    	                <label>'.$row['pertanyaan'].'<div class="text-danger">Silahkan Login Dengan Email Pengirim Untuk Menjawab Pertanyaan</div></label>
                        		                                <input class="form-control" type="text" value="Belum Terjawab" disabled>
                        		                            </div>';
                        		                        }
    		                    	                }else {
            		                    	           echo' 
            		                    	            <div class="form-group col-md-12">
            		                    	                <label>'.$row['pertanyaan'].'</label>';
            		                    	                if($row['bukti']) echo '<a href="../gambar/keterangan_tambahan/'.$row['bukti'].'">Lihat Foto</a>';
            		                    	                echo '<textarea class="form-control" disabled>'.$row['jawaban'].'</textarea>
            		                    	            </div>';
    		                    	                }
    		                    	            }
		                    	            ?>
		                    	            <?php if($data['foto']){
		                    	                echo'
		                    	            <div class="form-group col-md-12">
		                    	                <label>Foto</label><br>
		                    	                <img src="../gambar/aduan/'.$data['foto'].'" height="auto" width=50%>
		                    	            </div>';
		                    	            }?>
		                    	            <div class="form-group  col-md-12 padding-timeline">
		                    	                <?php
		                    	                    if($data['jenis']=='Keluhan'){
		                    	                ?>
		                    	                <ol class="timeline timeline--summary">
		                    	                    <li class='timeline__step done'>
		                    	                        <span class="timeline__step-title">
                                                            Request</br>
															<span class="timeline__step-subtitle">
																Keluhan dikirim ke customer service untuk diteruskan ke unit terkait
															</span></span>
                                                        <i class="timeline__step-marker"></i>
                                                    </li>
                                                    <?php
		                    	                        if($data['status_progress']=='Request' || $data['status_progress']=='Returned'){
		                    	                          echo  "<li class='timeline__step'>";
		                    	                        } else {
		                    	                          echo  "<li class='timeline__step done'>";
		                    	                        }
		                    	                    ?>
                                                        <span class="timeline__step-title">
                                                            Open</br>
															<span class="timeline__step-subtitle">
																Keluhan telah dikirim ke unit terkait untuk ditindaklanjuti
															</span>
														</span>
                                                
                                                        <i class="timeline__step-marker"></i>
                                                    </li>
                                                    <?php
		                    	                      if(($data['status_progress']=='Request' || $data['status_progress']=='Open' || $data['status_progress']=='Returned') && ($data['level']=="1"||$data['level']=="0" || $data['level']=='-1')){
		                    	                          echo  "<li class='timeline__step'>";
		                    	                        } else {
		                    	                          echo  "<li class='timeline__step done'>";
		                    	                        }
		                    	                    ?>
                                                        <span class="timeline__step-title">
                                                            Keluhan telah naik ke level 2</br>
															<span class="timeline__step-subtitle">
																Keluhan telah naik ke level 2 untuk dikoordinasikan oleh departemen
															</span></span>
                                                        
                                                        <i class="timeline__step-marker"></i>
                                                    </li>
                                                    <?php
		                    	                        if(($data['status_progress']=='Request' || $data['status_progress']=='Open' || $data['status_progress']=='Returned') && ($data['level']!="3" && $data['level']!='4')){
		                    	                          echo  "<li class='timeline__step'>";
		                    	                        } else {
		                    	                          echo  "<li class='timeline__step done'>";
		                    	                        }
		                    	                    ?>
                                                        <span class="timeline__step-title">
                                                            Keluhan telah naik ke level 3</br>
															<span class="timeline__step-subtitle">
																Keluhan telah naik ke level 3 untuk dikoordinasikan oleh Manajer
															</span>
														</span>
                                                        <i class="timeline__step-marker"></i>
                                                    </li>
														<?php
															if(($data['status_progress']=='Closed' || $data['status_progress']=='Complete' || $data['status_progress']=='Progress')){
																echo  "<li class='timeline__step done'>";
																$progres = true;
															} else {
																echo  "<li class='timeline__step'>";
																$progres = false;
															}
														?>
                                                        <span class="timeline__step-title">
															Progress
															<?php 
																//picture progres if exist
																if($progres){
																	$gambar= mysqli_query($koneksi, "SELECT * FROM tb_progress 
																									where id_aduan='$id_aduan' and 
																									tindakan like 'Feedback direspons oleh unit dengan keterangan%'
																									order by id_progress desc") or die(mysqli_error($koneksi));
																	if($gambar = mysqli_fetch_array($gambar)){
																		if(!is_null($gambar['bukti'])){
																			echo '<a href="../gambar/bukti/'.$gambar['bukti'].'" class="btn btn-success">Bukti</a>';
																		}
																	}
																}
																//picture progres if exist
															?>
															</br>
															<?php 
																$progresQuery= mysqli_query($koneksi, "SELECT * FROM tb_progress 
																								where id_aduan='$id_aduan' and 
																								tindakan like 'Feedback direspons oleh unit dengan keterangan%'
																								order by id_progress desc") or die(mysqli_error($koneksi));
																if($progres = mysqli_fetch_array($progresQuery)){
																	echo 
																	'<span class="timeline__step-subtitle">
																		'.$progres['tindakan'].'
																	</span></span>';
																}else{
																	echo 
																	'<span class="timeline__step-subtitle">
																		Keluhan sedang diproses oleh unit terkait
																	</span></span>';
																}
															?>
															
                                                        <i class="timeline__step-marker"></i>
                                                    </li> <?php
		                    	                        if(($data['status_progress']=='Closed' || $data['status_progress']=='Complete')){
															echo  "<li class='timeline__step done'>";
															$selesai = true;
		                    	                        } else {
															echo  "<li class='timeline__step'>";
															$selesai = false;
		                    	                        }
		                    	                    ?>
                                                        <span class="timeline__step-title">
															Complete
															<?php 
																//picture complete if exist
																if($selesai){
																	$gambar= mysqli_query($koneksi, "SELECT * FROM tb_progress 
																									where id_aduan='$id_aduan' and 
																									tindakan like 'Feedback telah selesai%'
																									order by id_progress desc") or die(mysqli_error($koneksi));
																	if($gambar = mysqli_fetch_array($gambar)){
																		if(!is_null($gambar['bukti'])){
																			echo '<a href="../gambar/bukti/'.$gambar['bukti'].'" class="btn btn-success">Bukti</a>';
																		}
																	}
																}
																//picture complete if exist
															?>
															</br>
															
															<?php 
															// dinamis teks for complete
																$completeQuery= mysqli_query($koneksi, "SELECT * FROM tb_progress 
																								where id_aduan='$id_aduan' and 
																								tindakan like 'Feedback telah selesai%'
																								order by id_progress desc") or die(mysqli_error($koneksi));
																if($complete = mysqli_fetch_array($completeQuery)){
																	echo 
																	'<span class="timeline__step-subtitle">
																		'.$complete['tindakan'].'
																	</span></span>';
																}else{
																	echo 
																	'<span class="timeline__step-subtitle">
																	Keluhan ditindaklanjuti dan menunggu konfirmasi dari customer service
																	</span></span>';
																}
																// end dinamis teks for complete
															?>
                                                        <i class="timeline__step-marker"></i>
                                                    </li>
                                                    <?php
		                    	                        if(($data['status_progress']=='Closed')){
		                    	                          echo  "<li class='timeline__step done'>";
		                    	                        } else {
		                    	                          echo  "<li class='timeline__step'>";
		                    	                        }
		                    	                    ?>
                                                        <span class="timeline__step-title">
                                                            Closed</br>
															<span class="timeline__step-subtitle">
																Keluhan telah ditutup oleh customer service
															</span></span>
                                                        <i class="timeline__step-marker"></i>
                                                    </li>
                                                </ol>
                                                <?php
		                    	                    } else {
                                                ?>
                                                <ol class="timeline timeline--summary">
		                    	                    <li class='timeline__step done'>
		                    	                        <span class="timeline__step-title">
                                                            Terkirim</span>
                                                        <i class="timeline__step-marker"></i>
                                                    </li>
                                                    <li class='timeline__step done'>
		                    	                        <span class="timeline__step-title">
                                                            Diterima</span>
                                                        <i class="timeline__step-marker"></i>
                                                    </li>
                                                </ol>
                                                <?php
		                    	                    }
                                                ?>
		                    	            </div>
		                    	            
		                    	        </div>
		                    	        <?php
		                    	    }
		                    	?>
		                    
		  
					<?php
					/**Button Penilaian */
					if(mysqli_num_rows($data1)!=0 && isset($_SESSION['id_customer'])&&
						$data['id_customer']==$_SESSION['id_customer'] && is_null($data['ulasan']) 
						&& $data['status']=='Closed' && $data['level']>-1	){
						echo '<div class="pull-right">
						<button type="button" class="btn btn-new-primary w-100 btn-icon-split" data-toggle="modal" data-target="#exampleModal">
							<span class="icon text-white-50">
								<i class="fas fa-star"></i>
							</span>
							<span class="text">
								Beri Penilaian
							</span>
						</button>
					</div>';
					}
						
					/**Button penilaian */
					/**button  edit */
						if($level==-1){
							if(!isset($data['id_customer'])||$data['id_customer']==$_SESSION['id_customer']){
								echo"
									<a href='edit_antrian.php?id=".$id_aduan."' class='btn btn-finish btn-fill btn-warning btn-wd w-100 mt-3'>Edit</a>
									<form action='../action/terima.php?id=".$id_aduan."' method='post' id='kirim-sekarang'>
										<button type='submit' class='btn btn-new-primary w-100 mt-3'>Kirim Sekarang</button>
									</form>";
							}
						}
					?>
					<a href="index.php" class='btn btn-finish btn-fill btn-secondary btn-wd w-100 mt-3'>Kembali<a>
					<div class="clearfix"></div>
		        </div>
	    	</div><!-- end row -->
			<script >
        if (window.name == "reloader") {
            window.name = "";
            location.reload();
        }

        window.onbeforeunload = function() {
            window.name = "reloader"; 
        }
    </script>
	
	<script src="../vendor/jquery/jquery.min.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Core plugin JavaScript-->
	<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="../assets/js/sb-admin-2.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			
			$('#kirim-sekarang').on('submit', function() {
        // Show the loading screen
            	$('#loading-screen').addClass("d-block");
        	});
			$('#nilai_1').click(function(){
				$('#nilai').val(1)
				$('#nilai_1').addClass('penilaian-checked')
				$('#nilai_2').removeClass('penilaian-checked')
				$('#nilai_3').removeClass('penilaian-checked')
				$('#nilai_4').removeClass('penilaian-checked')
				$('#nilai_5').removeClass('penilaian-checked')
			})
			$('#nilai_2').click(function(){
				$('#nilai').val(2)
				$('#nilai_1').addClass('penilaian-checked')
				$('#nilai_2').addClass('penilaian-checked')
				$('#nilai_3').removeClass('penilaian-checked')
				$('#nilai_4').removeClass('penilaian-checked')
				$('#nilai_5').removeClass('penilaian-checked')
			})
			$('#nilai_3').click(function(){
				$('#nilai').val(3)
				$('#nilai_1').addClass('penilaian-checked')
				$('#nilai_2').addClass('penilaian-checked')
				$('#nilai_3').addClass('penilaian-checked')
				$('#nilai_4').removeClass('penilaian-checked')
				$('#nilai_5').removeClass('penilaian-checked')
			})
			$('#nilai_4').click(function(){
				$('#nilai').val(4)
				$('#nilai_1').addClass('penilaian-checked')
				$('#nilai_2').addClass('penilaian-checked')
				$('#nilai_3').addClass('penilaian-checked')
				$('#nilai_4').addClass('penilaian-checked')
				$('#nilai_5').removeClass('penilaian-checked')
			})
			$('#nilai_5').click(function(){
				$('#nilai').val(5)
				$('#nilai_1').addClass('penilaian-checked')
				$('#nilai_2').addClass('penilaian-checked')
				$('#nilai_3').addClass('penilaian-checked')
				$('#nilai_4').addClass('penilaian-checked')
				$('#nilai_5').addClass('penilaian-checked')
			})
		})
	</script>

<?php require_once("./footer.php"); ?>