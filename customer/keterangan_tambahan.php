
<?php
    include('../koneksi.php');
	session_start();
    $id_aduan = $_GET['id'];
	if(isset($_SESSION)){
		if($_SESSION['status']!='login customer' && $_SESSION['status']!='login'){
		    $_SESSION['status']='nerobos';
			header("Location:../");
		}
	} else {
	    $_SESSION['status']='nerobos';
		header("Location:../");
	}
	include('header.php');
	$link = $_GET['id'];
	$query = mysqli_query($koneksi, "SELECT * FROM tb_keterangan_tambahan inner join tb_aduan on tb_aduan.id_aduan = tb_keterangan_tambahan.id_aduan where tb_keterangan_tambahan.link='$link'") or die(mysqli_error($koneksi));
    
    if($row = mysqli_fetch_array($query)){
        $id_aduan = $row['id_aduan'];
        $pertanyaan = $row['pertanyaan'];
        $id_customer = $row['id_customer'];
        if(!isset($_SESSION['jawaban'])){
            $terjawab = false;
        }else {
            header("Location:../customer/tampil_antri.php?id=".$id_aduan);
        }
    }
?>
<style>
    img{
  max-width:180px;
}
</style>
<!doctype html>
	<body onpageshow="myFunction()" class="login">
	<div class="image-container set-full-height">
	    <!--   Big container   -->
	    <div class="container">
	        <div class="row">
		        <div class="col-sm-6 col-sm-offset-3">

		            <!--      Wizard container        -->
		            <div class="wizard-container">
		                <div class="card wizard-card-baru" data-color="blue" id="wizardProfile" style='min-height:250px'>
		                    <form method="post" action="../action/add_jawaban.php" enctype="multipart/form-data">
		                        <div class="wizard-header text-center">
		                        	<h3 class="wizard-title">Keterangan Tambahan</h3>
		                    	</div>
		                    	<div class="col-sm-10 col-sm-offset-1">
		                    	<?php
		                    	     if(mysqli_num_rows($query)==0){
		                    	        echo '<div class="form-group">
		                    					    <div class="alert alert-warning text-center">Data tidak ditemukan</div>
		                    					</div>';
		                    	    } else{
		                    	            ?>
		                    	            <div class="row" style="margin-bottom:10px">
		                    	            <div class="col-md-4 my-auto">
		                    	                <div class="row col-md-12">
		                    	                    <span class="fa fa-user text-center" style="font-size:30px;float:left;margin-left:auto;margin-right:auto;"></span>
		                    	                </div>
		                    	                <div class="row col-md-12">
		                    	                    <label class="pull-left text-center" style="margin-left:auto;margin-right:auto;">Customer Service</label>
		                    	                </div>
		                    	            </div>
		                    	            <div class="col-md-8">
		                    	                <textarea name="pertanyaan" rows="4" class="form-control" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' disabled><?php echo $pertanyaan;?></textarea>
		                    	            </div>
		                    	        </div>
		                    	        <div class="row">
		                    	            <div class="col-sm-8 offset-md-4">
		                    	            <?php
		                    	                    if(!$terjawab) echo'<label>Silahkan masukkan keterangan</label>';
		                    	             ?>
		                    	             </div>
		                    	        </div>
		                    	        <div class="row" style="vertical-align:middle;">
		                    	            <div class="col-md-4 my-auto">
		                    	                <div class="row col-md-12">
		                    	                    <span class="fa fa-user text-center" style="font-size:30px;float:left;margin-left:auto;margin-right:auto;"></span>
		                    	                </div>
		                    	                <div class="row col-md-12">
		                    	                    <label class="pull-left text-center" style="margin-left:auto;margin-right:auto;">User</label>
		                    	                </div>
		                    	            </div>
		                    	            <div class="col-md-8">
		                    	                
		                    	                <textarea name="jawaban" rows="4" class="form-control" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' <?php if($terjawab) echo 'disabled'; ?>></textarea>
		                    	            </div>
		                    	        </div>
		                    	        <div class="row" style="margin-bottom:50px;">
		                    	            <div class="col-md-8 offset-md-4 form-group pull-right">
		                    	                <label>Masukkan gambar jika perlu</label>
		                    	                <input type="file" name="bukti" onchange="readURL(this);"  accept='image/*' >
		                    	                <img id="blah" src="http://placehold.it/180" alt="your image" />
		                    	            </div>
		                    	        </div>
		                    	        
		                    	        <?php
		                    	        echo '<input type="hidden" value="'.$link.'" name="link"></input>';
		                    	    }
		                    	?>
		                        
		                    </div>
		                    <div class="wizard-footer" style="position:absolute;bottom:10px;padding-left:20px;padding-right:20px;width:100%;">
		                            <?php
                                          if($id_customer==$_SESSION['id_customer']){
                                                echo"<div class='pull-right'>
            		                                <button type='submit' class='btn btn-finish btn-fill btn-primary btn-wd' name='next' value='Next' >Kirim</a>
            		                            </div>";
            		                      } 
		                            ?>
		                            <div class="pull-left">
		                                <?php
		                                    echo '<a href="tampil_antri.php?id='.$id_aduan.'" class="btn btn-finish btn-fill btn-secondary btn-wd">Kembali<a>'      
		                                ?>
		                            </div>
		                        <div class="clearfix"></div>
		                </form>
		            </div> <!-- wizard container -->
		        </div>
	    	</div><!-- end row -->
    <script >
     function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
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
