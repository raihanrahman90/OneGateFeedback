
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
	include('header.php');
?>
<!doctype html>
	<body onpageshow="myFunction()" class="login">
	<div class="image-container set-full-height">
	    <!--   Big container   -->
	    <div class="container h-100">
	        <div class="row justify-content-center">
		        <div class="col-sm-6">

		            <!--      Wizard container        -->
		            <div class="wizard-container">
		                <div class="card wizard-card-baru" data-color="blue" id="wizardProfile">
		                        <?php
		                        $id_aduan = $_GET['id'];
		                        $data1 = mysqli_query($koneksi, "SELECT *, tb_aduan.status as status_progress from tb_aduan 
                                		                        left join tb_progress on tb_aduan.id_aduan = tb_progress.id_aduan
                                		                        left join tb_detail_lokasi on tb_detail_lokasi.id_detail_lokasi = tb_aduan.id_detail_lokasi
                                		                        left join tb_lokasi on tb_detail_lokasi.id_lokasi = tb_lokasi.id_lokasi
                                		                        where tb_aduan.id_aduan = '$id_aduan'") or die(mysqli_error($koneksi));
		                        $data = mysqli_fetch_array($data1);
		                        ?>
    		                    <div class="wizard-header text-center">
		                        	<h3 class="wizard-title">Detail Antrian</h3>
		                    	</div>
		                    	<div class="col-sm-10 col-sm-offset-1">
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
		                    	                <input class="form-control" type="text" value=<?php echo "'".$data['ket']."'"?> readonly>
		                    	            </div>
		                    	            <div class="form-group col-md-12">
		                    	                <label>Lokasi</label>
		                    	                <input class="form-control" type="text" value=<?php echo "'".$data['nama_lokasi']."'"?> readonly>
		                    	            </div>
		                    	            <div class="form-group col-md-12">
		                    	                <label>Lokasi Detail</label>
		                    	                <input class="form-control" type="text" value=<?php echo "'".$data['nama_detail_lokasi']."'"?> readonly>
		                    	            </div>
		                    	            <?php
		                    	                $query = mysqli_query($koneksi, "SELECT * FROM tb_keterangan_tambahan inner join tb_aduan on tb_aduan.id_aduan = tb_keterangan_tambahan.id_aduan where tb_keterangan_tambahan.id_aduan='$id_aduan'") or die(mysqli_error($koneksi));
    		                    	            while($row = mysqli_fetch_array($query)){
    		                    	                if($row['jawaban']==null){
    		                    	                    if($row['id_customer']==$_SESSION['id_customer']){
                		                    	           echo' 
            		                    	            <div class="form-group col-md-12">
            		                    	                <label>Pertanyaan: '.$row['pertanyaan'].'</label><br>
                        		                                <a href="keterangan_tambahan.php?id='.$row['link'].'" class="btn btn-fill btn-success btn-wd">Jawab</a>
                        		                          </div>';
                        		                        }else {echo' 
            		                    	            <div class="form-group col-md-12">
            		                    	                <label>'.$row['pertanyaan'].'</label>
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
                                                            Open level 2</br>
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
                                                            Open level 3</br>
															<span class="timeline__step-subtitle">
																Keluhan telah naik ke level 3 untuk dikoordinasikan oleh Manajer
															</span></span>
                                                        
                                                        <i class="timeline__step-marker"></i>
                                                    </li>
                                                    <?php
		                    	                        if(($data['status_progress']=='Closed' || $data['status_progress']=='Complete' || $data['status_progress']=='Progress')){
															echo  "<li class='timeline__step done'>";
		                    	                        } else {
															echo  "<li class='timeline__step'>";
		                    	                        }
		                    	                    ?>
                                                        <span class="timeline__step-title">
                                                            Complete</br>
															<span class="timeline__step-subtitle">
																Keluhan ditindaklanjuti dan menunggu konfirmasi dari customer service
															</span></span>
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
		                    
		                    <div class="wizard-footer">
		                            <div class="pull-left">
		                                <a href="index.php" class='btn btn-finish btn-fill btn-secondary btn-wd'>Kembali<a>
		                            </div>
		  
		                            <?php
                                          if($level==-1){
											  if(!isset($data['id_customer'])||$data['id_customer']==$_SESSION['id_customer']){
													echo"<div class='pull-right'>
														<a href='edit_antrian.php?id=".$id_aduan."' class='btn btn-finish btn-fill btn-warning btn-wd'>Edit</a>
														<form action='../action/terima.php?id=".$id_aduan."' method='post'>
															<button type='submit' class='btn btn-finish btn-fill btn-success btn-wd'>Kirim</button>
														</form>
													</div>";
											  }
            		                      }
		                            ?>
		                            <div class="clearfix"></div>
		                        </div>
		                    	</div>
		            </div> <!-- wizard container -->
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
</body>
</html>
