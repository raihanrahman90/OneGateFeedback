<?php 
include 'header.php';
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Tambah Aduan</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
            	<form action="../action/add_aduan.php" id="my_form" method="post" enctype="multipart/form-data">
            		<table class="table" id="dataTable" width="100%" cellspacing="0">
            			<tbody>
            				<tr>
            					<td><label>Departemen</label></td>
            					<td><label>:</label></td>
            					<td>
                        <select name="Departemen" class="form-control departemen" id="departemen" required>
                          <?php
                            $departemen = mysqli_query($koneksi, "Select * from tb_departemen");
                            foreach($departemen as $row){
                              echo "<option value='".$row['id_departemen']."'>".$row['Departemen']."</option>";
                            }
                          ?>
                        </select>
                      </td>
            				</tr>
                    <tr>
                      
                    </tr>
                    <tr>
                      <div class="row">
                      <div class="col-lg-3">
                      <td><label>Divisi</label></td>
                      </div>
                      <div class="col-lg-3">
                      <td><label>:</label></td></div>
                      <div class="col-lg-6">
                      <td>
                        <select name="Divisi" class="form-control divisi" id="divisi" required>
                       "departemen">
                          <?php
                            $departemen = mysqli_query($koneksi, "Select * from tb_divisi where id_departemen=(select id_departemen from tb_departemen LIMIT 1)");
                            foreach($departemen as $row){
                              echo "<option value='".$row['id_divisi']."'>".$row['nama_divisi']."</option>";
                            }
                          ?>
                        </select>
                      </td>
                    </div>
                    </tr>
            				<tr>
                      <div class="row">
                      <div class="col-lg-3">
                      <td><label>Pelapor</label></td>
                      </div>
                      <div class="col-lg-3">
                      <td><label>:</label></td></div>
                      <div class="col-lg-6">
                      <td><input type="text" class="form-control divisi" name="pelapor" required></td></div>
                    </tr>
                    <tr>
                      <div class="row">
                      <div class="col-lg-3">
                      <td><label>Perihal</label></td>
                      </div>
                      <div class="col-lg-3">
                      <td><label>:</label></td></div>
                      <div class="col-lg-6">
                      <td><input type="text" class="form-control divisi" name="perihal" required></td></div>
                    </tr>
                    <tr>
                      <div class="row">
                      <div class="col-lg-3">
                      <td><label>Keterangan</label></td>
                      </div>
                      <div class="col-lg-3">
                      <td><label>:</label></td></div>
                      <div class="col-lg-6">
                      <td><input type="text" class="form-control divisi" name="Keterangan" required></td></div>
                    </tr>
                    
                    <tr>
                      <div class="row">
                      <div class="col-lg-3">
                      <td><label>Foto</label></td>
                      </div>
                      <div class="col-lg-3">
                      <td><label>:</label></td></div>
                      <div class="col-lg-6">
                      <td><input type="file" name="Bukti" id="foto" style='vertical-align: top;'><img id='gambar' src=<?php echo "'../gambar/aduan/".$foto."'"; ?> height=250px ></td></td>
                      </div>
                      </div>
                    </tr><tr>
                      <td colspan="3">
                        <button type="submit" class="btn btn-primary float-right">Tambah</button>                 
                      </td>
                    </tr>
            			</tbody>
            		</table>
            	</form>
            </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#gambar').attr('src', e.target.result).fadeIn('slow');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    $(document).ready(function() {
      $('#foto').change(function(){
        readURL(this);
      });
      $("#departemen" ) .change(function () {    
      var data = $('#my_form').serialize();
      $.ajax({
        type: 'POST',
        url: "../action/divisi_keluhan.php",
        data: data,
        success: function(response) {
          $("#divisi").html(response) ;
        }
      }); 
      });  
    });
      </script>
      <!-- End of Main Content -->
<?php include 'footer.php';
?>