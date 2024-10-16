
<?php
	require_once('./new-header.php');
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
		<form method="post" action="../action/add_jawaban.php" enctype="multipart/form-data" class="position-relative" id="form">
			<div class="col-sm-10 col-sm-offset-1">
			<?php
					if(mysqli_num_rows($query)==0){
					echo '<div class="form-group">
								<div class="alert alert-warning text-center">Data tidak ditemukan</div>
							</div>';
				} else{
						?>
					<div class="row" style="margin-bottom:10px">
						<div class="col-md-12">
							<label class="pull-left text-center" style="margin-left:auto;margin-right:auto;">Customer Service</label>
							<textarea name="pertanyaan" rows="3" class="form-control" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' disabled><?php echo $pertanyaan;?></textarea>
						</div>
					</div>
					<div class="row" style="vertical-align:middle;">
						<div class="col-md-12">
							<?php
								if(!$terjawab) echo'<label>Silahkan masukkan keterangan</label>';
							?>
							<textarea name="jawaban" rows="3" class="form-control" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' <?php if($terjawab) echo 'disabled'; ?>></textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<label>Masukkan gambar jika perlu</label>
							<input type="file" name="bukti" onchange="readURL(this);"  accept='image/*' >
						</div>
					</div>
					<div class="row justify-content-end mx-3">
						<?php
						echo '<a href="./tampil_antri.php?id='.$id_aduan.'" class="btn btn-fill btn-secondary btn-wd">Kembali</a>';
						if($id_customer==$_SESSION['id_customer']){
							echo"
								<button type='submit' class='btn btn-fill btn-new-primary btn-wd'>Kirim</button>
							";
						} 
						?>
					</div>
					<?php
					echo '<input type="hidden" value="'.$link.'" name="link"></input>';
				}
			?>
			<div>
				
			</div>
		</div>
		
	</form>
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
<?php require_once("./footer.php"); ?>